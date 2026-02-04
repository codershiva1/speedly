@extends('layouts.admin.app')

@section('content')
 
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
                {{ __('Edit Brand') }}: <span class="text-indigo-600">{{ $brand->name }}</span>
            </h2>
            <a href="{{ route('admin.brands.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to List
            </a>
        </div>


    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class=" text-gray-900">
                    <form method="POST" action="{{ route('admin.brands.update', $brand) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" :value="__('Brand Name')" class="font-semibold text-gray-700" />
                            <x-text-input id="name" name="name" type="text" 
                                class="mt-1 block w-full rounded-xl border-gray-200 focus:ring-indigo-500 shadow-sm" 
                                :value="old('name', $brand->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="logo" :value="__('Brand Logo')" class="font-semibold text-gray-700" />
                            <div class="mt-2 flex items-center gap-6">
                                <div id="image-preview" class="h-24 w-24 rounded-xl bg-gray-50 border-2 border-dashed border-gray-200 flex items-center justify-center overflow-hidden">
                                    @if($brand->logo)
                                        <img src="{{ asset('storage/' . $brand->logo) }}" class="h-full w-full object-contain" id="current-img" />
                                    @else
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="2"></path></svg>
                                    @endif
                                </div>
                                
                                <div class="flex-1">
                                    <input id="logo" name="logo" type="file" 
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                                        onchange="previewImage(this)" />
                                    <p class="mt-2 text-xs text-gray-400">Upload a new logo to replace the current one. (Max 2MB)</p>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                        </div>

                        <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                            <label for="status" class="inline-flex items-center cursor-pointer">
                                <input id="status" type="checkbox" name="status" value="1" 
                                    class="rounded-md border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" 
                                    @checked(old('status', $brand->status))>
                                <span class="ms-3 text-sm font-semibold text-gray-700">{{ __('Active Status') }}</span>
                            </label>
                            <p class="ms-8 text-xs text-gray-400">If unchecked, this brand will be hidden from the storefront.</p>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100">
                            <a href="{{ route('admin.brands.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700 transition">
                                {{ __('Cancel') }}
                            </a>
                            <x-primary-button class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-lg shadow-indigo-100">
                                {{ __('Update Brand') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('image-preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" class="h-full w-full object-contain" />`;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection