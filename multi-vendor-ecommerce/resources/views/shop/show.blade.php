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

@push('meta')
    <meta property="og:title" content="{{ $product->name }} | Speedly Shop">
    <meta property="og:description" content="Buy {{ $product->name }} for ₹{{ $product->discount_price ?? $product->price }}. Fresh stock, superfast delivery in 8 mins!">
    <meta property="og:image" content="@storageUrl($product->images->first()?->path ?? 'placeholder.png')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="product">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $product->name }}">
    <meta name="twitter:description" content="Get {{ $product->name }} delivered in minutes via Speedly.">
    <meta name="twitter:image" content="@storageUrl($product->images->first()?->path ?? 'placeholder.png')">
@endpush

    <div class="bg-gray-50 min-h-screen ">
        <div class="max-w-7xl mx-auto px-4 sm:px-4 lg:px-4 py-1 space-y-8">

            <!-- PRODUCT TOP SECTION -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start bg-white p-2">

                <!-- LEFT COLUMN (IMAGE + DETAILS COLLAPSIBLE) -->
                <div class="space-y-6 md:pr-6 md:border-r md:border-gray-200">

                    <!-- IMAGE -->
                    <div class="relative">

                    {{-- ACTION BUTTONS (TOP RIGHT) --}}
                    <div class="absolute top-2 right-2 z-20 flex flex-col gap-2">
                        {{-- SHARE BUTTON --}}
                        <button
                            onclick="shareProduct('{{ addslashes($product->name) }}', window.location.href)"
                            class="w-9 h-9 flex items-center justify-center rounded-full bg-white shadow-md hover:bg-gray-50 transition-all border border-gray-100"
                            title="Share Product"
                        >
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M16 8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                        </button>

                        {{-- WISHLIST --}}
                        @auth
                        <button
                            class="w-9 h-9 flex items-center justify-center rounded-full bg-white shadow-md wishlist-btn hover:scale-105 transition border border-gray-100"
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
                        class="w-9 h-9 flex items-center justify-center rounded-full bg-white shadow-md border border-gray-100">
                            <i class="fa fa-heart text-gray-400"></i>
                        </a>
                        @endauth
                    </div>

                        {{-- PRODUCT IMAGE SLIDER --}}
                        <div class="relative group/main-image">
                            <!-- Swiper -->
                            <div class="swiper mainProductSwiper rounded-3xl overflow-hidden bg-white">
                                <div class="swiper-wrapper">
                                    @foreach ($product->images as $image)
                                        <div class="swiper-slide flex items-center justify-center p-4">
                                            <img src="@storageUrl($image->path)" 
                                                alt="{{ $product->name }}"
                                                class="w-full h-auto max-h-[450px] object-contain">
                                        </div>
                                    @endforeach
                                    @if($product->images->isEmpty())
                                        <div class="swiper-slide flex items-center justify-center p-4">
                                            <img src="@storageUrl('uploads/products/1/image3.png')" 
                                                alt="{{ $product->name }}"
                                                class="w-full h-auto max-h-[450px] object-contain">
                                        </div>
                                    @endif
                                </div>
                                
                                {{-- NAVIGATION BUTTONS (Light Green Blur) --}}
                                <div class="swiper-button-prev !left-4 !w-11 !h-11 !bg-white/40 !backdrop-blur-lg !rounded-full !text-green-500 after:!text-lg hover:!bg-white/60 transition-all shadow-sm !hidden group-hover/main-image:!flex border-none"></div>
                                <div class="swiper-button-next !right-4 !w-11 !h-11 !bg-white/40 !backdrop-blur-lg !rounded-full !text-green-500 after:!text-lg hover:!bg-white/60 transition-all shadow-sm !hidden group-hover/main-image:!flex border-none"></div>
                            </div>

                            {{-- RATING & TIMING PILL + PAGINATION DOTS (Matched to Ref) --}}
                            <div class="flex items-center justify-between mt-5 px-1">
                                <div class="flex items-center gap-2 bg-[#f8f9fa] border border-gray-100/50 rounded-xl px-2.5 py-1.5 shadow-sm">
                                    {{-- Time --}}
                                    <div class="flex items-center gap-1.5 pr-2.5 border-r border-gray-200">
                                        <div class="w-4 h-4 rounded-full flex items-center justify-center">
                                            <i class="bi bi-clock-fill text-green-600 text-[11px]"></i>
                                        </div>
                                        <span class="text-[11px] font-black text-gray-800 tracking-tight">8 MINS</span>
                                    </div>
                                    {{-- Rating --}}
                                    <div class="flex items-center gap-1.5 pl-1">
                                        <div class="flex text-yellow-400 text-[10px]">
                                            @for($i=1; $i<=5; $i++)
                                                <i class="fa fa-star {{ $i > ($averageRating ?? 0) ? 'text-gray-200' : '' }}"></i>
                                            @endfor
                                        </div>
                                        <span class="text-[10px] font-black text-gray-500">({{ number_format($ratingCount ?? 0) }})</span>
                                    </div>
                                </div>

                                {{-- SLIDER DOTS --}}
                                <div class="main-slider-pagination !flex !static !w-auto"></div>
                            </div>
                        </div>

                        <style>
                            .main-slider-pagination .swiper-pagination-bullet {
                                width: 7px;
                                height: 7px;
                                background: #d1d5db;
                                opacity: 1;
                                transition: all 0.3s ease;
                                margin: 0 4px !important;
                            }
                            .main-slider-pagination .swiper-pagination-bullet-active {
                                width: 16px;
                                border-radius: 4px;
                                background: #4b5563;
                            }
                        </style>
                    </div>

                    <!-- PRODUCT DETAILS (COLLAPSIBLE) - Hidden on mobile here, moved below price -->
                    <div class="bg-white rounded-xl border mt-6 hidden md:block">
                        <button
                            type="button"
                            onclick="toggleProductDetails()"
                            class="w-full flex justify-between items-center px-4 py-3.5 text-sm font-bold text-green-600 hover:bg-gray-50 transition-colors rounded-xl">
                            <span id="productDetailsLabel">View product details</span>
                            <i id="productDetailsChevron" class="fa fa-chevron-down text-xs transition-transform duration-300"></i>
                        </button>

                        <div id="productDetailsContent"
                            class="hidden border-t border-gray-100 px-4 pb-4 pt-3 text-[12px] text-gray-700 space-y-4">
                            @foreach ($productDetails as $label => $value)
                                <div class="grid grid-cols-2 gap-4">
                                    <p class="text-gray-500 font-medium">{{ $label }}</p>
                                    <p class="text-gray-900 leading-relaxed font-semibold">
                                        {{ is_array($value) ? implode(', ', $value) : $value }}
                                    </p>
                                </div>
                            @endforeach
                            <p class="pt-3 text-[10px] text-gray-400 italic leading-relaxed border-t border-gray-50">
                                Every effort is made to maintain accuracy. Products may vary slightly from images shown.
                            </p>
                        </div>
                    </div>

                </div>

                <!-- RIGHT COLUMN (PRODUCT INFO) - STICKY -->
                <aside class="sticky top-32 self-start space-y-6">

                    <!-- TITLE -->
                    <div>
                        <h1 class="text-2xl md:text-3xl font-black text-gray-900 tracking-tight leading-tight">
                            {{ $product->name }}
                        </h1>
                        <p class="text-sm font-bold text-gray-400 mt-2 tracking-wide">
                            {{ optional($product->category)->name }}
                            @if ($product->brand) • {{ $product->brand->name }} @endif
                        </p>
                    </div>

                    <!-- PRICE & ADD TO CART -->
                    <div class="flex flex-col space-y-5">
                        <div class="flex items-baseline space-x-3">
                            <span class="text-3xl font-black text-gray-900">
                                ₹{{ $product->discount_price ?? $product->price }}
                            </span>
                            @if ($product->discount_price)
                                <span class="text-base text-gray-400 line-through font-bold">
                                    ₹{{ $product->price }}
                                </span>
                            @endif
                        </div>

                        {{-- MOBILE ACTION ROW: Product Details + Cart in one row --}}
                        <div class="grid grid-cols-2 md:grid-cols-1 gap-3">
                            <button
                                type="button"
                                onclick="toggleProductDetails()"
                                class="md:hidden flex items-center justify-between px-4 py-3 border border-gray-100 rounded-2xl text-xs font-black text-green-600 bg-white shadow-sm overflow-hidden"
                            >
                                <span class="truncate">VIEW DETAILS</span>
                                <i class="fa fa-chevron-down text-[10px]"></i>
                            </button>

                            @if(auth()->check() && auth()->user()->isDeliveryBoy())
                                <div class="px-6 py-3.5 bg-gray-100 text-gray-400 rounded-2xl text-[11px] font-black text-center cursor-not-allowed border border-gray-200 uppercase tracking-widest">
                                    NOT ALLOWED
                                </div>
                            @else
                                @auth
                                    <button
                                        class="cart-btn px-6 py-3.5 border-2 border-green-600 rounded-2xl text-xs font-black transition-all tracking-widest
                                        {{ $product->cartItem ? 'bg-green-600 text-white shadow-lg shadow-green-200' : 'text-green-600 bg-white hover:bg-green-50' }}"
                                        data-product-id="{{ $product->id }}"
                                        >
                                        {{ $product->cartItem ? 'ADDED' : 'ADD TO CART' }}
                                    </button>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="px-6 py-3.5 border-2 border-green-600 rounded-2xl text-xs font-black text-center text-green-600 bg-white hover:bg-green-50 tracking-widest block">
                                        ADD TO CART
                                    </a>
                                @endauth
                            @endif
                        </div>

                         {{-- Mobile Collapsible Content (Duplicates here but hidden on Desktop) --}}
                         <div id="productDetailsContentMobile" class="md:hidden hidden mt-2 bg-gray-50 rounded-2xl p-4 border border-gray-100 text-[11px] space-y-3">
                            @foreach ($productDetails as $label => $value)
                                <div class="flex justify-between gap-4">
                                    <span class="text-gray-500 shrink-0">{{ $label }}</span>
                                    <span class="text-gray-900 font-bold text-right">{{ is_array($value) ? implode(', ', $value) : $value }}</span>
                                </div>
                            @endforeach
                         </div>
                    </div>

                    <!-- PRODUCT FEATURES & BRAND -->
                    <div class="border-t pt-6 space-y-6">
                        {{-- BRAND CARD (NOW ABOVE) --}}
                        @if ($product->brand)
                            <a href="{{ route('products.all', ['brand' => $product->brand->slug]) }}" 
                               class="flex items-center justify-between p-4 bg-white border border-gray-100 rounded-2xl hover:bg-gray-50 transition-all group shadow-sm">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl border border-gray-50 flex items-center justify-center bg-gray-50 overflow-hidden shrink-0">
                                        @if($product->brand->image)
                                            <img src="@storageUrl($product->brand->image)" alt="{{ $product->brand->name }}" class="w-full h-full object-contain">
                                        @else
                                            <span class="text-xs font-black text-gray-400 opacity-50 uppercase">{{ substr($product->brand->name, 0, 1) }}</span>
                                        @endif
                                    </div>
                                    <div class="space-y-0.5">
                                        <h3 class="text-sm font-black text-gray-900 tracking-tight leading-none">{{ $product->brand->name }}</h3>
                                        <p class="text-[11px] font-bold text-gray-400">Explore all products</p>
                                    </div>
                                </div>
                                <i class="fa fa-chevron-right text-xs text-gray-300 group-hover:text-green-600 group-hover:translate-x-1 transition-all"></i>
                            </a>
                        @endif

                        {{-- RATINGS --}}
                        @if ($ratingCount)
                            <div class="flex items-center gap-2 text-sm text-gray-600 px-1">
                                <div class="flex text-yellow-400">
                                    @for($i=1; $i<=5; $i++)
                                        <i class="fa fa-star {{ $i > ($averageRating ?? 0) ? 'text-gray-200' : '' }}"></i>
                                    @endfor
                                </div>
                                <span class="font-black text-gray-900">{{ number_format($averageRating, 1) }}</span>
                                <span class="text-gray-400 font-bold">({{ number_format($ratingCount) }} reviews)</span>
                            </div>
                        @endif

                        {{-- WHY SHOP FROM SPEEDLY --}}
                        <div class="space-y-4 text-xs text-gray-600 px-1">
                            <p class="font-black text-gray-900 uppercase tracking-widest text-[10px]">Why shop from SpeedlyMart</p>
                            <div class="space-y-3">
                                <div class="flex items-start gap-3">
                                    <div class="w-7 h-7 bg-green-50 rounded-lg flex items-center justify-center shrink-0">
                                        <span class="text-green-600 text-xs text-[10px]">⚡</span>
                                    </div>
                                    <p class="leading-relaxed">
                                        <span class="font-black text-gray-900">Superfast delivery</span><br>
                                        <span class="text-gray-400">Get your order in minutes</span>
                                    </p>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="w-7 h-7 bg-green-50 rounded-lg flex items-center justify-center shrink-0">
                                        <span class="text-green-600 text-[10px]">💰</span>
                                    </div>
                                    <p class="leading-relaxed">
                                        <span class="font-black text-gray-900">Best prices</span><br>
                                        <span class="text-gray-400">Great deals & savings every day</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </aside>

    {{-- MOBILE FLOATING ADD BUTTON --}}
    <div class="fixed bottom-24 left-4 right-4 z-50 md:hidden pointer-events-none">
        <div class="flex justify-end">
            <div class="pointer-events-auto bg-black/90 backdrop-blur-md rounded-2xl shadow-2xl p-2.5 flex items-center gap-4 border border-white/10 animate-bounce-subtle">
                {{-- Product Preview --}}
                <div class="flex items-center gap-3 pl-1">
                    <div class="w-10 h-10 rounded-full bg-white p-1 overflow-hidden shrink-0 border border-white/20">
                        <img src="@storageUrl($product->images->first()?->path ?? 'uploads/products/1/image3.png')" alt="" class="w-full h-full object-contain">
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[10px] font-black text-white leading-none">₹{{ $product->discount_price ?? $product->price }}</span>
                        <span class="text-[8px] font-bold text-gray-400 uppercase tracking-wider">Unit Price</span>
                    </div>
                </div>

                {{-- Trigger Button --}}
                @if(!(auth()->check() && auth()->user()->isDeliveryBoy()))
                    <button 
                        class="cart-btn bg-green-600 text-white px-5 py-2.5 rounded-xl font-black text-[11px] tracking-widest flex items-center gap-2 hover:bg-green-500 transition-colors shadow-lg active:scale-95"
                        data-product-id="{{ $product->id }}">
                        {{ $product->cartItem ? 'ADDED' : 'ADD TO CART' }}
                    </button>
                @endif
            </div>
        </div>
    </div>

    <style>
        @keyframes bounce-subtle {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        .animate-bounce-subtle {
            animation: bounce-subtle 4s infinite ease-in-out;
        }
    </style>

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
                        @include('partials.product-card', ['product' => $product, 'isAd' => false])
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
                        @include('partials.product-card', ['product' => $product, 'isAd' => false])
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
                        @include('partials.product-card', ['product' => $product, 'isAd' => false])
                    @endforeach
                </div>
            </section>
            @endif

        </div>
    </div>



@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialize Main Product Slider
        const mainProductSwiper = new Swiper('.mainProductSwiper', {
            modules: [window.Navigation, window.Pagination],
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.main-slider-pagination',
                clickable: true,
            },
        });

        window.toggleProductDetails = function() {
            const content = document.getElementById('productDetailsContent');
            const mobileContent = document.getElementById('productDetailsContentMobile');
            const label = document.getElementById('productDetailsLabel');
            const chevron = document.getElementById('productDetailsChevron');

            const isDesktopVisible = !content.classList.contains('hidden');
            const isMobileVisible = !mobileContent.classList.contains('hidden');

            if (isDesktopVisible || isMobileVisible) {
                content.classList.add('hidden');
                mobileContent.classList.add('hidden');
                if(label) label.innerText = 'View product details';
                if(chevron) chevron.style.transform = 'rotate(0deg)';
            } else {
                content.classList.remove('hidden');
                mobileContent.classList.remove('hidden');
                if(label) label.innerText = 'Hide product details';
                if(chevron) chevron.style.transform = 'rotate(180deg)';
            }
        };

    });

    window.wishlistToggleUrl = "{{ route('wishlist.toggle', ':id') }}";
    window.CartToggleUrl = "{{ route('account.cart.toggle', ':id') }}";
</script>
@endpush

</x-layouts.site>
