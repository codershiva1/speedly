<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-sm">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-semibold">{{ __('Order #') }} {{ $order->order_number }}</p>
                            <p class="text-gray-500 text-xs mt-1">{{ $order->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div class="text-right text-xs">
                            <p>{{ __('Customer') }}: <span class="font-semibold">{{ optional($order->user)->name }}</span></p>
                            <p>{{ __('Status') }}: <span class="font-semibold">{{ ucfirst($order->status) }}</span></p>
                            <p>{{ __('Payment') }}: <span class="font-semibold">{{ ucfirst($order->payment_status) }}</span></p>
                        </div>
                    </div>

                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h3 class="font-semibold mb-2">{{ __('Shipping To') }}</h3>
                            <p>{{ $order->shipping_name }}</p>
                            <p class="text-gray-600">{{ $order->shipping_address_line1 }}</p>
                            @if ($order->shipping_address_line2)
                                <p class="text-gray-600">{{ $order->shipping_address_line2 }}</p>
                            @endif
                            <p class="text-gray-600">{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_postal_code }}</p>
                            <p class="text-gray-600">{{ $order->shipping_country }}</p>
                            <p class="mt-1 text-gray-600">{{ $order->shipping_phone }}</p>
                        </div>

                        <div>
                            <h3 class="font-semibold mb-2">{{ __('Summary') }}</h3>
                            <p class="flex justify-between"><span>{{ __('Subtotal') }}</span> <span>₹{{ number_format($order->subtotal_amount, 2) }}</span></p>
                            <p class="flex justify-between text-gray-600 text-xs mt-1"><span>{{ __('Discount') }}</span> <span>₹{{ number_format($order->discount_amount, 2) }}</span></p>
                            <p class="flex justify-between text-gray-600 text-xs mt-1"><span>{{ __('Shipping') }}</span> <span>₹{{ number_format($order->shipping_amount, 2) }}</span></p>
                            <p class="flex justify-between font-semibold mt-2"><span>{{ __('Total') }}</span> <span>₹{{ number_format($order->total_amount, 2) }}</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-sm">
                    <h3 class="font-semibold mb-3">{{ __('Items') }}</h3>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-3 py-2 text-left font-semibold text-xs">{{ __('Product') }}</th>
                                <th class="px-3 py-2 text-left font-semibold text-xs">{{ __('Vendor') }}</th>
                                <th class="px-3 py-2 text-left font-semibold text-xs">{{ __('Quantity') }}</th>
                                <th class="px-3 py-2 text-left font-semibold text-xs">{{ __('Unit Price') }}</th>
                                <th class="px-3 py-2 text-left font-semibold text-xs">{{ __('Total') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($order->items as $item)
                                <tr>
                                    <td class="px-3 py-2">
                                        {{ $item->product_name }}
                                    </td>
                                    <td class="px-3 py-2 text-xs text-gray-600">
                                        {{ optional($item->vendor)->name }}
                                    </td>
                                    <td class="px-3 py-2">{{ $item->quantity }}</td>
                                    <td class="px-3 py-2">₹{{ number_format($item->unit_price, 2) }}</td>
                                    <td class="px-3 py-2">₹{{ number_format($item->total_price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
