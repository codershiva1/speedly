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

    <form method="POST"
      action="{{ route('admin.products.update', $product) }}"
      enctype="multipart/form-data"
      class="space-y-8">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- LEFT SIDE --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- BASIC INFO --}}
            <div class="bg-white p-6 rounded-2xl shadow border">
                <h3 class="text-lg font-bold mb-4">General Information</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <x-input-label value="Product Name"/>
                        <x-text-input name="name" value="{{ old('name',$product->name) }}" required/>
                    </div>

                    <div>
                        <x-input-label value="SKU"/>
                        <x-text-input name="sku" value="{{ old('sku',$product->sku) }}" required/>
                    </div>

                    <div>
                        <x-input-label value="Stock"/>
                        <x-text-input type="number" name="stock_quantity"
                                      value="{{ old('stock_quantity',$product->stock_quantity) }}" required/>
                    </div>
                </div>

                <div class="mt-4">
                    <x-input-label value="Short Description"/>
                    <textarea name="short_description"
                              class="w-full rounded-xl border-gray-200">{{ old('short_description',$product->short_description) }}</textarea>
                </div>

                <div class="mt-4">
                    <x-input-label value="Full Description"/>
                    <textarea name="description"
                              rows="4"
                              class="w-full rounded-xl border-gray-200">{{ old('description',$product->description) }}</textarea>
                </div>
            </div>

            {{-- PRICING --}}
            <div class="bg-white p-6 rounded-2xl shadow border">
                <h3 class="text-lg font-bold mb-4">Pricing</h3>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label value="Price"/>
                        <x-text-input type="number" step="0.01"
                                      name="price"
                                      value="{{ old('price',$product->price) }}" required/>
                    </div>

                    <div>
                        <x-input-label value="Discount Price"/>
                        <x-text-input type="number" step="0.01"
                                      name="discount_price"
                                      value="{{ old('discount_price',$product->discount_price) }}"/>
                    </div>
                </div>
            </div>

            {{-- MAIN IMAGE --}}
            <div class="bg-white p-6 rounded-2xl shadow border">
                <h3 class="font-bold mb-4">Main Image</h3>

                @php
                    $mainImage = $product->images->where('is_primary',1)->first();
                @endphp

                @if($mainImage)
                    <img src="{{ asset('storage/'.$mainImage->path) }}"
                         class="w-40 h-40 object-cover rounded-xl mb-3">
                          <label class="flex items-center gap-2 mt-2 text-sm text-red-600 cursor-pointer">
                    <input type="checkbox" name="delete_main_image" value="1">
                    Remove main image
                </label>
                @endif

                <input type="file"
                       name="main_image"
                       accept="image/*"
                       class="block w-full text-sm">
                <p class="text-xs text-gray-400 mt-1">Replacing this will remove old main image</p>
            </div>

            {{-- GALLERY --}}
            <div class="bg-white p-6 rounded-2xl shadow border">
                <h3 class="font-bold mb-4">Gallery Images (Max 4)</h3>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                    @foreach($product->images->where('is_primary',0) as $image)
                        <div class="relative">
                            <img src="{{ asset('storage/'.$image->path) }}"
                                 class="w-full h-32 object-cover rounded-xl border">

                            <input type="checkbox"
                                name="delete_images[]"
                                value="{{ $image->id }}"
                                class="hidden peer">

                            <label class="flex items-center gap-2 text-sm cursor-pointer">
                                <input type="checkbox"
                                    name="delete_images[]"
                                    value="{{ $image->id }}"
                                    class="w-4 h-4 text-red-600 border-gray-300 rounded">
                                <span class="text-red-600 font-medium">
                                    Remove
                                </span>
                            </label>
                        </div>
                    @endforeach
                </div>

                <input type="file"
                       name="images[]"
                       multiple
                       accept="image/*"
                       class="block w-full text-sm">

                <p class="text-xs text-gray-400 mt-1">
                    You can upload remaining images up to max 4
                </p>
            </div>
        </div>

        {{-- RIGHT SIDE --}}
        <div class="space-y-6">

            {{-- STATUS --}}
            <div class="bg-white p-6 rounded-2xl shadow border">
                <h3 class="text-sm font-bold uppercase mb-4 text-gray-400">Publishing</h3>

                <select name="status" class="w-full rounded-xl border-gray-200">
                    <option value="active" @selected($product->status=='active')>Active</option>
                    <option value="draft" @selected($product->status=='draft')>Draft</option>
                    <option value="inactive" @selected($product->status=='inactive')>Inactive</option>
                </select>

                <div class="mt-4 space-y-2">
                    <label class="flex justify-between">
                        <span>Featured</span>
                        <input type="checkbox" name="is_featured" value="1"
                               @checked($product->is_featured)>
                    </label>

                    <label class="flex justify-between">
                        <span>Trending</span>
                        <input type="checkbox" name="is_trending" value="1"
                               @checked($product->is_trending)>
                    </label>
                </div>

                <button class="mt-6 w-full bg-indigo-600 text-white py-3 rounded-xl">
                    Update Product
                </button>
            </div>

            {{-- CATEGORY / BRAND --}}
            <div class="bg-white p-6 rounded-2xl shadow border">
                <x-input-label value="Category"/>
                <select name="category_id" class="w-full rounded-xl border-gray-200" required>
                    @foreach($categories as $id=>$name)
                        <option value="{{ $id }}" @selected($product->category_id==$id)>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>

                <div class="mt-4">
                    <x-input-label value="Brand"/>
                    <select name="brand_id" class="w-full rounded-xl border-gray-200">
                        <option value="">None</option>
                        @foreach($brands as $id=>$name)
                            <option value="{{ $id }}" @selected($product->brand_id==$id)>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>
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