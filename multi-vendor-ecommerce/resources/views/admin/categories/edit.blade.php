@extends('layouts.admin.app')

@section('content')
<div class="container mx-auto px-4 ">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Edit Category</h1>
            <p class="text-gray-500 mt-1 text-sm">Modifying: <span class="font-semibold text-indigo-600">{{ $category->name }}</span></p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition ease-in-out duration-150">
            <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to List
        </a>
    </div>

    <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                
                <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Category Details</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <x-input-label for="name" class="font-medium" :value="__('Category Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full rounded-lg" :value="old('name', $category->name)" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="parent_id" class="font-medium" :value="__('Parent Category')" />
                            <select id="parent_id" name="parent_id" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">-- No Parent (Top Level) --</option>
                                @foreach ($parents as $id => $name)
                                    <option value="{{ $id }}" @selected(old('parent_id', $category->parent_id) == $id)>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="description" class="font-medium" :value="__('Description')" />
                            <textarea id="description" name="description" rows="5" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $category->description) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center mb-4">
                        <svg class="w-5 h-5 text-indigo-500 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        <h2 class="text-lg font-semibold text-gray-800">SEO Settings</h2>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <x-input-label for="meta_title" :value="__('Meta Title')" />
                            <x-text-input id="meta_title" name="meta_title" type="text" class="mt-1 block w-full rounded-lg" :value="old('meta_title', $category->meta_title)" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="meta_keywords" :value="__('Keywords')" />
                                <x-text-input id="meta_keywords" name="meta_keywords" type="text" class="mt-1 block w-full rounded-lg" :value="old('meta_keywords', $category->meta_keywords)" />
                            </div>
                            <div>
                                <x-input-label for="meta_description" :value="__('Meta Description')" />
                                <textarea id="meta_description" name="meta_description" rows="2" class="mt-1 block w-full border-gray-300 rounded-lg focus:ring-indigo-500">{{ old('meta_description', $category->meta_description) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Status & Update</h2>
                    
                    <div class="flex items-center justify-between mb-6 p-3 bg-gray-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-700">Status</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="status" value="1" class="sr-only peer" @checked(old('status', $category->status))>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                        </label>
                    </div>

                    <x-primary-button class="w-full justify-center py-3 bg-indigo-600 hover:bg-indigo-700">
                        {{ __('Update Category') }}
                    </x-primary-button>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Category Image</h2>
                    
                    @if($category->image)
                        <div class="mb-4">
                            <p class="text-xs text-gray-500 mb-2">Current Image:</p>
                            <img src="{{ asset('public/storage/' . $category->image) }}" class="w-full h-40 object-cover rounded-lg border border-gray-200 shadow-sm">
                        </div>
                    @endif

                    <div class="mt-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Replace Image</label>
                        <input id="image" name="image" type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                    </div>
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>
            </div>
        </div>
    </form>
</div>
@endsection