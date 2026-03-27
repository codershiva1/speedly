@extends('layouts.admin.app')

@section('content')
<div class="max-w-7xl mx-auto  sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h2 class="text-xl md:text-2xl font-black text-emerald-900 tracking-tighter uppercase">Order Oversight</h2>
        <div class="flex gap-3">
            <a href="{{ route('admin.export.orders') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-gray-50 transition shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                Export CSV
            </a>
            <span class="inline-flex items-center px-3 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-xs font-bold ring-1 ring-emerald-200">
                Financial Control
            </span>
        </div>
    </div>

    <div class="hidden md:block bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold uppercase text-gray-500">Order ID</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase text-gray-500">Customer</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase text-gray-500">Total</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase text-gray-500">Status</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase text-gray-500 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach ($orders as $order)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm font-medium">
                        <span class="font-bold text-gray-800">#{{ $order->order_number }}</span>
                        <div class="text-[10px] text-gray-400">{{ $order->created_at->format('d M, Y H:i') }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        <div class="font-medium text-gray-800">{{ $order->user->name }}</div>
                        <div class="text-[10px] text-gray-400 font-mono">{{ $order->payment_method }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="font-black text-emerald-900">{{ $order->currency }} {{ number_format($order->total_amount, 2) }}</span>
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $colors = [
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'delivered' => 'bg-green-100 text-green-700',
                                'cancelled' => 'bg-red-100 text-red-700',
                                'shipped' => 'bg-blue-100 text-blue-700'
                            ];
                        @endphp
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold {{ $colors[$order->status] ?? 'bg-gray-100 text-gray-600' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.orders.show', $order) }}" class="inline-flex items-center px-4 py-2 bg-emerald-50 text-emerald-600 rounded-xl hover:bg-emerald-600 hover:text-white transition text-[10px] font-black uppercase tracking-widest shadow-sm">
                            View Details
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="grid grid-cols-1 gap-4 md:hidden">
        @foreach ($orders as $order)
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-emerald-50 group hover:bg-emerald-50/10 transition-colors">
            <div class="flex justify-between items-start mb-4">
                <div class="flex flex-col">
                    <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest leading-none mb-1">Order #{{ $order->order_number }}</span>
                    <div class="text-[9px] text-gray-400 font-bold uppercase tracking-tighter">{{ $order->created_at->format('d M, Y • H:i') }}</div>
                </div>
                <span class="px-2.5 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest border shadow-sm {{ $colors[$order->status] ?? 'bg-gray-50 text-gray-600 border-gray-100' }}">
                    {{ $order->status }}
                </span>
            </div>
            
            <div class="flex justify-between items-end mt-2">
                <div>
                    <div class="text-[11px] font-black text-emerald-900 uppercase tracking-tight">{{ $order->user->name }}</div>
                    <div class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-0.5">{{ $order->payment_method }}</div>
                    <div class="mt-2 text-base font-black text-emerald-900 tracking-tighter">
                        {{ $order->currency }} {{ number_format($order->total_amount, 2) }}
                    </div>
                </div>
                <a href="{{ route('admin.orders.show', $order) }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-md shadow-emerald-100 transition hover:bg-emerald-700">
                    Interact
                </a>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="mt-6">
        {{ $orders->links() }}
    </div>
</div>
@endsection