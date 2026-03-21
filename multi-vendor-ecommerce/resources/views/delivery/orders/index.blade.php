<x-delivery-layout>
    <x-slot name="header">
        Active Orders
    </x-slot>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-6">Assigned Deliveries</h3>
        
        <x-auth-session-status class="mb-4" :status="session('success')" />
        <x-input-error :messages="session('error')" class="mb-4" />

        @if($orders->isEmpty())
            <div class="text-center py-10">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No active orders</h3>
                <p class="mt-1 text-sm text-gray-500">You currently have no assigned deliveries.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($orders as $order)
                <!-- Order Card -->
                <div class="border border-gray-200 rounded-lg p-5 flex flex-col md:flex-row md:items-center justify-between {{ $order->delivery_status === 'out_for_delivery' ? 'bg-blue-50 border-blue-200' : 'bg-orange-50' }}">
                    <div class="flex items-start space-x-4 mb-4 md:mb-0 w-full md:w-2/3">
                        <div class="p-3 rounded-lg {{ $order->delivery_status === 'out_for_delivery' ? 'bg-blue-100 text-blue-600' : 'bg-orange-100 text-orange-600' }}">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center space-x-2">
                                <h4 class="font-bold text-gray-900 text-lg">Order #{{ $order->order_number }}</h4>
                                <span class="px-3 py-1 text-xs font-bold rounded-full 
                                    {{ $order->delivery_status === 'assigned' ? 'bg-yellow-200 text-yellow-800' : '' }}
                                    {{ $order->delivery_status === 'picked_up' ? 'bg-indigo-200 text-indigo-800' : '' }}
                                    {{ $order->delivery_status === 'out_for_delivery' ? 'bg-blue-200 text-blue-800' : '' }}">
                                    {{ strtoupper(str_replace('_', ' ', $order->delivery_status)) }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-700 mt-2 font-medium">Customer: {{ $order->shipping_name }}</p>
                            <p class="text-sm text-gray-600 truncate mt-1">Delivery: {{ $order->shipping_address_line1 }}, {{ $order->shipping_city }}</p>
                            <div class="flex items-center mt-3 text-sm text-gray-500 space-x-4">
                                <span><strong>Items:</strong> {{ $order->items->count() }}</span>
                                <span><strong>Amount to Collect:</strong> ₹{{ $order->total_amount }} ({{ $order->payment_method }})</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 w-full md:w-auto">
                        <a href="{{ route('delivery.orders.show', $order) }}" class="flex-1 md:flex-none text-center px-5 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm font-medium transition cursor-pointer">
                            View Details
                        </a>
                        
                        @if($order->delivery_status === 'assigned')
                            <form action="{{ route('delivery.orders.status', $order) }}" method="POST" class="flex-1 md:flex-none">
                                @csrf
                                <input type="hidden" name="status" value="picked_up">
                                <button type="submit" class="w-full px-5 py-2.5 bg-orange-500 text-white rounded-lg hover:bg-orange-600 text-sm font-medium transition shadow-sm">
                                    Mark Picked Up
                                </button>
                            </form>
                        @elseif($order->delivery_status === 'picked_up')
                            <form action="{{ route('delivery.orders.status', $order) }}" method="POST" class="flex-1 md:flex-none">
                                @csrf
                                <input type="hidden" name="status" value="out_for_delivery">
                                <button type="submit" class="w-full px-5 py-2.5 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm font-medium transition shadow-sm">
                                    Start Delivery
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</x-delivery-layout>
