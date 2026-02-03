@extends('layouts.admin.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
        <div>
            <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
                {{ __('Create New Product') }}
            </h2>
            <p class="text-sm text-gray-500">Fill in the details to list a new product in your store.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
            <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to List
        </a>
    </div>

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <span class="bg-indigo-100 text-indigo-600 p-2 rounded-lg me-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        </span>
                        General Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <x-input-label for="name" :value="__('Product Name')" class="font-semibold" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full border-gray-200 focus:ring-indigo-500 rounded-xl" :value="old('name')" placeholder="e.g. iPhone 15 Pro Max" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="sku" :value="__('SKU')" class="font-semibold" />
                            <x-text-input id="sku" name="sku" type="text" class="mt-1 block w-full border-gray-200 rounded-xl" :value="old('sku')" placeholder="PROD-123" required />
                            <x-input-error :messages="$errors->get('sku')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="stock_quantity" :value="__('Current Stock')" class="font-semibold" />
                            <x-text-input id="stock_quantity" name="stock_quantity" type="number" class="mt-1 block w-full border-gray-200 rounded-xl" :value="old('stock_quantity', 0)" required />
                        </div>
                    </div>

                    <div class="mt-6">
                        <x-input-label for="description" :value="__('Description')" class="font-semibold" />
                        <textarea id="description" name="description" rows="5" class="mt-1 block w-full border-gray-200 rounded-xl focus:ring-indigo-500 shadow-sm">{{ old('description') }}</textarea>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <span class="bg-emerald-100 text-emerald-600 p-2 rounded-lg me-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"></path></svg>
                        </span>
                        Pricing
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="price" :value="__('Price ($)')" />
                            <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full border-gray-200 rounded-xl" :value="old('price')" required />
                        </div>
                        <div>
                            <x-input-label for="discount_price" :value="__('Discount Price ($)')" />
                            <x-text-input id="discount_price" name="discount_price" type="number" step="0.01" class="mt-1 block w-full border-gray-200 rounded-xl" :value="old('discount_price')" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24 z-10">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-gray-400 mb-4">Publishing</h3>
                    
                    <div class="mb-6">
                        <x-input-label for="status" :value="__('Status')" class="mb-2" />
                        <select id="status" name="status" class="w-full border-gray-200 rounded-xl focus:ring-indigo-500">
                            <option value="active">Active</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>

                    <div class="space-y-3 mb-6 p-4 bg-gray-50 rounded-xl">
                        <label class="flex items-center justify-between cursor-pointer">
                            <span class="text-sm font-medium">Featured Product</span>
                            <input type="checkbox" name="is_featured" value="1" class="rounded border-gray-300 text-indigo-600">
                        </label>
                        <label class="flex items-center justify-between cursor-pointer">
                            <span class="text-sm font-medium">Trending Now</span>
                            <input type="checkbox" name="is_trending" value="1" class="rounded border-gray-300 text-indigo-600">
                        </label>
                    </div>

                    <x-primary-button class="w-full justify-center py-3 bg-indigo-600 hover:bg-indigo-700 shadow-lg rounded-xl">
                        {{ __('Create Product') }}
                    </x-primary-button>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-gray-400 mb-4">Organize</h3>
                    <div class="space-y-4">
                        <div>
                            <x-input-label for="category_id" :value="__('Category')" class="font-semibold" />
                            <select id="category_id" name="category_id" class="mt-1 block w-full border-gray-200 rounded-xl shadow-sm focus:ring-indigo-500" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $id => $name)
                                    <option value="{{ $id }}" @selected(old('category_id') == $id)>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-gray-400 mb-4">Gallery</h3>
                    <div class="border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:border-indigo-400 transition-colors">
                        <input id="images" name="images[]" type="file" class="hidden" multiple onchange="updateFileList(this)">
                        <label for="images" class="cursor-pointer">
                            <svg class="w-8 h-8 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                            <span class="mt-2 block text-xs font-semibold text-indigo-600">Click to upload images</span>
                        </label>
                    </div>
                    <div id="file-list" class="mt-3 text-[10px] text-gray-500 italic">No files selected</div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function updateFileList(input) {
        const list = document.getElementById('file-list');
        list.innerHTML = input.files.length + ' images selected';
    }
</script>
@endsection