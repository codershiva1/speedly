<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vendor Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white shadow-sm rounded-lg p-4">
                    <p class="text-xs text-gray-500">{{ __('Products') }}</p>
                    <p class="text-xl font-semibold mt-1">{{ $productsCount }}</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-4">
                    <p class="text-xs text-gray-500">{{ __('Orders') }}</p>
                    <p class="text-xl font-semibold mt-1">{{ $ordersCount }}</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-4">
                    <p class="text-xs text-gray-500">{{ __('Revenue (all orders)') }}</p>
                    <p class="text-xl font-semibold mt-1">₹{{ number_format($revenue, 2) }}</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-sm">
                    <h3 class="font-semibold mb-3">{{ __('Recent Orders for Your Products') }}</h3>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-3 py-2 text-left font-semibold text-xs">{{ __('Order #') }}</th>
                                <th class="px-3 py-2 text-left font-semibold text-xs">{{ __('Customer') }}</th>
                                <th class="px-3 py-2 text-left font-semibold text-xs">{{ __('Date') }}</th>
                                <th class="px-3 py-2 text-left font-semibold text-xs">{{ __('Status') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($recentOrders as $order)
                                <tr>
                                    <td class="px-3 py-2">{{ $order->order_number }}</td>
                                    <td class="px-3 py-2">{{ optional($order->user)->name }}</td>
                                    <td class="px-3 py-2">{{ $order->created_at->format('d M Y H:i') }}</td>
                                    <td class="px-3 py-2 text-xs">{{ ucfirst($order->status) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-3 py-4 text-center text-gray-500">{{ __('No orders yet.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
