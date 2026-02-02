@extends('layouts.admin.app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>


     <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Orders</h1>
        <!-- <a href="{{ route('admin.coupons.create') }}"
           class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Add Orders
        </a> -->
    </div>

    @if(session('status'))
        <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
            {{ session('status') }}
        </div>
    @endif

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-sm">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-3 py-2 text-left font-semibold">{{ __('Order #') }}</th>
                                <th class="px-3 py-2 text-left font-semibold">{{ __('Customer') }}</th>
                                <th class="px-3 py-2 text-left font-semibold">{{ __('Date') }}</th>
                                <th class="px-3 py-2 text-left font-semibold">{{ __('Status') }}</th>
                                <th class="px-3 py-2 text-left font-semibold">{{ __('Payment') }}</th>
                                <th class="px-3 py-2 text-left font-semibold">{{ __('Total') }}</th>
                                <th class="px-3 py-2"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($orders as $order)
                                <tr>
                                    <td class="px-3 py-2">{{ $order->order_number }}</td>
                                    <td class="px-3 py-2">{{ optional($order->user)->name }}</td>
                                    <td class="px-3 py-2">{{ $order->created_at->format('d M Y H:i') }}</td>
                                    <td class="px-3 py-2">{{ ucfirst($order->status) }}</td>
                                    <td class="px-3 py-2">{{ ucfirst($order->payment_status) }}</td>
                                    <td class="px-3 py-2">₹{{ number_format($order->total_amount, 2) }}</td>
                                    <td class="px-3 py-2 text-right">
                                        <a href="{{ route('admin.orders.show', $order) }}" class="text-xs text-indigo-600 hover:underline">{{ __('View') }}</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-3 py-4 text-center text-gray-500">{{ __('No orders found.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
