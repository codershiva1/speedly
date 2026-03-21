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
                </div>
            </div>

            <!-- Delivery Assignment Box -->
            <div class="bg-white p-6 shadow-sm sm:rounded-lg mb-6 border border-gray-100">
                <h3 class="font-bold text-gray-800 mb-4">{{ __('Delivery Assignment') }}</h3>
                
                @if($order->deliveryBoy)
                    <div class="p-3 bg-green-50 border border-green-100 rounded-lg flex items-center gap-3 mb-4">
                        <div class="h-10 w-10 rounded-full bg-green-200 flex items-center justify-center text-green-800 font-bold">
                            {{ substr($order->deliveryBoy->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-800">{{ $order->deliveryBoy->name }}</p>
                            <p class="text-xs text-green-700 font-medium">Status: {{ strtoupper(str_replace('_', ' ', $order->delivery_status)) }}</p>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500">Delivery OTP: <span class="font-bold tracking-widest">{{ $order->delivery_otp }}</span></p>
                @endif

                <form action="{{ route('vendor.orders.assign', $order) }}" method="POST" class="mt-4">
                    @csrf
                    <x-input-label for="delivery_boy_id" :value="__($order->deliveryBoy ? 'Reassign Delivery Boy' : 'Assign Delivery Boy')" class="mb-2 text-xs font-bold uppercase text-gray-500" />
                    <div class="flex gap-2">
                        <select name="delivery_boy_id" required class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            <option value="">-- Choose Rider --</option>
                            @foreach($deliveryBoys as $boy)
                                <option value="{{ $boy->id }}" @selected($order->delivery_boy_id == $boy->id)>{{ $boy->name }}</option>
                            @endforeach
                        </select>
                        <x-primary-button class="bg-orange-500 hover:bg-orange-600 px-4 py-2">
                            {{ __('Assign') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-sm">
                    <h3 class="font-semibold mb-3">{{ __('Items (Your Products)') }}</h3>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-3 py-2 text-left font-semibold text-xs">{{ __('Product') }}</th>
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
