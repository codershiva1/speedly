<x-layouts.site :title="config('app.name', 'Speedly Shop')">

    @push('styles')
        @vite(['resources/css/home.css'])
    @endpush

    @push('scripts')
        @vite(['resources/js/homeslider.js'])
    @endpush

    @php
        $heroProduct = $featuredProducts->first();
    @endphp

    

    {{-- HERO AREA --}}
    <section class="mb-6" data-aos="fade-up">
        <x-homeslider />
    </section>

@if($categories->isNotEmpty())
            {{-- ================= BEST SELLER ================= --}}

            <section class="bg-white  shadow-sm p-2">
                <div class="">

                    <!-- SECTION HEADING -->
                    <div class="flex items-center justify-between mb-3 text-sm">
                           
                            <a href="{{ route('shop.index') }}" class="text-xs text-indigo-600 hover:underline">View all</a>
                        </div>


                    <!-- GRID -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">

                        @foreach ($categories->take(6) as $category)
                        
                        <div class="bg-gray-100 rounded-2xl p-3">
                        
                            <!-- 2x2 PRODUCT PREVIEW -->
                            <div class="grid grid-cols-2 gap-2">
                                @foreach ($category->products->take(4) as $product)
                        
                                <a href="{{ route('shop.show', $product->slug) }}">
                        
                                    <div class="bg-white rounded-lg flex items-center justify-center h-16 overflow-hidden">
                        
                                        <img 
                                        src="{{ asset('public/storage/'.$product->images->first()->path) }}"
                                        class="max-h-14 object-contain "
                                        style="width: 70%;
"
                                        alt="">
                        
                                    </div>
                        
                                </a>
                        
                                @endforeach
                            </div>
                        
                            <!-- + MORE -->
                            <div class="flex justify-center mt-2">
                                <span class="bg-white text-xs px-3 py-1 rounded-full shadow text-gray-600">
                                    +{{ max(0,$category->products->count()-4) }} more
                                </span>
                            </div>
                        
                            <!-- CATEGORY NAME -->
                            <p class="text-sm font-semibold text-gray-900 text-center mt-2">
                                {{ $category->name }}
                            </p>
                        
                        </div>
                        
                        @endforeach
                        
                        </div>
                </div>
           </section>
        @endif




    <!-- <div class="bg-gray-50"> -->
        <div style="background: white;">
        <!-- <div class="max-w-7xl mx-auto px-4 sm:px-4 lg:px-4 py-4 space-y-8"> -->
<div class=" mx-auto  sm:px-4 lg:px-4 py-1 space-y-8">
        <section class=" overflow-hidden">
            <div class="flex flex-col lg:flex-row gap-3">
                <div class="w-full">
                    
                    {{-- 1. DESKTOP GRID (Hidden on Mobile/Tablet) --}}
                    <div class="hidden md:grid grid-cols-4 md:grid-cols-6 lg:grid-cols-7 xl:grid-cols-10 gap-2.5">
                        @foreach($topCategories->take(20) as $category)
                            @include('partials.category-card', ['category' => $category])
                        @endforeach
                    </div>

                    {{-- 2. MOBILE/TABLET SLIDER (Visible only on small screens) --}}
                    <div class="md:hidden relative group">
                        <div class="swiper categorySwiper">
                            <div class="swiper-wrapper">
                                @foreach($topCategories->take(20) as $category)
                                    <div class="swiper-slide px-1">
                                        @include('partials.category-card', ['category' => $category])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        {{-- Navigation Buttons (Optional for mobile) --}}
                        <div class="cat-prev absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white/80 rounded-full p-1 shadow md:hidden hidden group-hover:block">
                            <i class="fa-solid fa-chevron-left text-xs"></i>
                        </div>
                        <div class="cat-next absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white/80 rounded-full p-1 shadow md:hidden hidden group-hover:block">
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </div>
                    </div>

                </div>
            </div>
        </section>

         {{-- ================= ICONS SLIDER SECTION (shows 3 at a time, slides by 1) ================= --}}
           <section class="icons-carousel-section max-w-7xl mx-auto" data-aos="fade-up">
                <div class="">

                <!-- RIGHT SIDE SLIDER (3/4 WIDTH) -->
                <div class="md:col-span-3 overflow-hidden relative">
                    <div class="swiper iconSwiper">
                        <div class="swiper-wrapper">

                            <!-- Slide 1 -->
                            <div class="swiper-slide">
                                <div class="icon-card">
                                    <div class="icon">🚚</div>
                                    <div class="meta">
                                        <p class="font-semibold text-gray-900">Free Delivery</p>
                                        <p class="text-gray-500 text-xs">Free shipping on all orders</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Slide 2 -->
                            <div class="swiper-slide">
                                <div class="icon-card">
                                    <div class="icon">💰</div>
                                    <div class="meta">
                                        <p class="font-semibold text-gray-900">Big Saving Shop</p>
                                        <p class="text-gray-500 text-xs">Save big every single order</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Slide 3 -->
                            <div class="swiper-slide">
                                <div class="icon-card">
                                    <div class="icon">⏰</div>
                                    <div class="meta">
                                        <p class="font-semibold text-gray-900">Online Support 24/7</p>
                                        <p class="text-gray-500 text-xs">We’re here day and night</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Slide 4 -->
                            <div class="swiper-slide">
                                <div class="icon-card">
                                    <div class="icon">🔁</div>
                                    <div class="meta">
                                        <p class="font-semibold text-gray-900">Money Back Return</p>
                                        <p class="text-gray-500 text-xs">Guarantee under 7 days</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Slide 5 -->
                            <div class="swiper-slide">
                                <div class="icon-card">
                                    <div class="icon">🎁</div>
                                    <div class="meta">
                                        <p class="font-semibold text-gray-900">Member Discount</p>
                                        <p class="text-gray-500 text-xs">On orders over $120.00</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Navigation -->
                        <div class="swiper-button-prev icon-swiper-prev"></div>
                        <div class="swiper-button-next icon-swiper-next"></div>
                    </div>
                </div>
           </section>



        @if($megaDeals->isNotEmpty())
            <section class=" overflow-hidden">
                {{-- HEADER --}}
                <div class="flex items-center justify-between mb-3 mt-3 text-sm px-2">
                    <x-section-header 
                        title="Mega Deals" 
                        badgeText="Flash Sale" 
                        icon="bolt" 
                        :pulse="true" 
                    />
                    <a href="{{ route('shop.index') }}" class="text-xs text-indigo-600 hover:underline">View all</a>
                </div>

                {{-- UNIVERSAL SLIDER --}}
                <div class="relative group px-2">
                    <div class="swiper dealsSwiper">
                        <div class="swiper-wrapper">
                            @foreach ($megaDeals as $product)
                                <div class="swiper-slide h-auto flex">
                                    {{-- PRODUCT CARD START --}}
                                    <div class="relative bg-white rounded-xl border border-gray-200 hover:shadow-md transition-all p-2 flex flex-col w-full">
                                        {{-- WISHLIST --}}
                                        @auth
                                        <button class="absolute top-2 right-2 z-10 w-8 h-8 flex items-center justify-center rounded-full bg-white shadow-md wishlist-btn hover:scale-105 transition"
                                                data-product-id="{{ $product->id }}">
                                            <i class="fa fa-heart {{ auth()->user()->wishlist->contains('product_id', $product->id) ? 'text-red-500' : 'text-gray-400' }}"></i>
                                        </button>
                                        @else
                                        <a href="{{ route('login') }}" class="absolute top-2 right-2 z-10 w-8 h-8 flex items-center justify-center rounded-full bg-white shadow-md">
                                            <i class="fa fa-heart text-gray-400"></i>
                                        </a>
                                        @endauth

                                        {{-- IMAGE --}}
                                        <a href="{{ route('shop.show', $product->slug) }}" class="block">
                                            <div class="w-full h-36  rounded-lg overflow-hidden flex items-center justify-center">
                                                @php $img = $product->images->first(); @endphp
                                                <img src="{{ $img ? asset('public/storage/' . $img->path) : asset('storage/uploads/products/default.png') }}"
                                                    class="w-full h-full object-contain p-2" alt="{{ $product->name }}">
                                            </div>
                                        </a>

                                        {{-- INFO --}}
                                        <div class="mt-3 flex-1">
                                            <span class="inline-flex items-center gap-1 bg-orange-50 text-yellow-900 text-[10px] font-semibold px-2 py-0.5 rounded-full mb-2">
                                                <i class="fa-solid fa-clock"></i> 8 MINS
                                            </span>
                                            <p class="text-sm font-semibold text-gray-900 leading-tight line-clamp-1">
                                                {{ $product->name }}
                                            </p>
                                            @if($product->size)
                                                <p class="text-xs text-gray-500 mt-1">{{ $product->size }}</p>
                                            @endif
                                        </div>

                                        {{-- PRICE & ACTION --}}
                                        <div class="mt-3 flex items-center justify-between">
                                            
                                            <div class="flex flex-col leading-tight">
                                                @if ($product->discount_price && $product->discount_price > 0)
                                                    {{-- Show Discounted Price as primary --}}
                                                    <span class="text-base font-bold text-gray-900">₹{{ $product->discount_price }}</span>
                                                    {{-- Show Original Price with strikethrough --}}
                                                    <span class="line-through text-[10px] text-gray-400">₹{{ $product->price }}</span>
                                                @else
                                                    {{-- No discount available: Show only the regular price --}}
                                                    <span class="text-base font-bold text-gray-900">₹{{ $product->price }}</span>
                                                @endif
                                            </div>
                                            @auth
                                                <button class="cart-btn px-3 py-1.5 border border-green-600 rounded-lg text-xs font-bold {{ $product->cartItem ? 'bg-green-100 text-green-600' : 'text-green-600 hover:bg-green-50' }}"
                                                        data-product-id="{{ $product->id }}">
                                                    {{ $product->cartItem ? 'ADDED' : 'ADD' }}
                                                </button>
                                            @else
                                                <a href="{{ route('login') }}" class="px-3 py-1.5 border border-green-600 rounded-lg text-xs font-bold text-green-600">ADD</a>
                                            @endauth
                                        </div>
                                    </div>
                                    {{-- PRODUCT CARD END --}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    {{-- NAVIGATION --}}
                    <div class="deals-prev absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-green-300 rounded-full w-10 h-10 flex items-center justify-center  cursor-pointer opacity-2 group-hover:opacity-100 transition-opacity hidden md:flex border border-gray-100">
                        <i class="fa fa-chevron-left text-white"></i>
                    </div>
                    <div class="deals-next absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-green-300 rounded-full w-10 h-10 flex items-center justify-center shadow-lg cursor-pointer opacity-1 group-hover:opacity-100 transition-opacity hidden md:flex border border-gray-100">
                        <i class="fa fa-chevron-right text-white"></i>
                    </div>
                </div>
            </section> 
        @endif

       @if($newProducts->isNotEmpty())
            <section class=" overflow-hidden">
                {{-- HEADER --}}
                <div class="flex items-center justify-between mb-3 mt-3 text-sm px-2">
                    <x-section-header 
                        title="New Arrivals" 
                        badgeText="Fresh Stock" 
                        icon="leaf" 
                        :pulse="true"
                    />
                    <a href="{{ route('shop.index') }}" class="text-xs text-indigo-600 hover:underline">View all</a>
                </div>

                {{-- UNIVERSAL SLIDER --}}
                <div class="relative group px-2">
                    <div class="swiper dealsSwiper">
                        <div class="swiper-wrapper">
                            @foreach ($newProducts as $product)
                                <div class="swiper-slide h-auto flex">
                                    {{-- PRODUCT CARD START --}}
                                    <div class="relative bg-white rounded-xl border border-gray-200 hover:shadow-md transition-all p-2 flex flex-col w-full">
                                        
                                        {{-- WISHLIST ICON --}}
                                        @auth
                                        <button
                                            class="absolute top-2 right-2 z-10 w-8 h-8 flex items-center justify-center rounded-full bg-white shadow-md wishlist-btn hover:scale-105 transition"
                                            data-product-id="{{ $product->id }}"
                                        >
                                            <i class="fa fa-heart {{ auth()->user()->wishlist->contains('product_id', $product->id) ? 'text-red-500' : 'text-gray-400' }}"></i>
                                        </button>
                                        @else
                                        <a href="{{ route('login') }}" class="absolute top-2 right-2 z-10 w-8 h-8 flex items-center justify-center rounded-full bg-white shadow-md">
                                            <i class="fa fa-heart text-gray-400"></i>
                                        </a>
                                        @endauth

                                        {{-- IMAGE --}}
                                        <a href="{{ route('shop.show', $product->slug) }}" class="block">
                                            <div class="w-full h-36  rounded-lg overflow-hidden flex items-center justify-center">
                                                @php $img = $product->images->first(); @endphp
                                                <img src="{{ $img ? asset('public/storage/' . $img->path) : asset('storage/uploads/products/1/image3.png') }}" 
                                                    class="w-full h-full object-contain"
                                                    alt="{{ $product->name }}" >
                                            </div>
                                        </a>

                                        {{-- PRODUCT TITLE & INFO --}}
                                        <div class="mt-3 flex-1">
                                            <span class="w-fit inline-flex items-center gap-1 bg-orange-50 text-yellow-900 text-[10px] font-semibold px-2 py-0.5 rounded-full mb-2">
                                                <svg class="w-3.5 h-3.5 text-yellow-700" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-12.75a.75.75 0 00-1.5 0v4.19l-2.2 2.2a.75.75 0 101.06 1.06l2.39-2.39V5.25z" clip-rule="evenodd" />
                                                </svg>
                                                8 MINS
                                            </span>

                                            <p class="text-sm font-semibold text-gray-900 leading-tight line-clamp-1">
                                                {{ $product->name }}
                                            </p>

                                            @if($product->size)
                                                <p class="text-xs text-gray-500 mt-1">{{ $product->size }}</p>
                                            @endif
                                        </div>

                                        {{-- PRICE & ADD BUTTON --}}
                                        <div class="mt-3 flex items-center justify-between">
                                           <div class="flex flex-col leading-tight">
                                                @if ($product->discount_price && $product->discount_price > 0)
                                                    {{-- Show Discounted Price as primary --}}
                                                    <span class="text-base font-bold text-gray-900">₹{{ $product->discount_price }}</span>
                                                    {{-- Show Original Price with strikethrough --}}
                                                    <span class="line-through text-[10px] text-gray-400">₹{{ $product->price }}</span>
                                                @else
                                                    {{-- No discount available: Show only the regular price --}}
                                                    <span class="text-base font-bold text-gray-900">₹{{ $product->price }}</span>
                                                @endif
                                            </div>

                                            @auth
                                                <button
                                                    class="cart-btn px-3 py-1.5 border border-green-600 rounded-lg text-xs font-bold
                                                    {{ $product->cartItem ? 'bg-green-100 text-green-600' : 'text-green-600 hover:bg-green-50' }}"
                                                    data-product-id="{{ $product->id }}"
                                                >
                                                    {{ $product->cartItem ? 'ADDED' : 'ADD' }}
                                                </button>
                                            @else
                                                <a href="{{ route('login') }}" class="px-3 py-1.5 border border-green-600 rounded-lg text-xs font-bold text-green-600">
                                                    ADD
                                                </a>
                                            @endauth
                                        </div>
                                    </div>
                                    {{-- PRODUCT CARD END --}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    {{-- NAVIGATION ARROWS (Hidden on mobile, visible on desktop hover) --}}
                    <div class="deals-prev absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-green-300 rounded-full w-10 h-10 flex items-center justify-center shadow-lg cursor-pointer opacity-2 group-hover:opacity-100 transition-opacity hidden md:flex border border-gray-100">
                        <i class="fa fa-chevron-left text-white"></i>
                    </div>
                    <div class="deals-next absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-green-300 rounded-full w-10 h-10 flex items-center justify-center shadow-lg cursor-pointer opacity-2 group-hover:opacity-100 transition-opacity hidden md:flex border border-gray-100">
                        <i class="fa fa-chevron-right text-white"></i>
                    </div>
                </div>
            </section>
        @endif


            <!-- ---------------------------------------------------------------------- -->
             {{-- ================= DYNAMIC TRIPLE BANNERS ================= --}}
            @if(isset($adsplacements['home_triple_banner']) && $adsplacements['home_triple_banner']->ads->isNotEmpty())
                <section class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($adsplacements['home_triple_banner']->ads->take(3) as $ad)
                        <div class="banner relative overflow-hidden rounded-xl group" style="height:200px;">
                            <a href="{{ route('offers.click', $ad->id) }}" class="block w-full h-full">
                                {{-- asset('storage/' . $ad->banner_image) --}}
                                <img 
                                    src="{{$ad->banner_image}}" 
                                    class="w-full h-full object-cover banner-img transition-transform duration-500 group-hover:scale-105" 
                                    alt="{{ $ad->title }}"
                                />
                                {{-- Optional: Show Title if needed --}}
                                <div class="absolute inset-0 bg-black/10 group-hover:bg-black/0 transition-colors"></div>
                            </a>
                        </div>
                    @endforeach
                </section>
            @endif

            {{-- ================= MOVING OFFER STRIP ================= --}}
            <section class="w-full overflow-hidden" data-aos="fade-up">
                <div class="bg-indigo-700 text-white shadow-sm relative" style="padding:5px;">

                    <div class="marquee whitespace-nowrap flex items-center text-[20px]">

                        <span class="mx-6 flex items-center gap-1">
                            <span class="text-amber-300">&#9733;</span>
                            Mega offers now on Amazon Fresh | Up to 40% off
                        </span>

                        <span class="mx-6 flex items-center gap-1">
                            <span class="text-green-300">&#10003;</span>
                            FREE delivery over ₹499. Fulfilled by Amazon.
                        </span>

                        <span class="mx-6 flex items-center gap-1">
                            <span class="text-yellow-300">&#128179;</span>
                            Flat $10 instant cashback on wallet & UPI transactions
                        </span>

                        {{-- Duplicate content for infinite loop --}}
                        <span class="mx-6 flex items-center gap-1">
                            <span class="text-amber-300">&#9733;</span>
                            Mega offers now on Amazon Fresh | Up to 40% off
                        </span>

                        <span class="mx-6 flex items-center gap-1">
                            <span class="text-green-300">&#10003;</span>
                            FREE delivery over ₹499. Fulfilled by Amazon.
                        </span>

                        <span class="mx-6 flex items-center gap-1">
                            <span class="text-yellow-300">&#128179;</span>
                            Flat $10 instant cashback on wallet & UPI transactions
                        </span>

                    </div>
                </div>
            </section>


            {{-- ================= DEALS / NEW / FEATURED ROW ================= --}}
            <section class="grid grid-cols-1 lg:grid-cols-3  gap-6">
                {{-- LEFT BIG FEATURE CARD (DEAL OF THE DAY) --}}
   

                {{-- RIGHT: PRODUCT SLIDER WITH 2–ROW PAIRS --}}
                <div class="lg:col-span-3 bg-gray-50  " data-aos="fade-left">

                    {{-- Tabs --}}
 
                    {{-- === SWIPER WRAPPER === --}}


        @if($trendingProducts->isNotEmpty())
            <section style="background: white;">
                <!-- <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">Featured products</h2>
                </div> -->
                <div class="flex items-center justify-between mb-3 text-sm">
                        <x-section-header 
                            title="Trending Now" 
                            badgeText="Hot Picks" 
                            icon="fire" 
                            :pulse="true"
                        />
                        <a href="{{ route('shop.index') }}" class="text-xs text-indigo-600 hover:underline">View all</a>
                    </div>
          
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    @foreach ($trendingProducts->take(6) as $product)
                        <div class="relative bg-white rounded-xl border border-gray-200 hover:shadow-md transition-all p-2 flex flex-col">
                            

                           {{-- WISHLIST ICON (TOP RIGHT) --}}

                            @auth
                            <button
                                class="absolute top-2 right-2 z-10 w-8 h-8 flex items-center justify-center rounded-full bg-white shadow-md wishlist-btn hover:scale-105 transition"
                                data-product-id="{{ $product->id }}"
                                aria-label="Add to wishlist"
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


                            {{-- IMAGE --}}
                            <a href="{{ route('shop.show', $product->slug) }}" class="block">
                                <div class="w-full h-36 rounded-lg overflow-hidden flex items-center justify-center">
                                    @php 
                                        $img = $product->images->first(); 
                                    @endphp

                                   
                                    <img src="{{ $img ? asset('public/storage/' . $img->path) : asset('public/storage/uploads/products/1/image3.png') }}" 
                                        class="w-full h-full object-contain"
                                        alt="{{ $product->name }}" >
                                   
                                </div>
                            </a>

                            {{-- PRODUCT TITLE & SIZE --}}
                            <span class="w-fit inline-flex items-center gap-1 bg-orange-50 text-yellow-900 text-xs font-semibold px-2.5 py-0.5 rounded-full mt-3">
                            <svg class="w-3.5 h-3.5 text-yellow-700" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-12.75a.75.75 0 00-1.5 0v4.19l-2.2 2.2a.75.75 0 101.06 1.06l2.39-2.39V5.25z" clip-rule="evenodd" />
                            </svg>
                            8 MINS
                            </span>

                            <div class="mt-2 flex-1">
                                <p class="text-sm font-semibold text-gray-900 leading-tight line-clamp-1">
                                    {{ $product->name }}
                                </p>

                                @if($product->size)
                                    <p class="text-sm text-gray-500 mt-1">{{ $product->size }}</p>
                                @endif
                            </div>

                            {{-- PRICE & ADD BUTTON --}}
                            <div class="mt-2 flex items-center justify-between">
                                
                                {{-- PRICE (discount below actual) --}}
                                <div class="flex flex-col leading-tight">
                                    @if ($product->discount_price && $product->discount_price > 0)
                                        {{-- Show Discounted Price as primary --}}
                                        <span class="text-base font-bold text-gray-900">₹{{ $product->discount_price }}</span>
                                        {{-- Show Original Price with strikethrough --}}
                                        <span class="line-through text-[10px] text-gray-400">₹{{ $product->price }}</span>
                                    @else
                                        {{-- No discount available: Show only the regular price --}}
                                        <span class="text-base font-bold text-gray-900">₹{{ $product->price }}</span>
                                    @endif
                                </div>

                                {{-- ADD BUTTON --}}
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
                                    class="cart-btn px-2 py-1.5 border border-green-600 rounded-lg text-sm font-semibold">
                                        ADD
                                    </a>
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
                </section> 

            @endif

            @if($featuredProducts->isNotEmpty())
                <section>
                    <div class="flex items-center justify-between mb-3 mt-3 text-sm">
                       <x-section-header 
                            title="Featured" 
                            badgeText="Handpicked" 
                            icon="star" 
                            :pulse="true"
                        />
                        <a href="{{ route('shop.index') }}" class="text-xs text-indigo-600 hover:underline">View all</a>
                    </div>
                 <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    @foreach ($featuredProducts->take(6) as $product)
                        <div class="relative bg-white rounded-xl border border-gray-200 hover:shadow-md transition-all p-2 flex flex-col">
                            

                            {{-- WISHLIST ICON (TOP RIGHT) --}}

                            @auth
                            <button
                                class="absolute top-2 right-2 z-10 w-8 h-8 flex items-center justify-center rounded-full bg-white shadow-md wishlist-btn hover:scale-105 transition"
                                data-product-id="{{ $product->id }}"
                                aria-label="Add to wishlist"
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


                            {{-- IMAGE --}}
                            <a href="{{ route('shop.show', $product->slug) }}" class="block">
                                <div class="w-full h-36  rounded-lg overflow-hidden flex items-center justify-center">
                                    @php 
                                        $img = $product->images->first(); 
                                    @endphp

                                   
                                    <img src="{{ $img ? asset('public/storage/' . $img->path) : asset('public/storage/uploads/products/1/image3.png') }}" 
                                        class="w-full h-full object-contain"
                                        alt="{{ $product->name }}" >
                                   
                                </div>
                            </a>

                            {{-- PRODUCT TITLE & SIZE --}}
                            <span class="w-fit inline-flex items-center gap-1 bg-orange-50 text-yellow-900 text-xs font-semibold px-2.5 py-0.5 rounded-full mt-3">
                            <svg class="w-3.5 h-3.5 text-yellow-700" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-12.75a.75.75 0 00-1.5 0v4.19l-2.2 2.2a.75.75 0 101.06 1.06l2.39-2.39V5.25z" clip-rule="evenodd" />
                            </svg>
                            8 MINS
                            </span>

                            <div class="mt-2 flex-1">
                                <p class="text-sm font-semibold text-gray-900 leading-tight line-clamp-1">
                                    {{ $product->name }}
                                </p>

                                @if($product->size)
                                    <p class="text-sm text-gray-500 mt-1">{{ $product->size }}</p>
                                @endif
                            </div>

                            {{-- PRICE & ADD BUTTON --}}
                            <div class="mt-2 flex items-center justify-between">
                                
                                {{-- PRICE (discount below actual) --}}
                               <div class="flex flex-col leading-tight">
                                    @if ($product->discount_price && $product->discount_price > 0)
                                        {{-- Show Discounted Price as primary --}}
                                        <span class="text-base font-bold text-gray-900">₹{{ $product->discount_price }}</span>
                                        {{-- Show Original Price with strikethrough --}}
                                        <span class="line-through text-[10px] text-gray-400">₹{{ $product->price }}</span>
                                    @else
                                        {{-- No discount available: Show only the regular price --}}
                                        <span class="text-base font-bold text-gray-900">₹{{ $product->price }}</span>
                                    @endif
                                </div>

                                {{-- ADD BUTTON --}}
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
                                    class="cart-btn px-2 py-1.5 border border-green-600 rounded-lg text-sm font-semibold">
                                        ADD
                                    </a>
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif


                </div>


                
            </section>

        @if($budgetStore->isNotEmpty())
            {{-- ================= BANNER + CATEGORY & PRODUCTS ================= --}}
            <section >
                <div class="flex items-center justify-between mb-3 text-sm">
                        <x-section-header 
                            title="Budget Store" 
                            badgeText="Under ₹199" 
                            icon="bolt" 
                            :pulse="true"
                        />
                        <a href="{{ route('shop.index') }}" class="text-xs text-indigo-600 hover:underline">View all</a>
                    </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                {{-- TWO WIDE TOP BANNERS (LIKE SURFACE KEYBOARD / SPEAKER) --}}
              

                {{-- BELOW: CATEGORIES SIDEBAR + ROW OF PRODUCTS --}}
                
                <div class="lg:col-span-4 grid grid-cols-1 lg:grid-cols-4  mt-2" data-aos="fade-left">
                    {{-- LEFT SIDEBAR CATEGORIES --}}
                    {{-- LEFT SIDEBAR AD --}}
<aside class="lg:col-span-1 bg-white shadow-sm text-xs h-fit-content">
    @php 
        $sidebarAd = $adsplacements['home_budget_sidebar']->ads->first() ?? null; 
    @endphp
{{-- asset('storage/' . $sidebarAd->banner_image) --}}
    @if($sidebarAd)
        <div class="relative hidden md:flex items-center justify-center 
                    h-full min-h-[300px] px-6 py-10 
                    bg-cover bg-center bg-no-repeat rounded-lg overflow-hidden group"
             style="background-image: url('{{$sidebarAd->banner_image}}');">
            
            <a href="{{ route('offers.click', $sidebarAd->id) }}" class="absolute inset-0 z-20"></a>
            
            <div class="absolute inset-0 bg-black/40 group-hover:bg-black/30 transition-all"></div>

            <div class="relative text-white text-left z-10">
                <h2 class="text-xl font-bold leading-tight">{{ $sidebarAd->title }}</h2>
                <p class="text-sm mt-1 opacity-90">Click to explore</p>
            </div>
        </div>
    @else
        {{-- Fallback if no ad exists --}}
        <div class="h-full min-h-[300px] bg-gray-100 flex items-center justify-center rounded-lg">
            <span class="text-gray-400">Exclusive Deals</span>
        </div>
    @endif
</aside>

                    {{-- RIGHT PRODUCTS STRIP --}}
                    <div class="lg:col-span-3 bg-gray-50   ">
   

                        {{-- === SWIPER WRAPPER === --}}
                          

                             <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($budgetStore->take(4) as $product)
                        <div class="relative bg-white rounded-xl border border-gray-200 hover:shadow-md transition-all p-2 flex flex-col">
                            

                            {{-- WISHLIST ICON (TOP RIGHT) --}}

                            @auth
                            <button
                                class="absolute top-2 right-2 z-10 w-8 h-8 flex items-center justify-center rounded-full bg-white shadow-md wishlist-btn hover:scale-105 transition"
                                data-product-id="{{ $product->id }}"
                                aria-label="Add to wishlist"
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


                            {{-- IMAGE --}}
                            <a href="{{ route('shop.show', $product->slug) }}" class="block">
                                <div class="w-full h-36  rounded-lg overflow-hidden flex items-center justify-center">
                                    @php 
                                        $img = $product->images->first(); 
                                    @endphp

                                  
                                    <img src="{{ $img ? asset('public/storage/' . $img->path) : asset('public/storage/uploads/products/1/image3.png') }}" 
                                        class="w-full h-full object-contain"
                                        alt="{{ $product->name }}" >
                                    
                                </div>
                            </a>

                            {{-- PRODUCT TITLE & SIZE --}}
                            <span class="w-fit inline-flex items-center gap-1 bg-orange-50 text-yellow-900 text-xs font-semibold px-2.5 py-0.5 rounded-full mt-3">
                            <svg class="w-3.5 h-3.5 text-yellow-700" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-12.75a.75.75 0 00-1.5 0v4.19l-2.2 2.2a.75.75 0 101.06 1.06l2.39-2.39V5.25z" clip-rule="evenodd" />
                            </svg>
                            8 MINS
                            </span>

                            <div class="mt-2 flex-1">
                                <p class="text-sm font-semibold text-gray-900 leading-tight line-clamp-1">
                                    {{ $product->name }}
                                </p>

                                @if($product->size)
                                    <p class="text-sm text-gray-500 mt-1">{{ $product->size }}</p>
                                @endif
                            </div>

                            {{-- PRICE & ADD BUTTON --}}
                            <div class="mt-2 flex items-center justify-between">
                                
                                {{-- PRICE (discount below actual) --}}
                                <div class="flex flex-col leading-tight">
                                    @if ($product->discount_price && $product->discount_price > 0)
                                        {{-- Show Discounted Price as primary --}}
                                        <span class="text-base font-bold text-gray-900">₹{{ $product->discount_price }}</span>
                                        {{-- Show Original Price with strikethrough --}}
                                        <span class="line-through text-[10px] text-gray-400">₹{{ $product->price }}</span>
                                    @else
                                        {{-- No discount available: Show only the regular price --}}
                                        <span class="text-base font-bold text-gray-900">₹{{ $product->price }}</span>
                                    @endif
                                </div>

                                {{-- ADD BUTTON --}}
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
                                    class="cart-btn px-2 py-1.5 border border-green-600 rounded-lg text-sm font-semibold">
                                        ADD
                                    </a>
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>

                    </div>
                </div>
                </div>
            </section>
       @endif

       @if($categories->isNotEmpty())
            {{-- ================= BEST SELLER ================= --}}

            <section class="bg-white  shadow-sm">
                <div class="">

                    <!-- SECTION HEADING -->
                    <div class="flex items-center justify-between mb-3 text-sm">
                           
                        <x-section-header 
                            title="Best Sellers" 
                            badgeText="Best Selections" 
                            icon="bolt" 
                            :pulse="true"
                        />
                            <a href="{{ route('shop.index') }}" class="text-xs text-indigo-600 hover:underline">View all</a>
                        </div>


                    <!-- GRID -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">

                        <!-- PRODUCT CARD -->
                        @foreach ($categories->take(6) as $category)
                            <div class="bg-gray-100  w-auto p-2">

                                <!-- INNER IMAGE GRID -->
                                <div class="grid grid-cols-2 grid-rows-2 gap-2">
                                    @foreach ($category->products->take(4) as $product)
                                    <a href="{{ route('shop.show', $product->slug) }}" class="block">
                                    
                                    <div class="bg-white flex items-center justify-center h-20 overflow-hidden rounded">
                                    <img 
                                    src="{{ asset('public/storage/' . $product->images->first()->path) }}"
                                    class="w-full h-full object-contain p-1"
                                    alt=""
                                    >
                                    
                                    </div>
                                    
                                    </a>
                                    @endforeach
                                    </div>

                                <!-- + MORE (WHITE PILL) -->
                                <div class="flex justify-center mt-2">
                                    <span class="bg-white text-xs text-gray-600 px-3 py-0.5 rounded-full shadow-sm">
                                        +{{ max(0, $category->products->count() - 4) }} more
                                    </span>
                                </div>

                                <!-- CATEGORY NAME -->
                                <p class="text-sm font-semibold text-gray-900 text-center mb-3 leading-tight mt-1">
                                    {{ $category->name }}
                                </p>

                            </div>
                            @endforeach

                        <!-- Add more cards as needed -->

                    </div>
                </div>
           </section>
        @endif

       
            {{-- ================= LATEST NEWS ================= --}}
            <section class="bg-white  shadow-sm p-2">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-sm font-semibold text-gray-900" style="font-size:22px;">Latest News</h2>
                    <a href="{{ route('pages.blog') }}" class="text-xs text-indigo-600 hover:underline">View all articles</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    @foreach($latestNews as $article)
                        <article class="bg-white border border-gray-100  overflow-hidden flex flex-col text-xs" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="h-48 bg-gray-100 overflow-hidden news-img">
                                <!-- <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-full object-cover"> -->
                                 <img src="https://i.pinimg.com/1200x/e0/2a/f3/e02af35aeb189bb2414984bd23e921da.jpg" alt="" class="w-full h-full object-cover">
                            </div>
                            <div class="p-3 flex-1 flex flex-col">
                                <p class="text-[11px] text-gray-400 mb-1">{{ $article['date']->format('d M Y') }}</p>
                                <h3 class="font-semibold text-gray-900 mb-1 line-clamp-2">{{ $article['title'] }}</h3>
                                <p class="text-gray-600 line-clamp-3 flex-1">{{ $article['excerpt'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
          
        </div>
    </div>

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
    window.CartToggleUrl = "{{ route('account.cart.toggle', ':id') }}";
</script>

</x-layouts.site>
