@extends('layouts.admin.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
        <div>
            <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
                {{ __('Edit Product') }}: <span class="text-indigo-600">{{ $product->name }}</span>
            </h2>
            <p class="text-sm text-gray-500">Update product details, pricing, and media.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-xl font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition">
            <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Inventory
        </a>
    </div>

    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">General Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <x-input-label for="name" :value="__('Product Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full rounded-xl border-gray-200" :value="old('name', $product->name)" required />
                        </div>

                        <div>
                            <x-input-label for="sku" :value="__('SKU')" />
                            <x-text-input id="sku" name="sku" type="text" class="mt-1 block w-full rounded-xl border-gray-200" :value="old('sku', $product->sku)" required />
                        </div>

                        <div>
                            <x-input-label for="stock_quantity" :value="__('Current Stock')" />
                            <x-text-input id="stock_quantity" name="stock_quantity" type="number" class="mt-1 block w-full rounded-xl border-gray-200" :value="old('stock_quantity', $product->stock_quantity)" required />
                        </div>
                    </div>

                    <div class="mt-6">
                        <x-input-label for="short_description" :value="__('Short Description')" />
                        <textarea id="short_description" name="short_description" rows="2" class="mt-1 block w-full border-gray-200 rounded-xl shadow-sm">{{ old('short_description', $product->short_description) }}</textarea>
                    </div>

                    <div class="mt-6">
                        <x-input-label for="description" :value="__('Full Description')" />
                        <textarea id="description" name="description" rows="5" class="mt-1 block w-full border-gray-200 rounded-xl shadow-sm">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>

                <div>
                    <x-input-label for="price" value="Price" />
                    <x-text-input
                        id="price"
                        name="price"
                        type="number"
                        step="0.01"
                        class="mt-1 block w-full"
                        value="{{ old('price', $product->price) }}"
                        required
                    />
                </div>

                <div>
                    <x-input-label for="discount_price" value="Discount Price" />
                    <x-text-input
                        id="discount_price"
                        name="discount_price"
                        type="number"
                        step="0.01"
                        class="mt-1 block w-full"
                        value="{{ old('discount_price', $product->discount_price) }}"
                    />
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Product Gallery</h3>
                
                <div id="image-preview-container" class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                    @foreach ($product->images as $image)
                        <div class="relative group" id="existing-img-{{ $image->id }}">
                            <img src="{{ asset('storage/'.$image->path) }}" class="w-full h-32 object-cover rounded-xl border border-gray-100">
                            <div class="absolute inset-0 bg-black bg-opacity-40 rounded-xl opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                <label class="cursor-pointer bg-red-500 p-2 rounded-full text-white shadow-lg transform hover:scale-110 transition">
                                    <input type="checkbox" name="delete_images[]" value="{{ $image->id }}" class="hidden" onchange="toggleOverlay(this, 'existing-img-{{ $image->id }}')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="border-2 border-dashed border-gray-200 rounded-xl p-8 text-center hover:border-indigo-400 transition-all cursor-pointer bg-gray-50 group" onclick="document.getElementById('images').click()">
                    <input id="images" name="images[]" type="file" class="hidden" multiple accept="image/*" onchange="previewImages(this)">
                    <svg class="w-10 h-10 mx-auto text-gray-400 group-hover:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="2"></path></svg>
                    <span class="mt-2 block text-sm font-semibold text-indigo-600">Click to upload new images</span>
                    <p class="text-xs text-gray-400 mt-1">PNG, JPG up to 2MB</p>
                </div>
            </div>

            <script>
                // Nayi select ki hui images ka preview dikhane ke liye
                function previewImages(input) {
                    const container = document.getElementById('image-preview-container');
                    if (input.files) {
                        Array.from(input.files).forEach(file => {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const div = document.createElement('div');
                                div.className = 'relative animate-pulse';
                                div.innerHTML = `
                                    <img src="${e.target.result}" class="w-full h-32 object-cover rounded-xl border-2 border-indigo-200 shadow-sm">
                                    <span class="absolute top-1 right-1 bg-indigo-600 text-white text-[8px] px-2 py-1 rounded-full uppercase">New</span>
                                `;
                                container.appendChild(div);
                                setTimeout(() => div.classList.remove('animate-pulse'), 500);
                            }
                            reader.readAsDataURL(file);
                        });
                    }
                }

                // Delete mark karne par visual feedback
                function toggleOverlay(checkbox, elementId) {
                    const el = document.getElementById(elementId);
                    if(checkbox.checked) {
                        el.classList.add('opacity-30', 'grayscale');
                    } else {
                        el.classList.remove('opacity-30', 'grayscale');
                    }
                }
            </script>
            </div>

            <div class="space-y-6">
                <div class="sticky top-24 space-y-6"> <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-sm font-bold uppercase tracking-wider text-gray-400 mb-4">Publishing</h3>
                        
                        <div class="mb-6">
                            <x-input-label for="status" :value="__('Product Status')" />
                            <select id="status" name="status" class="w-full mt-1 border-gray-200 rounded-xl focus:ring-indigo-500">
                                <option value="active" {{ (isset($product) && $product->status == 'active') ? 'selected' : '' }}>Active</option>
                                <option value="draft" {{ (isset($product) && $product->status == 'draft') ? 'selected' : '' }}>Draft</option>
                                <option value="inactive" {{ (isset($product) && $product->status == 'inactive') ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="space-y-3 mb-6 p-4 bg-gray-50 rounded-xl">
                            <label class="flex items-center justify-between cursor-pointer">
                                <span class="text-sm font-medium text-gray-700">Featured Product</span>
                                <input type="checkbox" name="is_featured" value="1" {{ (isset($product) && $product->is_featured) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600">
                            </label>
                            <label class="flex items-center justify-between cursor-pointer">
                                <span class="text-sm font-medium text-gray-700">Trending Now</span>
                                <input type="checkbox" name="is_trending" value="1" {{ (isset($product) && $product->is_trending) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600">
                            </label>
                        </div>

                        <x-primary-button class="w-full justify-center py-3 bg-indigo-600 hover:bg-indigo-700 shadow-lg rounded-xl">
                            {{ isset($product) ? __('Update Product') : __('Create Product') }}
                        </x-primary-button>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-sm font-bold uppercase tracking-wider text-gray-400 mb-4">Organize</h3>
                        <div class="space-y-4">
                            <div>
                                <x-input-label for="category_id" :value="__('Category')" />
                                <select id="category_id" name="category_id" class="mt-1 block w-full border-gray-200 rounded-xl focus:ring-indigo-500" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $id => $name)
                                        <option value="{{ $id }}" {{ (isset($product) && $product->category_id == $id) ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="brand_id" :value="__('Brand')" />
                                <select id="brand_id" name="brand_id" class="mt-1 block w-full border-gray-200 rounded-xl focus:ring-indigo-500">
                                    <option value="">None</option>
                                    @foreach ($brands as $id => $name)
                                        <option value="{{ $id }}" {{ (isset($product) && $product->brand_id == $id) ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div> </div>
        </div>
    </form>
</div>

<script>
    function updateFileList(input) {
        const list = document.getElementById('file-list');
        list.innerHTML = input.files.length + ' new images selected';
    }
</script>
@endsection