<!-- {{-- <x-app-layout></x-app-layout> --}} -->

<x-layouts.site :title="config('app.name', 'Speedly Shop')">

    @push('styles')
        @vite(['resources/css/home.css'])
    @endpush

    @push('scripts')
        @vite(['resources/js/homeslider.js'])
    @endpush

    <x-slot name="header">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">
            🧾 Order Details
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Review your order information and purchased items
        </p>
    </div>
</x-slot>

<div class="py-8 bg-gray-50 container">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <!-- 🔹 ORDER INFO -->
        <div class="bg-white rounded-2xl shadow p-6">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">

                <div>
                    <p class="text-sm text-gray-500">Order Number</p>
                    <p class="text-lg font-bold text-indigo-600">
                        #{{ $order->order_number }}
                    </p>
                    <p class="text-xs text-gray-500 mt-1">
                        {{ $order->created_at->format('d M Y, h:i A') }}
                    </p>
                </div>

                <div class="flex gap-3">
                    <span class="px-4 py-1 rounded-full text-xs font-semibold
                        {{ $order->status === 'completed'
                            ? 'bg-green-100 text-green-700'
                            : ($order->status === 'cancelled'
                                ? 'bg-red-100 text-red-700'
                                : 'bg-yellow-100 text-yellow-700') }}">
                        {{ ucfirst($order->status) }}
                    </span>

                    <span class="px-4 py-1 rounded-full text-xs font-semibold
                        {{ $order->payment_status === 'paid'
                            ? 'bg-emerald-100 text-emerald-700'
                            : 'bg-orange-100 text-orange-700' }}">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </div>

            </div>
        </div>

        <!-- 🔹 SHIPPING + SUMMARY -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- SHIPPING -->
            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="font-bold text-gray-800 mb-3">
                    🚚 Shipping Details
                </h3>

                <p class="font-semibold">{{ $order->shipping_name }}</p>
                <p class="text-gray-600 mt-1">{{ $order->shipping_address_line1 }}</p>

                @if ($order->shipping_address_line2)
                    <p class="text-gray-600">{{ $order->shipping_address_line2 }}</p>
                @endif

                <p class="text-gray-600">
                    {{ $order->shipping_city }},
                    {{ $order->shipping_state }}
                    {{ $order->shipping_postal_code }}
                </p>

                <p class="text-gray-600">{{ $order->shipping_country }}</p>

                <p class="mt-2 text-sm font-semibold text-gray-700">
                    📞 {{ $order->shipping_phone }}
                </p>
            </div>

            <!-- SUMMARY -->
            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="font-bold text-gray-800 mb-3">
                    💳 Order Summary
                </h3>

                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span>₹{{ number_format($order->subtotal_amount, 2) }}</span>
                    </div>

                    <div class="flex justify-between text-gray-500">
                        <span>Discount</span>
                        <span>- ₹{{ number_format($order->discount_amount, 2) }}</span>
                    </div>

                    <div class="flex justify-between text-gray-500">
                        <span>Shipping</span>
                        <span>₹{{ number_format($order->shipping_amount, 2) }}</span>
                    </div>

                    <hr>

                    <div class="flex justify-between text-lg font-bold">
                        <span>Total</span>
                        <span class="text-indigo-600">
                            ₹{{ number_format($order->total_amount, 2) }}
                        </span>
                    </div>
                </div>

                <p class="mt-3 text-xs text-gray-500">
                    Payment Method: <strong>Cash on Delivery (COD)</strong>
                </p>
            </div>

        </div>

        <!-- 🔹 ORDER ITEMS -->
        <div class="bg-white rounded-2xl shadow overflow-hidden">

            <div class="p-6 border-b">
                <h3 class="text-lg font-bold text-gray-800">
                    🛍️ Ordered Items
                </h3>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-5 py-3 text-left font-semibold">Product</th>
                            <th class="px-5 py-3 text-left font-semibold">Vendor</th>
                            <th class="px-5 py-3 text-left font-semibold">Qty</th>
                            <th class="px-5 py-3 text-left font-semibold">Unit Price</th>
                            <th class="px-5 py-3 text-left font-semibold">Total</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @foreach ($order->items as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-5 py-4 font-semibold">
                                    {{ $item->product_name }}
                                </td>
                                <td class="px-5 py-4 text-gray-500">
                                    {{ optional($item->vendor)->name ?? '—' }}
                                </td>
                                <td class="px-5 py-4">
                                    × {{ $item->quantity }}
                                </td>
                                <td class="px-5 py-4">
                                    ₹{{ number_format($item->unit_price, 2) }}
                                </td>
                                <td class="px-5 py-4 font-semibold">
                                    ₹{{ number_format($item->total_price, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>

</x-layouts.site>
