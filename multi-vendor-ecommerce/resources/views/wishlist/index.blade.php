<style>
@media (max-width: 767px) {
    .sticky-header{
        display:none;
    }
}
</style>

<x-layouts.site title="My Wishlist">

<div class="max-w-6xl mx-auto py-6 px-2">

    <h1 class="text-2xl font-bold mb-6 flex items-center gap-2">
        ❤️ My Wishlist
    </h1>

    @forelse($wishlists as $wish)

        @php 
            $img = $wish->product?->images->first();

            $fullPath = $img
                ? asset('public/storage/'.$img->path)
                : asset('storage/uploads/products/1/image3.png');
        @endphp

        <div class="bg-white rounded-xl shadow-sm p-2 mb-2">

            <div class="flex gap-4 items-start">

                <!-- PRODUCT IMAGE -->
                <div class="flex-shrink-0">
                    <img 
                        src="{{ $fullPath }}"
                        class="w-20 h-20 object-cover rounded-lg border">
                    
                    <!--@if($wish->product->stock == 0)-->
                    <!--    <p class="text-red-500 text-xs mt-1">-->
                    <!--        Out of stock-->
                    <!--    </p>-->
                    <!--@endif-->
                </div>


                <!-- PRODUCT INFO -->
                <div class="flex-1">

                    <h2 class="font-semibold text-sm leading-tight text-gray-800">
                        {{ $wish->product->name }}
                    </h2>

                    <p class="text-gray-700 text-sm mt-1 font-medium">
                        ₹{{ number_format($wish->product->price, 2) }}
                    </p>


                    <!-- ACTION BUTTONS -->
                    <div class="flex items-center gap-3 mt-3 flex-wrap">

                        <!-- ADD TO CART -->
                        <form method="POST" action="{{ route('account.cart.store') }}">
                            @csrf

                            <input type="hidden" 
                                name="product_id" 
                                value="{{ $wish->product->id }}">

                               <button
                                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm rounded-lg transition">
                                    Add to Cart
                                </button>
                            <!--@if($wish->product->stock == 0)-->

                            <!--    <button-->
                            <!--        type="button"-->
                            <!--        class="px-4 py-2 bg-gray-400 text-white text-sm rounded-lg cursor-not-allowed">-->
                            <!--        Out of Stock-->
                            <!--    </button>-->

                            <!--@else-->

                            <!--    <button-->
                            <!--        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm rounded-lg transition">-->
                            <!--        Add to Cart-->
                            <!--    </button>-->

                            <!--@endif-->
                        </form>


                        <!-- REMOVE -->
                        <form method="POST" action="{{ route('wishlist.destroy', $wish) }}">
                            @csrf
                            @method('DELETE')

                            <button 
                                class="text-red-500 text-sm hover:underline">
                                Remove
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    @empty

        <div class="text-center py-20">

            <p class="text-gray-500 text-lg">
                Your wishlist is empty.
            </p>

            <a href="{{ route('shop.index') }}"
                class="inline-block mt-4 bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg">

                Continue Shopping

            </a>

        </div>

    @endforelse

</div>

</x-layouts.site>