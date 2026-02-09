<x-layouts.site :title="__('₹'.$price.' Store')">

   {{-- PREMIUM BANNER SLIDER --}}
    @if($topBanners->isNotEmpty() && !$search)
        <div class="px-4 py-2">
            {{-- Flex container ensuring no wrapping and forced spacing --}}
            <div class="flex gap-2 overflow-x-auto no-scrollbar snap-x snap-mandatory">
                @foreach($topBanners as $banner)
                    {{-- 
                    1. min-w-[calc(50%-4px)]: Forces exactly 2 banners per row (minus half the gap).
                    2. max-h-[120px]: Prevents the banner from becoming "huge" vertically.
                    3. aspect-video: Maintains a professional cinematic ratio.
                    --}}
                    <div class="min-w-[calc(50%-4px)] md:min-w-[calc(48.33%-8px)] h-58 md:h-40 bg-gray-100 rounded-xl overflow-hidden snap-start flex-shrink-0 border border-gray-100 shadow-sm">
                        <img src="{{ asset('storage/'.$banner->banner_image) }}" 
                            class="w-full h-full object-cover" 
                            alt="Promotion">
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="flex items-center justify-between w-full bg-white/90 px-5 py-1">
        <div class="px-5 ">
            <h1 class="text-2xl font-black text-gray-900 italic tracking-tight">₹{{ $price }} <span class="text-green-600">Store</span></h1>
            <p class="text-[11px] text-gray-400 font-bold uppercase tracking-[0.2em] mt-1">Quality items under budget</p>
        </div>
            {{-- MODERN STICKY SEARCH --}}
        <div class="sticky top-20 bg-white/90 backdrop-blur-md z-30 px-4  border-b border-gray-100">
            <form method="GET">
                <div class="flex items-center bg-gray-100 rounded-2xl px-4 py-2.5 border border-transparent focus-within:border-green-500 focus-within:bg-white transition-all duration-300">
                    <i class="bi bi-search text-gray-400 mr-3"></i>
                    <input type="text" name="q" value="{{ $search }}" placeholder="Search in ₹{{ $price }} store" class="w-full bg-transparent focus:outline-none text-sm font-medium">
                </div>
            </form>
        </div>

    </div>

    {{-- PRODUCT LISTINGS --}}
    @php $sectionIndex = 0; @endphp

    @foreach($products as $categoryName => $items)
        <section class="px-4 py-3">
            <div class="flex items-center justify-between mb-3 px-1">
                <h2 class="font-extrabold text-gray-800 text-xl tracking-tight">{{ $categoryName }}</h2>
                <div class="h-px flex-1 bg-gray-100 mx-4"></div>
                <span class="text-[10px] font-black text-gray-300 uppercase tracking-widest">{{ $items->count() }} Items</span>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($items as $product)
                    @include('partials.product-card', ['product' => $product, 'isAd' => false])
                @endforeach
            </div>
        </section>

        {{-- SPONSORED BREAK (Injected after every 2 categories) --}}
        @php $sectionIndex++; @endphp
        @if($sectionIndex % 2 == 0 && $inlineAds->isNotEmpty())
            <div class="my-1 py-4 bg-gradient-to-b from-gray-50 to-white border-y border-gray-100">
                <div class="px-5 mb-6 flex justify-between items-end">
                    <div>
                        <span class="bg-amber-100 text-amber-700 text-[9px] font-black px-2 py-0.5 rounded uppercase tracking-tighter shadow-sm">Promoted</span>
                        <h3 class="text-xl font-black text-gray-800 mt-1">Featured For You</h3>
                    </div>
                </div>
                
                {{-- SPONSORED BREAK --}}
                <div class="flex gap-4 overflow-x-auto px-5 no-scrollbar">
                    @foreach($inlineAds->shuffle()->take(6) as $ad)
                        {{-- FIX: Added flex-shrink-0 and a fixed max-width --}}
                        <div class="min-w-[170px] md:min-w-[200px] flex-shrink-0 max-w-[200px]">
                            @include('partials.product-card', ['product' => $ad->target, 'isAd' => true])
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach

    {{-- FLOATING CART (Keep your original functionality) --}}
     @if($cartCount > 0)
        <div id="floating-cart"
            onclick="window.location='{{ route('account.cart.index') }}'"
            class="floatingcart fixed bottom-20 left-2/4 -translate-x-1/2
                    bg-green-600 text-white
                    rounded-full
                    px-3 py-2.5
                    flex items-center gap-3
                    shadow-2xl
                    cursor-pointer
                    z-50
                    transition-all duration-300"
        >

            <!-- Cart Icon -->
            <!-- <i class="bi bi-cart3 text-xl"></i> -->
            <!-- Item count -->
             <div class="relative">
                <i class="bi bi-bag-check-fill text-2xl"></i>
                <span class="absolute -top-2 -right-2 bg-white text-green-600 text-[10px] font-black w-5 h-5 rounded-full flex items-center justify-center shadow-sm">
                    {{ $cartCount }}
                </span>
            </div>

            <!-- Divider -->
            <span class="h-4 w-px bg-green-300"></span>

            <!-- Total -->
             <div class="flex flex-col">
                <span class="text-[10px] font-bold uppercase tracking-tighter opacity-80 leading-none">View Cart</span>
                <span class="text-sm font-bold ">
                    ₹<span class="cartTotal">{{ number_format($cartTotal) }}</span>
                </span>
            </div>

            <i class="bi bi-chevron-right text-xs opacity-50"></i>
        </div>
    @endif

    <script>
        window.wishlistToggleUrl = "{{ route('wishlist.toggle', ':id') }}";
        window.CartToggleUrl     = "{{ route('account.cart.toggle', ':id') }}";
    </script>

    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</x-layouts.site>