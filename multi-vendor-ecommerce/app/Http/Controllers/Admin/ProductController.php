<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Product, Category, Brand, ProductImage};
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
        $data = $this->validateProduct($request);
        $data['slug'] = Str::slug($request->name);
        $data['vendor_id'] = auth()->id(); // Current Admin/Vendor ID

        // Handling Boolean Checkboxes (is_featured, etc.)
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $data['is_trending'] = $request->has('is_trending') ? 1 : 0;
        $data['is_new'] = $request->has('is_new') ? 1 : 0;

        $product = Product::create($data);

        // Multiple Images Upload
        if ($request->hasFile('images')) {
            $this->uploadImages($product, $request->file('images'));
        }

        return redirect()->route('admin.products.index')->with('status', 'Product Added!');
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
        $data = $this->validateProduct($request, $product->id);
        $data['slug'] = Str::slug($request->name);
        
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $data['is_trending'] = $request->has('is_trending') ? 1 : 0;
        $data['is_new'] = $request->has('is_new') ? 1 : 0;

        $product->update($data);

        if ($request->hasFile('images')) {
            $this->uploadImages($product, $request->file('images'));
        }

        return redirect()->route('admin.products.index')->with('status', 'Product Updated!');
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
            'sku' => 'required|unique:products,sku,'.$id,
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