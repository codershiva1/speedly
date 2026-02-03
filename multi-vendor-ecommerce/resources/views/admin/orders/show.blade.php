@extends('layouts.admin.app')

@section('content')

        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
                {{ __('Order #') }}{{ $order->order_number }}
            </h2>
            <a href="{{ route('admin.orders.index') }}" class="text-sm text-indigo-600 hover:underline font-medium">
                &larr; Back to Orders
            </a>
        </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white p-6 shadow-sm sm:rounded-2xl border border-gray-100">
                <form action="{{ route('admin.orders.status.update', $order) }}" method="POST" class="flex flex-wrap items-end gap-4">
                    @csrf
                    @method('PATCH')
                    
                    <div class="flex-1 min-w-[200px]">
                        <x-input-label for="status" :value="__('Update Order Status')" class="mb-2 text-xs font-bold uppercase text-gray-500" />
                        <select name="status" class="w-full rounded-xl border-gray-200 focus:ring-indigo-500 text-sm">
                            <option value="pending" @selected($order->status == 'pending')>Pending</option>
                            <option value="confirmed" @selected($order->status == 'confirmed')>Confirmed</option>
                            <option value="shipped" @selected($order->status == 'shipped')>Shipped</option>
                            <option value="delivered" @selected($order->status == 'delivered')>Delivered</option>
                            <option value="cancelled" @selected($order->status == 'cancelled')>Cancelled</option>
                        </select>
                    </div>

                    <div class="flex-1 min-w-[200px]">
                        <x-input-label for="payment_status" :value="__('Update Payment')" class="mb-2 text-xs font-bold uppercase text-gray-500" />
                        <select name="payment_status" class="w-full rounded-xl border-gray-200 focus:ring-indigo-500 text-sm">
                            <option value="pending" @selected($order->payment_status == 'pending')>Pending</option>
                            <option value="paid" @selected($order->payment_status == 'paid')>Paid</option>
                            <option value="failed" @selected($order->payment_status == 'failed')>Failed</option>
                            <option value="refunded" @selected($order->payment_status == 'refunded')>Refunded</option>
                        </select>
                    </div>

                    <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 h-[42px] px-6 rounded-xl transition">
                        {{ __('Update') }}
                    </x-primary-button>
                </form>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                        <div class="p-6">
                            <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 me-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                {{ __('Order Items') }}
                            </h3>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    <thead>
                                        <tr class="text-xs uppercase text-gray-400 border-b border-gray-50">
                                            <th class="py-3 font-semibold">{{ __('Product') }}</th>
                                            <th class="py-3 font-semibold">{{ __('Price') }}</th>
                                            <th class="py-3 font-semibold text-center">{{ __('Qty') }}</th>
                                            <th class="py-3 font-semibold text-right">{{ __('Total') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-50">
                                        @foreach ($order->items as $item)
                                            <tr>
                                                <td class="py-4">
                                                    <div class="font-bold text-gray-800 text-sm">{{ $item->product_name }}</div>
                                                    <div class="text-[10px] text-gray-400 uppercase">Vendor: {{ optional($item->vendor)->name }}</div>
                                                </td>
                                                <td class="py-4 text-sm text-gray-600">₹{{ number_format($item->unit_price, 2) }}</td>
                                                <td class="py-4 text-sm text-gray-600 text-center">{{ $item->quantity }}</td>
                                                <td class="py-4 text-sm font-bold text-gray-800 text-right">₹{{ number_format($item->total_price, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white p-6 shadow-sm sm:rounded-2xl border border-gray-100">
                        <h3 class="font-bold text-gray-800 mb-4">{{ __('Customer Details') }}</h3>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 font-bold">
                                    {{ substr(optional($order->user)->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800">{{ optional($order->user)->name }}</p>
                                    <p class="text-xs text-gray-500">{{ optional($order->user)->email }}</p>
                                </div>
                            </div>
                            <hr class="border-gray-50">
                            <div>
                                <p class="text-[10px] uppercase font-bold text-gray-400 mb-1">{{ __('Shipping Address') }}</p>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    {{ $order->shipping_name }}<br>
                                    {{ $order->shipping_address_line1 }}<br>
                                    {{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_postal_code }}<br>
                                    <span class="font-bold">{{ $order->shipping_phone }}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-indigo-900 p-6 shadow-sm sm:rounded-2xl text-white">
                        <h3 class="font-bold mb-4 opacity-80 uppercase text-xs tracking-widest">{{ __('Payment Summary') }}</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="opacity-70">Subtotal</span>
                                <span>₹{{ number_format($order->subtotal_amount, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="opacity-70">Shipping</span>
                                <span>₹{{ number_format($order->shipping_amount, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-red-300">
                                <span class="opacity-70">Discount</span>
                                <span>-₹{{ number_format($order->discount_amount, 2) }}</span>
                            </div>
                            <hr class="border-indigo-800 my-2">
                            <div class="flex justify-between font-extrabold text-lg">
                                <span>Total Paid</span>
                                <span>₹{{ number_format($order->total_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection