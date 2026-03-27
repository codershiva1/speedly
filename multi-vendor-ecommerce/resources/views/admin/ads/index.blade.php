@extends('layouts.admin.app')

@section('content')
<div class="sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-xl md:text-2xl font-extrabold text-gray-800 tracking-tight">Advertisement Management</h2>
            <p class="text-xs text-gray-500 mt-1">Manage platform banners and promotions.</p>
        </div>
        <a href="{{ route('admin.ads.create') }}" class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 bg-emerald-600 text-white rounded-xl font-bold text-xs shadow-lg shadow-emerald-100 hover:bg-emerald-700 transition">
            <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            ADD CAMPAIGN
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-emerald-50/50 border-b border-gray-100">
                    <tr>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500">Banner</th>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500">Campaign Details</th>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500">Placement</th>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500 text-center">Stats</th>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500 text-center">Status</th>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($ads as $ad)
                    <tr class="hover:bg-emerald-50/20 transition group">
                        <td class="p-4 min-w-[120px]">
                            <div class="relative w-24 h-12 rounded-lg bg-gray-100 border border-gray-100 overflow-hidden shadow-sm">
                                <img src="{{ asset($ad->banner_image) }}" class="h-full w-full object-cover group-hover:scale-110 transition duration-500">
                            </div>
                        </td>
                        <td class="p-4">
                            <div class="font-bold text-gray-900 leading-tight">{{ $ad->title }}</div>
                            <div class="text-[10px] text-gray-400 font-mono mt-0.5 uppercase tracking-tighter">
                                {{ $ad->starts_at ? $ad->starts_at->format('M d') : 'Immediate' }} &rarr; {{ $ad->ends_at ? $ad->ends_at->format('M d') : 'Forever' }}
                            </div>
                        </td>
                        <td class="p-4">
                            <span class="text-xs font-bold text-gray-600 bg-gray-100 px-2 py-1 rounded-lg uppercase tracking-wider">{{ $ad->adPlacement->name }}</span>
                        </td>
                        <td class="p-4 text-center">
                            <div class="flex flex-col">
                                <span class="text-xs font-black text-emerald-600">{{ $ad->clicks_count ?? 0 }}</span>
                                <span class="text-[9px] text-gray-400 uppercase font-bold tracking-tighter">Clicks</span>
                            </div>
                        </td>
                        <td class="p-4 text-center">
                            @if($ad->is_active)
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-[10px] font-bold uppercase tracking-wider">Active</span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-500 rounded-full text-[10px] font-bold uppercase tracking-wider">Paused</span>
                            @endif
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex justify-end items-center gap-3">
                                <a href="{{ route('admin.ads.edit', $ad->id) }}" class="text-emerald-600 hover:text-emerald-800 text-xs font-black uppercase tracking-widest bg-emerald-50 px-3 py-1.5 rounded-lg transition-all">Edit</a>
                                <form action="{{ route('admin.ads.destroy', $ad->id) }}" method="POST" onsubmit="return confirm('Stop Campaign?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-500 hover:text-red-700 text-xs font-black uppercase tracking-widest bg-red-50 px-3 py-1.5 rounded-lg transition-all">End</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr><td colspan="6" class="p-16 text-center text-gray-400 italic bg-gray-50/50">No ads found. Grow your platform with banners.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View (Zero Scroll) -->
        <div class="md:hidden divide-y divide-gray-50">
            @forelse($ads as $ad)
            <div class="p-5 bg-white group hover:bg-emerald-50/10 transition-colors">
                <div class="flex items-start justify-between mb-4">
                    <div class="relative w-32 h-16 rounded-2xl bg-gray-100 border-2 border-white shadow-sm ring-1 ring-gray-100 overflow-hidden shrink-0">
                        <img src="{{ asset($ad->banner_image) }}" class="h-full w-full object-cover">
                    </div>
                    <div class="ml-4 flex-1">
                        <div class="flex items-center justify-between">
                            <div class="font-black text-emerald-900 text-sm leading-tight uppercase tracking-tight">{{ $ad->title }}</div>
                        </div>
                        <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">
                            {{ $ad->adPlacement->name }}
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 mb-5">
                    <div class="bg-gray-50 p-3 rounded-2xl border border-gray-100">
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Campaign Period</p>
                        <p class="text-[10px] font-black text-emerald-900 uppercase tracking-tighter">
                            {{ $ad->starts_at ? $ad->starts_at->format('d M') : 'NOW' }} &rarr; {{ $ad->ends_at ? $ad->ends_at->format('d M') : 'INF' }}
                        </p>
                    </div>
                    <div class="bg-emerald-50/30 p-3 rounded-2xl border border-emerald-100">
                        <p class="text-[9px] font-black text-emerald-600 uppercase tracking-widest mb-1">Engagement</p>
                        <p class="text-sm font-black text-emerald-900 leading-none">{{ $ad->clicks_count ?? 0 }} <span class="text-[9px] text-gray-400 uppercase tracking-widest ml-1">Clicks</span></p>
                    </div>
                </div>
                
                <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                    @if($ad->is_active)
                        <span class="px-3 py-1.5 bg-emerald-50 text-emerald-700 border border-emerald-100 rounded-xl text-[9px] font-black uppercase tracking-widest shadow-sm">Active Sync</span>
                    @else
                        <span class="px-3 py-1.5 bg-gray-50 text-gray-600 border border-gray-100 rounded-xl text-[9px] font-black uppercase tracking-widest shadow-sm">Node Paused</span>
                    @endif
                    
                    <div class="flex gap-2">
                        <a href="{{ route('admin.ads.edit', $ad->id) }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-emerald-700 transition shadow-md shadow-emerald-100">Edit</a>
                        <form action="{{ route('admin.ads.destroy', $ad->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="inline-flex items-center px-4 py-2 bg-rose-50 text-rose-600 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-rose-600 hover:text-white transition shadow-sm border border-rose-100">End</button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
                <div class="p-12 text-center text-gray-300 italic text-sm font-black uppercase tracking-[0.2em]">Zero Campaigns Active</div>
            @endforelse
        </div>
    </div>
    <div class="mt-6">
        {{ $ads->links() }}
    </div>
</div>
@endsection
