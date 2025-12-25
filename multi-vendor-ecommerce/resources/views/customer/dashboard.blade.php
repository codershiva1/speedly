<x-layouts.site :title="__('Customer Dashboard').' | '.config('app.name')">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                <div class="bg-white shadow-sm rounded-lg p-4">
                    <p class="text-xs text-gray-500">{{ __('Orders') }}</p>
                    <p class="text-xl font-semibold mt-1">{{ $ordersCount }}</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-4">
                    <p class="text-xs text-gray-500">{{ __('Pending') }}</p>
                    <p class="text-xl font-semibold mt-1">{{ $pendingOrdersCount }}</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-4">
                    <p class="text-xs text-gray-500">{{ __('Completed') }}</p>
                    <p class="text-xl font-semibold mt-1">{{ $completedOrdersCount }}</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-4">
                    <p class="text-xs text-gray-500">{{ __('Total Spent') }}</p>
                    <p class="text-xl font-semibold mt-1">₹{{ number_format($totalSpent, 2) }}</p>
                </div>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('shop.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                    {{ __('Shop Now') }}
                </a>
                <a href="{{ route('account.orders.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50">
                    {{ __('View Orders') }}
                </a>
                <a href="{{ route('account.cart.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50">
                    {{ __('View Cart') }}
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-sm">
                    <h3 class="font-semibold mb-3">{{ __('Recent Orders') }}</h3>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-3 py-2 text-left font-semibold text-xs">{{ __('Order #') }}</th>
                                <th class="px-3 py-2 text-left font-semibold text-xs">{{ __('Date') }}</th>
                                <th class="px-3 py-2 text-left font-semibold text-xs">{{ __('Status') }}</th>
                                <th class="px-3 py-2 text-left font-semibold text-xs">{{ __('Total') }}</th>
                                <th class="px-3 py-2"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($recentOrders as $order)
                                <tr>
                                    <td class="px-3 py-2">{{ $order->order_number }}</td>
                                    <td class="px-3 py-2">{{ $order->created_at->format('d M Y H:i') }}</td>
                                    <td class="px-3 py-2 text-xs">{{ ucfirst($order->status) }}</td>
                                    <td class="px-3 py-2">₹{{ number_format($order->total_amount, 2) }}</td>
                                    <td class="px-3 py-2 text-right">
                                        <a href="{{ route('account.orders.show', $order) }}" class="text-xs text-indigo-600 hover:underline">{{ __('View') }}</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-3 py-4 text-center text-gray-500">{{ __('No recent orders.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts.site>