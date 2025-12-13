<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('account.checkout.store') }}">
                        @csrf

                        <h3 class="font-semibold mb-4">{{ __('Shipping Details') }}</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="shipping_name" :value="__('Full Name')" />
                                <x-text-input id="shipping_name" name="shipping_name" type="text" class="mt-1 block w-full" :value="old('shipping_name', $user->name)" required />
                                <x-input-error :messages="$errors->get('shipping_name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="shipping_phone" :value="__('Phone')" />
                                <x-text-input id="shipping_phone" name="shipping_phone" type="text" class="mt-1 block w-full" :value="old('shipping_phone')" required />
                                <x-input-error :messages="$errors->get('shipping_phone')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="shipping_email" :value="__('Email')" />
                                <x-text-input id="shipping_email" name="shipping_email" type="email" class="mt-1 block w-full" :value="old('shipping_email', $user->email)" required />
                                <x-input-error :messages="$errors->get('shipping_email')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="shipping_address_line1" :value="__('Address Line 1')" />
                                <x-text-input id="shipping_address_line1" name="shipping_address_line1" type="text" class="mt-1 block w-full" :value="old('shipping_address_line1')" required />
                                <x-input-error :messages="$errors->get('shipping_address_line1')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="shipping_address_line2" :value="__('Address Line 2')" />
                                <x-text-input id="shipping_address_line2" name="shipping_address_line2" type="text" class="mt-1 block w-full" :value="old('shipping_address_line2')" />
                                <x-input-error :messages="$errors->get('shipping_address_line2')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="shipping_city" :value="__('City')" />
                                <x-text-input id="shipping_city" name="shipping_city" type="text" class="mt-1 block w-full" :value="old('shipping_city')" required />
                                <x-input-error :messages="$errors->get('shipping_city')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="shipping_state" :value="__('State')" />
                                <x-text-input id="shipping_state" name="shipping_state" type="text" class="mt-1 block w-full" :value="old('shipping_state')" required />
                                <x-input-error :messages="$errors->get('shipping_state')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="shipping_postal_code" :value="__('Postal Code')" />
                                <x-text-input id="shipping_postal_code" name="shipping_postal_code" type="text" class="mt-1 block w-full" :value="old('shipping_postal_code')" required />
                                <x-input-error :messages="$errors->get('shipping_postal_code')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="shipping_country" :value="__('Country')" />
                                <x-text-input id="shipping_country" name="shipping_country" type="text" class="mt-1 block w-full" :value="old('shipping_country', 'India')" />
                                <x-input-error :messages="$errors->get('shipping_country')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="notes" :value="__('Order Notes (optional)')" />
                            <textarea id="notes" name="notes" rows="3" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('notes') }}</textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>

                        <div class="mt-6">
                            <x-primary-button>{{ __('Place Order (Cash on Delivery)') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold mb-4">{{ __('Order Summary') }}</h3>

                    @php $subtotal = $cart->items->sum('total_price'); @endphp

                    <ul class="divide-y divide-gray-100 text-sm mb-4">
                        @foreach ($cart->items as $item)
                            <li class="py-2 flex justify-between">
                                <span>{{ $item->product->name }} × {{ $item->quantity }}</span>
                                <span>₹{{ number_format($item->total_price, 2) }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <div class="border-t border-gray-200 pt-3 text-sm">
                        <div class="flex justify-between">
                            <span>{{ __('Subtotal') }}</span>
                            <span>₹{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-500 text-xs mt-1">
                            <span>{{ __('Shipping') }}</span>
                            <span>{{ __('Calculated as 0 for now') }}</span>
                        </div>
                        <div class="flex justify-between font-semibold mt-2">
                            <span>{{ __('Total') }}</span>
                            <span>₹{{ number_format($subtotal, 2) }}</span>
                        </div>
                    </div>

                    <p class="mt-3 text-xs text-gray-500">
                        {{ __('Payment method: Cash on Delivery (COD). Online payment gateways can be integrated later.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
