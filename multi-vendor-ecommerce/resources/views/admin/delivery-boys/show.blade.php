@extends('layouts.admin.app')

@section('content')
<div class="sm:px-6 lg:px-8 pb-10">
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="flex items-center gap-6">
            <div class="relative">
                @if($deliveryBoy->image_url)
                    <img src="{{ asset($deliveryBoy->image_url) }}" class="h-24 w-24 rounded-3xl object-cover ring-4 ring-emerald-50 shadow-2xl">
                @else
                    <div class="h-24 w-24 rounded-3xl bg-emerald-600 flex items-center justify-center text-white text-3xl font-black shadow-2xl">
                        {{ substr($deliveryBoy->name, 0, 1) }}
                    </div>
                @endif
                <div class="absolute -bottom-2 -right-2 bg-white p-1.5 rounded-xl shadow-lg border border-gray-100">
                    <div class="bg-emerald-500 w-4 h-4 rounded-lg"></div>
                </div>
            </div>
            <div>
                <h2 class="text-3xl font-black text-emerald-900 tracking-tight leading-none">{{ $deliveryBoy->name }}</h2>
                <div class="flex items-center gap-3 mt-3">
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ $deliveryBoy->email }}</span>
                    <span class="w-1 h-1 rounded-full bg-emerald-100"></span>
                    <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">Rider ID: #RID-{{ $deliveryBoy->id }}</span>
                </div>
            </div>
        </div>
        
        <div class="flex gap-3">
            <button class="px-6 py-3 bg-white border border-gray-200 text-gray-700 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-gray-50 transition shadow-sm">Contact Rider</button>
            <button class="px-6 py-3 bg-emerald-600 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-emerald-700 transition shadow-xl shadow-emerald-100">Adjust Earnings</button>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-8 rounded-3xl border border-gray-50 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition">
                <svg class="w-16 h-16 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/></svg>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[2px] mb-2">Total Deliveries</p>
            <h4 class="text-4xl font-black text-emerald-900 leading-none">{{ number_format($stats['total_deliveries']) }}</h4>
            <div class="mt-4 flex items-center gap-2">
                <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md">Completion: 98%</span>
            </div>
        </div>

        <div class="bg-white p-8 rounded-3xl border border-gray-50 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition">
                <svg class="w-16 h-16 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/></svg>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[2px] mb-2">Internal Earnings</p>
            <h4 class="text-4xl font-black text-emerald-900 leading-none">₹{{ number_format($stats['total_earnings'], 2) }}</h4>
            <div class="mt-4 flex items-center gap-2">
                <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md">Available for payout</span>
            </div>
        </div>

        <div class="bg-white p-8 rounded-3xl border border-gray-50 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition">
                <svg class="w-16 h-16 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[2px] mb-2">Trust Score / Rating</p>
            <h4 class="text-4xl font-black text-emerald-900 leading-none">{{ $stats['rating'] }}<span class="text-lg text-emerald-100 ml-1">/5</span></h4>
            <div class="mt-4 flex items-center gap-2">
                <span class="text-[10px] font-bold text-yellow-600 bg-yellow-50 px-2 py-0.5 rounded-md">Platinum Class Rider</span>
            </div>
        </div>
    </div>

    <!-- History Tables -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        <!-- Recent Deliveries -->
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-50 flex items-center justify-between">
                <h4 class="font-black text-gray-800 uppercase text-xs tracking-widest">Recent Mission History</h4>
                <a href="#" class="text-[10px] font-black text-emerald-600 tracking-tighter uppercase hover:underline">Full Logs</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50/50">
                        <tr>
                            <th class="p-4 text-[9px] font-black uppercase text-gray-400">Order</th>
                            <th class="p-4 text-[9px] font-black uppercase text-gray-400">Total</th>
                            <th class="p-4 text-[9px] font-black uppercase text-gray-400">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($deliveryBoy->deliveries as $order)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="p-4">
                                    <div class="text-[11px] font-black text-gray-900">#{{ $order->order_number }}</div>
                                    <div class="text-[9px] text-gray-400">{{ $order->created_at->format('M d, Y') }}</div>
                                </td>
                                <td class="p-4">
                                    <div class="text-[11px] font-black text-gray-900">{{ $order->currency }} {{ number_format($order->total_amount, 0) }}</div>
                                </td>
                                <td class="p-4 uppercase">
                                    <span class="px-2 py-0.5 bg-emerald-50 text-emerald-600 rounded-md text-[9px] font-black tracking-widest">{{ $order->status }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="p-10 text-center text-gray-400 italic text-xs uppercase tracking-widest font-bold">No recent missions found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Vehicle & Profile Details -->
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
            <h4 class="font-black text-gray-800 uppercase text-xs tracking-widest mb-8">Asset & Logistics Details</h4>
            <div class="space-y-6">
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Vehicle Type</span>
                    <span class="text-xs font-black text-gray-800 uppercase">{{ $deliveryBoy->deliveryBoyProfile->vehicle_type ?? 'None Assigned' }}</span>
                </div>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Active Zone</span>
                    <span class="text-xs font-black text-gray-800 uppercase">{{ $deliveryBoy->deliveryBoyProfile->delivery_zone ?? 'Global' }}</span>
                </div>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Account Status</span>
                    <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-[9px] font-black uppercase tracking-[2px]">Verified</span>
                </div>
                
                <div class="pt-6">
                    <button class="w-full py-4 bg-emerald-50 text-emerald-600 rounded-2xl font-black text-[10px] uppercase tracking-[3px] hover:bg-emerald-600 hover:text-white transition-all shadow-sm">View Vehicle Documents</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
