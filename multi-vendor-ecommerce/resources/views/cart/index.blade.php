<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Cart') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @php $subtotal = $cart->items->sum('total_price'); @endphp

                    @if ($cart->items->isEmpty())
                        <p class="text-gray-500 mb-4">{{ __('Your cart is empty.') }}</p>
                        <a href="{{ route('shop.index') }}" class="text-indigo-600 hover:underline text-sm">
                            {{ __('Continue shopping') }}
                        </a>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 text-sm">
                                <thead>
                                    <tr>
                                        <th class="px-3 py-2 text-left font-semibold">{{ __('Product') }}</th>
                                        <th class="px-3 py-2 text-left font-semibold">{{ __('Price') }}</th>
                                        <th class="px-3 py-2 text-left font-semibold">{{ __('Quantity') }}</th>
                                        <th class="px-3 py-2 text-left font-semibold">{{ __('Total') }}</th>
                                        <th class="px-3 py-2"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach ($cart->items as $item)
                                        <tr>
                                            <td class="px-3 py-2">
                                                <div class="font-semibold">{{ $item->product->name }}</div>
                                            </td>
                                            <td class="px-3 py-2">₹{{ number_format($item->unit_price, 2) }}</td>
                                            <td class="px-3 py-2">
                                                <form method="POST" action="{{ route('account.cart.items.update', $item) }}" class="inline-flex items-center space-x-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="number" name="quantity" min="1" value="{{ $item->quantity }}" class="w-16 border-gray-300 rounded-md text-sm" />
                                                    <button type="submit" class="text-xs text-indigo-600 hover:underline">{{ __('Update') }}</button>
                                                </form>
                                            </td>
                                            <td class="px-3 py-2">₹{{ number_format($item->total_price, 2) }}</td>
                                            <td class="px-3 py-2 text-right">
                                                <form method="POST" action="{{ route('account.cart.items.destroy', $item) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-xs text-red-600 hover:underline" onclick="return confirm('Remove this item?')">{{ __('Remove') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6 flex justify-between items-center">
                            <div>
                                <a href="{{ route('shop.index') }}" class="text-sm text-indigo-600 hover:underline">
                                    {{ __('Continue shopping') }}
                                </a>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-600">{{ __('Subtotal') }}: <span class="font-semibold">₹{{ number_format($subtotal, 2) }}</span></p>
                                <p class="text-xs text-gray-400">{{ __('Shipping and discounts will be calculated at checkout.') }}</p>
                                <a href="{{ route('account.checkout.index') }}" class="mt-3 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                                    {{ __('Proceed to Checkout') }}
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
