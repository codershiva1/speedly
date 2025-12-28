<x-layouts.site :title="config('app.name', 'Speedly Shop')">

    @push('styles')
        @vite(['resources/css/home.css'])
    @endpush

    @push('scripts')
        @vite(['resources/js/homeslider.js'])
    @endpush

   



   {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Cart') }}
        </h2>
    </x-slot>  --}}

    

@php $subtotal = $cart->items->sum('total_price'); @endphp

<div class="bg-gray-100 min-h-screen py-4 sm:py-8">
    <div class="max-w-7xl mx-auto px-3 sm:px-4 grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">

        <!-- LEFT -->
        <div class="lg:col-span-2 space-y-3 sm:space-y-4">

            <!-- HEADER -->
            <div class="bg-white shadow p-3 sm:p-4 rounded-xl">
                <h1 class="text-lg sm:text-xl font-bold text-gray-800">
                    🛒 My Cart
                    <span class="text-sm text-gray-500 font-normal">
                        ({{ $cart->items->count() }} items)
                    </span>
                </h1>
            </div>

            <!-- CART ITEMS -->
           @foreach ($cart->items as $item)
            <div class="bg-white rounded-xl shadow p-3 sm:p-4
                        flex flex-col sm:flex-row gap-3 sm:gap-4 cart-item relative"
                data-id="{{ $item->id }}"
                data-unit="{{ $item->unit_price }}">

                <!-- REMOVE (DESKTOP) -->
                <!-- <button 
                        class="hidden sm:flex absolute top-3 right-3 text-gray-400 hover:text-red-500">
                    <form method="POST" action="{{ route('account.cart.items.destroy', $item) }}"> @csrf @method('DELETE') <button type="submit" class="text-xs text-red-600 hover:underline" onclick="return confirm('Remove this item?')">{{ __('Remove') }}</button> </form>
                </button> -->

                <!-- IMAGE -->
                <div class="w-full sm:w-28 h-40 sm:h-28 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                    <img src="http://localhost/speedly/multi-vendor-ecommerce/public/storage/uploads/products/2/image7.png"
                        class="w-full h-full object-cover">
                </div>

                <!-- INFO -->
                <div class="flex-1">
                    <h2 class="font-semibold text-sm sm:text-base">
                        {{ $item->product->name }}
                    </h2>

                    <p class="text-base sm:text-lg font-bold mt-1">
                        ₹{{ number_format($item->unit_price,2) }}
                    </p>

                    <!-- QTY -->
                    <div class="mt-3 inline-flex items-center border rounded-lg overflow-hidden">
                        <button onclick="updateQty({{ $item->id }}, -1)"
                                class="px-4 py-2 bg-gray-100 text-lg">−</button>

                        <input id="qty-{{ $item->id }}"
                            value="{{ $item->quantity }}"
                            readonly
                            class="w-14 text-center border-0">

                        <button onclick="updateQty({{ $item->id }}, 1)"
                                class="px-4 py-2 bg-gray-100 text-lg">+</button>
                    </div>

                    <!-- REMOVE (MOBILE) -->
                    <button onclick="removeItem({{ $item->id }})"
                            class="sm:hidden mt-3 text-red-500 text-sm font-medium">
                        <form method="POST" action="{{ route('account.cart.items.destroy', $item) }}"> @csrf @method('DELETE') <button type="submit" class="text-xs text-red-600 hover:underline" onclick="return confirm('Remove this item?')">{{ __('Remove') }}</button> </form>
                    </button>
                </div>

                <!-- PRICE -->
                <div class="text-left sm:text-right sm:min-w-[120px] flex sm:block items-center justify-between">
                    <span class="text-sm text-gray-500 sm:hidden">Total</span>
                    <p class="text-lg font-bold mt-4">
                        ₹<span id="item-total-{{ $item->id }}">
                            {{ number_format($item->total_price,2) }}
                        </span>
                    </p>
                </div>
            </div>
            @endforeach
            <a href="{{ route('shop.index') }}" class="text-indigo-600 hover:underline text-sm"> {{ __('Continue shopping') }} </a>
        </div>

        <!-- RIGHT -->
        <div class="lg:sticky lg:top-6 h-fit">
            <div class="bg-white rounded-xl shadow p-4 sm:p-6">

                <h2 class="font-bold mb-3 sm:mb-4">Price Details</h2>

                @php $subtotal = $cart->items->sum('total_price'); @endphp

                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span id="cart-subtotal">₹{{ number_format($subtotal, 2) }}</span>
                    </div>

                    <div class="flex justify-between text-green-600">
                        <span>Delivery</span>
                        <span>FREE</span>
                    </div>

                    <div class="border-t pt-3 flex justify-between font-bold text-base">
                        <span>Total</span>
                        <span id="cart-total">₹{{ number_format($subtotal, 2) }}</span>
                    </div>
                </div>

                <a href="{{ route('account.checkout.index') }}"
                   class="block mt-5 sm:mt-6 bg-orange-500 text-white text-center py-2.5 rounded-lg font-semibold active:bg-orange-600">
                    PLACE ORDER
                </a>
            </div>
        </div>

    </div>
</div>




</x-layouts.site>


<script>
     const updateCartUrl = "{{ route('account.cart.items.update', ':id') }}";
function updateQty(itemId, change) {

    let qtyInput = document.getElementById('qty-' + itemId);
    let qty = parseInt(qtyInput.value) + change;
    if (qty < 1) return;

    fetch(updateCartUrl.replace(':id', itemId), {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ quantity: qty })
    })
    .then(res => res.json())
    .then(data => {
        qtyInput.value = data.quantity;
        document.getElementById('item-total-' + itemId).innerText = data.item_total.toFixed(2);
        document.getElementById('cart-subtotal').innerText = data.subtotal.toFixed(2);
    });
}
</script>