<x-layouts.site :title="__('Customer Dashboard').' | '.config('app.name')">
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800">
            👋 Welcome Back,
            <span class="text-indigo-600">{{ auth()->user()->name }}</span>
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Here’s a quick overview of your account activity
        </p>
    </x-slot>

    <div class="py-8 bg-gray-50 container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- 🔹 STATS CARDS -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 text-white rounded-2xl p-5 shadow-lg hover:scale-[1.02] transition">
                    <p class="text-sm opacity-80">Total Orders</p>
                    <p class="text-3xl font-bold mt-2">{{ $ordersCount }}</p>
                </div>

                <div class="bg-white rounded-2xl p-5 shadow hover:shadow-lg transition">
                    <p class="text-sm text-gray-500">Pending Orders</p>
                    <p class="text-3xl font-bold text-yellow-500 mt-2">{{ $pendingOrdersCount }}</p>
                </div>

                <div class="bg-white rounded-2xl p-5 shadow hover:shadow-lg transition">
                    <p class="text-sm text-gray-500">Completed Orders</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $completedOrdersCount }}</p>
                </div>

                <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-2xl p-5 shadow-lg hover:scale-[1.02] transition">
                    <p class="text-sm opacity-80">Total Spent</p>
                    <p class="text-3xl font-bold mt-2">₹{{ number_format($totalSpent, 2) }}</p>
                </div>

            </div>

            <!-- 🔹 QUICK ACTIONS -->
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('shop.index') }}"
                   class="flex items-center gap-2 px-2 py-2 rounded-xl bg-indigo-600 text-white text-sm font-semibold shadow hover:bg-indigo-500 transition">
                    🛍️ Shop Now
                </a>

                <a href="{{ route('account.orders.index') }}"
                   class="flex items-center gap-2 px-2 py-2 rounded-xl bg-white border text-sm font-semibold shadow hover:bg-gray-100 transition">
                    📦 My Orders
                </a>

                <a href="{{ route('account.cart.index') }}"
                   class="flex items-center gap-2 px-2 py-2 rounded-xl bg-white border text-sm font-semibold shadow hover:bg-gray-100 transition">
                    🛒 My Cart
                </a>
            </div>

            <!-- 🔹 RECENT ORDERS -->
            <div class="bg-white rounded-2xl shadow">
                <div class="p-6 border-b">
                    <h3 class="text-lg font-bold text-gray-800">
                        📄 Recent Orders
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-5 py-3 text-left font-semibold">Order #</th>
                                <th class="px-5 py-3 text-left font-semibold">Date</th>
                                <th class="px-5 py-3 text-left font-semibold">Status</th>
                                <th class="px-5 py-3 text-left font-semibold">Total</th>
                                <th class="px-5 py-3 text-right"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse ($recentOrders as $order)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-5 py-4 font-medium">
                                        {{ $order->order_number }}
                                    </td>
                                    <td class="px-5 py-4 text-gray-500">
                                        {{ $order->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-5 py-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                                            {{ $order->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 font-semibold">
                                        ₹{{ number_format($order->total_amount, 2) }}
                                    </td>
                                    <td class="px-5 py-4 text-right">
                                        <a href="{{ route('account.orders.show', $order) }}"
                                           class="text-indigo-600 font-semibold hover:underline">
                                            View →
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-5 py-6 text-center text-gray-500">
                                        No recent orders found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-layouts.site>
