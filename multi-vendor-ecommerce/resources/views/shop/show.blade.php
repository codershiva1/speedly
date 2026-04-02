<x-layouts.site :title="$product->name">


@php
$productDetails = $product->product_details ?? [];
if ($product->description && !isset($productDetails['Description'])) {
    $productDetails['Description'] = $product->description;
}
@endphp
<style>
    .custom-scrollbar::-webkit-scrollbar {
        height: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #ddd;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #ccc;
    }
    #mainProductImage {
        transition: transform 0.2s ease-out;
    }
</style>

    <div class="bg-gray-50 min-h-screen ">
        <div class="max-w-7xl mx-auto px-4 sm:px-4 lg:px-4 py-1 space-y-8">

            <!-- PRODUCT TOP SECTION -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start bg-white p-2">

                <!-- LEFT COLUMN (IMAGE + DETAILS COLLAPSIBLE) -->
                <div class="space-y-6 md:pr-6 md:border-r md:border-gray-200">

                    <!-- IMAGE -->
                    <div class="relative">

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

                        <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center group/main-image cursor-zoom-in relative">
                            @php $primaryImage = $product->images->first(); @endphp
                            
                            <img id="mainProductImage" src="{{ $primaryImage ? asset('public/storage/' . $primaryImage->path) : asset('public/storage/uploads/products/1/image3.png') }}"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-cover transition-transform duration-500 origin-center"
                                onmousemove="zoomImage(event)"
                                onmouseleave="resetZoom()">
                            
                             <!-- SLIDER OVERLAYS -->
                             <div class="absolute inset-x-0 top-1/2 -translate-y-1/2 flex justify-between px-4 opacity-0 group-hover/main-image:opacity-100 transition-opacity">
                                <button onclick="prevImage()" class="w-10 h-10 rounded-full bg-white/80 hover:bg-white shadow-lg flex items-center justify-center text-gray-800 transition">
                                    <i class="fa fa-chevron-left"></i>
                                </button>
                                <button onclick="nextImage()" class="w-10 h-10 rounded-full bg-white/80 hover:bg-white shadow-lg flex items-center justify-center text-gray-800 transition">
                                    <i class="fa fa-chevron-right"></i>
                                </button>
                             </div>
                        </div>

                        @if ($product->discount_price)
                            <span class="absolute top-3 left-3 bg-green-600 text-white text-xs px-2 py-1 rounded-full">
                                SAVE ₹{{ $product->price - $product->discount_price }}
                            </span>
                        @endif

                         {{-- THUMBNAILS --}}
                
                         <div class="flex gap-3 overflow-x-auto mt-2 pb-2 custom-scrollbar">
                            @foreach ($product->images as $index => $image)
                                <img src="{{ asset('public/storage/' . $image->path) }}"
                                    class="thumbnail-img w-20 h-20 object-contain bg-gray-50 rounded-xl p-2 border cursor-pointer hover:border-green-500 transition {{ $index === 0 ? 'border-green-500 shadow-sm' : 'border-gray-100' }}"
                                    onclick="changeMainImage(this, {{ $index }})">
                            @endforeach
                        </div>

                    </div>

                    <!-- PRODUCT DETAILS (COLLAPSIBLE) -->
                    <div class="bg-white rounded-xl border mt-6">
                        <button
                            type="button"
                            onclick="toggleProductDetails()"
                            class="w-full flex justify-between items-center px-3 py-3 text-[14px] font-medium text-gray-900">
                            Product Details
                            <span id="productDetailsToggle" class="text-green-600 text-[12px] font-semibold">
                                View more
                            </span>
                        </button>

                        <div id="productDetailsContent"
                            class="hidden border-t px-3 pb-3 text-[12px] text-gray-700 space-y-3">

                            @foreach ($productDetails as $label => $value)
                                <div class="grid grid-cols-2 gap-3">
                                    <p class="text-gray-500">{{ $label }}</p>

                                    @if (is_array($value))
                                        <ul class="list-disc pl-4 space-y-1 text-gray-900">
                                            @foreach ($value as $item)
                                                <li>{{ $item }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-gray-900 leading-relaxed">
                                            {{ $value }}
                                        </p>
                                    @endif
                                </div>
                            @endforeach

                            <!-- DISCLAIMER -->
                            <p class="pt-2 text-[11px] text-gray-400 leading-relaxed">
                                Every effort is made to maintain accuracy of all information. However,
                                actual product packaging and materials may contain more and/or different information.
                            </p>
                        </div>
                    </div>

                </div>

                <!-- RIGHT COLUMN (PRODUCT INFO) - STICKY -->
                <aside class="sticky top-32 self-start space-y-4">

                    <!-- TITLE -->
                    <div>
                        <h1 class="text-xl md:text-2xl font-semibold text-gray-900">
                            {{ $product->name }}
                        </h1>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ optional($product->category)->name }}
                            @if ($product->brand) • {{ $product->brand->name }} @endif
                        </p>
                    </div>

                    <!-- DELIVERY INFO -->
                    <div class="flex items-center gap-1 space-x-2 text-sm bg-green-50 text-green-700 px-3 py-2 rounded-lg w-fit">
                        🚚 Delivery in <span class="font-semibold">8 mins</span>
                    </div>

                    <!-- PRICE & ADD TO CART -->
                    <div class="flex flex-col space-y-3">
                        <div class="flex items-center space-x-3">
                            <span class="text-2xl font-bold text-gray-900">
                                ₹{{ $product->discount_price ?? $product->price }}
                            </span>
                            @if ($product->discount_price)
                                <span class="text-sm text-gray-400 line-through">
                                    ₹{{ $product->price }}
                                </span>
                            @endif
                        </div>

                       {{-- ADD BUTTON --}}
                        @if(auth()->check() && auth()->user()->isDeliveryBoy())
                            <div class="px-2 py-3 px-6 border border-gray-200 bg-gray-50 text-gray-400 rounded-full text-xs font-semibold text-center cursor-not-allowed w-50" title="Delivery accounts cannot make purchases.">
                                NOT ALLOWED
                            </div>
                        @else
                            @auth
                                <button
                                    class="cart-btn px-2 py-3 px-6 border border-green-600 rounded-full text-sm font-semibold w-50
                                    {{ $product->cartItem ? 'bg-green-100 text-green-600' : 'text-green-600 hover:bg-green-50' }}"
                                    data-product-id="{{ $product->id }}"
                                    >
                                    {{ $product->cartItem ? 'ADDED' : 'ADD TO CART' }}
                                </button>
                            @else
                                <a href="{{ route('login') }}"
                                    class="cart-btn px-2 py-3 px-6 border border-green-600 rounded-full text-sm font-semibold text-center w-50 block">
                                    ADD TO CART
                                </a>
                            @endauth
                        @endif
                    </div>

                    <!-- RATINGS -->
                    @if ($ratingCount)
                        <div class="flex items-center text-sm text-gray-600">
                            <span class="mr-1 font-medium">{{ number_format($averageRating, 1) }}</span>
                            <span class="text-yellow-400">★★★★★</span>
                            <span class="ml-1 text-xs text-gray-500">({{ $ratingCount }})</span>
                        </div>
                    @endif

                    <!-- WHY SHOP FROM BLINKIT / SELLER INFO -->
                    <div class="border-t pt-4 space-y-3 text-xs text-gray-600">
                        <p class="font-semibold text-gray-900">Why shop from SpeedlyMart</p>
                        <div class="space-y-2">
                            <div class="flex items-start gap-2">
                                <span class="text-green-600">⚡</span>
                                <p>
                                    <span class="font-medium text-gray-900">Superfast delivery</span><br>
                                    Get your groceries delivered in minutes
                                </p>
                            </div>

                            <div class="flex items-start gap-2">
                                <span class="text-green-600">💰</span>
                                <p>
                                    <span class="font-medium text-gray-900">Best prices & offers</span><br>
                                    Great deals, discounts & savings everyday
                                </p>
                            </div>

                            <div class="flex items-start gap-2">
                                <span class="text-green-600">🛒</span>
                                <p>
                                    <span class="font-medium text-gray-900">Wide assortment</span><br>
                                    Choose from thousands of products
                                </p>
                            </div>
                        </div>

                        @if ($product->vendor && $product->vendor->vendorProfile)
                            <p class="text-gray-500 mt-2 text-xs">
                                Sold by
                                <a href="{{ route('vendors.show', $product->vendor->vendorProfile->slug) }}"
                                class="text-indigo-600 font-medium">
                                    {{ $product->vendor->vendorProfile->store_name }}
                                </a>
                            </p>
                        @endif
                    </div>

                </aside>

            </div>

            <!-- REVIEWS SECTION -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- REVIEWS LIST -->
                <section class="md:col-span-2 bg-white rounded-xl shadow-sm p-5">
                    <h2 class="font-semibold text-gray-900 mb-4">
                        Customer Reviews
                    </h2>

                    @forelse ($approvedReviews as $review)
                        <div class="border-b py-3 last:border-0">
                            <div class="flex justify-between text-xs">
                                <span class="font-semibold">{{ $review->user->name }}</span>
                                <span class="text-gray-400">{{ $review->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="text-yellow-400 text-xs mt-1">
                                {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                            </div>
                            @if ($review->comment)
                                <p class="text-sm text-gray-700 mt-1">{{ $review->comment }}</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No reviews yet.</p>
                    @endforelse
                </section>

                <!-- REVIEW FORM -->
                <section class="bg-white rounded-xl shadow-sm p-5">
                    <h2 class="font-semibold text-gray-900 mb-3">Write a Review</h2>

                    @auth
                        <form method="POST" action="{{ route('shop.reviews.store', $product) }}" class="space-y-3">
                            @csrf

                            <select name="rating" class="w-full border rounded-lg px-3 py-2 text-sm">
                                @for ($i = 5; $i >= 1; $i--)
                                    <option value="{{ $i }}">{{ $i }} Stars</option>
                                @endfor
                            </select>

                            <textarea name="comment" rows="3"
                                      class="w-full border rounded-lg px-3 py-2 text-sm"
                                      placeholder="Share your experience"></textarea>

                            <x-primary-button class="w-full">
                                Submit Review
                            </x-primary-button>
                        </form>
                    @else
                        <p class="text-sm text-gray-500">
                            Please <a href="{{ route('login') }}" class="text-indigo-600">login</a> to review.
                        </p>
                    @endauth
                </section>

            </div>

                <!-- SIMILAR PRODUCTS -->
            @if($similarProducts->isNotEmpty())
            <section class="mt-10">
                <h2 class="text-lg font-semibold mb-4">Similar Products</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    @foreach ($similarProducts as $product)
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
                                    @php $img = $product->images->first(); @endphp
                                   
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
                            <div class="mt-3 flex items-center justify-between">
                                
                                {{-- PRICE (discount below actual) --}}
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

                                {{-- ADD BUTTON --}}
                                @if(auth()->check() && auth()->user()->isDeliveryBoy())
                                    <button disabled class="px-2 py-1.5 border border-gray-200 bg-gray-50 text-gray-400 rounded-lg text-[10px] font-semibold cursor-not-allowed shrink-0" title="Delivery accounts cannot make purchases.">
                                        RESTRICTED
                                    </button>
                                @else
                                    @auth
                                        <button
                                            class="cart-btn px-2 py-1.5 border border-green-600 rounded-lg text-[11px] font-semibold shrink-0
                                            {{ $product->cartItem ? 'bg-green-100 text-green-600' : 'text-green-600 hover:bg-green-50' }}"
                                            data-product-id="{{ $product->id }}"
                                            >
                                            {{ $product->cartItem ? 'ADDED' : 'ADD' }}
                                        </button>
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="px-2 py-1.5 border border-green-600 rounded-lg text-[11px] font-semibold text-green-600 block text-center shrink-0 hover:bg-green-50">
                                            ADD
                                        </a>
                                    @endauth
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- TOP 10 PRODUCTS IN THIS CATEGORY -->
            @if($topCategoryProducts->isNotEmpty())
            <section class="mt-10">
                <h2 class="text-lg font-semibold mb-4">Top 10 Products in this Category</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    @foreach ($topCategoryProducts as $product)
                        <div class="relative bg-white rounded-xl border border-gray-200 hover:shadow-md transition-all p-2 flex flex-col overflow-hidden">
                            
                            {{-- STOCK SCARCITY (DIAGONAL RIBBON) --}}
                            @if($product->stock_quantity > 0 && $product->stock_quantity <= 10)
                                <div class="absolute -right-[34px] top-[14px] w-[140px] h-[24px] bg-[#1a7a1a] text-white text-[9px] font-black tracking-widest flex items-center justify-center rotate-45 z-1 shadow-sm border-y border-white/20 uppercase" style="box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                    {{ $product->stock_quantity }} LEFT
                                </div>
                            @endif

                            {{-- DISCOUNT BADGE --}}
                            @if($product->discount_price && $product->price > 0)
                                @php $discountPercent = round((($product->price - $product->discount_price) / $product->price) * 100); @endphp
                                <div class="absolute top-2 left-2 z-10 bg-green-600 text-white text-[9px] font-bold px-1.5 py-0.5 rounded shadow-sm">
                                    {{ $discountPercent }}% OFF
                                </div>
                            @endif

                           {{-- WISHLIST ICON (TOP RIGHT) --}}
                            @auth
                            <button
                                class="absolute top-1 right-1 z-20 w-7 h-7 flex items-center justify-center rounded-full bg-white shadow-sm wishlist-btn hover:scale-105 transition"
                                data-product-id="{{ $product->id }}"
                            >
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
                                    <img src="{{ $img ? asset('public/storage/' . $img->path) : asset('public/storage/uploads/products/1/image3.png') }}" 
                                        class="w-full h-full object-contain p-2" 
                                        alt="{{ $product->name }}">
                                </div>
                            </a>

                            {{-- INFO --}}
                            <div class="mt-3 flex-1">
                                <span class="inline-flex items-center gap-1 bg-orange-50 text-yellow-900 text-[9px] font-semibold px-2 py-0.5 rounded-full mb-1">
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
                                    <p class="text-xs text-gray-500 mt-0.5">{{ $product->size }}</p>
                                @endif
                            </div>

                            {{-- PRICE & ADD BUTTON --}}
                            <div class="mt-3 flex items-center justify-between">
                                <div class="flex flex-col leading-tight">
                                    @if ($product->discount_price && $product->discount_price > 0)
                                        <span class="text-base font-bold text-gray-900">₹{{ $product->discount_price }}</span>
                                        <span class="line-through text-xs text-gray-400">₹{{ $product->price }}</span>
                                    @else
                                        <span class="text-base font-bold text-gray-900">₹{{ $product->price }}</span>
                                    @endif
                                </div>

                                {{-- ADD BUTTON --}}
                                @if(auth()->check() && auth()->user()->isDeliveryBoy())
                                    <button disabled class="px-2 py-1.5 border border-gray-200 bg-gray-50 text-gray-400 rounded-lg text-[10px] font-semibold cursor-not-allowed shrink-0" title="Delivery accounts cannot make purchases.">
                                        RESTRICTED
                                    </button>
                                @else
                                    @auth
                                        <button
                                            class="cart-btn px-2 py-1.5 border border-green-600 rounded-lg text-xs font-bold shrink-0
                                            {{ $product->cartItem ? 'bg-green-100 text-green-600' : 'text-green-600 hover:bg-green-50' }}"
                                            data-product-id="{{ $product->id }}"
                                            >
                                            {{ $product->cartItem ? 'ADDED' : 'ADD' }}
                                        </button>
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="cart-btn px-2 py-1.5 border border-green-600 rounded-lg text-xs font-bold text-green-600 block text-center shrink-0">
                                            ADD
                                        </a>
                                    @endauth
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            @endif



            <!-- PEOPLE ALSO BOUGHT -->
            @if($peopleAlsoBought->isNotEmpty())
            <section class="mt-10">
                <h2 class="text-lg font-semibold mb-4">People Also Bought</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    @foreach ($peopleAlsoBought as $product)
                        <div class="relative bg-white rounded-xl border border-gray-200 hover:shadow-md transition-all p-2 flex flex-col overflow-hidden">
                            
                            {{-- STOCK SCARCITY (DIAGONAL RIBBON) --}}
                            @if($product->stock_quantity > 0 && $product->stock_quantity <= 10)
                                <div class="absolute -right-[34px] top-[14px] w-[140px] h-[24px] bg-[#1a7a1a] text-white text-[9px] font-black tracking-widest flex items-center justify-center rotate-45 z-1 shadow-sm border-y border-white/20 uppercase" style="box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                    {{ $product->stock_quantity }} LEFT
                                </div>
                            @endif

                            {{-- DISCOUNT BADGE --}}
                            @if($product->discount_price && $product->price > 0)
                                @php $discountPercent = round((($product->price - $product->discount_price) / $product->price) * 100); @endphp
                                <div class="absolute top-2 left-2 z-10 bg-green-600 text-white text-[9px] font-bold px-1.5 py-0.5 rounded shadow-sm">
                                    {{ $discountPercent }}% OFF
                                </div>
                            @endif

                           {{-- WISHLIST ICON (TOP RIGHT) --}}
                            @auth
                            <button
                                class="absolute top-1 right-1 z-20 w-7 h-7 flex items-center justify-center rounded-full bg-white shadow-sm wishlist-btn hover:scale-105 transition"
                                data-product-id="{{ $product->id }}"
                            >
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
                                    <img src="{{ $img ? asset('public/storage/' . $img->path) : asset('public/storage/uploads/products/1/image3.png') }}" 
                                        class="w-full h-full object-contain p-2" 
                                        alt="{{ $product->name }}">
                                </div>
                            </a>

                            {{-- INFO --}}
                            <div class="mt-3 flex-1">
                                <span class="inline-flex items-center gap-1 bg-orange-50 text-yellow-900 text-[9px] font-semibold px-2 py-0.5 rounded-full mb-1">
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
                                    <p class="text-xs text-gray-500 mt-0.5">{{ $product->size }}</p>
                                @endif
                            </div>

                            {{-- PRICE & ADD BUTTON --}}
                            <div class="mt-3 flex items-center justify-between">
                                <div class="flex flex-col leading-tight">
                                    @if ($product->discount_price && $product->discount_price > 0)
                                        <span class="text-base font-bold text-gray-900">₹{{ $product->discount_price }}</span>
                                        <span class="line-through text-xs text-gray-400">₹{{ $product->price }}</span>
                                    @else
                                        <span class="text-base font-bold text-gray-900">₹{{ $product->price }}</span>
                                    @endif
                                </div>

                                {{-- ADD BUTTON --}}
                                @auth
                                    <button
                                        class="cart-btn px-2 py-1.5 border border-green-600 rounded-lg text-xs font-bold shrink-0
                                        {{ $product->cartItem ? 'bg-green-100 text-green-600' : 'text-green-600 hover:bg-green-50' }}"
                                        data-product-id="{{ $product->id }}"
                                        >
                                        {{ $product->cartItem ? 'ADDED' : 'ADD' }}
                                    </button>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="cart-btn px-2 py-1.5 border border-green-600 rounded-lg text-xs font-bold text-green-600 block text-center shrink-0">
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
    </div>



<script>
    let currentImageIndex = 0;
    const productImages = [
        @foreach ($product->images as $image)
            "{{ asset('public/storage/' . $image->path) }}",
        @endforeach
    ];

    function changeMainImage(element, index) {
        currentImageIndex = index;
        const mainImg = document.getElementById('mainProductImage');
        mainImg.src = element.src;

        document.querySelectorAll('.thumbnail-img').forEach(img => {
            img.classList.remove('border-green-500', 'shadow-sm');
            img.classList.add('border-gray-100');
        });

        element.classList.remove('border-gray-100');
        element.classList.add('border-green-500', 'shadow-sm');
    }

    function prevImage() {
        if (productImages.length <= 1) return;
        currentImageIndex = (currentImageIndex - 1 + productImages.length) % productImages.length;
        updateMainImageFromIndex();
    }

    function nextImage() {
        if (productImages.length <= 1) return;
        currentImageIndex = (currentImageIndex + 1) % productImages.length;
        updateMainImageFromIndex();
    }

    function updateMainImageFromIndex() {
        const mainImg = document.getElementById('mainProductImage');
        mainImg.src = productImages[currentImageIndex];
        
        const thumbnails = document.querySelectorAll('.thumbnail-img');
        thumbnails.forEach((img, idx) => {
            if (idx === currentImageIndex) {
                img.classList.remove('border-gray-100');
                img.classList.add('border-green-500', 'shadow-sm');
                img.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
            } else {
                img.classList.remove('border-green-500', 'shadow-sm');
                img.classList.add('border-gray-100');
            }
        });
    }

    function zoomImage(e) {
        const img = document.getElementById('mainProductImage');
        const x = e.offsetX;
        const y = e.offsetY;
        const w = img.offsetWidth;
        const h = img.offsetHeight;
        
        const xPerc = (x / w) * 100;
        const yPerc = (y / h) * 100;

        img.style.transformOrigin = `${xPerc}% ${yPerc}%`;
        img.style.transform = "scale(2.5)";
    }

    function resetZoom() {
        const img = document.getElementById('mainProductImage');
        img.style.transform = "scale(1)";
        img.style.transformOrigin = "center";
    }

    function toggleProductDetails() {
        const content = document.getElementById('productDetailsContent');
        const toggle = document.getElementById('productDetailsToggle');

        const isOpen = !content.classList.contains('hidden');

        if (isOpen) {
            content.classList.add('hidden');
            toggle.innerText = 'View more';
        } else {
            content.classList.remove('hidden');
            toggle.innerText = 'View less';
        }
    }

        window.wishlistToggleUrl = "{{ route('wishlist.toggle', ':id') }}";
        window.CartToggleUrl = "{{ route('account.cart.toggle', ':id') }}";
</script>

</x-layouts.site>
