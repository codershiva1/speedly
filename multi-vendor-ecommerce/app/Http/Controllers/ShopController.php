<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('images', 'categories', 'brand')
            ->where('status', 'active');

        $search = $request->input('q');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $selectedCategory = $request->input('category');
        if ($selectedCategory) {
            $query->where(function ($mainQuery) use ($selectedCategory) {

                // 1. Pivot table match
                $mainQuery->whereHas('categories', function ($q) use ($selectedCategory) {
                    $q->where('slug', $selectedCategory);
                });

                // 2. Fallback to category_id
                $mainQuery->orWhereHas('category', function ($q) use ($selectedCategory) {
                    $q->where('slug', $selectedCategory);
                });

            });

        }

        $minPrice = $request->input('min_price');
        if ($minPrice !== null && $minPrice !== '') {
            $query->where('price', '>=', (float) $minPrice);
        }

        $maxPrice = $request->input('max_price');
        if ($maxPrice !== null && $maxPrice !== '') {
            $query->where('price', '<=', (float) $maxPrice);
        }

        // Apply Sorting
        $sort = $request->input('sort');
        if ($sort === 'price_low_high') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_high_low') {
            $query->orderBy('price', 'desc');
        } else {
            // Default or 'latest'
            $query->latest();
        }

        $products = $query
            ->paginate(12)
            ->withQueryString();

        $categories = Category::where('status', 'active')
            ->orderBy('name')
            ->get();

        if ($selectedCategory) {
            $currentCat = $categories->firstWhere('slug', $selectedCategory);
            if ($currentCat) {
                $categories = $categories->sortBy(function ($c) use ($currentCat) {
                    // 1. Current category always first
                    if ($c->id === $currentCat->id) return 0;
                    
                    // 2. If current is a parent, prioritize its children
                    if (is_null($currentCat->parent_id)) {
                        if ($c->parent_id === $currentCat->id) return 1;
                    } 
                    // 3. If current is a child, prioritize its siblings (same parent)
                    else {
                        if ($c->parent_id === $currentCat->parent_id) return 1;
                        if ($c->id === $currentCat->parent_id) return 1; // Also show the parent itself high up
                    }

                    // 4. Everything else
                    return 2;
                })->values();
            }
        }

        $featuredProducts = Product::with('images', 'categories')
            ->where('status', 'active')
            ->where('is_featured', true)
            ->latest()
            ->take(8)
            ->get();
            
        // Fill featuredProducts if it doesn't have enough
        if ($featuredProducts->count() < 8) {
             $extraFeatured = Product::with('images', 'categories')
                ->where('status', 'active')
                ->whereNotIn('id', $featuredProducts->pluck('id')->toArray())
                ->inRandomOrder()
                ->take(8 - $featuredProducts->count())
                ->get();
             $featuredProducts = $featuredProducts->merge($extraFeatured);
        }

        // --- RELATED PRODUCTS (if search/category yields few results) ---
        $relatedProducts = collect();
        if ($products->currentPage() == 1 && $products->count() < 12) {
             $needed = 12 - $products->count();
             $existingIds = $products->pluck('id')->toArray();
             
             $relatedQuery = Product::with('images', 'categories', 'brand')->where('status', 'active');
             if (!empty($existingIds)) {
                 $relatedQuery->whereNotIn('products.id', $existingIds);
             }

            // If category is selected, try to find stuff in siblings
            if ($selectedCategory && isset($currentCat)) {

                $relatedQuery->where(function ($mainQuery) use ($currentCat) {

                    // 🟢 CASE 1: CURRENT CATEGORY IS PARENT
                    if (is_null($currentCat->parent_id)) {

                        // Pivot table
                        $mainQuery->whereHas('categories', function ($q) use ($currentCat) {
                            $q->where('parent_id', $currentCat->id);
                        });

                        // Fallback to category_id
                        $mainQuery->orWhereHas('category', function ($q) use ($currentCat) {
                            $q->where('parent_id', $currentCat->id);
                        });

                    } 
                    
                    // 🟢 CASE 2: CURRENT CATEGORY IS CHILD
                    else {

                        // Pivot table
                        $mainQuery->whereHas('categories', function ($q) use ($currentCat) {
                            $q->where('parent_id', $currentCat->parent_id)
                            ->orWhere('categories.id', $currentCat->parent_id); // Explicit table
                        });

                        // Fallback to category_id
                        $mainQuery->orWhereHas('category', function ($q) use ($currentCat) {
                            $q->where('parent_id', $currentCat->parent_id)
                            ->orWhere('categories.id', $currentCat->parent_id); // Explicit table
                        });

                    }

                });
            }


             $relatedProducts = $relatedQuery->inRandomOrder()->take($needed)->get();

             // Fallback to purely random if STILL not enough
             if ($relatedProducts->count() < $needed) {
                 $stillNeeded = $needed - $relatedProducts->count();
                 $skipIds = array_merge($existingIds, $relatedProducts->pluck('id')->toArray());
                 $randomProducts = Product::with('images', 'categories')
                     ->where('status', 'active')
                     ->when(!empty($skipIds), fn($q) => $q->whereNotIn('products.id', $skipIds))
                     ->inRandomOrder()
                     ->take($stillNeeded)
                     ->get();
                 $relatedProducts = $relatedProducts->merge($randomProducts);
             }

             // Seamlessly inject padding directly into the paginator
             $products->setCollection($products->getCollection()->merge($relatedProducts));
        }

        $filters = [
            'q' => $search,
            'category' => $selectedCategory,
            'min_price' => $minPrice,
            'max_price' => $maxPrice,
        ];

        if ($request->ajax()) {
            return response()->json([
                'html' => view('shop.partials.product_list', compact('products'))->render(),
                'next_page' => $products->nextPageUrl()
            ]);
        }

        return view('shop.index', compact('products', 'categories', 'featuredProducts', 'filters'));
    }

    public function show(string $slug): View
    {
        $product = Product::with('images', 'categories', 'brand', 'vendor')
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        $approvedReviews = $product->reviews()
            ->where('status', 'approved')
            ->with('user')
            ->latest()
            ->get();

        $averageRating = $approvedReviews->avg('rating');
        $ratingCount = $approvedReviews->count();

        // --- SIMILAR PRODUCTS ---
        $similarProducts = Product::with('images')
            ->where('status', 'active')
            ->where(function ($q) use ($product) {

                $q->where(function ($inner) use ($product) {

                    // Only run pivot if exists
                    if ($product->categories->isNotEmpty()) {
                        $inner->whereHas('categories', function ($sub) use ($product) {
                            $sub->whereIn('categories.id', $product->categories->pluck('id'));
                        });
                    }

                    // Always allow fallback
                    if ($product->category_id) {
                        $inner->orWhere('category_id', $product->category_id);
                    }

                });

            }) // same category
            ->where('id', '!=', $product->id) // exclude current product
            ->latest()
            ->take(6)
            ->get();

        // --- TOP 10 PRODUCTS IN THIS CATEGORY ---
        $topCategoryProducts = Product::with('images')
            ->where('status', 'active')
            ->where(function ($q) use ($product) {

                $q->where(function ($inner) use ($product) {

                    // Only run pivot if exists
                    if ($product->categories->isNotEmpty()) {
                        $inner->whereHas('categories', function ($sub) use ($product) {
                            $sub->whereIn('categories.id', $product->categories->pluck('id'));
                        });
                    }

                    // Always allow fallback
                    if ($product->category_id) {
                        $inner->orWhere('category_id', $product->category_id);
                    }

                });

            })
            ->orderByDesc('is_trending') // assuming you track sales_count
            ->take(6)
            ->get();

        // --- PEOPLE ALSO BOUGHT (related by orders) ---
        // Simplest approach: products from same category or randomly
        $peopleAlsoBought = Product::with('images')
            ->where('status', 'active')
            ->where(function ($q) use ($product) {

                $q->where(function ($inner) use ($product) {

                    // Only run pivot if exists
                    if ($product->categories->isNotEmpty()) {
                        $inner->whereHas('categories', function ($sub) use ($product) {
                            $sub->whereIn('categories.id', $product->categories->pluck('id'));
                        });
                    }

                    // Always allow fallback
                    if ($product->category_id) {
                        $inner->orWhere('category_id', $product->category_id);
                    }

                });

            })
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(6)
            ->get();

        return view('shop.show', compact(
            'product',
            'approvedReviews',
            'averageRating',
            'ratingCount',
            'similarProducts',
            'topCategoryProducts',
            'peopleAlsoBought'
        ));
    }

}
