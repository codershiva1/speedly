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
            📦 My Orders
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Track, view and manage all your orders in one place
        </p>
    </div>
</x-slot>

<div class="py-8 bg-gray-50 container">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <div class="bg-white rounded-2xl shadow overflow-hidden">

            <!-- TABLE HEADER -->
            <div class="p-6 border-b">
                <h3 class="text-lg font-semibold text-gray-800">
                    Recent Orders
                </h3>
            </div>

            <!-- TABLE -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-5 py-3 text-left font-semibold">Order #</th>
                            <th class="px-5 py-3 text-left font-semibold">Date</th>
                            <th class="px-5 py-3 text-left font-semibold">Status</th>
                            <th class="px-5 py-3 text-left font-semibold">Payment</th>
                            <th class="px-5 py-3 text-left font-semibold">Total</th>
                            <th class="px-5 py-3 text-right"></th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @forelse ($orders as $order)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-5 py-4 font-semibold text-indigo-600">
                                    {{ $order->order_number }}
                                </td>

                                <td class="px-5 py-4 text-gray-500">
                                    {{ $order->created_at->format('d M Y, h:i A') }}
                                </td>

                                <td class="px-5 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $order->status === 'completed'
                                            ? 'bg-green-100 text-green-700'
                                            : ($order->status === 'cancelled'
                                                ? 'bg-red-100 text-red-700'
                                                : 'bg-yellow-100 text-yellow-700') }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>

                                <td class="px-5 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $order->payment_status === 'paid'
                                            ? 'bg-emerald-100 text-emerald-700'
                                            : 'bg-orange-100 text-orange-700' }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>

                                <td class="px-5 py-4 font-bold">
                                    ₹{{ number_format($order->total_amount, 2) }}
                                </td>

                                <td class="px-5 py-4 text-right">
                                    <a href="{{ route('account.orders.show', $order) }}"
                                       class="inline-flex items-center gap-1 text-indigo-600 font-semibold hover:underline">
                                        View Details →
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-8 text-center text-gray-500">
                                    😕 You haven’t placed any orders yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <div class="p-5 border-t bg-gray-50">
                {{ $orders->links() }}
            </div>
        </div>

    </div>
</div>

    </x-layouts.site>


