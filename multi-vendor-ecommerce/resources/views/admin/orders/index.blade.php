@extends('layouts.admin.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-extrabold text-gray-800">Order Management</h2>
        
        <div class="flex gap-2">
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-lg text-xs font-bold">Pending</a>
            <a href="{{ route('admin.orders.index', ['status' => 'confirmed']) }}" class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-bold">Confirmed</a>
            <a href="{{ route('admin.orders.index') }}" class="px-3 py-1 bg-gray-100 text-gray-700 rounded-lg text-xs font-bold">All Orders</a>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
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
                    <td class="px-6 py-4 text-sm">
                        <span class="font-bold text-gray-800">#{{ $order->order_number }}</span>
                        <div class="text-[10px] text-gray-400">{{ $order->created_at->format('d M, Y H:i') }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $order->user->name }}
                        <div class="text-[10px] text-gray-400 font-mono">{{ $order->payment_method }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="font-bold text-gray-900">{{ $order->currency }} {{ number_format($order->total_amount, 2) }}</span>
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
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold {{ $colors[$order->status] ?? 'bg-gray-100' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.orders.show', $order) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 transition text-xs font-bold">
                            View Details
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection