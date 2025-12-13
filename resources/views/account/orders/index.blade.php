<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead>
                            <tr>
                                <th class="px-3 py-2 text-left font-semibold">{{ __('Order #') }}</th>
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
                                    <td class="px-3 py-2">{{ $order->created_at->format('d M Y H:i') }}</td>
                                    <td class="px-3 py-2">{{ ucfirst($order->status) }}</td>
                                    <td class="px-3 py-2">{{ ucfirst($order->payment_status) }}</td>
                                    <td class="px-3 py-2">₹{{ number_format($order->total_amount, 2) }}</td>
                                    <td class="px-3 py-2 text-right">
                                        <a href="{{ route('account.orders.show', $order) }}" class="text-xs text-indigo-600 hover:underline">{{ __('View') }}</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-3 py-4 text-center text-gray-500">{{ __('You have not placed any orders yet.') }}</td>
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
</x-app-layout>
