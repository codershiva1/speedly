@extends('layouts.admin.app')

@section('content')
<div class="sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight leading-none">New Ad Campaign</h2>
            <p class="text-gray-500 mt-2">Platform ke liye naya promotion setup karein.</p>
        </div>
        <a href="{{ route('admin.ads.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-xl font-bold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition">
            <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            BACK TO LIST
        </a>
    </div>

    <div class="max-w-4xl mx-auto">
        <form action="{{ route('admin.ads.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 pb-20">
            @csrf
            
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Campaign Title</label>
                        <input type="text" name="title" required class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 focus:bg-white focus:ring-2 focus:ring-emerald-500 transition outline-none text-gray-800 font-bold" placeholder="e.g. Summer Mega Sale 2026">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Placement Location</label>
                        <select name="ad_placement_id" required class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 focus:bg-white focus:ring-2 focus:ring-emerald-500 appearance-none outline-none text-gray-800 font-bold">
                            @foreach($placements as $placement)
                                <option value="{{ $placement->id }}">{{ $placement->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Status</label>
                        <select name="is_active" class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 focus:bg-white focus:ring-2 focus:ring-emerald-500 appearance-none outline-none text-gray-800 font-bold">
                            <option value="1">Active (Immediately)</option>
                            <option value="0">Paused (Draft)</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Banner Image (Recom. 1200x400)</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-100 border-dashed rounded-3xl bg-gray-50/50 hover:bg-emerald-50/30 transition">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-300" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label class="relative cursor-pointer bg-transparent rounded-md font-bold text-emerald-600 hover:text-emerald-500 focus-within:outline-none">
                                        <span>Click to upload banner</span>
                                        <input name="banner_image" type="file" required class="sr-only">
                                    </label>
                                </div>
                                <p class="text-xs text-gray-400">PNG, JPG, WEBP up to 2MB</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 md:col-span-2">
                        <div>
                            <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Start Date (Optional)</label>
                            <input type="date" name="starts_at" class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 focus:bg-white focus:ring-2 focus:ring-emerald-500 outline-none text-gray-800 font-bold">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">End Date (Optional)</label>
                            <input type="date" name="ends_at" class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 focus:bg-white focus:ring-2 focus:ring-emerald-500 outline-none text-gray-800 font-bold">
                        </div>
                    </div>
                </div>

                <div class="mt-10">
                    <button type="submit" class="w-full bg-emerald-600 text-white px-6 py-5 rounded-3xl font-black uppercase tracking-widest hover:bg-emerald-700 transition shadow-xl shadow-emerald-200 flex items-center justify-center gap-3">
                        Launch Campaign
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 7l5 5m0 0l-5 5m5-5H6" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
