<x-layouts.site :title="__('Search')">

    {{-- STORE SEARCH BAR --}}
    <div class="sticky top-16 bg-white z-20 px-4 py-2 border-b">
        <form method="GET">
            <div class="flex items-center bg-gray-100 rounded-full px-4 py-2">
                <i class="bi bi-search text-gray-500 mr-3"></i>
                <input
                    type="text"
                    name="q"
                    value="{{ $search }}"
                    placeholder="Search in ₹{{ $price }} store"
                    class="w-full bg-transparent focus:outline-none text-sm"
                >
            </div>
        </form>
    </div>

    {{-- STORE TITLE --}}
    <div class="px-4 pt-4">
        <h1 class="text-xl font-bold text-gray-900">
            ₹{{ $price }} Store
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            All products under ₹{{ $price }}
        </p>
    </div>

    {{-- PRODUCTS GROUPED BY PARENT CATEGORY --}}
    @foreach($products as $parentCategory => $items)
        <section class="px-4 py-5 bg-white">
            {{-- CATEGORY TITLE --}}
            <div class="flex items-center justify-between mb-3">
                <span class="font-semibold text-gray-900" style="font-size:20px;">
                    {{ $parentCategory }}
                </span>
            </div>

            {{-- PRODUCT GRID --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach ($items as $product)
                    <div class="relative bg-white rounded-xl border border-gray-200 hover:shadow-md transition-all p-2 flex flex-col">

                        {{-- WISHLIST --}}
                        @auth
                            <button
                                class="absolute top-2 right-2 z-10 w-8 h-8 flex items-center justify-center rounded-full bg-white shadow-md wishlist-btn hover:scale-105 transition"
                                data-product-id="{{ $product->id }}"
                            >
                                <i class="fa fa-heart
                                    {{ auth()->user()->wishlist->contains('product_id', $product->id)
                                        ? 'text-red-500'
                                        : 'text-gray-400' }}">
                                </i>
                            </button>
                        @else
                            <a href="{{ route('login') }}"
                            class="absolute top-2 right-2 z-10 w-8 h-8 flex items-center justify-center rounded-full bg-white shadow-md">
                                <i class="fa fa-heart text-gray-400"></i>
                            </a>
                        @endauth

                        {{-- PRODUCT IMAGE --}}
                        <a href="{{ route('shop.show', $product->slug) }}" class="block">
                            <div class="w-full h-36 bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center">
                                @php
                                    $img = $product->images->first();
                                @endphp

                                @if ($img)
                                    <img
                                        src="{{ asset('storage/' . $img->path) }}"
                                        class="w-full h-full object-contain"
                                        alt="{{ $product->name }}"
                                    >
                                @else
                                    <span class="text-gray-400 text-xs">No Image</span>
                                @endif
                            </div>
                        </a>

                        {{-- DELIVERY TAG --}}
                        <span class="w-fit inline-flex items-center gap-1 bg-orange-50 text-yellow-900 text-xs font-semibold px-2.5 py-0.5 rounded-full mt-3">
                            <svg class="w-3.5 h-3.5 text-yellow-700" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-12.75a.75.75 0 00-1.5 0v4.19l-2.2 2.2a.75.75 0 101.06 1.06l2.39-2.39V5.25z" clip-rule="evenodd" />
                            </svg>
                            8 MINS
                        </span>

                        {{-- PRODUCT INFO --}}
                        <div class="mt-2 flex-1">
                            <p class="text-sm font-semibold text-gray-900 leading-tight line-clamp-1">
                                {{ $product->name }}
                            </p>

                            @if($product->size)
                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $product->size }}
                                </p>
                            @endif
                        </div>

                        {{-- PRICE & ADD --}}
                        <div class="mt-3 flex items-center justify-between">
                            <div class="flex flex-col leading-tight">
                                <span class="text-base font-bold text-gray-900">
                                    ₹{{ $product->price }}
                                </span>

                                @if ($product->discount_price)
                                    <span class="line-through text-xs text-gray-400">
                                        ₹{{ $product->discount_price }}
                                    </span>
                                @endif
                            </div>

                            @auth
                                <button
                                    class="cart-btn px-2 py-1.5 border border-green-600 rounded-lg text-sm font-semibold
                                    {{ $product->cartItem ? 'bg-green-100 text-green-600' : 'text-green-600 hover:bg-green-50' }}"
                                    data-product-id="{{ $product->id }}"
                                >
                                    {{ $product->cartItem ? 'ADDED' : 'ADD' }}
                                </button>
                            @else
                                <a href="{{ route('login') }}"
                                class="px-2 py-1.5 border border-green-600 rounded-lg text-sm font-semibold text-green-600">
                                    ADD
                                </a>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endforeach

    {{-- EMPTY STATE --}}
    @if($products->isEmpty())
        <div class="text-center py-10 text-gray-500">
            No products found in ₹{{ $price }} store.
        </div>
    @endif

    @if($cartCount > 0)
            <div id="floating-cart"
                onclick="window.location='{{ route('account.cart.index') }}'"
                class="floatingcart fixed bottom-20 left-1/4 -translate-x-1/2
                        bg-green-600 text-white
                        rounded-full
                        px-3 py-2.5
                        flex items-center gap-2
                        shadow-2xl
                        cursor-pointer
                        z-50
                        transition-all duration-300"
            >

                <!-- Cart Icon -->
                <i class="bi bi-cart3 text-xl"></i>

                <!-- Item count -->
                <span class="text-sm font-semibold ">
                    <span class="cart-count">{{ $cartCount }}</span>
                    items
                </span>

                <!-- Divider -->
                <span class="h-4 w-px bg-green-300"></span>

                <!-- Total -->
                <span class="text-sm font-bold ">
                    ₹<span class="cartTotal">{{ number_format($cartTotal) }}</span>
                </span>

            </div>
        @endif

    <script>
        window.wishlistToggleUrl = "{{ route('wishlist.toggle', ':id') }}";
        window.CartToggleUrl = "{{ route('account.cart.toggle', ':id') }}";
    </script>

</x-layouts.site>