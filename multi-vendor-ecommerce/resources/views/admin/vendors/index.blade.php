@extends('layouts.admin.app')

@section('content')
<div class="sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h2 class="text-xl md:text-2xl font-black text-emerald-900 tracking-tighter uppercase">Vendor Command Center</h2>
        <div class="flex gap-3">
            <a href="{{ route('admin.export.vendors') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-gray-50 transition shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                Export CSV
            </a>
            <span class="inline-flex items-center px-3 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-xs font-bold ring-1 ring-emerald-200">
                Marketplace Control
            </span>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-emerald-50/50 border-b border-gray-100">
                    <tr>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500">Store / Vendor</th>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500">Contact</th>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500">Status</th>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($vendors as $vendor)
                    <tr class="hover:bg-emerald-50/20 transition">
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                @if($vendor->vendorProfile && $vendor->vendorProfile->logo)
                                    <img src="{{ asset($vendor->vendorProfile->logo) }}" class="h-10 w-10 rounded-lg object-cover border border-gray-200">
                                @else
                                    <div class="h-10 w-10 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 font-bold text-sm">
                                        {{ substr($vendor->vendorProfile->store_name ?? $vendor->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <div class="font-black text-emerald-900 leading-tight uppercase text-xs">{{ $vendor->vendorProfile->store_name ?? 'No Store Name' }}</div>
                                    <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Owner: {{ $vendor->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 text-sm text-gray-600">
                            <div>{{ $vendor->email }}</div>
                            <div class="flex gap-2 mt-1">
                                <span class="bg-gray-100 px-1.5 py-0.5 rounded text-[10px] font-bold text-gray-400 uppercase tracking-tighter">{{ $vendor->products_count }} Prods</span>
                                <span class="bg-emerald-50 px-1.5 py-0.5 rounded text-[10px] font-bold text-emerald-600 uppercase tracking-tighter">{{ $vendor->orders_count }} Orders</span>
                            </div>
                        </td>
                        <td class="p-4">
                            @php
                                $status = $vendor->vendorProfile->status ?? 'pending';
                                $statusClasses = [
                                    'approved' => 'bg-emerald-100 text-emerald-700',
                                    'pending' => 'bg-yellow-100 text-yellow-700',
                                    'rejected' => 'bg-red-100 text-red-700',
                                ][$status] ?? 'bg-gray-100 text-gray-700';
                            @endphp
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $statusClasses }}">
                                {{ $status }}
                            </span>
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex justify-end items-center gap-2">
                                <a href="{{ route('admin.vendors.show', $vendor->id) }}" class="bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white text-[10px] font-black px-4 py-2 rounded-xl transition uppercase tracking-widest shadow-sm">Performance</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr><td colspan="4" class="p-8 text-center text-gray-500 italic">No vendors found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View (Zero Scroll) -->
        <div class="md:hidden divide-y divide-gray-50">
            @forelse($vendors as $vendor)
            <div class="p-5 bg-white group hover:bg-emerald-50/10 transition-colors">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-4">
                        @if($vendor->vendorProfile && $vendor->vendorProfile->logo)
                            <img src="{{ asset($vendor->vendorProfile->logo) }}" class="h-14 w-14 rounded-2xl object-cover border-2 border-white shadow-sm ring-1 ring-gray-100">
                        @else
                            <div class="h-14 w-14 rounded-2xl bg-emerald-100 flex items-center justify-center text-emerald-600 font-black text-xl shadow-inner border-2 border-white ring-1 ring-gray-100">
                                {{ substr($vendor->vendorProfile->store_name ?? $vendor->name, 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <div class="font-black text-emerald-900 text-sm leading-tight uppercase tracking-tight">{{ $vendor->vendorProfile->store_name ?? 'Nameless Store' }}</div>
                            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-0.5">ID: #{{ $vendor->id }} | {{ $vendor->name }}</div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 mb-5">
                    <div class="bg-gray-50 p-3 rounded-2xl border border-gray-100">
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Products</p>
                        <p class="text-sm font-black text-emerald-900">{{ $vendor->products_count }} Items</p>
                    </div>
                    <div class="bg-emerald-50/30 p-3 rounded-2xl border border-emerald-100">
                        <p class="text-[9px] font-black text-emerald-600 uppercase tracking-widest mb-1">Total Sales</p>
                        <p class="text-sm font-black text-emerald-900">{{ $vendor->orders_count }} Orders</p>
                    </div>
                </div>
                
                <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                    <div>
                        @php
                            $status = $vendor->vendorProfile->status ?? 'pending';
                            $statusClasses = [
                                'approved' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                'pending' => 'bg-yellow-50 text-yellow-700 border-yellow-100',
                                'rejected' => 'bg-red-50 text-red-700 border-red-100',
                            ][$status] ?? 'bg-gray-50 text-gray-700 border-gray-100';
                        @endphp
                        <span class="px-3 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest border {{ $statusClasses }} shadow-sm">
                            {{ $status }}
                        </span>
                    </div>
                    
                    <a href="{{ route('admin.vendors.show', $vendor->id) }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-emerald-700 transition shadow-md shadow-emerald-100">
                        View Command
                    </a>
                </div>
            </div>
            @empty
                <div class="p-12 text-center text-gray-300 italic text-sm font-black uppercase tracking-[0.2em]">Zero Vendors Established</div>
            @endforelse
        </div>
    </div>

    <div class="mt-6">
        {{ $vendors->links() }}
    </div>
</div>
@endsection
