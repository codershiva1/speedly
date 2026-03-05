<x-layouts.site :title="__('Shop')">
    <!-- <div class="bg-gradient-to-r from-indigo-600 via-indigo-500 to-sky-500 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex flex-col md:flex-row items-center gap-8">
            ...
        </div>
    </div> -->

    <div class="mx-auto sm:px-6 lg:px-8 py-8">

        @if($featuredProducts->isNotEmpty())

        <!-- ===== LEFT RIGHT WRAPPER START ===== -->
<<<<<<< HEAD
        <div class="flex flex-row items-start mb-10" style="padding-left:5px; padding-right:5px; gap:5px;">
            <!-- LEFT SIDE : FILTER BY CATEGORY -->
            <div class="w-24 sm:w-28 md:w-1/4 bg-white py-4 px-2 md:py-6 md:px-4 rounded-xl border border-gray-200
            max-h-[650px] overflow-hidden">

                <h2 class="text-lg font-semibold mb-4">
                    Filter by Category
                </h2>

                <div class="flex flex-col gap-4 overflow-y-auto pr-2 custom-scroll"
                    style="height: 400px; overscroll-behavior: contain;">

                    <a href="{{ route('shop.index', array_merge(request()->except('page', 'category'), ['category' => null])) }}" class="block px-3 py-1.5 rounded-lg text-xs font-medium
                     {{ empty($filters['category']) ? 
                      'text-indigo-700 ' : 'hover:bg-gray-50 text-gray-700 border border-transparent' }}">
                        All Categories
                    </a>

                    @foreach($categories as $category)
                    <a href="{{ route('shop.index', ['category' => $category->id]) }}"
                        class="flex flex-col items-center text-center  md:text-left md:gap-3">

                        <div class="w-12 h-12 md:w-14 md:h-14 bg-gray-100 rounded-full flex items-center justify-center">
                            @if($category->image)
                            <img src="{{ asset('public/storage/' . $category->image) }}"
                                class="w-10 h-10 object-contain">
                            @endif
                        </div>

                        <span class="text-xs md:text-sm mt-1 md:mt-0">
                            {{ $category->name }}
                        </span>

                    </a>
                    @endforeach

                </div>

            </div>

            <!-- RIGHT SIDE : FEATURED PRODUCTS -->
            <div class="w-3/4">

                <section>
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900">Featured products</h2>
                    </div>
                    <form method="GET" action="{{ route('shop.index') }}">
                        <select name="sort" onchange="this.form.submit()" class="border border-gray-300 rounded-lg px-2 mb-3 bg-white text-xs text-gray-700 cursor-pointer">
                            <option value="">Sort By</option>
                            <option value="price_low_high" {{ request('sort') == 'price_low_high' ? 'selected' : '' }}> Price: Low to High </option>
                            <option value="price_high_low" {{ request('sort') == 'price_high_low' ? 'selected' : '' }}> Price: High to Low </option>
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}> Latest </option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}> Oldest </option>
                        </select>
                        {{-- KEEP OTHER FILTERS --}}
                        @foreach(request()->except('page', 'sort') as $name => $value)
                        <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                        @endforeach
                    </form>

                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-5 gap-3 md:gap-5">
                        @foreach ($featuredProducts->take(6) as $product)
                        <div class="relative bg-white rounded-2xl border border-gray-200 p-3 flex flex-col">
                            {{-- WISHLIST ICON (TOP RIGHT) --}} @auth
                            <button class="absolute top-2 right-2 z-10 w-8 h-8 flex items-center justify-center rounded-full bg-white shadow-md wishlist-btn hover:scale-105 transition"
                                data-product-id="{{ $product->id }}" aria-label="Add to wishlist"> <i class="fa fa-heart {{ auth()->user()->wishlist->contains('product_id', $product->id) ? 
                                'text-red-500' : 'text-gray-400' }}">
                                </i>
                            </button>
                            @else
                            <a href="{{ route('login') }}" class="absolute top-2 right-2 z-10 w-8 h-8 flex items-center justify-center rounded-full bg-white shadow-md">
                                <i class="fa fa-heart text-gray-400"></i>
                            </a>
                            @endauth

                            {{-- IMAGE SECTION --}}
                            <a href="{{ route('shop.show', $product->slug) }}" class="block">
                                <div class="relative rounded-2xl flex items-center justify-center">
                                    @php $img = $product->images->first(); @endphp
                                    <img src="{{ $img ? asset('public/storage/' . $img->path) : asset('public/storage/uploads/products/1/image3.png') }}"
                                        class="h-32 object-contain" alt="{{ $product->name }}">
                                </div>
                            </a>

                            {{-- PRODUCT TITLE & SIZE --}}

                            <!-- <span class="w-fit inline-flex items-center gap-1 bg-orange-50 text-yellow-900 text-xs font-semibold px-2.5 py-0.5 rounded-full mt-3">
                    <svg class="w-3.5 h-3.5 text-yellow-700" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-12.75a.75.75 0 00-1.5 0v4.19l-2.2 2.2a.75.75 0 101.06 1.06l2.39-2.39V5.25z" clip-rule="evenodd" />
                    </svg> 8 MINS </span> -->
                            <div class="mt-2 flex-1">
                                <p class="text-sm font-semibold text-gray-900 leading-tight line-clamp-1">
                                    {{ $product->name }}
                                </p>
                                @if($product->size) <p class="text-sm text-gray-500 mt-1">
                                    {{ $product->size }}
                                </p>
                                @endif
                            </div>

                            {{-- PRICE & ADD BUTTON --}}
                            <div class="mt-3 flex items-center justify-between gap-1">
                                {{-- PRICE (discount below actual) --}}
                                <div class="flex flex-col leading-tight overflow-hidden">
                                    {{-- Price --}}
                                    <span class="text-[10px] font-bold text-gray-900 truncate"> ₹{{ $product->price }} </span>
                                    {{-- Discount Price under it --}}
                                    @if ($product->discount_price)
                                    <span class="line-through text-xs text-gray-400">
                                        ₹{{ $product->discount_price }} </span>
                                    @endif
                                </div>
                                {{-- ADD BUTTON --}}
                                @auth
                                <button class="cart-btn shrink-0 px-2 py-1 border border-green-600 rounded-md text-[10px] font-semibold {{ $product->cartItem ? 'bg-green-100 text-green-600' : 'text-green-600 hover:bg-green-50' }}" data-product-id="{{ $product->id }}">
                                    {{ $product->cartItem ? 'ADDED' : 'ADD' }}
                                </button>
                                @else
                                <a href="{{ route('login') }}" class="cart-btn px-2 py-1.5 border border-green-600 rounded-lg text-sm font-semibold"> ADD </a>
                                @endauth
                            </div>

                        </div>
                        @endforeach
                    </div>



                </section>

            </div>

        </div>
        <!-- ===== LEFT RIGHT WRAPPER END ===== -->

        @endif


        <!-- Products grid -->
        <div class="col-span-5" style="padding-left: 5px;">

            <div class="flex items-center justify-between mb-4 text-xs text-gray-600">
                <p>{{ $products->total() }} products found</p>
            </div>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-7 gap-3 md:gap-4" style="padding-left:5px; padding-right:5px;">
            @foreach ($products as $product)
            <div class="relative bg-white rounded-xl border border-gray-200 hover:shadow-md transition-all p-2 flex flex-col">
                {{-- WISHLIST ICON (TOP RIGHT) --}}
                @auth
                <button class="absolute top-2 right-2 z-10 w-8 h-8 flex items-center justify-center rounded-full bg-white shadow-md wishlist-btn hover:scale-105 transition" data-product-id="{{ $product->id }}" aria-label="Add to wishlist">
                    <i class="fa fa-heart {{ auth()->user()->wishlist->contains('product_id', $product->id) ? 'text-red-500' : 'text-gray-400' }}"> </i>
                </button>
                @else
                <a href="{{ route('login') }}" class="absolute top-2 right-2 z-10 w-8 h-8 flex items-center justify-center rounded-full bg-white shadow-md">
                    <i class="fa fa-heart text-gray-400"></i> </a>
                @endauth
                {{-- IMAGE --}}

                <a href="{{ route('shop.show', $product->slug) }}" class="block">
                    <div class="w-full h-36  rounded-lg overflow-hidden flex items-center justify-center">
                        @php
                        $img = $product->images->first();
                        @endphp
                        <img src="{{ $img ? asset('public/storage/' . $img->path) : asset('public/storage/uploads/products/1/image3.png') }}" class="w-full h-full object-contain" alt="{{ $product->name }}">
                    </div>
                </a>
                {{-- PRODUCT TITLE & SIZE --}}

                <span class="w-fit inline-flex items-center gap-1 bg-orange-50 text-yellow-900 text-xs font-semibold px-2.5 py-0.5 rounded-full mt-3">
                    <svg class="w-3.5 h-3.5 text-yellow-700" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-12.75a.75.75 0 00-1.5 0v4.19l-2.2 2.2a.75.75 0 101.06 1.06l2.39-2.39V5.25z" clip-rule="evenodd" />
                    </svg> 8 MINS </span>
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
                {{-- PRICE & ADD BUTTON --}}

                <div class="mt-3 flex items-center justify-between">
                    {{-- PRICE (discount below actual) --}}
                    <div class="flex flex-col leading-tight">
                        {{-- Price --}} <span class="text-base font-bold text-gray-900">
                            ₹{{ $product->price }} </span>
                        {{-- Discount Price under it --}}
                        @if ($product->discount_price) <span class="line-through text-xs text-gray-400">
                            ₹{{ $product->discount_price }} </span> @endif
                    </div> {{-- ADD BUTTON --}}
                    @auth
                    <button class="cart-btn px-2 py-1.5 border border-green-600 rounded-lg text-sm font-semibold {{ $product->cartItem ? 'bg-green-100 text-green-600' : 'text-green-600 hover:bg-green-50' }}" data-product-id="{{ $product->id }}">
                        {{ $product->cartItem ? 'ADDED' : 'ADD' }}
                    </button>
                    @else
                    <a href="{{ route('login') }}" class="cart-btn px-2 py-1.5 border border-green-600 rounded-lg text-sm font-semibold"> ADD </a>
                    @endauth
                </div>
            </div> @endforeach
        </div>
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </div>



    <!-- ================= FILTER + PRODUCT GRID BELOW SAME ================= -->

    <section class=" grid-cols-6 gap-6">

        <!-- Filters -->
        <!-- <aside class="md:col-span-1 bg-white rounded-xl border border-gray-200 p-4 text-sm space-y-6 sticky top-8 bottom-8 h-fit overflow-y-auto"> -->

        <!-- <aside class="col-span-1 bg-white rounded-xl border border-gray-200 p-4 text-sm space-y-6 h-fit sticky top-6">

            <!-- CATEGORY FILTER -->
        <!-- commented code same as before -->

        <!-- PRICE RANGE FILTER -->
        <!-- <div class="border-t border-gray-100 pt-4"> -->
        <!-- <div>
                <h3 class="font-semibold text-gray-900 mb-3 text-sm">
                    Price Range
                </h3>
                <form method="GET" action="{{ route('shop.index') }}" class="space-y-3">

                    <div class="flex items-center gap-1 w-full">

                        <input type="number"
                            name="min_price"
                            value="{{ $filters['min_price'] ?? '' }}"
                            placeholder="Min"
                            class="flex-1 px-3 py-1.5 border border-gray-200 rounded-lg text-xs w-full" />

                        <span class="text-gray-400 text-sm">—</span>

                        <input type="number"
                            name="max_price"
                            value="{{ $filters['max_price'] ?? '' }}"
                            placeholder="Max"
                            class="flex-1 px-3 py-1.5 border border-gray-200 rounded-lg text-xs w-full" />
                    </div>

                    @foreach (request()->except('page', 'min_price', 'max_price') as $name => $value)
                    <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                    @endforeach

=======
        <div class="flex gap-[10px] px-[5px] h-[calc(100vh-120px)]">
            <!-- LEFT SIDE : FILTER BY CATEGORY -->
            <div class="w-24 sm:w-28 md:w-1/4 
            bg-white rounded-xl border border-gray-200
            flex flex-col
            overflow-hidden">
                <h2 class="text-lg font-semibold mb-4 sticky top-0 bg-white z-10 px-2">
                    Filter by Category
                </h2>

                <div class="flex flex-col gap-4 overflow-y-auto pr-2 custom-scroll"
                    style="height: 800px; overscroll-behavior: contain;">

                    <a href="{{ route('shop.index', array_merge(request()->except('page', 'category'), ['category' => null])) }}" class="block px-3 py-1.5 rounded-lg text-xs font-medium
                     {{ empty($filters['category']) ? 
                      'text-indigo-700 ' : 'hover:bg-gray-50 text-gray-700 border border-transparent' }}">
                        All Categories
                    </a>

                    @foreach($categories as $category)
                    <a href="{{ route('shop.index', array_merge(request()->except('page', 'category'), ['category' => null])) }}"
                        class="flex flex-col items-center text-center  md:text-left md:gap-3">

                        <div class="w-12 h-12 md:w-14 md:h-14 bg-gray-100 rounded-full flex items-center justify-center">
                            @if($category->image)
                            <img src="{{ asset('public/storage/' . $category->image) }}"
                                class="w-10 h-10 object-contain">
                            @endif
                        </div>

                        <span class="text-xs md:text-sm mt-1 md:mt-0">
                            {{ $category->name }}
                        </span>

                    </a>
                    @endforeach

                </div>

            </div>

            <!-- RIGHT SIDE : FEATURED PRODUCTS -->
            <div class="flex-1 overflow-y-auto">

                <section>
                    <div class="flex items-center justify-between sticky top-0 z-10">
                        <h2 class="text-lg font-semibold text-gray-900">Featured productsdd</h2>
                    </div>
                    <form method="GET" action="{{ route('shop.index') }}">
                        <select name="sort" onchange="this.form.submit()" class="border border-gray-300 rounded-lg px-2 mb-3 bg-white text-xs text-gray-700 cursor-pointer">
                            <option value="">Sort By</option>
                            <option value="price_low_high" {{ request('sort') == 'price_low_high' ? 'selected' : '' }}> Price: Low to High </option>
                            <option value="price_high_low" {{ request('sort') == 'price_high_low' ? 'selected' : '' }}> Price: High to Low </option>
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}> Latest </option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}> Oldest </option>
                        </select>
                        {{-- KEEP OTHER FILTERS --}}
                        @foreach(request()->except('page', 'sort') as $name => $value)
                        <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                        @endforeach
                    </form>

                    <!-- <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-5 gap-3 md:gap-5">
                        @foreach ($featuredProducts->take(6) as $product)
                        <div class="relative bg-white rounded-2xl border border-gray-200 p-3 flex flex-col">
                            {{-- WISHLIST ICON (TOP RIGHT) --}} @auth
                            <button class="absolute top-2 right-2 z-10 w-8 h-8 flex items-center justify-center rounded-full bg-white shadow-md wishlist-btn hover:scale-105 transition"
                                data-product-id="{{ $product->id }}" aria-label="Add to wishlist"> <i class="fa fa-heart {{ auth()->user()->wishlist->contains('product_id', $product->id) ? 
                                'text-red-500' : 'text-gray-400' }}">
                                </i>
                            </button>
                            @else
                            <a href="{{ route('login') }}" class="absolute top-2 right-2 z-10 w-8 h-8 flex items-center justify-center rounded-full bg-white shadow-md">
                                <i class="fa fa-heart text-gray-400"></i>
                            </a>
                            @endauth

                            {{-- IMAGE SECTION --}}
                            <a href="{{ route('shop.show', $product->slug) }}" class="block">
                                <div class="relative rounded-2xl flex items-center justify-center">
                                    @php $img = $product->images->first(); @endphp
                                    <img src="{{ $img ? asset('public/storage/' . $img->path) : asset('public/storage/uploads/products/1/image3.png') }}"
                                        class="h-32 object-contain" alt="{{ $product->name }}">
                                </div>
                            </a>

                            {{-- PRODUCT TITLE & SIZE --}}

                            <!-- <span class="w-fit inline-flex items-center gap-1 bg-orange-50 text-yellow-900 text-xs font-semibold px-2.5 py-0.5 rounded-full mt-3">
                         <svg class="w-3.5 h-3.5 text-yellow-700" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-12.75a.75.75 0 00-1.5 0v4.19l-2.2 2.2a.75.75 0 101.06 1.06l2.39-2.39V5.25z" clip-rule="evenodd" />
                         </svg> 8 MINS </span> -->
                    <!-- <div class="mt-2 flex-1">
                                <p class="text-sm font-semibold text-gray-900 leading-tight line-clamp-1">
                                    {{ $product->name }}
                                </p>
                                @if($product->size) <p class="text-sm text-gray-500 mt-1">
                                    {{ $product->size }}
                                </p>
                                @endif
                            </div>

                            {{-- PRICE & ADD BUTTON --}}
                            <div class="mt-3 flex items-center justify-between gap-1">
                                {{-- PRICE (discount below actual) --}}
                                <div class="flex flex-col leading-tight overflow-hidden">
                                    {{-- Price --}}
                                    <span class="text-[10px] font-bold text-gray-900 truncate"> ₹{{ $product->price }} </span>
                                    {{-- Discount Price under it --}}
                                    @if ($product->discount_price)
                                    <span class="line-through text-xs text-gray-400">
                                        ₹{{ $product->discount_price }} </span>
                                    @endif
                                </div>
                                {{-- ADD BUTTON --}}
                                @auth
                                <button class="cart-btn shrink-0 px-2 py-1 border border-green-600 rounded-md text-[10px] font-semibold {{ $product->cartItem ? 'bg-green-100 text-green-600' : 'text-green-600 hover:bg-green-50' }}" data-product-id="{{ $product->id }}">
                                    {{ $product->cartItem ? 'ADDED' : 'ADD' }}
                                </button>
                                @else
                                <a href="{{ route('login') }}" class="cart-btn px-2 py-1.5 border border-green-600 rounded-lg text-sm font-semibold"> ADD </a>
                                @endauth
                            </div>

                        </div>
                        @endforeach -->
                    <!-- </div> -->




                    <!-- Products grid -->
                    <div class="col-span-5" style="padding-left: 5px;">

                        <div class="flex items-center justify-between mb-4 text-xs text-gray-600">
                            <p>{{ $products->count() }} products found</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3 md:gap-4" style="padding-left:5px; padding-right:5px;">
                        @foreach ($products as $product)
                        <div class="relative bg-white rounded-xl border border-gray-200 hover:shadow-md transition-all p-2 flex flex-col">
                            {{-- WISHLIST ICON (TOP RIGHT) --}}
                            @auth
                            <button class="absolute top-2 right-2 z-10 w-8 h-8 flex items-center justify-center rounded-full bg-white shadow-md wishlist-btn hover:scale-105 transition" data-product-id="{{ $product->id }}" aria-label="Add to wishlist">
                                <i class="fa fa-heart {{ auth()->user()->wishlist->contains('product_id', $product->id) ? 'text-red-500' : 'text-gray-400' }}"> </i>
                            </button>
                            @else
                            <a href="{{ route('login') }}" class="absolute top-2 right-2 z-10 w-8 h-8 flex items-center justify-center rounded-full bg-white shadow-md">
                                <i class="fa fa-heart text-gray-400"></i> </a>
                            @endauth
                            {{-- IMAGE --}}

                            <a href="{{ route('shop.show', $product->slug) }}" class="block">
                                <div class="w-full h-36  rounded-lg overflow-hidden flex items-center justify-center">
                                    @php
                                    $img = $product->images->first();
                                    @endphp
                                    <img src="{{ $img ? asset('public/storage/' . $img->path) : asset('public/storage/uploads/products/1/image3.png') }}" class="w-full h-full object-contain" alt="{{ $product->name }}">
                                </div>
                            </a>
                            {{-- PRODUCT TITLE & SIZE --}}

                            <span class="w-fit inline-flex items-center gap-1 bg-orange-50 text-yellow-900 text-xs font-semibold px-2.5 py-0.5 rounded-full mt-3">
                                <svg class="w-3.5 h-3.5 text-yellow-700" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-12.75a.75.75 0 00-1.5 0v4.19l-2.2 2.2a.75.75 0 101.06 1.06l2.39-2.39V5.25z" clip-rule="evenodd" />
                                </svg> 8 MINS </span>
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
                            {{-- PRICE & ADD BUTTON --}}

                            <div class="mt-3 flex items-center justify-between">
                                {{-- PRICE (discount below actual) --}}
                                <div class="flex flex-col leading-tight">
                                    {{-- Price --}}
                                    <span class="text-[12px] font-bold text-gray-900">
                                        ₹{{ $product->price }} </span>
                                    {{-- Discount Price under it --}}
                                    @if ($product->discount_price)
                                    <span class="line-through text-xs text-gray-400">
                                        ₹{{ $product->discount_price }} </span> @endif
                                </div> {{-- ADD BUTTON --}}
                                @auth
                                <button class="cart-btn px-2 py-1.5 border border-green-600 rounded-lg text-sm font-semibold {{ $product->cartItem ? 'bg-green-100 text-green-600' : 'text-green-600 hover:bg-green-50' }}" data-product-id="{{ $product->id }}">
                                    {{ $product->cartItem ? 'ADDED' : 'ADD' }}
                                </button>
                                @else
                                <a href="{{ route('login') }}" class="cart-btn px-2 py-1.5 border border-green-600 rounded-lg text-sm font-semibold"> ADD </a>
                                @endauth
                            </div>
                        </div> @endforeach
                    </div>

            </div>



            </section>

        </div>

    </div>
    <!-- ===== LEFT RIGHT WRAPPER END ===== -->

    @endif






    <!-- ================= FILTER + PRODUCT GRID BELOW SAME ================= -->

    <section class=" grid-cols-6 gap-6">

        <!-- Filters -->
        <!-- <aside class="md:col-span-1 bg-white rounded-xl border border-gray-200 p-4 text-sm space-y-6 sticky top-8 bottom-8 h-fit overflow-y-auto"> -->

        <!-- <aside class="col-span-1 bg-white rounded-xl border border-gray-200 p-4 text-sm space-y-6 h-fit sticky top-6">

            <!-- CATEGORY FILTER -->
        <!-- commented code same as before -->

        <!-- PRICE RANGE FILTER -->
        <!-- <div class="border-t border-gray-100 pt-4"> -->
        <!-- <div>
                <h3 class="font-semibold text-gray-900 mb-3 text-sm">
                    Price Range
                </h3>
                <form method="GET" action="{{ route('shop.index') }}" class="space-y-3">

                    <div class="flex items-center gap-1 w-full">

                        <input type="number"
                            name="min_price"
                            value="{{ $filters['min_price'] ?? '' }}"
                            placeholder="Min"
                            class="flex-1 px-3 py-1.5 border border-gray-200 rounded-lg text-xs w-full" />

                        <span class="text-gray-400 text-sm">—</span>

                        <input type="number"
                            name="max_price"
                            value="{{ $filters['max_price'] ?? '' }}"
                            placeholder="Max"
                            class="flex-1 px-3 py-1.5 border border-gray-200 rounded-lg text-xs w-full" />
                    </div>

                    @foreach (request()->except('page', 'min_price', 'max_price') as $name => $value)
                    <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                    @endforeach

>>>>>>> 77c47bce9cd6b8902533b689b483523e01c4b12f
                    <button type="submit"
                        class=" px-4 py-2 bg-indigo-600 text-white rounded-lg text-xs font-semibold hover:bg-indigo-500">
                        Apply
                    </button>

                </form>
            </div> -->
        <!-- </div> -->

        <!-- </aside> -->
        <!-- </aside> -->



    </section>

    </div>

    <script>
        window.wishlistToggleUrl = "{{ route('wishlist.toggle', ':id') }}";
        window.CartToggleUrl = "{{ route('account.cart.toggle', ':id') }}";
    </script>

    <!-- <script>
document.addEventListener("DOMContentLoaded", function() {
    const scrollBox = document.querySelector(".custom-scroll");

    scrollBox.addEventListener("wheel", function(e) {
        const atTop = scrollBox.scrollTop === 0;
        const atBottom = scrollBox.scrollHeight - scrollBox.scrollTop === scrollBox.clientHeight;

        if ((atTop && e.deltaY < 0) || (atBottom && e.deltaY > 0)) {
            e.preventDefault();
        }
    }, { passive: false });
});
</script> -->

    <style>
        .custom-scroll {
            scrollbar-width: thin;
            scrollbar-color: #2563eb #e5e7eb;
        }

        /* Chrome */
        .custom-scroll::-webkit-scrollbar {
            width: 10px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background: #e5e7eb;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background-color: #2563eb;
            border-radius: 10px;
        }
    </style>
</x-layouts.site>