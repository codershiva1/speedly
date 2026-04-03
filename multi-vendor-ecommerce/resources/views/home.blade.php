<x-layouts.site :title="config('app.name', 'Speedly Shop')">

    @push('styles')
        @vite(['resources/css/home.css'])
        <style>
            /* Slider Navigation Styling */
            .product-slider-container .swiper-button-disabled {
                opacity: 0 !important;
                pointer-events: none;
                transition: opacity 0.3s ease;
            }
            .swiper-prev, .swiper-next {
                transition: all 0.3s ease;
                display: flex !important;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            }
            .swiper-prev:hover, .swiper-next:hover {
                background: #22c55e !important;
                transform: translateY(-50%) scale(1.1) !important;
            }

            /* Badge/Pulse Folding Animation */
            .badge-folding {
                animation: unfold 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
                transform-origin: left;
            }
            @keyframes unfold {
                0% { transform: scaleX(0); opacity: 0; }
                100% { transform: scaleX(1); opacity: 1; }
            }
            
            .glow-pulse {
                box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4);
                animation: glow 2s infinite;
            }
            @keyframes glow {
                0% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4); }
                70% { box-shadow: 0 0 0 10px rgba(34, 197, 94, 0); }
                100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
            }
            /* Triple Banner Slider Styling */
            .tripleBannerSwiper {
                padding-top: 20px !important;
                padding-bottom: 20px !important;
            }
            .tripleBannerPagination .swiper-pagination-bullet {
                width: 10px;
                height: 10px;
                background: #22c55e;
                opacity: 0.2;
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                border-radius: 5px;
            }
            .tripleBannerPagination .swiper-pagination-bullet-active {
                width: 35px;
                opacity: 1;
                background: #16a34a;
            }
            .tripleBannerSwiper .swiper-slide {
                transition: all 0.6s ease;
                opacity: 0.4;
                transform: scale(0.85);
            }
            .tripleBannerSwiper .swiper-slide-active {
                opacity: 1;
                transform: scale(1);
            }
        </style>
    @endpush

    @push('scripts')
        @vite(['resources/js/homeslider.js'])
    @endpush

    @php
        $heroProduct = $featuredProducts->first();
    @endphp

    

    {{-- HERO AREA & PROMO CARDS --}}
    <section class="mb-6 -mt-16 md:mt-0" data-aos="fade-up">
        <div class="grid grid-cols-2 gap-3 mb-6 md:hidden">
            <!-- Promo Card 1 -->
            <div class="bg-white rounded-2xl p-3 shadow-lg flex items-center gap-2 border border-green-50">
                <div class="w-10 h-10 bg-green-50 rounded-full flex items-center justify-center">
                    <i class="bi bi-cart-plus text-green-600 text-xl"></i>
                </div>
                <div>
                    <h4 class="text-[10px] font-bold text-gray-800 leading-tight">Get FLAT ₹50 OFF</h4>
                    <p class="text-[8px] text-gray-500">First order > ₹199</p>
                </div>
            </div>
            <!-- Promo Card 2 -->
            <div class="bg-white rounded-2xl p-3 shadow-lg flex items-center gap-2 border border-green-50">
                <div class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center">
                    <i class="bi bi-truck text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h4 class="text-[10px] font-bold text-gray-800 leading-tight">Enjoy FREE delivery</h4>
                    <p class="text-[8px] text-gray-500">On all your orders</p>
                </div>
            </div>
        </div>
        
        <x-homeslider />
    </section>

@if($categories->isNotEmpty())
    {{-- ================= CATEGORY CARDS ================= --}}
    <section class="bg-gradient-to-b from-green-50/50 to-white py-3 px-2">

        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-8 gap-2">

            @foreach ($categories->take(16) as $category)
                @php
                    $catProducts = $category->products()->with('images')->get();
                    $count = $catProducts->count();
                @endphp

                {{-- Skip categories with less than 4 products --}}
                @if($count < 4)
                    @continue
                @endif

                @php
                    $preview = $catProducts->take(4);
                    $previewCount = $preview->count();
                    // Grid cols: 1 item = 1 col full-width, 2-4 items = 2 cols
                    $gridCols = $previewCount === 1 ? 'grid-cols-1' : 'grid-cols-2';
                    $extraCount = max(0, $count - 4);
                @endphp

                <a href="{{ route('shop.index', ['category' => $category->slug]) }}" class="group block">
                    <div class="bg-white rounded-2xl p-2 shadow-sm border border-gray-100 group-hover:shadow-md group-hover:border-green-200 transition-all duration-200">

                        {{-- Adaptive Product Image Grid --}}
                        <div class="grid {{ $gridCols }} gap-1 mb-2">
                            @foreach ($preview as $product)
                                @php $img = $product->images->first(); @endphp
                                <div class="bg-gray-50 rounded-xl flex items-center justify-center overflow-hidden
                                    {{ $previewCount === 1 ? 'h-24' : 'h-14' }}">
                                    @if($img)
                                        <img
                                            src="@storageUrl($img->path)"
                                            class="object-contain w-full h-full p-1"
                                            alt="{{ $product->name }}"
                                            loading="lazy">
                                    @else
                                        <i class="bi bi-image text-gray-300 text-xl"></i>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        
                        {{-- Product count badge --}}
                        <div class="flex justify-center mt-1">
                            <span class="bg-green-100 text-green-700 text-[9px] font-semibold px-2 py-0.5 rounded-full">
                                @if($extraCount > 0) &middot; +{{ $extraCount }} more @endif
                            </span>
                        </div>
                        
                        {{-- Category Name --}}
                        <p class="text-[11px] font-semibold text-gray-800 text-center leading-tight truncate">
                            {{ $category->name }}
                        </p>
                    </div>
                </a>

            @endforeach
        </div>
    </section>
@endif




    <!-- <div class="bg-gray-50"> -->
        <div style="background: white;">
        <!--    {{-- CONTINUED GRADIENT FROM HEADER --}}
    <div class="md:hidden h-20 bg-gradient-to-b from-[#10b981] to-white -mt-5"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 md:mt-20">
 -->
<div class=" mx-auto  sm:px-4 lg:px-4 py-1 space-y-5">
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
           <section class="icons-carousel-section max-w-8xl mx-auto" data-aos="fade-up">
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
                        <!-- <div class="swiper-button-prev icon-swiper-prev"></div>
                        <div class="swiper-button-next icon-swiper-next"></div> -->
                    </div>
                </div>
           </section>



        @if($megaDeals->isNotEmpty())
            <section class="overflow-hidden">
                {{-- HEADER --}}
                <div class="flex items-center justify-between mb-3 mt-3 text-sm px-2">
                    <x-section-header 
                        title="Mega Deals" 
                        badgeText="Flash Sale" 
                        icon="bolt" 
                        :pulse="true" 
                    />
                    <a href="{{ route('products.all', ['type' => 'mega-deals']) }}" class="text-xl text-green-600 hover:underline">View all</a>
                </div>

                {{-- UNIVERSAL SLIDER --}}
                <div class="relative group px-2 product-slider-container">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            @foreach ($megaDeals as $product)
                                <div class="swiper-slide h-auto flex pb-4">
                                    {{-- PRODUCT CARD START --}}
                                    <div class="relative bg-white rounded-xl border border-gray-200 hover:shadow-md transition-all p-2 flex flex-col w-full overflow-hidden">
                                        
                                        {{-- 3. STOCK SCARCITY (DIAGONAL RIBBON) --}}
                                        @if($product->stock_quantity > 0 && $product->stock_quantity <= 10)
                                            <div class="absolute -right-[34px] top-[14px] w-[140px] h-[24px] bg-[#1a7a1a] text-white text-[9px] font-black tracking-widest flex items-center justify-center rotate-45 z-1 shadow-sm border-y border-white/20 uppercase" style="box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                                {{ $product->stock_quantity }} LEFT
                                            </div>
                                        @endif

                                        {{-- 1. DISCOUNT BADGE --}}
                                        @if($product->discount_price && $product->price > 0)
                                            @php $discountPercent = round((($product->price - $product->discount_price) / $product->price) * 100); @endphp
                                            <div class="absolute top-2 left-2 z-10 bg-green-600 text-white text-[9px] font-bold px-1.5 py-0.5 rounded shadow-sm">
                                                {{ $discountPercent }}% OFF
                                            </div>
                                        @endif

                                        {{-- WISHLIST (STAYS ON TOP) --}}
                                        @auth
                                        <button class="absolute top-1 right-1 z-20 w-7 h-7 flex items-center justify-center rounded-full bg-white shadow-sm wishlist-btn hover:scale-105 transition"
                                                data-product-id="{{ $product->id }}">
                                            <i class="fa fa-heart {{ auth()->user()->wishlist->contains('product_id', $product->id) ? 'text-red-500' : 'text-gray-400' }} text-[10px]"></i>
                                        </button>
                                        @else
                                        <a href="{{ route('login') }}" class="absolute top-1 right-1 z-20 w-7 h-7 flex items-center justify-center rounded-full bg-white shadow-sm">
                                            <i class="fa fa-heart text-gray-400 text-[10px]"></i>
                                        </a>
                                        @endauth

                                        {{-- IMAGE --}}
                                        <a href="{{ route('shop.show', $product->slug) }}" class="block">
                                            <div class="w-full h-36 rounded-lg overflow-hidden flex items-center justify-center">
                                                @php $img = $product->images->first(); @endphp
                                                <img src="@storageUrl($img ? $img->path : 'uploads/products/default.png')"
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

                                            {{-- 2. STAR RATINGS (Always visible now) --}}
                                            @php 
                                                $avgRating = $product->reviews_avg_rating ?? $product->reviews()->avg('rating') ?? 0;
                                                $reviewCount = $product->reviews_count ?? $product->reviews()->count() ?? 0;
                                            @endphp
                                            <div class="flex items-center gap-1 mt-1 mb-1 opacity-90">
                                                <div class="flex text-yellow-400 text-[9px] gap-0.5">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fa{{ $i <= round($avgRating) ? '-solid' : '-regular' }} fa-star"></i>
                                                    @endfor
                                                </div>
                                                <span class="text-[9px] text-gray-500 font-medium">({{ $reviewCount }})</span>
                                            </div>

                                            @if($product->size)
                                                <p class="text-xs text-gray-500 mt-0.5 leading-tight">{{ $product->size }}</p>
                                            @endif
                                        </div>

                                        {{-- PRICE & ACTION --}}
                                        <div class="mt-3 flex items-center justify-between">
                                            <div class="flex flex-col leading-tight">
                                                @if ($product->discount_price && $product->discount_price > 0)
                                                    <span class="text-base font-bold text-gray-900">₹{{ $product->discount_price }}</span>
                                                    <span class="line-through text-[10px] text-gray-400">₹{{ $product->price }}</span>
                                                @else
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
                    <div class="swiper-prev absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white rounded-full w-10 h-10 flex items-center justify-center shadow-lg cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity hidden md:flex border border-gray-100 text-green-600">
                        <i class="fa fa-chevron-left"></i>
                    </div>
                    <div class="swiper-next absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white rounded-full w-10 h-10 flex items-center justify-center shadow-lg cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity hidden md:flex border border-gray-100 text-green-600">
                        <i class="fa fa-chevron-right"></i>
                    </div>
                </div>
            </section> 
        @endif

        @if($newProducts->isNotEmpty())
            <section class="overflow-hidden">
                {{-- HEADER --}}
                <div class="flex items-center justify-between mb-3 mt-3 text-sm px-2">
                    <x-section-header 
                        title="New Arrivals" 
                        badgeText="Fresh Stock" 
                        icon="leaf" 
                        :pulse="true"
                    />
                    <a href="{{ route('products.all', ['type' => 'new-arrivals']) }}" class="text-xl text-green-600 hover:underline">View all</a>
                </div>

                {{-- UNIVERSAL SLIDER --}}
                <div class="relative group px-2 product-slider-container">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            @foreach ($newProducts as $product)
                                <div class="swiper-slide h-auto flex pb-4">
                                     {{-- PRODUCT CARD START --}}
                                    <div class="relative bg-white rounded-xl border border-gray-200 hover:shadow-md transition-all p-2 flex flex-col w-full overflow-hidden">
                                        
                                        {{-- 3. STOCK SCARCITY (DIAGONAL RIBBON) --}}
                                        @if($product->stock_quantity > 0 && $product->stock_quantity <= 10)
                                            <div class="absolute -right-[34px] top-[14px] w-[140px] h-[24px] bg-[#1a7a1a] text-white text-[9px] font-black tracking-widest flex items-center justify-center rotate-45 z-1 shadow-sm border-y border-white/20 uppercase" style="box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                                {{ $product->stock_quantity }} LEFT
                                            </div>
                                        @endif

                                        {{-- 1. DISCOUNT BADGE --}}
                                        @if($product->discount_price && $product->price > 0)
                                            @php $discountPercent = round((($product->price - $product->discount_price) / $product->price) * 100); @endphp
                                            <div class="absolute top-2 left-2 z-10 bg-green-600 text-white text-[9px] font-bold px-1.5 py-0.5 rounded shadow-sm">
                                                {{ $discountPercent }}% OFF
                                            </div>
                                        @endif

                                        {{-- WISHLIST (STAYS ON TOP) --}}
                                        @auth
                                        <button class="absolute top-1 right-1 z-20 w-7 h-7 flex items-center justify-center rounded-full bg-white shadow-sm wishlist-btn hover:scale-105 transition"
                                                data-product-id="{{ $product->id }}">
                                            <i class="fa fa-heart {{ auth()->user()->wishlist->contains('product_id', $product->id) ? 'text-red-500' : 'text-gray-400' }} text-[10px]"></i>
                                        </button>
                                        @else
                                        <a href="{{ route('login') }}" class="absolute top-1 right-1 z-20 w-7 h-7 flex items-center justify-center rounded-full bg-white shadow-sm">
                                            <i class="fa fa-heart text-gray-400 text-[10px]"></i>
                                        </a>
                                        @endauth

                                        {{-- IMAGE --}}
                                        <a href="{{ route('shop.show', $product->slug) }}" class="block">
                                            <div class="w-full h-36 rounded-lg overflow-hidden flex items-center justify-center">
                                                @php $img = $product->images->first(); @endphp
                                                <img src="@storageUrl($img ? $img->path : 'uploads/products/default.png')"
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

                                            {{-- STAR RATINGS --}}
                                            @php 
                                                $avgRating = $product->reviews_avg_rating ?? $product->reviews()->avg('rating') ?? 0;
                                                $reviewCount = $product->reviews_count ?? $product->reviews()->count() ?? 0;
                                            @endphp
                                            <div class="flex items-center gap-1 mt-1 mb-1 opacity-90">
                                                <div class="flex text-yellow-400 text-[9px] gap-0.5">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fa{{ $i <= round($avgRating) ? '-solid' : '-regular' }} fa-star"></i>
                                                    @endfor
                                                </div>
                                                <span class="text-[9px] text-gray-500 font-medium">({{ $reviewCount }})</span>
                                            </div>

                                            @if($product->size)
                                                <p class="text-xs text-gray-500 mt-0.5 leading-tight">{{ $product->size }}</p>
                                            @endif
                                        </div>

                                        {{-- PRICE & ACTION --}}
                                        <div class="mt-3 flex items-center justify-between">
                                            <div class="flex flex-col leading-tight">
                                                @if ($product->discount_price && $product->discount_price > 0)
                                                    <span class="text-base font-bold text-gray-900">₹{{ $product->discount_price }}</span>
                                                    <span class="line-through text-[10px] text-gray-400">₹{{ $product->price }}</span>
                                                @else
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
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    {{-- NAVIGATION --}}
                    <div class="swiper-prev absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white rounded-full w-10 h-10 flex items-center justify-center shadow-lg cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity hidden md:flex border border-gray-100 text-green-600">
                        <i class="fa fa-chevron-left"></i>
                    </div>
                    <div class="swiper-next absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white rounded-full w-10 h-10 flex items-center justify-center shadow-lg cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity hidden md:flex border border-gray-100 text-green-600">
                        <i class="fa fa-chevron-right"></i>
                    </div>
                </div>
            </section>
        @endif


            <!-- ---------------------------------------------------------------------- -->
            {{-- ================= PREMIUM DYNAMIC TRIPLE BANNERS ================= --}}
            @if(isset($adsplacements['home_triple_banner']) && $adsplacements['home_triple_banner']->ads->isNotEmpty())
                <section class="py-12 overflow-hidden tripleBannerSlider bg-gray-50/50">
                    <div class="max-w-7xl mx-auto px-4">
                        <div class="relative group">
                            <div class="swiper tripleBannerSwiper !overflow-visible">
                                <div class="swiper-wrapper">
                                    @foreach($adsplacements['home_triple_banner']->ads as $ad)
                                        <div class="swiper-slide">
                                            <div class="banner w-full relative overflow-hidden rounded-[2rem] shadow-2xl border-4 border-white group/slide" 
                                                 style="height: 250px; md:height: 350px;">
                                                
                                                <a href="{{ route('offers.click', $ad->id) }}" class="block w-full h-full relative">
                                                    {{-- Gradient Overlay --}}
                                                    <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/30 to-transparent z-10 transition-opacity group-hover/slide:opacity-60 duration-500"></div>
                                                    
                                                    {{-- Main Image --}}
                                                    <img src="{{$ad->banner_image}}" 
                                                         class="w-full h-full object-cover transition-transform duration-1000 group-hover/slide:scale-110" 
                                                         alt="{{ $ad->title }}">

                                                    {{-- Text Content --}}
                                                    <div class="absolute inset-0 z-20 flex flex-col justify-center px-6 md:px-12">
                                                        <div class="max-w-md transform transition-all duration-700 group-hover/slide:translate-x-4">
                                                            @if($ad->subtitle)
                                                            <span class="text-green-400 text-xs md:text-sm font-black uppercase tracking-[0.2em] mb-3 block animate-pulse">
                                                                {{ $ad->subtitle }}
                                                            </span>
                                                            @endif
                                                            
                                                            <h4 class="text-2xl md:text-5xl font-black text-white italic uppercase leading-[0.85] tracking-tighter drop-shadow-2xl">
                                                                {{ $ad->title }}
                                                            </h4>
                                                            
                                                            <div class="h-1.5 w-16 bg-green-500 rounded-full mt-6 mb-4 group-hover/slide:w-32 transition-all duration-700"></div>
                                                            
                                                            <div  class="inline-flex items-center gap-3 bg-white text-black px-5 md:px-8 py-3 rounded-full text-[10px] md:text-xs font-black uppercase tracking-widest hover:bg-green-600 hover:text-white transition-all transform hover:scale-110 shadow-xl w-fit">
                                                                Grab Now
                                                                <i class="fa fa-arrow-right text-[10px]"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Navigation Controls --}}
                            <div class="triple-prev absolute -left-6 top-1/2 -translate-y-1/2 z-30 w-12 h-12 bg-white border border-gray-100 rounded-full flex items-center justify-center shadow-2xl cursor-pointer hover:bg-green-600 hover:text-white transition-all transform hover:scale-110 active:scale-90 opacity-0 group-hover:opacity-100 hidden md:flex">
                                <i class="fa fa-chevron-left"></i>
                            </div>
                            <div class="triple-next absolute -right-6 top-1/2 -translate-y-1/2 z-30 w-12 h-12 bg-white border border-gray-100 rounded-full flex items-center justify-center shadow-2xl cursor-pointer hover:bg-green-600 hover:text-white transition-all transform hover:scale-110 active:scale-90 opacity-0 group-hover:opacity-100 hidden md:flex">
                                <i class="fa fa-chevron-right"></i>
                            </div>

                            {{-- Pagination --}}
                            <div class="tripleBannerPagination flex justify-center gap-2 mt-8"></div>
                        </div>
                    </div>
                </section>
            @endif

            {{-- ================= MOVING OFFER STRIP ================= --}}
            <section class="w-full overflow-hidden" data-aos="fade-up">
                <div class="bg-green-700 text-white shadow-sm relative" style="padding:5px;">

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
            <section style="background: white;" class="overflow-hidden">
                <div class="flex items-center justify-between mb-3 text-sm px-2">
                        <x-section-header 
                            title="Trending Now" 
                            badgeText="Hot Picks" 
                            icon="fire" 
                            :pulse="true"
                        />
                        <a href="{{ route('products.all', ['type' => 'trending']) }}" class="text-xl text-green-600 hover:underline">View all</a>
                    </div>
          
                <div class="relative group px-2 product-slider-container">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            @foreach ($trendingProducts as $product)
                                <div class="swiper-slide h-auto flex pb-4">
                                    <div class="relative bg-white rounded-xl border border-gray-200 hover:shadow-md transition-all p-2 flex flex-col w-full overflow-hidden">
                                        
                                        {{-- 3. STOCK SCARCITY (DIAGONAL RIBBON) --}}
                                        @if($product->stock_quantity > 0 && $product->stock_quantity <= 10)
                                            <div class="absolute -right-[34px] top-[14px] w-[140px] h-[24px] bg-[#1a7a1a] text-white text-[9px] font-black tracking-widest flex items-center justify-center rotate-45 z-1 shadow-sm border-y border-white/20 uppercase" style="box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                                {{ $product->stock_quantity }} LEFT
                                            </div>
                                        @endif

                                        {{-- 1. DISCOUNT BADGE --}}
                                        @if($product->discount_price && $product->price > 0)
                                            @php $discountPercent = round((($product->price - $product->discount_price) / $product->price) * 100); @endphp
                                            <div class="absolute top-2 left-2 z-10 bg-green-600 text-white text-[9px] font-bold px-1.5 py-0.5 rounded shadow-sm">
                                                {{ $discountPercent }}% OFF
                                            </div>
                                        @endif

                                        {{-- WISHLIST (STAYS ON TOP) --}}
                                        @auth
                                        <button class="absolute top-1 right-1 z-20 w-7 h-7 flex items-center justify-center rounded-full bg-white shadow-sm wishlist-btn hover:scale-105 transition"
                                                data-product-id="{{ $product->id }}">
                                            <i class="fa fa-heart {{ auth()->user()->wishlist->contains('product_id', $product->id) ? 'text-red-500' : 'text-gray-400' }} text-[10px]"></i>
                                        </button>
                                        @else
                                        <a href="{{ route('login') }}" class="absolute top-1 right-1 z-20 w-7 h-7 flex items-center justify-center rounded-full bg-white shadow-sm">
                                            <i class="fa fa-heart text-gray-400 text-[10px]"></i>
                                        </a>
                                        @endauth

                                        {{-- IMAGE --}}
                                        <a href="{{ route('shop.show', $product->slug) }}" class="block">
                                            <div class="w-full h-36 rounded-lg overflow-hidden flex items-center justify-center">
                                                @php $img = $product->images->first(); @endphp
                                                <img src="@storageUrl($img ? $img->path : 'uploads/products/default.png')"
                                                    class="w-full h-full object-contain p-2" alt="{{ $product->name }}">
                                            </div>
                                        </a>

                                        {{-- INFO --}}
                                        <div class="mt-3 flex-1">
                                            <span class="w-fit inline-flex items-center gap-1 bg-orange-50 text-yellow-900 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                                <i class="fa-solid fa-clock"></i> 8 MINS
                                            </span>
                                            <p class="text-sm font-semibold text-gray-900 leading-tight line-clamp-1 mt-2">
                                                {{ $product->name }}
                                            </p>

                                            {{-- STAR RATINGS --}}
                                            @php 
                                                $avgRating = $product->reviews_avg_rating ?? $product->reviews()->avg('rating') ?? 0;
                                                $reviewCount = $product->reviews_count ?? $product->reviews()->count() ?? 0;
                                            @endphp
                                            <div class="flex items-center gap-1 mt-1 mb-1 opacity-90">
                                                <div class="flex text-yellow-400 text-[9px] gap-0.5">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fa{{ $i <= round($avgRating) ? '-solid' : '-regular' }} fa-star"></i>
                                                    @endfor
                                                </div>
                                                <span class="text-[9px] text-gray-500 font-medium">({{ $reviewCount }})</span>
                                            </div>

                                            @if($product->size)
                                                <p class="text-sm text-gray-500 mt-0.5">{{ $product->size }}</p>
                                            @endif
                                        </div>

                                        {{-- PRICE & ACTION --}}
                                        <div class="mt-2 flex items-center justify-between">
                                            <div class="flex flex-col leading-tight">
                                                @if ($product->discount_price && $product->discount_price > 0)
                                                    <span class="text-base font-bold text-gray-900">₹{{ $product->discount_price }}</span>
                                                    <span class="line-through text-[10px] text-gray-400">₹{{ $product->price }}</span>
                                                @else
                                                    <span class="text-base font-bold text-gray-900">₹{{ $product->price }}</span>
                                                @endif
                                            </div>
                                            @auth
                                                 <button class="cart-btn px-2 py-1.5 border border-green-600 rounded-lg text-sm font-semibold {{ $product->cartItem ? 'bg-green-100 text-green-600' : 'text-green-600 hover:bg-green-50' }}"
                                                    data-product-id="{{ $product->id }}">
                                                    {{ $product->cartItem ? 'ADDED' : 'ADD' }}
                                                </button>
                                            @else
                                                <a href="{{ route('login') }}" class="cart-btn px-2 py-1.5 border border-green-600 rounded-lg text-sm font-semibold text-green-600">ADD</a>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    {{-- NAVIGATION --}}
                    <div class="swiper-prev absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white rounded-full w-10 h-10 flex items-center justify-center shadow-lg cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity hidden md:flex border border-gray-100 text-green-600">
                        <i class="fa fa-chevron-left"></i>
                    </div>
                    <div class="swiper-next absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white rounded-full w-10 h-10 flex items-center justify-center shadow-lg cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity hidden md:flex border border-gray-100 text-green-600">
                        <i class="fa fa-chevron-right"></i>
                    </div>
                </div>
            </section> 
        @endif

            @if($featuredProducts->isNotEmpty())
                <section class="overflow-hidden">
                    <div class="flex items-center justify-between mb-3 mt-3 text-sm px-2">
                       <x-section-header 
                            title="Featured" 
                            badgeText="Handpicked" 
                            icon="star" 
                            :pulse="true"
                        />
                        <a href="{{ route('products.all', ['type' => 'featured']) }}" class="text-xl text-green-600 hover:underline">View all</a>
                    </div>
                    
                    <div class="relative group px-2 product-slider-container">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @foreach ($featuredProducts as $product)
                                    <div class="swiper-slide h-auto flex pb-4">
                                        <div class="relative bg-white rounded-xl border border-gray-200 hover:shadow-md transition-all p-2 flex flex-col w-full overflow-hidden">
                                            
                                            {{-- 3. STOCK SCARCITY (DIAGONAL RIBBON) --}}
                                            @if($product->stock_quantity > 0 && $product->stock_quantity <= 10)
                                                <div class="absolute -right-[34px] top-[14px] w-[140px] h-[24px] bg-[#1a7a1a] text-white text-[9px] font-black tracking-widest flex items-center justify-center rotate-45 z-1 shadow-sm border-y border-white/20 uppercase" style="box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                                    {{ $product->stock_quantity }} LEFT
                                                </div>
                                            @endif

                                            {{-- 1. DISCOUNT BADGE --}}
                                            @if($product->discount_price && $product->price > 0)
                                                @php $discountPercent = round((($product->price - $product->discount_price) / $product->price) * 100); @endphp
                                                <div class="absolute top-2 left-2 z-10 bg-green-600 text-white text-[9px] font-bold px-1.5 py-0.5 rounded shadow-sm">
                                                    {{ $discountPercent }}% OFF
                                                </div>
                                            @endif

                                            {{-- WISHLIST (STAYS ON TOP) --}}
                                            @auth
                                            <button class="absolute top-1 right-1 z-20 w-7 h-7 flex items-center justify-center rounded-full bg-white shadow-sm wishlist-btn hover:scale-105 transition"
                                                    data-product-id="{{ $product->id }}">
                                                <i class="fa fa-heart {{ auth()->user()->wishlist->contains('product_id', $product->id) ? 'text-red-500' : 'text-gray-400' }} text-[10px]"></i>
                                            </button>
                                            @else
                                            <a href="{{ route('login') }}" class="absolute top-1 right-1 z-20 w-7 h-7 flex items-center justify-center rounded-full bg-white shadow-sm">
                                                <i class="fa fa-heart text-gray-400 text-[10px]"></i>
                                            </a>
                                            @endauth

                                            {{-- IMAGE --}}
                                            <a href="{{ route('shop.show', $product->slug) }}" class="block">
                                                <div class="w-full h-36 rounded-lg overflow-hidden flex items-center justify-center">
                                                    @php $img = $product->images->first(); @endphp
                                                    <img src="@storageUrl($img ? $img->path : 'uploads/products/default.png')"
                                                        class="w-full h-full object-contain p-2" alt="{{ $product->name }}">
                                                </div>
                                            </a>

                                            {{-- INFO --}}
                                            <div class="mt-3 flex-1">
                                                <span class="w-fit inline-flex items-center gap-1 bg-orange-50 text-yellow-900 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                                    <i class="fa-solid fa-clock"></i> 8 MINS
                                                </span>
                                                <p class="text-sm font-semibold text-gray-900 leading-tight line-clamp-1 mt-2">
                                                    {{ $product->name }}
                                                </p>

                                                {{-- STAR RATINGS --}}
                                                @php 
                                                    $avgRating = $product->reviews_avg_rating ?? $product->reviews()->avg('rating') ?? 0;
                                                    $reviewCount = $product->reviews_count ?? $product->reviews()->count() ?? 0;
                                                @endphp
                                                <div class="flex items-center gap-1 mt-1 mb-1 opacity-90">
                                                    <div class="flex text-yellow-400 text-[9px] gap-0.5">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <i class="fa{{ $i <= round($avgRating) ? '-solid' : '-regular' }} fa-star"></i>
                                                        @endfor
                                                    </div>
                                                    <span class="text-[9px] text-gray-500 font-medium">({{ $reviewCount }})</span>
                                                </div>

                                                @if($product->size)
                                                    <p class="text-sm text-gray-500 mt-0.5">{{ $product->size }}</p>
                                                @endif
                                            </div>

                                            {{-- PRICE & ACTION --}}
                                            <div class="mt-2 flex items-center justify-between">
                                                <div class="flex flex-col leading-tight">
                                                    @if ($product->discount_price && $product->discount_price > 0)
                                                        <span class="text-base font-bold text-gray-900">₹{{ $product->discount_price }}</span>
                                                        <span class="line-through text-[10px] text-gray-400">₹{{ $product->price }}</span>
                                                    @else
                                                        <span class="text-base font-bold text-gray-900">₹{{ $product->price }}</span>
                                                    @endif
                                                </div>
                                                @auth
                                                     <button class="cart-btn px-2 py-1.5 border border-green-600 rounded-lg text-sm font-semibold {{ $product->cartItem ? 'bg-green-100 text-green-600' : 'text-green-600 hover:bg-green-50' }}"
                                                        data-product-id="{{ $product->id }}">
                                                        {{ $product->cartItem ? 'ADDED' : 'ADD' }}
                                                    </button>
                                                @else
                                                    <a href="{{ route('login') }}" class="cart-btn px-2 py-1.5 border border-green-600 rounded-lg text-sm font-semibold text-green-600">ADD</a>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        {{-- NAVIGATION --}}
                        <div class="swiper-prev absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white rounded-full w-10 h-10 flex items-center justify-center shadow-lg cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity hidden md:flex border border-gray-100 text-green-600">
                            <i class="fa fa-chevron-left"></i>
                        </div>
                        <div class="swiper-next absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white rounded-full w-10 h-10 flex items-center justify-center shadow-lg cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity hidden md:flex border border-gray-100 text-green-600">
                            <i class="fa fa-chevron-right"></i>
                        </div>
                    </div>
                </section>
            @endif

            {{-- ================= SHOP BY BRANDS ================= --}}
            @if(isset($brands) && $brands->isNotEmpty())
                <section class="py-12 bg-white overflow-hidden" data-aos="fade-up">
                    <div class="px-2">
                        <div class="flex items-center justify-between mb-6">
                            <x-section-header 
                                title="Shop by Brands" 
                                badgeText="Featured" 
                                icon="award" 
                                :pulse="true"
                            />
                            <a href="{{ route('shop.index') }}" class="text-[10px] font-black text-green-600 hover:text-green-800 transition-all tracking-widest flex items-center gap-1 group/all uppercase bg-green-50 px-3 py-1.5 rounded-full hover:bg-green-100 shadow-sm border border-green-200/50">
                                View ALL <i class="fa-solid fa-chevron-right text-[8px] group-hover/all:translate-x-1 transition-transform"></i>
                            </a>
                        </div>

                        <!-- Brands Slider (Optimized Content-to-Slide Density) -->
                        <div class="relative group product-slider-container" data-slides-desktop="10" data-slides-tablet="7" data-slides-mobile="4">
                            <div class="swiper">
                                <div class="swiper-wrapper">
                                    @foreach($brands as $brand)
                                        <div class="swiper-slide h-auto pb-6">
                                            <a href="{{ route('shop.index', ['brand' => $brand->slug]) }}" 
                                               class="group/brand flex flex-col items-center gap-2 p-3 bg-gray-50/50 rounded-3xl border border-transparent hover:border-green-100 hover:bg-white hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 mx-auto w-full overflow-hidden">
                                                
                                                <div class="w-14 h-14 sm:w-16 sm:h-16 lg:w-20 lg:h-20 bg-white rounded-full flex items-center justify-center p-2 sm:p-4 shadow-sm border border-gray-100 group-hover/brand:shadow-md transition-all duration-500 overflow-hidden relative">
                                                    <div class="absolute inset-0 bg-green-500/0 group-hover/brand:bg-green-500/5 transition-colors"></div>
                                                    <img src="@storageUrl($brand->logo)" 
                                                         class="w-full h-full object-contain grayscale group-hover/brand:grayscale-0 transition-all duration-700 scale-90 group-hover/brand:scale-110" 
                                                         alt="{{ $brand->name }}">
                                                </div>

                                                <div class="flex flex-col items-center text-center w-full px-0.5">
                                                    <span class="text-[8px] sm:text-[9px] lg:text-[10px] font-black text-gray-800 group-hover/brand:text-green-600 uppercase tracking-tighter transition-colors leading-tight w-full truncate block">
                                                        {{ $brand->name }}
                                                    </span>
                                                    <span class="text-[7px] text-gray-400 font-bold mt-1 opacity-0 group-hover/brand:opacity-100 transition-all duration-300 transform translate-y-1 group-hover/brand:translate-y-0 hidden sm:block whitespace-nowrap">
                                                        VIEW ALL
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            {{-- Minified Navigation Arrows --}}
                            <div class="swiper-prev absolute -left-2 top-1/2 -translate-y-1/2 z-20 bg-white/95 shadow-lg rounded-full w-9 h-9 flex items-center justify-center border border-gray-50 cursor-pointer text-green-600 hover:bg-green-600 hover:text-white transition-all opacity-0 group-hover:opacity-100 hidden md:flex">
                                <i class="fa-solid fa-chevron-left text-xs"></i>
                            </div>
                            <div class="swiper-next absolute -right-2 top-1/2 -translate-y-1/2 z-20 bg-white/95 shadow-lg rounded-full w-9 h-9 flex items-center justify-center border border-gray-100 cursor-pointer text-green-600 hover:bg-green-600 hover:text-white transition-all opacity-0 group-hover:opacity-100 hidden md:flex">
                                <i class="fa-solid fa-chevron-right text-xs"></i>
                            </div>
                        </div>
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
                        <a href="{{ route('products.all', ['type' => 'budget-store']) }}" class="text-xl text-green-600 hover:underline">View all</a>
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
                <div class="lg:col-span-3 bg-gray-50">
                    {{-- UNIVERSAL SLIDER --}}
                    <div class="relative group px-2 product-slider-container" data-slides-desktop="5">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @foreach ($budgetStore as $product)
                                    <div class="swiper-slide h-auto flex pb-4">
                                        {{-- PRODUCT CARD START --}}
                                        <div class="relative bg-white rounded-xl border border-gray-200 hover:shadow-md transition-all p-2 flex flex-col w-full overflow-hidden">
                                            
                                            {{-- 3. STOCK SCARCITY (DIAGONAL RIBBON) --}}
                                            @if($product->stock_quantity > 0 && $product->stock_quantity <= 10)
                                                <div class="absolute -right-[34px] top-[14px] w-[140px] h-[24px] bg-[#1a7a1a] text-white text-[9px] font-black tracking-widest flex items-center justify-center rotate-45 z-1 shadow-sm border-y border-white/20 uppercase" style="box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                                    {{ $product->stock_quantity }} LEFT
                                                </div>
                                            @endif

                                            {{-- 1. DISCOUNT BADGE --}}
                                            @if($product->discount_price && $product->price > 0)
                                                @php $discountPercent = round((($product->price - $product->discount_price) / $product->price) * 100); @endphp
                                                <div class="absolute top-2 left-2 z-10 bg-green-600 text-white text-[9px] font-bold px-1.5 py-0.5 rounded shadow-sm">
                                                    {{ $discountPercent }}% OFF
                                                </div>
                                            @endif

                                            {{-- WISHLIST (STAYS ON TOP) --}}
                                            @auth
                                            <button class="absolute top-1 right-1 z-20 w-7 h-7 flex items-center justify-center rounded-full bg-white shadow-sm wishlist-btn hover:scale-105 transition"
                                                    data-product-id="{{ $product->id }}">
                                                <i class="fa fa-heart {{ auth()->user()->wishlist->contains('product_id', $product->id) ? 'text-red-500' : 'text-gray-400' }} text-[10px]"></i>
                                            </button>
                                            @else
                                            <a href="{{ route('login') }}" class="absolute top-1 right-1 z-20 w-7 h-7 flex items-center justify-center rounded-full bg-white shadow-sm">
                                                <i class="fa fa-heart text-gray-400 text-[10px]"></i>
                                            </a>
                                            @endauth

                                            {{-- IMAGE --}}
                                            <a href="{{ route('shop.show', $product->slug) }}" class="block">
                                                <div class="w-full h-36 rounded-lg overflow-hidden flex items-center justify-center">
                                                    @php $img = $product->images->first(); @endphp
                                                    <img src="@storageUrl($img ? $img->path : 'uploads/products/default.png')"
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

                                                {{-- STAR RATINGS --}}
                                                @php 
                                                    $avgRating = $product->reviews_avg_rating ?? $product->reviews()->avg('rating') ?? 0;
                                                    $reviewCount = $product->reviews_count ?? $product->reviews()->count() ?? 0;
                                                @endphp
                                                <div class="flex items-center gap-1 mt-1 mb-1 opacity-90">
                                                    <div class="flex text-yellow-400 text-[9px] gap-0.5">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <i class="fa{{ $i <= round($avgRating) ? '-solid' : '-regular' }} fa-star"></i>
                                                        @endfor
                                                    </div>
                                                    <span class="text-[9px] text-gray-500 font-medium">({{ $reviewCount }})</span>
                                                </div>

                                                @if($product->size)
                                                    <p class="text-xs text-gray-500 mt-0.5 leading-tight">{{ $product->size }}</p>
                                                @endif
                                            </div>

                                            {{-- PRICE & ACTION --}}
                                            <div class="mt-3 flex items-center justify-between">
                                                <div class="flex flex-col leading-tight">
                                                    @if ($product->discount_price && $product->discount_price > 0)
                                                        <span class="text-base font-bold text-gray-900">₹{{ $product->discount_price }}</span>
                                                        <span class="line-through text-[10px] text-gray-400">₹{{ $product->price }}</span>
                                                    @else
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
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        {{-- NAVIGATION --}}
                        <div class="swiper-prev absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white rounded-full w-10 h-10 flex items-center justify-center shadow-lg cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity hidden md:flex border border-gray-100 text-green-600">
                            <i class="fa fa-chevron-left"></i>
                        </div>
                        <div class="swiper-next absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white rounded-full w-10 h-10 flex items-center justify-center shadow-lg cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity hidden md:flex border border-gray-100 text-green-600">
                            <i class="fa fa-chevron-right"></i>
                        </div>
                    </div>
                </div>

                    </div>
                </div>
            </section>
       @endif

       @if($categories->isNotEmpty())
            {{-- ================= BEST SELLERS (SLIDER) ================= --}}
            <section class="bg-white py-6 overflow-hidden">
                <div class="px-2">
                    <!-- SECTION HEADING -->
                    <div class="flex items-center justify-between mb-4">
                        <x-section-header 
                            title="Best Sellers" 
                            badgeText="Best Selections" 
                            icon="bolt" 
                            :pulse="true"
                        />
                        <a href="{{ route('categories.index') }}" class="text-xs font-bold text-green-600 hover:underline uppercase tracking-wider flex items-center gap-1">
                            Explore All <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>

                    <!-- SLIDER CONTAINER -->
                    <div class="relative group product-slider-container" data-slides-desktop="3" data-slides-tablet="2">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @foreach ($categories as $category)
                                    @php
                                        // Take up to 4 products for the specific criss-cross bento grid in the image
                                        $displayProducts = $category->products->take(4);
                                        $pCount = $displayProducts->count();
                                    @endphp

                                    @if($pCount >= 3)
                                        <div class="swiper-slide h-auto pb-2">
                                            <div class="w-full bg-gray-50/80 rounded-2xl p-3 border border-gray-100 hover:border-green-200 transition-all hover:shadow-xl group/card h-full flex flex-col">
                                                
                                                <!-- HEADER -->
                                                <div class="flex items-center justify-between mb-3">
                                                    <div class="flex flex-col">
                                                        <h3 class="text-sm font-extrabold text-gray-900 group-hover/card:text-green-700 transition-colors line-clamp-1">
                                                            {{ $category->name }}
                                                        </h3>
                                                        <span class="text-[10px] font-medium text-gray-500 uppercase tracking-tight">{{ $category->products->count() }} items</span>
                                                    </div>
                                                    <span class="text-[10px] font-black text-white bg-green-600 px-2 py-1 rounded shadow-sm">
                                                        BEST
                                                    </span>
                                                </div>

                                                <!-- CRISS-CROSS BENTO GRID (WITH WHITE DIVIDER LINES) -->
                                                <div class="flex gap-[2px] bg-white rounded-xl overflow-hidden border-2 border-white shadow-sm h-72">
                                                    {{-- LEFT COLUMN --}}
                                                    <div class="flex flex-col gap-[2px] w-1/2 h-full">
                                                        {{-- Small Top --}}
                                                        <a href="{{ route('shop.show', $displayProducts[0]->slug) }}" class="h-[40%] bg-gray-50/80 hover:bg-white transition-colors h-full flex items-center justify-center p-2 relative group/img">
                                                            <img src="@storageUrl($displayProducts[0]->images->first()->path)" class="w-full h-full object-contain mix-blend-multiply group-hover/img:scale-110 transition-transform duration-500" alt="">
                                                        </a>
                                                        {{-- Large Bottom --}}
                                                        @if($pCount > 1)
                                                        <a href="{{ route('shop.show', $displayProducts[1]->slug) }}" class="h-[60%] bg-gray-50/80 hover:bg-white transition-colors h-full flex items-center justify-center p-4 relative group/img">
                                                            <img src="@storageUrl($displayProducts[1]->images->first()->path)" class="w-full h-full object-contain mix-blend-multiply group-hover/img:scale-110 transition-transform duration-500" alt="">
                                                        </a>
                                                        @endif
                                                    </div>

                                                    {{-- RIGHT COLUMN --}}
                                                    <div class="flex flex-col gap-[2px] w-1/2 h-full">
                                                        {{-- Large Top --}}
                                                        @if($pCount > 2)
                                                        <a href="{{ route('shop.show', $displayProducts[2]->slug) }}" class="h-[60%] bg-gray-50/80 hover:bg-white transition-colors h-full flex items-center justify-center p-4 relative group/img">
                                                            <img src="@storageUrl($displayProducts[2]->images->first()->path)" class="w-full h-full object-contain mix-blend-multiply group-hover/img:scale-110 transition-transform duration-500" alt="">
                                                        </a>
                                                        @endif
                                                        {{-- Small Bottom --}}
                                                        @if($pCount > 3)
                                                        <a href="{{ route('shop.show', $displayProducts[3]->slug) }}" class="h-[40%] bg-gray-50/80 hover:bg-white transition-colors h-full flex items-center justify-center p-2 relative group/img">
                                                            <img src="@storageUrl($displayProducts[3]->images->first()->path)" class="w-full h-full object-contain mix-blend-multiply group-hover/img:scale-110 transition-transform duration-500" alt="">
                                                        </a>
                                                        @else
                                                            {{-- Placeholder --}}
                                                            <div class="h-[40%] bg-gray-50/40 flex items-center justify-center">
                                                                <i class="fa-solid fa-plus text-gray-200"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- FOOTER ACTIONS -->
                                                <div class="mt-3 flex items-center justify-between pt-2 border-t border-gray-100">
                                                     <a href="{{ route('shop.index', ['category' => $category->slug]) }}" class="inline-flex items-center gap-1.5 text-[11px] font-black text-green-600 hover:text-green-800 transition-colors group/btn">
                                                        EXPLORE NOW
                                                        <i class="fa-solid fa-arrow-right text-[10px] group-hover/btn:translate-x-1 transition-transform"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <!-- CUSTOM NAVIGATION -->
                        <div class="swiper-prev absolute -left-4 top-1/2 -translate-y-1/2 z-20 bg-white/90 backdrop-blur-md rounded-full w-12 h-12 items-center justify-center shadow-lg border border-gray-50 cursor-pointer text-green-600 hover:bg-green-600 hover:text-white transition-all hidden md:flex">
                            <i class="fa-solid fa-chevron-left"></i>
                        </div>
                        <div class="swiper-next absolute -right-4 top-1/2 -translate-y-1/2 z-20 bg-white/90 backdrop-blur-md rounded-full w-12 h-12 items-center justify-center shadow-lg border border-gray-50 cursor-pointer text-green-600 hover:bg-green-600 hover:text-white transition-all hidden md:flex">
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                    </div>
                </div>
            </section>
        @endif

       
          
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
