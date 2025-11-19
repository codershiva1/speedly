<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Product') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="sku" :value="__('SKU')" />
                                <x-text-input id="sku" name="sku" type="text" class="mt-1 block w-full" :value="old('sku')" required />
                                <x-input-error :messages="$errors->get('sku')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="category_id" :value="__('Category')" />
                                <select id="category_id" name="category_id" class="mt-1 block w-full border-gray-300 rounded-md">
                                    @foreach ($categories as $id => $name)
                                        <option value="{{ $id }}" @selected(old('category_id') == $id)>{{ $name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="brand_id" :value="__('Brand')" />
                                <select id="brand_id" name="brand_id" class="mt-1 block w-full border-gray-300 rounded-md">
                                    <option value="">-- {{ __('None') }} --</option>
                                    @foreach ($brands as $id => $name)
                                        <option value="{{ $id }}" @selected(old('brand_id') == $id)>{{ $name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('brand_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="price" :value="__('Price')" />
                                <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full" :value="old('price')" required />
                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="discount_price" :value="__('Discount Price')" />
                                <x-text-input id="discount_price" name="discount_price" type="number" step="0.01" class="mt-1 block w-full" :value="old('discount_price')" />
                                <x-input-error :messages="$errors->get('discount_price')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="stock_quantity" :value="__('Stock Quantity')" />
                                <x-text-input id="stock_quantity" name="stock_quantity" type="number" class="mt-1 block w-full" :value="old('stock_quantity', 0)" required />
                                <x-input-error :messages="$errors->get('stock_quantity')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="status" :value="__('Status')" />
                                <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md">
                                    <option value="active" @selected(old('status') === 'active')>{{ __('Active') }}</option>
                                    <option value="draft" @selected(old('status') === 'draft')>{{ __('Draft') }}</option>
                                    <option value="inactive" @selected(old('status') === 'inactive')>{{ __('Inactive') }}</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="short_description" :value="__('Short Description')" />
                            <textarea id="short_description" name="short_description" rows="2" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('short_description') }}</textarea>
                            <x-input-error :messages="$errors->get('short_description')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="images" :value="__('Images')" />
                            <input id="images" name="images[]" type="file" class="mt-1 block w-full" multiple>
                            <x-input-error :messages="$errors->get('images.*')" class="mt-2" />
                        </div>

                        <div class="flex justify-end mt-6">
                            <a href="{{ route('admin.products.index') }}" class="me-3 text-sm text-gray-600 hover:underline">{{ __('Cancel') }}</a>
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
