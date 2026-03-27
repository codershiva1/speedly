@extends('layouts.admin.app')

@section('content')
<div class="sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h2 class="text-xl md:text-2xl font-black text-emerald-900 tracking-tighter uppercase">Delivery Boy Management</h2>
        <div class="flex gap-2">
            <span class="inline-flex items-center px-3 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-xs font-bold ring-1 ring-emerald-200">
                Operations Control
            </span>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-emerald-50/50 border-b border-gray-100">
                    <tr>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500">Delivery Boy</th>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500">Vehicle / Zone</th>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500">Performance</th>
                        <th class="p-4 text-xs font-bold uppercase text-gray-500 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($deliveryBoys as $boy)
                    <tr class="hover:bg-emerald-50/20 transition">
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                @if($boy->image_url)
                                    <img src="{{ asset($boy->image_url) }}" class="h-10 w-10 rounded-full object-cover border border-gray-200">
                                @else
                                    <div class="h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 font-bold text-sm">
                                        {{ substr($boy->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <div class="font-black text-emerald-900 leading-tight uppercase text-xs">{{ $boy->name }}</div>
                                    <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ $boy->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 text-sm text-gray-600">
                            <div>{{ optional($boy->deliveryBoyProfile)->vehicle_type ?? 'N/A' }}</div>
                            <div class="text-xs text-gray-400">Zone: {{ optional($boy->deliveryBoyProfile)->delivery_zone ?? 'Global' }}</div>
                        </td>
                        <td class="p-4">
                            <div class="flex flex-col gap-1">
                                <div class="flex items-center gap-1">
                                    <span class="text-xs font-bold text-gray-700">{{ optional($boy->deliveryBoyProfile)->rating ?? '0.0' }}</span>
                                    <svg class="w-3 h-3 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                </div>
                                <div class="text-[10px] text-gray-400 uppercase">Deliveries: {{ optional($boy->deliveryBoyProfile)->total_deliveries ?? 0 }}</div>
                            </div>
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex justify-end items-center gap-2">
                                <a href="{{ route('admin.delivery-boys.show', $boy->id) }}" class="bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white text-[10px] font-black px-4 py-2 rounded-xl transition uppercase tracking-widest shadow-sm">Performance</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @if($deliveryBoys->isEmpty())
                        <tr><td colspan="4" class="p-8 text-center text-gray-500 italic">No delivery boys found.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View (Zero Scroll) -->
        <div class="md:hidden divide-y divide-gray-50">
            @forelse($deliveryBoys as $boy)
            <div class="p-5 bg-white group hover:bg-emerald-50/10 transition-colors">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-4">
                        @if($boy->image_url)
                            <img src="{{ asset($boy->image_url) }}" class="h-14 w-14 rounded-2xl object-cover border-2 border-white shadow-sm ring-1 ring-gray-100">
                        @else
                            <div class="h-14 w-14 rounded-2xl bg-emerald-100 flex items-center justify-center text-emerald-600 font-black text-xl shadow-inner border-2 border-white ring-1 ring-gray-100">
                                {{ substr($boy->name, 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <div class="font-black text-emerald-900 text-sm leading-tight uppercase tracking-tight">{{ $boy->name }}</div>
                            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-0.5">{{ $boy->email }}</div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 mb-5">
                    <div class="bg-gray-50 p-3 rounded-2xl border border-gray-100">
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Vehicle / Zone</p>
                        <p class="text-[11px] font-black text-emerald-900 uppercase tracking-tighter">{{ optional($boy->deliveryBoyProfile)->vehicle_type ?? 'N/A' }}</p>
                        <p class="text-[9px] text-gray-400 font-bold uppercase mt-0.5">{{ optional($boy->deliveryBoyProfile)->delivery_zone ?? 'Global' }}</p>
                    </div>
                    <div class="bg-emerald-50/30 p-3 rounded-2xl border border-emerald-100">
                        <p class="text-[9px] font-black text-emerald-600 uppercase tracking-widest mb-1">Performance</p>
                        <div class="flex items-center gap-1.5">
                            <span class="text-sm font-black text-emerald-900">{{ optional($boy->deliveryBoyProfile)->rating ?? '0.0' }}</span>
                            <svg class="w-3 h-3 text-yellow-400 fill-current mb-0.5" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <p class="text-[9px] text-gray-400 font-bold uppercase mt-1">{{ optional($boy->deliveryBoyProfile)->total_deliveries ?? 0 }} Deliveries</p>
                    </div>
                </div>
                
                <div class="flex items-center justify-center pt-4 border-t border-gray-50">
                    <a href="{{ route('admin.delivery-boys.show', $boy->id) }}" class="flex items-center justify-center w-full py-3 bg-emerald-600 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-emerald-700 transition shadow-md shadow-emerald-100">
                        Performance Protocol
                    </a>
                </div>
            </div>
            @empty
                <div class="p-12 text-center text-gray-300 italic text-sm font-black uppercase tracking-[0.2em]">Zero Personal Enlisted</div>
            @endforelse
        </div>
    </div>

    <div class="mt-6">
        {{ $deliveryBoys->links() }}
    </div>
</div>
@endsection
