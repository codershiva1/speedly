@extends('layouts.admin.app')

@section('content')
<div class="sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Add Category</h2>
            <p class="text-gray-500 mt-1">Nayi marketplace category define karein.</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-600 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition shadow-sm w-fit">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Back to List
        </a>
    </div>

    <div class="max-w-4xl mx-auto">
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Category Name</label>
                        <input type="text" name="name" required class="w-full bg-gray-50 border-none rounded-2xl px-5 py-3.5 focus:bg-white focus:ring-2 focus:ring-emerald-500 transition outline-none text-gray-800 shadow-inner" placeholder="e.g. Electronics">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Parent Category</label>
                        <select name="parent_id" class="w-full bg-gray-50 border-none rounded-2xl px-5 py-3.5 focus:bg-white focus:ring-2 focus:ring-emerald-500 appearance-none outline-none text-gray-800 shadow-inner">
                            <option value="">None (Top Level)</option>
                            @foreach($parents as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Status</label>
                        <select name="status" class="w-full bg-gray-50 border-none rounded-2xl px-5 py-3.5 focus:bg-white focus:ring-2 focus:ring-emerald-500 appearance-none outline-none text-gray-800 shadow-inner">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                        <textarea name="description" rows="3" class="w-full bg-gray-50 border-none rounded-2xl px-5 py-3.5 focus:bg-white focus:ring-2 focus:ring-emerald-500 transition outline-none text-gray-800 shadow-inner" placeholder="Category details..."></textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Category Image</label>
                        <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition">
                    </div>
                </div>

                <div class="mt-8">
                    <button type="submit" class="w-full bg-emerald-600 text-white px-6 py-4 rounded-2xl font-bold hover:bg-emerald-700 transition shadow-lg shadow-emerald-200 flex items-center justify-center gap-2">
                        Create Category
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection