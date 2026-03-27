@extends('layouts.admin.app')

@section('content')
<div class="sm:px-6 lg:px-8 pb-10">
    <div class="mb-10">
        <h2 class="text-3xl font-black text-gray-900 tracking-tight leading-none">System Settings</h2>
        <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mt-3">Configure platform-wide parameters and business rules.</p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center gap-3 animate-pulse">
            <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </div>
            <p class="text-xs font-black text-emerald-700 uppercase tracking-wider">{{ session('success') }}</p>
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            @foreach($settings as $group => $groupSettings)
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-50 flex items-center justify-between bg-gray-50/30">
                        <h4 class="font-black text-gray-800 uppercase text-xs tracking-widest">{{ ucfirst($group) }} Settings</h4>
                        <div class="w-2 h-2 rounded-full bg-emerald-400"></div>
                    </div>
                    <div class="p-8 space-y-6">
                        @foreach($groupSettings as $setting)
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-tighter mb-2">{{ str_replace('_', ' ', $setting->key) }}</label>
                                
                                @if($setting->type === 'image')
                                    <div class="flex items-center gap-4">
                                        @if($setting->value)
                                            <img src="{{ asset($setting->value) }}" class="h-16 w-32 object-contain rounded-xl border border-gray-100 bg-gray-50 p-2">
                                        @endif
                                        <input type="file" name="{{ $setting->key }}" class="block w-full text-[10px] text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition">
                                    </div>
                                @elseif($setting->type === 'number')
                                    <input type="number" name="{{ $setting->key }}" value="{{ $setting->value }}" class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                                @else
                                    <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                                @endif
                                <p class="text-[9px] text-gray-400 mt-2 font-medium">Internal Key: <code class="bg-gray-100 px-1 rounded">{{ $setting->key }}</code></p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-12 flex justify-center">
            <button type="submit" class="px-12 py-4 bg-emerald-600 text-white rounded-2xl font-black text-[10px] uppercase tracking-[3px] shadow-2xl shadow-emerald-200 hover:bg-emerald-700 hover:scale-105 transition-all active:scale-95 flex items-center gap-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                Publish All Changes
            </button>
        </div>
    </form>
</div>
@endsection
