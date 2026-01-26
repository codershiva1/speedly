<!-- {{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot> --}} -->

    <x-layouts.site :title="config('app.name', 'Speedly Shop')">

    @push('styles')
        @vite(['resources/css/home.css'])
    @endpush

    @push('scripts')
        @vite(['resources/js/homeslider.js'])
    @endpush

    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-100 py-10">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- LEFT : SHIPPING FORM -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg border border-gray-100">
            <div class="p-8">

                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                    🚚 Shipping Details
                </h2>

                <form method="POST" action="{{ route('account.checkout.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        @foreach ([
                            ['shipping_name','Full Name',$user->name],
                            ['shipping_phone','Phone',''],
                            ['shipping_email','Email',$user->email],
                            ['shipping_city','City',''],
                            ['shipping_state','State',''],
                            ['shipping_postal_code','Postal Code','']
                        ] as [$name,$label,$value])
                        <div>
                            <x-input-label for="{{ $name }}" :value="__($label)" />
                            <x-text-input
                                id="{{ $name }}"
                                name="{{ $name }}"
                                type="text"
                                class="mt-1 block w-full rounded-xl focus:ring-2 focus:ring-indigo-500"
                                :value="old($name,$value)"
                                required
                            />
                            <x-input-error :messages="$errors->get($name)" class="mt-2" />
                        </div>
                        @endforeach

                        <div class="md:col-span-2">
                            <x-input-label for="shipping_address_line1" :value="__('Address Line 1')" />
                            <x-text-input id="shipping_address_line1" name="shipping_address_line1"
                                class="mt-1 block w-full rounded-xl"
                                :value="old('shipping_address_line1')" required />
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="shipping_address_line2" :value="__('Address Line 2 (Optional)')" />
                            <x-text-input id="shipping_address_line2" name="shipping_address_line2"
                                class="mt-1 block w-full rounded-xl"
                                :value="old('shipping_address_line2')" />
                        </div>
                    </div>

                    <div class="mt-5">
                        <x-input-label for="notes" :value="__('Order Notes (Optional)')" />
                        <textarea id="notes" name="notes" rows="3"
                            class="mt-1 w-full rounded-xl border-gray-300 focus:ring-indigo-500"
                            placeholder="Any delivery instructions?">{{ old('notes') }}</textarea>
                    </div>

                    <!-- TRUST -->
                    <div class="mt-6 flex items-center gap-3 text-sm text-gray-600 bg-gray-50 p-4 rounded-xl">
                        🔒 <span>Your information is 100% secure & never shared</span>
                    </div>

                    <div class="mt-8">
                        <x-primary-button
                            class="w-full py-3 text-lg rounded-xl bg-indigo-600 hover:bg-indigo-700 shadow-lg">
                            ✅ Place Order (Cash on Delivery)
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>

        <!-- RIGHT : ORDER SUMMARY -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 sticky top-6 h-fit">
            <div class="p-6">

                <h3 class="text-xl font-semibold mb-4 flex items-center gap-2">
                    🧾 Order Summary
                </h3>

                @php
                    $subtotal = $cart->items->sum('total_price');
                    $discount = session('applied_coupon.discount', 0);
                    $finalTotal = max($subtotal - $discount, 0);
                @endphp


                <ul class="divide-y text-sm mb-4">
                    @foreach ($cart->items as $item)
                        <li class="py-3 flex justify-between">
                            <span class="text-gray-700">
                                {{ $item->product->name }}
                                <span class="text-xs text-gray-400">× {{ $item->quantity }}</span>
                            </span>
                            <span class="font-medium">₹{{ number_format($item->total_price, 2) }}</span>
                        </li>
                    @endforeach
                </ul>

                <div class="border-t pt-4 space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span>₹{{ number_format($subtotal, 2) }}</span>
                    </div>

                    @if($discount > 0)
                        <div class="flex justify-between text-green-700">
                            <span>Coupon Discount</span>
                            <span>-₹{{ number_format($discount, 2) }}</span>
                        </div>
                    @endif

                    <div class="flex justify-between text-gray-500">
                        <span>Shipping</span>
                        <span>Free</span>
                    </div>

                    <div class="flex justify-between font-bold text-lg pt-2">
                        <span>Total</span>
                        <span class="text-indigo-600">
                            ₹{{ number_format($finalTotal, 2) }}
                        </span>
                    </div>
                </div>


                <div class="mt-4 bg-green-50 border border-green-200 rounded-xl p-3 text-xs text-green-700">
                    💵 Cash on Delivery available <br>
                    📦 Fast & safe delivery across India
                </div>
            </div>
        </div>
    </div>
</div>

</x-layouts.site>
<!-- {{-- </x-app-layout> --}} -->
