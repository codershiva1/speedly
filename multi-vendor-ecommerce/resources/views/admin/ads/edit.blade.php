@extends('layouts.admin.app')

@section('content')
<div class="sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight leading-none text-emerald-600">Update Campaign</h2>
            <p class="text-gray-500 mt-2">Modify campaign parameters for <span class="font-bold text-gray-800">{{ $ad->title }}</span>.</p>
        </div>
        <a href="{{ route('admin.ads.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-xl font-bold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition">
            <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            BACK TO LIST
        </a>
    </div>

    <div class="max-w-4xl mx-auto">
        <form action="{{ route('admin.ads.update', $ad->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 pb-20">
            @csrf
            @method('PUT')
            
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Campaign Title</label>
                        <input type="text" name="title" value="{{ old('title', $ad->title) }}" required class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 focus:bg-white focus:ring-2 focus:ring-emerald-500 transition outline-none text-gray-800 font-bold">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Placement Location</label>
                        <select name="ad_placement_id" required class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 focus:bg-white focus:ring-2 focus:ring-emerald-500 appearance-none outline-none text-gray-800 font-bold">
                            @foreach($placements as $placement)
                                <option value="{{ $placement->id }}" {{ $ad->ad_placement_id == $placement->id ? 'selected' : '' }}>{{ $placement->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Status</label>
                        <select name="is_active" class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 focus:bg-white focus:ring-2 focus:ring-emerald-500 appearance-none outline-none text-gray-800 font-bold">
                            <option value="1" {{ $ad->is_active ? 'selected' : '' }}>Active (Immediately)</option>
                            <option value="0" {{ !$ad->is_active ? 'selected' : '' }}>Paused (Draft)</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Banner Image</label>
                        <div class="mt-4 flex items-center gap-6">
                            <div class="w-48 h-24 rounded-2xl bg-gray-50 border border-gray-100 overflow-hidden shadow-inner">
                                <img src="{{ asset($ad->banner_image) }}" class="h-full w-full object-cover">
                            </div>
                            <div class="flex-grow">
                                <input name="banner_image" type="file" class="text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-2xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition cursor-pointer">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 md:col-span-2">
                        <div>
                            <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Start Date</label>
                            <input type="date" name="starts_at" value="{{ old('starts_at', $ad->starts_at?->format('Y-m-d')) }}" class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 focus:bg-white focus:ring-2 focus:ring-emerald-500 outline-none text-gray-800 font-bold">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">End Date</label>
                            <input type="date" name="ends_at" value="{{ old('ends_at', $ad->ends_at?->format('Y-m-d')) }}" class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 focus:bg-white focus:ring-2 focus:ring-emerald-500 outline-none text-gray-800 font-bold">
                        </div>
                    </div>
                </div>

                <div class="mt-10">
                    <button type="submit" class="w-full bg-emerald-600 text-white px-6 py-5 rounded-3xl font-black uppercase tracking-widest hover:bg-emerald-700 transition shadow-xl shadow-emerald-200 flex items-center justify-center gap-3">
                        Save Changes
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
