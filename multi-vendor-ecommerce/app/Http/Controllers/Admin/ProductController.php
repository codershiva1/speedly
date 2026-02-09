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
        $products = Product::with([
                'category',
                'brand',
                'primaryImage' // 🔥 MAIN IMAGE
            ])
            ->when($request->search, function ($q) use ($request) {
                $q->where(function ($query) use ($request) {
                    $query->where('name', 'LIKE', "%{$request->search}%")
                        ->orWhere('sku', 'LIKE', "%{$request->search}%");
                });
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
        // 1️⃣ Validation: Sabhi fields jo DB mein NOT NULL hain yahan hone chahiye
        $request->validate([
            'name' => 'required|max:255',
            'sku' => 'required|unique:products,sku',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'status' => 'required|in:active,draft,inactive',
            'main_image' => '|image|max:2048',
            'images.*' => 'nullable|image|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // 2️⃣ Data Prepare (Ensure all fillable keys are handled)
            $product = Product::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'sku' => $request->sku,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'stock_quantity' => $request->stock_quantity,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'vendor_id' => auth()->id(), // 🔥 Ye missing tha shayad!
                'status' => $request->status,
                'description' => $request->description,
                'short_description' => $request->short_description,
                'is_featured' => $request->has('is_featured'),
                'is_trending' => $request->has('is_trending'),
            ]);

            $subFolder = "uploads/products/{$product->id}";

            // 3️⃣ Main Image Upload
            if ($request->hasFile('main_image')) {
                $path = $request->file('main_image')->store($subFolder, 'public');
                $product->images()->create([
                    'path' => $path,
                    'is_primary' => 1,
                    'sort_order' => 0,
                ]);
            }

            // 4️⃣ Gallery Images Upload
            if ($request->hasFile('main_image')) {

                // 🔴 OLD MAIN IMAGE REMOVE (DB + FILE)
                $oldMain = $product->images()
                    ->where('is_primary', 1)
                    ->first();

                if ($oldMain) {
                    $oldPath = public_path('storage/' . $oldMain->path);

                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }

                    $oldMain->delete();
                }

                // 📂 Folder Path
                $folderPath = public_path('storage/uploads/products/' . $product->id);

                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0755, true);
                }

                // 🆕 Upload New Main Image
                $file = $request->file('main_image');
                $fileName = uniqid('main_') . '.' . $file->getClientOriginalExtension();

                $file->move($folderPath, $fileName);

                // ✅ SAVE AS PRIMARY IMAGE
                $product->images()->create([
                    'path'       => 'uploads/products/' . $product->id . '/' . $fileName,
                    'is_primary' => 1,   // 🔥 ALWAYS PRIMARY
                    'sort_order' => 0,
                ]);
            }

            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Done!');

        } catch (\Exception $e) {
            DB::rollBack();
            // 🔥 Sabse important: Ye aapko batayega ki error asal mein hai kya
            return back()->withInput()->with('error', 'SQL Error: ' . $e->getMessage());
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
        // 1️⃣ Validation
        $request->validate([
            'name' => 'required|max:255',
            'sku' => 'required|unique:products,sku,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer',
            'status' => 'required|in:active,draft,inactive',

            // MAIN IMAGE (optional on update)
            'main_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            // GALLERY
            'images' => 'nullable|array|max:4',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',

            'delete_images' => 'nullable|array',
        ]);

        DB::beginTransaction();

        try {

            // 2️⃣ Update product basic info
            $product->update([
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
            ]);

            $folderPath = public_path('storage/uploads/products/' . $product->id);
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            // 3️⃣ Delete selected images
            if ($request->filled('delete_images')) {
                $images = ProductImage::whereIn('id', $request->delete_images)->get();

                foreach ($images as $img) {
                    if (file_exists(public_path('storage/' . $img->path))) {
                        unlink(public_path('storage/' . $img->path));
                    }
                    $img->delete();
                }
            }

            // 4️⃣ MAIN IMAGE UPDATE
            if ($request->hasFile('main_image')) {

                // 🔴 OLD MAIN IMAGE REMOVE (DB + FILE)
                $oldMain = $product->images()
                    ->where('is_primary', 1)
                    ->first();

                if ($oldMain) {
                    $oldPath = public_path('storage/' . $oldMain->path);

                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }

                    $oldMain->delete();
                }

                // 📂 Folder Path
                $folderPath = public_path('storage/uploads/products/' . $product->id);

                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0755, true);
                }

                // 🆕 Upload New Main Image
                $file = $request->file('main_image');
                $fileName = uniqid('main_') . '.' . $file->getClientOriginalExtension();

                $file->move($folderPath, $fileName);

                // ✅ SAVE AS PRIMARY IMAGE
                $product->images()->create([
                    'path'       => 'uploads/products/' . $product->id . '/' . $fileName,
                    'is_primary' => 1,   // 🔥 ALWAYS PRIMARY
                    'sort_order' => 0,
                ]);
            }

            // 5️⃣ GALLERY IMAGE LIMIT CHECK
            $existingGalleryCount = $product->images()->where('is_primary', 0)->count();
            $newGalleryCount = $request->hasFile('images') ? count($request->file('images')) : 0;

            if (($existingGalleryCount + $newGalleryCount) > 4) {
                throw new \Exception('Maximum 4 gallery images allowed.');
            }

            // 6️⃣ Upload new gallery images
            if ($request->hasFile('images')) {

                $lastSortOrder = $product->images()->max('sort_order') ?? 1;

                foreach ($request->file('images') as $index => $file) {

                    $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move($folderPath, $fileName);

                    $product->images()->create([
                        'path' => 'uploads/products/' . $product->id . '/' . $fileName,
                        'is_primary' => 0,
                        'sort_order' => $lastSortOrder + $index + 1,
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Product updated successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
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