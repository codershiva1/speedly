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



    <!-- <div class="bg-gray-50"> -->
        <div style="background: white;">
        <!-- <div class="max-w-7xl mx-auto px-4 sm:px-4 lg:px-4 py-4 space-y-8"> -->
<div class=" mx-auto px-1 sm:px-4 lg:px-4 py-1 space-y-8">
        <section class="max-w-7xl mx-auto  px-1">

            <div class="flex flex-col lg:flex-row gap-3">

                <!-- LEFT: Category Grid -->
                <div class="w-full lg:w-6/6">
                    <!-- <div class="grid  grid-cols-4 sm:grid-cols-6 lg:grid-cols-7 gap-4"> -->
                    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-7 xl:grid-cols-10 gap-2.5">


                        @foreach($topCategories->take(20) as $category)
                            <a href="{{ route('shop.index', ['category' => $category->slug]) }}"
                            class="group flex flex-col items-center text-center bg-[#F4F7FB] rounded-2xl p-2 shadow-sm 
                                    hover:shadow-md hover:-translate-y-1 transition-all">

                                <!-- Image (Fixed Size & Same for All) -->
                                <div class="h-20 w-20 flex items-center justify-center overflow-hidden rounded-md">
                                    <img src="{{ asset('storage/'.$category->image) }}"
                                    alt="{{ $category->name }}"
                                    class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">

                                </div>

                                <!-- Category Name -->
                                <p class="mt-3 font-semibold text-gray-900 text-xs md:text-sm leading-tight">
                                    {{ $category->name }}
                                </p>

                                <!-- Item Count -->
                                <p class="text-gray-500 text-[11px] md:text-xs">
                                    {{ $category->products_count }} Items
                                </p>
                                
                            </a>
                        @endforeach

                    </div>
                </div>

                <!-- RIGHT: FILTER BOX -->
                 {{--
                <!-- <div class="w-full lg:w-1/6">
                    <div class="bg-white shadow-md rounded-xl p-4" style="height: 340px;overflow-y: scroll;">

                        <h3 class="text-lg font-semibold mb-4 text-gray-800">Category Filter</h3>

                    <div class="space-y-3">

                        @foreach($topCategories as $category)
                            <a
                                href="{{ route('shop.index', ['category' => $category->slug]) }}"
                                class="flex items-center justify-between text-sm px-2 py-1 rounded
                                    hover:bg-gray-100
                                    {{ request('category') == $category->slug ? 'font-semibold text-blue-600' : 'text-gray-700' }}"
                            >
                                <span>{{ $category->name }}</span>

                                <span class="text-gray-400 text-xs">
                                    ({{ $category->products_count }})
                                </span>
                            </a>
                        @endforeach

                    </div>
                </div> -->
                --}}

            </div>

        </section>


         <!-- {{-- ================= TOP FEATURE ICON ROW ================= --}}
            <section class="grid grid-cols-2 md:grid-cols-5 gap-4">
                <div class="bg-white rounded-lg shadow-sm px-4 py-3 flex items-start space-x-3 text-xs">
                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-amber-100 text-amber-600 text-lg">🚚</div>
                    <div>
                        <p class="font-semibold text-gray-900">Free Delivery</p>
                        <p class="text-gray-500">Free shipping on all orders</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-sm px-4 py-3 flex items-start space-x-3 text-xs">
                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-amber-100 text-amber-600 text-lg">💰</div>
                    <div>
                        <p class="font-semibold text-gray-900">Big Saving Shop</p>
                        <p class="text-gray-500">Save big every single order</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-sm px-4 py-3 flex items-start space-x-3 text-xs">
                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-amber-100 text-amber-600 text-lg">⏰</div>
                    <div>
                        <p class="font-semibold text-gray-900">Online Support 24/7</p>
                        <p class="text-gray-500">We’re here day and night</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-sm px-4 py-3 flex items-start space-x-3 text-xs">
                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-amber-100 text-amber-600 text-lg">🔁</div>
                    <div>
                        <p class="font-semibold text-gray-900">Money Back Return</p>
                        <p class="text-gray-500">Guarantee under 7 days</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-sm px-4 py-3 flex items-start space-x-3 text-xs">
                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-amber-100 text-amber-600 text-lg">🎁</div>
                    <div>
                        <p class="font-semibold text-gray-900">Member Discount</p>
                        <p class="text-gray-500">On orders over $120.00</p>
                    </div>
                </div>
            </section> -->

         {{-- ================= ICONS SLIDER SECTION (shows 3 at a time, slides by 1) ================= --}}
           <section class="icons-carousel-section max-w-7xl mx-auto" data-aos="fade-up">
                <div class="">

                    <!-- LEFT SIDE (1/4 WIDTH) -->
                    <!-- <div class="relative hidden md:flex items-center p-6 bg-cover bg-center md:col-span-1"
                        style="background-image: url('https://wordpress.templatetrip.com/WCM003_egudgets/wp-content/uploads/2023/08/banner-03.jpg');">

                       
                        <div class="absolute inset-0 bg-black/40"></div>

                        
                        <div class="relative text-white text-left">
                            <h2 class="text-xl font-bold leading-tight">Why Shop With Us?</h2>
                            <p class="text-sm mt-1 opacity-90">Best features & benefits</p>
                        </div>
                </div> -->


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
            <section>
                <!-- <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">Featured products</h2>
                </div> -->
                <div class="flex items-center justify-between mb-3 mt-3 text-sm">
                        <x-section-header 
                            title="Mega Deals" 
                            badgeText="Flash Sale" 
                            icon="bolt" 
                            :pulse="true" 
                        />
                        <a href="{{ route('shop.index') }}" class="text-xs text-indigo-600 hover:underline">View all</a>
                    </div>
          
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    @foreach ($megaDeals->take(6) as $product)
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
                                <div class="w-full h-36 bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center">
                                    @php 
                                        $img = $product->images->first(); 
                                    @endphp

                                    <img src="{{ $img ? asset('public/storage/' . $img->path) : asset('public/storage/uploads/products/1/image3.png') }}"
                                        class="w-full h-full object-contain"
                                        alt="{{ $product->name }}">
                                  
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
                                    {{-- Price --}}
                                    <span class="text-base font-bold text-gray-900">
                                        ₹{{ $product->price }}
                                    </span>

                                    {{-- Discount Price under it --}}
                                    @if ($product->discount_price)
                                        <span class="line-through text-xs text-gray-400">
                                            ₹{{ $product->discount_price }}
                                        </span>
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

        @if($newProducts->isNotEmpty())
                <section>
                    <div class="flex items-center justify-between mb-3 mt-3 text-sm">
                        <x-section-header 
                            title="New Arrivals" 
                            badgeText="Fresh Stock" 
                            icon="leaf" 
                            :pulse="true"
                        />
                        <a href="{{ route('shop.index') }}" class="text-xs text-indigo-600 hover:underline">View all</a>
                    </div>

                 <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    @foreach ($newProducts->take(6) as $product)
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
                                <div class="w-full h-36 bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center">
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
                                    {{-- Price --}}
                                    <span class="text-base font-bold text-gray-900">
                                        ₹{{ $product->price }}
                                    </span>

                                    {{-- Discount Price under it --}}
                                    @if ($product->discount_price)
                                        <span class="line-through text-xs text-gray-400">
                                            ₹{{ $product->discount_price }}
                                        </span>
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


            <!-- ---------------------------------------------------------------------- -->

                  
            {{-- ================= THREE COLOUR BANNERS ================= --}}
            <section class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="banner relative overflow-hidden " style="height:200px;">
                        <!-- Banner Image -->
                    <img src="https://i.pinimg.com/1200x/fa/cc/de/faccde06184e838e68cbe361149ece9d.jpg" class="w-full h-full object-cover banner-img" />

                       
                </div>
               <div class="banner relative overflow-hidden "  style="height:200px;">
                        <!-- Banner Image -->
                    <img src="https://i.pinimg.com/1200x/62/0b/6e/620b6eaa3fbc897871fff2b6f6d3efe1.jpg"
                        class="w-full h-full object-cover banner-img" />

                        
                </div>
                <div class="banner relative overflow-hidden "  style="height:200px;">
                        <!-- Banner Image -->
                    <img src="https://i.pinimg.com/736x/c0/4c/89/c04c89ef90ce8c726b0b483823e79b93.jpg"
                        class="w-full h-full object-cover banner-img" />

                       
                </div>
            </section>


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
                                <div class="w-full h-36 bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center">
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
                                    {{-- Price --}}
                                    <span class="text-base font-bold text-gray-900">
                                        ₹{{ $product->price }}
                                    </span>

                                    {{-- Discount Price under it --}}
                                    @if ($product->discount_price)
                                        <span class="line-through text-xs text-gray-400">
                                            ₹{{ $product->discount_price }}
                                        </span>
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
                                <div class="w-full h-36 bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center">
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
                                    {{-- Price --}}
                                    <span class="text-base font-bold text-gray-900">
                                        ₹{{ $product->price }}
                                    </span>

                                    {{-- Discount Price under it --}}
                                    @if ($product->discount_price)
                                        <span class="line-through text-xs text-gray-400">
                                            ₹{{ $product->discount_price }}
                                        </span>
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
                    <aside class="lg:col-span-1 bg-white  shadow-sm  text-xs h-fit-content">
                       

                            <!-- LEFT SIDE (1/4 WIDTH) -->
                           <div class="relative hidden md:flex items-center justify-center 
                                    h-full min-h-[300px] px-6 py-10 
                                    bg-cover bg-center bg-no-repeat
                                    md:col-span-1"
                            style="background-image: url('https://i.pinimg.com/736x/35/95/9e/35959e77f6237aaec2c673e772c73e08.jpg');">

                            <!-- OPTIONAL DARK OVERLAY -->
                            <div class="absolute inset-0 bg-black/40"></div>

                            <!-- TEXT -->
                            <div class="relative text-white text-left z-10">
                                <h2 class="text-xl font-bold leading-tight">Why Shop With Us?</h2>
                                <p class="text-sm mt-1 opacity-90">Best features & benefits</p>
                            </div>
                        </div>
                                            
                        
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
                                <div class="w-full h-36 bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center">
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
                                    {{-- Price --}}
                                    <span class="text-base font-bold text-gray-900">
                                        ₹{{ $product->price }}
                                    </span>

                                    {{-- Discount Price under it --}}
                                    @if ($product->discount_price)
                                        <span class="line-through text-xs text-gray-400">
                                            ₹{{ $product->discount_price }}
                                        </span>
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

            <section class="bg-white  shadow-sm p-4">
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
                            <div class="bg-gray-100  w-auto">

                                <!-- INNER IMAGE GRID -->
                                <div class="grid grid-cols-2 grid-rows-2 ">
                                    @foreach ($category->products->take(4) as $product)
                                        <a href="{{ route('shop.show', $product->slug) }}" class="block">
                                            <div class="bg-white  flex items-center justify-center ">
                                                <!-- <img 
                                                    src="{{ asset('storage/' . $product->images->first()->path) }}"
                                                    class="w-full h-full object-contain p-1"
                                                    alt=""
                                                > -->
                                                <img 
                                                    src="{{ asset('storage/uploads/products/1/image2.png')}}"
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
            <section class="bg-white  shadow-sm p-4">
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
