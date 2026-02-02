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
                </div> -->  --}}

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



            @if($featuredProducts->isNotEmpty())
            <section>
                <!-- <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">Featured products</h2>
                </div> -->
                <div class="flex items-center justify-between mb-3 mt-3 text-sm">
                        <div class="flex items-center space-x-6">
                            <span class="font-semibold text-gray-900   pb-1" style="font-size:22px;">
                                Best offer Products
                            </span>
                           
                        </div>
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
                                        $fullPath = $img 
                                            ? 'http://localhost/speedly/multi-vendor-ecommerce/public/storage/' . $img->path 
                                            : null;
                                    @endphp

                                    @if ($img)
                                        <img src="{{ asset('storage/uploads/products/1/image3.png') }}"
                                        class="w-full h-full object-contain"
                                        alt="{{ $product->name }}">
                                    @else
                                        <span class="text-gray-400 text-xs">No Image</span>
                                    @endif
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
                            <div class="mt-3 flex items-center justify-between">
                                
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

                <section>
                    <div class="flex items-center justify-between mb-3 mt-3 text-sm">
                        <div class="flex items-center space-x-6">
                            <span class="font-semibold text-gray-900   pb-1" style="font-size:22px;">
                                Best offer Products
                            </span>
                           
                        </div>
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
                                        $fullPath = $img 
                                            ? 'http://localhost/speedly/multi-vendor-ecommerce/public/storage/' . $img->path 
                                            : null;
                                    @endphp

                                    @if ($img)
                                        <img src="{{ asset('storage/uploads/products/2/image6.png')}}" 
                                            class="w-full h-full object-contain"
                                            alt="{{ $product->name }}" >
                                    @else
                                        <span class="text-gray-400 text-xs">No Image</span>
                                    @endif
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
                            <div class="mt-3 flex items-center justify-between">
                                
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

                        <!-- Your Banner Text -->
                    <!-- <div class="absolute inset-0 flex items-center px-6 py-5 text-white z-10">
                        <div class="flex-1">
                            <span class="text-[11px] font-semibold uppercase bg-amber-400 text-gray-900 px-2 py-0.5 rounded">
                                Smart Phones
                            </span>
                            <h3 class="mt-2 text-lg font-bold">OnePlus 8</h3>
                            <p class="mt-1 text-xs">128 GB Green in 2013</p>
                            <p class="mt-3 text-sm">From <span class="text-yellow-300 font-semibold">$60.99/-</span></p>
                        </div>
                    </div> -->
                </div>
               <div class="banner relative overflow-hidden "  style="height:200px;">
                        <!-- Banner Image -->
                    <img src="https://i.pinimg.com/1200x/62/0b/6e/620b6eaa3fbc897871fff2b6f6d3efe1.jpg"
                        class="w-full h-full object-cover banner-img" />

                        <!-- Your Banner Text -->
                    <!-- <div class="absolute inset-0 flex items-center px-6 py-5 text-white z-10">
                        <div class="flex-1">
                            <span class="text-[11px] font-semibold uppercase bg-amber-400 text-gray-900 px-2 py-0.5 rounded">
                                Smart Watches
                            </span>
                            <h3 class="mt-2 text-lg font-bold">Apple Watch Series 4</h3>
                            <p class="mt-3 text-sm">From <span class="text-yellow-300 font-semibold">$14.99/-</span></p>
                        </div>
                    </div> -->
                </div>
                <div class="banner relative overflow-hidden "  style="height:200px;">
                        <!-- Banner Image -->
                    <img src="https://i.pinimg.com/736x/c0/4c/89/c04c89ef90ce8c726b0b483823e79b93.jpg"
                        class="w-full h-full object-cover banner-img" />

                        <!-- Your Banner Text -->
                    <!-- <div class="absolute inset-0 flex items-center px-6 py-5 text-white z-10">
                        <div class="flex-1">
                            <span class="text-[11px] font-semibold uppercase bg-amber-400 text-gray-900 px-2 py-0.5 rounded">
                            Popular Product
                            </span>
                            <h3 class="mt-2 text-lg font-bold">Polaroid Now Instant i-Type</h3>
                            <p class="mt-3 text-sm">From <span class="text-yellow-300 font-semibold">$90.99/-</span></p>
                        </div>
                    </div> -->
                </div>
            </section>

            {{-- ================= HERO + TOP NAV BAR AREA ================= --}}
            <!-- <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                {{-- LEFT: MAIN HERO SLIDER STYLE --}}
                <div class="lg:col-span-9 bg-white rounded-lg shadow-sm overflow-hidden flex flex-col md:flex-row" data-aos="fade-right">
                    <div class="w-full md:w-2/3 p-6 flex flex-col justify-center">
                        <p class="inline-flex items-center text-xs font-semibold uppercase tracking-wide bg-amber-500 text-white px-3 py-1 rounded-full mb-4">
                            Weekend Discounts
                        </p>

                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">
                            The New Branded<br>
                            <span class="text-gray-800">Home Wireless Speaker</span>
                        </h1>

                        <p class="mt-3 text-sm text-gray-600">
                            Experience premium sound quality with modern, minimalist design — perfect for your living room, office, or studio.
                        </p>

                        <p class="mt-4 text-sm text-gray-800">
                            From <span class="text-red-500 text-xl font-bold">$29.99/-</span>
                        </p>

                        <div class="mt-5">
                            <a href="{{ $heroProduct ? route('shop.show', $heroProduct->slug) : route('shop.index') }}"
                               class="inline-flex items-center px-5 py-2.5 bg-sky-700 hover:bg-sky-800 text-sm font-semibold text-white rounded shadow-sm">
                                SHOP NOW
                            </a>
                        </div>
                    </div>

                    <div class="w-full md:w-1/3 bg-gray-100 flex items-center justify-center" data-aos="fade-left">
                        @php
                            $image = $heroProduct?->images->first();
                        @endphp
                        @if($image)
                            <img src="{{ asset('storage/'.$image->path) }}"
                                 alt="{{ $heroProduct->name }}"
                                 class="w-full h-full object-cover">
                        @else
                            {{-- placeholder hero image --}}
                            <img src="{{ asset('images/demo/hero-speaker.jpg') }}"
                                 alt="Wireless speaker"
                                 class="w-full h-full object-cover">
                        @endif
                    </div>
                </div>

                {{-- RIGHT: VERTICAL QUICK ACTION ICONS (FAKE WIDGET LIKE DEMO) --}}
                <div class="lg:col-span-3 flex lg:flex-col gap-3 justify-end" data-aos="fade-up">
                    <div class="flex lg:flex-col gap-3">
                        @foreach (['🏠','🧩','❤','⬆'] as $emoji)
                            <button class="flex items-center justify-center w-10 h-10 bg-white shadow rounded-full text-gray-700 hover:bg-gray-100 text-lg">
                                {{ $emoji }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </section> -->


          

            

            <!-- {{-- ================= HORIZONTAL OFFER STRIP ================= --}}
            <section class="bg-indigo-700 text-[11px] text-white rounded-lg shadow-sm flex flex-wrap items-center justify-between px-4 py-2">
                <p>Mega offers now on Amazon Fresh | Up to 40% off</p>
                <p>FREE delivery over ₹499. Fulfilled by Amazon.</p>
                <p>Flat $10 instant cashback on wallet &amp; UPI transactions</p>
            </section> -->

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


            {{-- ================= CATEGORY STRIP ================= --}}
            <!-- <section class="bg-white rounded-lg shadow-sm p-4">
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4 text-xs">
                    @foreach($topCategories->take(8) as $category)
                        <a href="{{ route('shop.index',['category'=>$category->slug]) }}"
                           class="flex flex-col items-center md:items-start border border-gray-100 rounded-lg px-3 py-3 hover:border-indigo-500 transition">
                            <div class="h-10 w-10 rounded-full bg-gray-50 flex items-center justify-center mb-2">
                                <span class="text-[11px] font-semibold text-indigo-600">
                                    {{ strtoupper(substr($category->name,0,2)) }}
                                </span>
                            </div>
                            <p class="font-semibold text-gray-900">{{ $category->name }}</p>
                            <p class="text-gray-500 text-[11px]">{{ $category->products_count }} Items</p>
                        </a>
                    @endforeach
                </div>
            </section> -->

            {{-- ================= TWO-ROW CATEGORY SLIDER ================= --}}
{{-- ================= CATEGORY SLIDER (2 ROWS) ================= --}}


<!-- <section class="category-slider-section max-w-7xl mx-auto my-8" data-aos="fade-up">
    <div class="relative border border-gray-200  overflow-hidden bg-white">

        <div class="swiper categorySwiper">
            <div class="swiper-wrapper ">

                {{-- Chunk the categories in pairs (2 per slide) --}}
                @foreach($topCategories->chunk(2) as $pair)
                    <div class="swiper-slide twocategory-slide h-full">
                        <div class="flex flex-col  category-slide">

                            @foreach($pair as $category)
                                <a href="{{ route('shop.index',['category'=>$category->slug]) }}"
                                   class="cat-card flex items-center gap-3 border border-gray-100 p-3 category-slidelink">
                                    
                                   

                                    <div class="">
                                        <p class="cat-title font-semibold text-gray-900">{{ $category->name }}</p>
                                        <p class="cat-items">{{ $category->products_count }} Items</p>
                                    </div>
                                    <div class="cat-img-wrapper bg-white p-1 transition-all duration-300">

                                        <img class="cat-img transition-transform duration-300"
                                            style="height:60px; width:60px;"
                                            src="{{ $category->image ? asset('storage/'.$category->image) : 'https://via.placeholder.com/50' }}"
                                            alt="{{ $category->name }}">

                                    </div>
                                </a>
                            @endforeach

                        </div>
                    </div>
                @endforeach

            </div>

            <div class="swiper-button-prev cat-prev"></div>
            <div class="swiper-button-next cat-next"></div>

        </div>
    </div>
</section> -->





            {{-- ================= DEALS / NEW / FEATURED ROW ================= --}}
            <section class="grid grid-cols-1 lg:grid-cols-3  gap-6">
                {{-- LEFT BIG FEATURE CARD (DEAL OF THE DAY) --}}
                <!-- <div class="lg:col-span-1 bg-white  flex flex-col" data-aos="fade-right">
                    <h2 class="text-sm font-semibold text-gray-900 mb-2">Deals of the Day</h2>
                    @php $highlight = $dealsOfDay->first(); @endphp
                    @if($highlight)
                        <div class="border-2 border-red-400  overflow-hidden flex-1 flex flex-col">
                            <div class="h-44 bg-gray-100 flex items-center justify-center overflow-hidden">
                                @php $image = $highlight->images->first(); @endphp
                                @if($image)
                                    <img src="{{ asset('storage/'.$image->path) }}" alt="{{ $highlight->name }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-gray-400 text-xs">No image</span>
                                @endif
                            </div>
                            <div class="p-3 text-xs flex-1 flex flex-col">
                                <p class="text-[11px] text-gray-500 mb-1">{{ optional($highlight->category)->name }}</p>
                                <h3 class="font-semibold text-gray-900 mb-1 line-clamp-2">{{ $highlight->name }}</h3>
                                <ul class="list-disc list-inside text-[11px] text-gray-600 space-y-0.5">
                                    <li>Portable computing for work and play.</li>
                                    <li>High resolution display for immersive visuals.</li>
                                    <li>Long-lasting battery life for on-the-go use.</li>
                                </ul>
                                <p class="mt-2 font-bold text-red-500">₹{{ $highlight->discount_price ?? $highlight->price }}</p>
                            </div>
                        </div>
                    @else
                        <p class="text-xs text-gray-500">No deals available.</p>
                    @endif
                </div> -->

                {{-- RIGHT: ROW OF PRODUCTS WITH TABS TITLES (STATIC LIKE DEMO) --}}
                <!-- <div class="lg:col-span-3 bg-white rounded-lg shadow-sm p-4" data-aos="fade-left">
                    <div class="flex items-center justify-between mb-3 text-sm">
                        <div class="flex items-center space-x-6">
                            <span class="font-semibold text-gray-900 border-b-2 border-indigo-600 pb-1">
                                Deals of the Day
                            </span>
                            <span class="text-gray-500">New Products</span>
                            <span class="text-gray-500">Featured Products</span>
                        </div>
                        <a href="{{ route('shop.index') }}" class="text-xs text-indigo-600 hover:underline">View all</a>
                    </div>

                    <div class="flex space-x-4 overflow-x-auto scrollbar-thin pb-1">
                        @forelse($dealsOfDay as $product)
                            <a href="{{ route('shop.show',$product->slug) }}"
                               class="flex-shrink-0 w-48 bg-white border border-gray-100 rounded-lg overflow-hidden hover:shadow-sm transition flex flex-col">
                                <div class="h-28 bg-gray-100 flex items-center justify-center overflow-hidden">
                                    @php $image = $product->images->first(); @endphp
                                    @if($image)
                                        <img src="{{ asset('storage/'.$image->path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-gray-400 text-xs">No image</span>
                                    @endif
                                </div>
                                <div class="p-2 text-xs flex-1 flex flex-col">
                                    <p class="text-[11px] text-gray-500 mb-1">{{ optional($product->category)->name }}</p>
                                    <p class="font-semibold text-gray-900 line-clamp-2 flex-1">{{ $product->name }}</p>
                                    <p class="mt-1 font-bold text-indigo-600">₹{{ $product->discount_price ?? $product->price }}</p>
                                </div>
                            </a>
                        @empty
                            <p class="text-xs text-gray-500">No products in deals list.</p>
                        @endforelse
                    </div>
                </div> -->

                {{-- RIGHT: PRODUCT SLIDER WITH 2–ROW PAIRS --}}
                <div class="lg:col-span-3 bg-gray-50  " data-aos="fade-left">

                    {{-- Tabs --}}
                    <!-- <div class="flex items-center justify-between mb-3 text-sm">
                        <div class="flex items-center space-x-6">
                            <span class="font-semibold text-gray-900 border-b-2 border-indigo-600 pb-1">
                                Deals of the Day
                            </span>
                            <span class="text-gray-500">New Products</span>
                            <span class="text-gray-500">Featured Products</span>
                        </div>
                        <a href="{{ route('shop.index') }}" class="text-xs text-indigo-600 hover:underline">View all</a>
                    </div> -->

                    {{-- === SWIPER WRAPPER === --}}


                    @if($featuredProducts->isNotEmpty())
            <section style="background: white;">
                <!-- <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">Featured products</h2>
                </div> -->
                <div class="flex items-center justify-between mb-3 text-sm">
                        <div class="flex items-center space-x-6">
                            <span class="font-semibold text-gray-900   pb-1" style="font-size:22px;">
                                Best offer Products
                            </span>
                           
                        </div>
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
                                        $fullPath = $img 
                                            ? 'http://localhost/speedly/multi-vendor-ecommerce/public/storage/' . $img->path 
                                            : null;
                                    @endphp

                                    @if ($img)
                                        <img src="{{ asset('storage/uploads/products/2/image5.png')}}" 
                                            class="w-full h-full object-contain"
                                            alt="{{ $product->name }}" >
                                    @else
                                        <span class="text-gray-400 text-xs">No Image</span>
                                    @endif
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
                            <div class="mt-3 flex items-center justify-between">
                                
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

                <section>
                    <div class="flex items-center justify-between mb-3 mt-3 text-sm">
                        <div class="flex items-center space-x-6">
                            <span class="font-semibold text-gray-900   pb-1" style="font-size:22px;">
                                Best offer Products
                            </span>
                           
                        </div>
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
                                        $fullPath = $img 
                                            ? 'http://localhost/speedly/multi-vendor-ecommerce/storage/' . $img->path 
                                            : null;
                                    @endphp

                                    @if ($img)
                                        <img src="{{ asset('storage/uploads/products/2/image4.png')}}" 
                                            class="w-full h-full object-contain"
                                            alt="{{ $product->name }}" >
                                    @else
                                        <span class="text-gray-400 text-xs">No Image</span>
                                    @endif
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
                            <div class="mt-3 flex items-center justify-between">
                                
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




                    <!-- <div class="relative">

                        <div class="swiper dealsSwiper">
                            <div class="swiper-wrapper pb-12">

                                {{-- Chunk products into PAIRS (2 per column) --}}
                            
                                @foreach($dealsOfDay->chunk(2) as $pair)
                                    <div class="swiper-slide deals-swiperslide">
                                        <div class="grid grid-rows-2 deals-slide">
                                            @foreach($pair as $product)

                                                <div class="eg-card group relative">

                                                    {{-- CARD BOX --}}
                                                    <div class="eg-box border border-gray-200 bg-white overflow-hidden">

                                                        {{-- IMAGE --}}
                                                        <a href="{{ route('shop.show',$product->slug) }}" class="block h-40 overflow-hidden">
                                                            @php $image = $product->images->first(); @endphp

                                                            @if($image)
                                                                <img src="http://localhost/speedly_wind/multi-vendor-ecommerce/public/storage/uploads/categories/3/image1.avif"
                                                                    class="eg-img  object-cover" />
                                                            @else
                                                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                                    No image
                                                                </div>
                                                            @endif
                                                        </a>

                                                        {{-- CONTENT --}}
                                                        <div class="p-3 text-xs bg-white">
                                                            <div class="text-[11px] text-gray-500">
                                                                {{ optional($product->category)->name }}
                                                            </div>

                                                            <a href="{{ route('shop.show',$product->slug) }}"
                                                            class="font-semibold text-gray-900 line-clamp-2 mt-1 block">
                                                                {{ $product->name }}
                                                            </a>

                                                            <div class="font-bold text-indigo-600 mt-2">
                                                                ₹{{ $product->discount_price ?? $product->price }}
                                                            </div>
                                                        </div>

                                                    </div>

                                                    {{-- CTA OUTSIDE CARD (Does NOT push anything) --}}
                                                    <div class=" eg-cta bg-white border-l border-r border-b border-gray-200 pb-1" >
                                                        <button class="eg-cta-button">
                                                            Add to Cart
                                                        </button>
                                                    </div>

                                                </div>

                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                            {{-- Navigation --}}
                            <div class="swiper-button-prev deals-prev"></div>
                            <div class="swiper-button-next deals-next"></div>
                        </div>
                    </div> -->

                </div>


                
            </section>

            {{-- ================= BANNER + CATEGORY & PRODUCTS ================= --}}
            <section >
                <div class="flex items-center justify-between mb-3 text-sm">
                        <div class="flex items-center space-x-6">
                            <span class="font-semibold text-gray-900   pb-1" style="font-size:22px;">
                                Best offer Products
                            </span>
                           
                        </div>
                        <a href="{{ route('shop.index') }}" class="text-xs text-indigo-600 hover:underline">View all</a>
                    </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                {{-- TWO WIDE TOP BANNERS (LIKE SURFACE KEYBOARD / SPEAKER) --}}
                <!-- <div class="lg:col-span-4 grid grid-cols-1 md:grid-cols-2 gap-4" >

                   <div class="banner relative overflow-hidden " data-aos="fade-right">
                      
                        <img src="https://wordpress.templatetrip.com/WCM003_egudgets/wp-content/uploads/2023/08/banner-04.jpg"
                            class="w-full h-full object-cover banner-img" />

                        
                        <div class="absolute inset-0 flex items-center px-6 py-5 text-white z-10">
                            <div class="flex-1">
                                <span class="text-[11px] font-semibold uppercase bg-amber-400 text-gray-900 px-2 py-0.5 rounded">
                                    Popular Product
                                </span>
                                <h3 class="mt-2 text-lg font-bold">Microsoft Surface Wireless Keyboard</h3>
                                <p class="mt-2 text-xs">From <span class="text-yellow-300 font-semibold">$37.85/-</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="banner relative overflow-hidden " data-aos="fade-left">
                      
                        <img src="https://wordpress.templatetrip.com/WCM003_egudgets/wp-content/uploads/2023/08/banner-05.jpg"
                            class="w-full h-full object-cover banner-img" />

                     
                        <div class="absolute inset-0 flex items-center px-6 py-5 text-white z-10">
                            <div class="flex-1">
                                <span class="text-[11px] font-semibold uppercase bg-amber-400 text-gray-900 px-2 py-0.5 rounded">
                                    Popular Product
                                </span>
                                <h3 class="mt-2 text-lg font-bold">Bang &amp; Olufsen Beoplay A1 Speaker</h3>
                                <p class="mt-2 text-xs">From <span class="text-emerald-300 font-semibold">$10.99/-</span></p>
                            </div>
                        </div>
                    </div>
                       
                </div> -->

                {{-- BELOW: CATEGORIES SIDEBAR + ROW OF PRODUCTS --}}
                
                <div class="lg:col-span-4 grid grid-cols-1 lg:grid-cols-4  mt-2" data-aos="fade-left">
                    {{-- LEFT SIDEBAR CATEGORIES --}}
                    <aside class="lg:col-span-1 bg-white  shadow-sm  text-xs h-fit-content">
                        <!-- <h2 class="text-lg font-semibold text-gray-900 mb-3">Shop By <br> Categories</h2>
                        <hr>
                        <ul class="space-y-1">
                            @foreach ($categories->take(5) as $category)
                                <li>
                                    <a href="{{ route('shop.index',['category'=>$category->slug]) }}"
                                       class="flex items-center justify-between px-2 py-1 rounded hover:bg-gray-50">
                                        <span class="flex items-center space-x-2">
                                            <span class="inline-flex h-6 w-6 rounded-full bg-indigo-50 text-[10px] items-center justify-center text-indigo-600 font-semibold">
                                                {{ strtoupper(substr($category->name, 0, 2)) }}
                                            </span>
                                            <span class="text-gray-700">{{ $category->name }}</span>
                                        </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{ route('shop.index') }}" >
                        <button class="mt-3 inline-flex items-center text-indigo-600 text-[11px] hover:underline">
                            <strong>
                            + All Category
                            </strong>
                        </button>
                        </a> -->

                        

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
                        <!-- <div class="flex items-center justify-between banner">
                            <a href="#" class="banner-image ">
								<img decoding="async" src="https://wordpress.templatetrip.com/WCM003_egudgets/wp-content/uploads/2024/08/category-slider-banner-02-1.jpg" title="category-slider-banner-02" alt="category-slider-banner-02" loading="lazy">
                            </a>
                            <span class="text-sm font-semibold text-gray-900">Popular Product</span>
                            class="text-xs text-indigo-600 hover:underline">View all
                        </div> -->
                        <!-- ------------------------------------------- -->

                        {{-- === SWIPER WRAPPER === --}}
                            <!-- <div class="relative">

                                <div class="swiper dealsSwiper">
                                    <div class="swiper-wrapper pb-12">
                                    
                                        @foreach($featuredProducts as $product)
                                            <div class="swiper-slide deals-swiperslide">
                                                <div class="grid grid-rows-2 deals-slide">
                                                

                                                        <div class="eg-card group relative deals-slide">

                                                            {{-- CARD BOX --}}
                                                            <div class="eg-box border border-gray-200 bg-white overflow-hidden">

                                                                {{-- IMAGE --}}
                                                                <a href="{{ route('shop.show',$product->slug) }}" class="block h-40 overflow-hidden">
                                                                    @php $image = $product->images->first(); @endphp

                                                                    @if($image)
                                                                        <img src="http://localhost/speedly_wind/multi-vendor-ecommerce/public/storage/uploads/categories/3/image1.avif"
                                                                            class="eg-img  object-cover" />
                                                                    @else
                                                                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                                            No image
                                                                        </div>
                                                                    @endif
                                                                </a>

                                                                {{-- CONTENT --}}
                                                                <div class="p-3 text-xs bg-white">
                                                                    <div class="text-[11px] text-gray-500">
                                                                        {{ optional($product->category)->name }}
                                                                    </div>

                                                                    <a href="{{ route('shop.show',$product->slug) }}"
                                                                    class="font-semibold text-gray-900 line-clamp-2 mt-1 block">
                                                                        {{ $product->name }}
                                                                    </a>

                                                                    <div class="font-bold text-indigo-600 mt-2">
                                                                        ₹{{ $product->discount_price ?? $product->price }}
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            {{-- CTA OUTSIDE CARD (Does NOT push anything) --}}
                                                            <div class=" eg-cta bg-white border-l border-r border-b border-gray-200 pb-1" >
                                                                <button class="eg-cta-button">
                                                                    Add to Cart
                                                                </button>
                                                            </div>

                                                        </div>

                                            
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>

                                    {{-- Navigation --}}
                                    <div class="swiper-button-prev deals-prev"></div>
                                    <div class="swiper-button-next deals-next"></div>
                                </div>
                            </div> -->


                             <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($featuredProducts->take(4) as $product)
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
                                        $fullPath = $img 
                                            ? 'http://localhost/speedly/multi-vendor-ecommerce/storage/' . $img->path 
                                            : null;
                                    @endphp

                                    @if ($img)
                                        <img src="{{ asset('storage/uploads/products/2/image7.png')}}" 
                                            class="w-full h-full object-contain"
                                            alt="{{ $product->name }}" >
                                    @else
                                        <span class="text-gray-400 text-xs">No Image</span>
                                    @endif
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
                            <div class="mt-3 flex items-center justify-between">
                                
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




                        <!-- ----------------------------------------------------- -->
                        <!-- <div class="flex space-x-4 overflow-x-auto scrollbar-thin pb-1">
                            @forelse($featuredProducts as $product)
                                <a href="{{ route('shop.show',$product->slug) }}"
                                   class="flex-shrink-0 w-44 bg-white border border-gray-100 rounded-lg overflow-hidden hover:shadow-sm transition flex flex-col">
                                    <div class="h-28 bg-gray-100 flex items-center justify-center overflow-hidden">
                                        @php $image = $product->images->first(); @endphp
                                        @if($image)
                                            <img src="{{ asset('storage/'.$image->path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-gray-400 text-xs">No image</span>
                                        @endif
                                    </div>
                                    <div class="p-2 text-xs flex-1 flex flex-col">
                                        <p class="text-[11px] text-gray-500 mb-1">{{ optional($product->category)->name }}</p>
                                        <p class="font-semibold text-gray-900 line-clamp-2 flex-1">{{ $product->name }}</p>
                                        <p class="mt-1 font-bold text-indigo-600">₹{{ $product->discount_price ?? $product->price }}</p>
                                    </div>
                                </a>
                            @empty
                                <p class="text-xs text-gray-500">No products yet.</p>
                            @endforelse
                        </div> -->
                    </div>
                </div>
                </div>
            </section>

            {{-- ================= BEST SELLER ================= --}}


            <section class="bg-white  shadow-sm p-4">
            <div class="container mx-auto">

                <!-- SECTION HEADING -->
                  <div class="flex items-center justify-between mb-3 text-sm">
                        <div class="flex items-center space-x-6">
                            <span class="font-semibold text-gray-900   pb-1" style="font-size:22px;">
                                Best Sellers
                            </span>
                           
                        </div>
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

 <script>
    window.wishlistToggleUrl = "{{ route('wishlist.toggle', ':id') }}";
    window.CartToggleUrl = "{{ route('account.cart.toggle', ':id') }}";
</script>

</x-layouts.site>
