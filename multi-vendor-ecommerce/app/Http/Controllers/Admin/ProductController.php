<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Product, Category, Brand, ProductImage};
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // 1. List all products with Search
    public function index(Request $request)
    {
        $products = Product::with(['category', 'brand'])
            ->when($request->search, function($q) use ($request) {
                $q->where('name', 'LIKE', "%{$request->search}%")
                  ->orWhere('sku', 'LIKE', "%{$request->search}%");
            })
            ->latest()
            ->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    // 2. Show Create Form
   public function create()
    {
        // Sirf Active categories lein aur 'name' ko 'id' ke saath map karein
        $categories = Category::where('status', 1)
                            ->orderBy('name')
                            ->pluck('name', 'id'); //

        $brands = Brand::orderBy('name')->pluck('name', 'id');

        return view('admin.products.create', compact('categories', 'brands'));
    }

    // 3. Save New Product
   public function store(Request $request)
        {
            DB::beginTransaction();

            try {
                // 1️⃣ Validation
                $request->validate([
                    'name' => 'required|max:255',
                    'sku' => 'required|unique:products,sku',
                    'category_id' => 'required|exists:categories,id',
                    'price' => 'required|numeric|min:0',
                    'discount_price' => 'nullable|numeric|min:0',
                    'stock_quantity' => 'required|integer|min:0',
                    'status' => 'required|in:active,draft,inactive',
                    'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
                ]);

                // 2️⃣ Prepare data
                $data = [
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'sku' => $request->sku,
                    'price' => $request->price,
                    'discount_price' => $request->discount_price,
                    'stock_quantity' => $request->stock_quantity,
                    'category_id' => $request->category_id,
                    'brand_id' => $request->brand_id,
                    'status' => $request->status,
                    'description' => $request->description,
                    'short_description' => $request->short_description,
                    'is_featured' => $request->has('is_featured'),
                    'is_trending' => $request->has('is_trending'),
                    'updated_by' => auth()->id(),
                ];

                // 3️⃣ Create product
                $product = Product::create($data);

                // 4️⃣ Upload Images (ROOT public)
                if ($request->hasFile('images')) {
                    $lastSortOrder = 0; // new product, no previous images
                    $folderPath = public_path('storage/uploads/products/' . $product->id);

                    if (!file_exists($folderPath)) {
                        mkdir($folderPath, 0777, true);
                    }

                    foreach ($request->file('images') as $index => $file) {
                        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
                        $file->move($folderPath, $fileName);

                        $product->images()->create([
                            'path' => 'uploads/products/' . $product->id . '/' . $fileName,
                            'is_primary' => ($lastSortOrder == 0 && $index == 0) ? 1 : 0,
                            'sort_order' => $lastSortOrder + $index + 1,
                        ]);
                    }
                }

                DB::commit();

                return redirect()
                    ->route('admin.products.index')
                    ->with('success', 'Product created successfully');

            } catch (\Exception $e) {
                DB::rollBack();
                return back()
                    ->withInput()
                    ->with('error', 'Something went wrong: ' . $e->getMessage());
            }
        }

    // 4. Show Edit Form
    public function edit(Product $product)
    {
       $categories = Category::orderBy('name')->pluck('name', 'id');
        $brands = Brand::orderBy('name')->pluck('name', 'id');
        $product->load('images');
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    // 5. Update Product
   public function update(Request $request, Product $product)
    {
        // 1. Validation
        $request->validate([
            'name' => 'required|max:255',
            'sku' => 'required|unique:products,sku,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer',
            'status' => 'required|in:active,draft,inactive',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        DB::beginTransaction();
        try {
            // 2. Main Data Update
            $product->update([
                'name'           => $request->name,
                'slug'           => Str::slug($request->name),
                'sku'            => $request->sku,
                'price'          => $request->price,
                'discount_price' => $request->discount_price,
                'stock_quantity' => $request->stock_quantity,
                'category_id'    => $request->category_id,
                'brand_id'       => $request->brand_id,
                'status'         => $request->status,
                'description'    => $request->description,
                'short_description' => $request->short_description,
                'is_featured'    => $request->has('is_featured'),
                'is_trending'    => $request->has('is_trending'),
                'updated_by'     => auth()->id(),
            ]);

            // 3. Delete Selected Images
            if ($request->filled('delete_images')) {
                $imagesToDelete = ProductImage::whereIn('id', $request->delete_images)->get();
                foreach ($imagesToDelete as $img) {
                    Storage::disk('public')->delete($img->path);
                    $img->delete();
                }
            }

            // 4. Upload New Images
            if ($request->hasFile('images')) {

                $lastSortOrder = $product->images()->max('sort_order') ?? 0;
                $folderPath = public_path('storage/uploads/products/' . $product->id);

                // folder exist nahi karta to banao
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }

                foreach ($request->file('images') as $index => $file) {

                    $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

                    // 🔥 DIRECT public me move
                    $file->move($folderPath, $fileName);

                    $product->images()->create([
                        'path'       => 'uploads/products/' . $product->id . '/' . $fileName,
                        'is_primary' => ($lastSortOrder == 0 && $index == 0) ? 1 : 0,
                        'sort_order' => $lastSortOrder + $index + 1,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Product and Gallery updated!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Update failed: ' . $e->getMessage());
        }
    }

    // 6. Delete Product
    public function destroy(Product $product)
    {
        // Delete images from storage
        foreach($product->images as $img) {
            Storage::disk('public')->delete($img->path);
            $img->delete();
        }
        $product->delete();
        return back()->with('status', 'Product Deleted!');
    }

    // Private Helper for Validation
    private function validateProduct($request, $id = null) {
        return $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'sku' => 'required|unique:products,sku,' . $product->id,
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'stock_quantity' => 'required|integer',
            'status' => 'required|in:draft,active,inactive',
            'description' => 'nullable',
            'short_description' => 'nullable|max:255',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable',
            'meta_keywords' => 'nullable',
        ]);
    }

    // Private Helper for Images
    private function uploadImages($product, $files) {
        foreach ($files as $index => $file) {
            $path = $file->store('products', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'path' => $path,
                'is_primary' => ($index === 0 && !$product->images()->where('is_primary', 1)->exists()),
            ]);
        }
    }
}