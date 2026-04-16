@php
    $cardStyle = $isAd 
        ? 'border-2 border-yellow-400 bg-white shadow-[0_4px_20px_rgba(245,158,11,0.08)]' 
        : 'border border-gray-100 bg-white hover:shadow-xl hover:border-transparent';
@endphp

<div class="relative overflow-hidden rounded-xl border border-gray-200 bg-white hover:shadow-md p-2 flex flex-col transition-all duration-300 group h-full w-full {{ $isAd ? 'border-2 border-yellow-400 shadow-[0_4px_20px_rgba(245,158,11,0.08)]' : '' }}">
    
    {{-- SPONSORED TAG --}}
    @if($isAd)
        <div class="absolute top-2 left-2 z-10">
            <span class="bg-amber-400 text-white text-[9px] font-black px-1.5 py-0.5 rounded shadow-sm uppercase">Sponsored</span>
        </div>
    @endif

    <div class="relative group/img">
        <a href="{{ route('shop.show', $product->slug) }}" class="block">
            <div class="w-full h-36 rounded-lg overflow-hidden flex items-center justify-center relative">
                @php 
                    $img = $product->images->first(); 
                @endphp

                @if ($img)
                    <img src="@storageUrl($img ? $img->path : 'placeholder.png')" 
                        class="w-full h-full object-contain"
                        alt="{{ $product->name }}" >
                @else
                    <span class="text-gray-400 text-xs">No Image</span>
                @endif
                
                {{-- DISCOUNT BADGE --}}
                @if($product->discount_price && $product->price > 0 && !$isAd)
                    @php $discountPercent = round((($product->price - $product->discount_price) / $product->price) * 100); @endphp
                    <div class="absolute top-2 left-2 z-10 bg-green-600 text-white text-[9px] font-bold px-1.5 py-0.5 rounded shadow-sm">
                        {{ $discountPercent }}% OFF
                    </div>
                @endif

                {{-- WISHLIST --}}
                @auth
                    <button class="absolute top-2 right-2 z-20 w-7 h-7 flex items-center justify-center rounded-full bg-white/80 backdrop-blur shadow-sm wishlist-btn hover:scale-110 transition"
                            data-product-id="{{ $product->id }}" onclick="event.preventDefault();">
                        <i class="fa fa-heart {{ auth()->user()->wishlist->contains('product_id', $product->id) ? 'text-red-500' : 'text-gray-300' }} text-[10px]"></i>
                    </button>
                @else
                    <a href="{{ route('login') }}" class="absolute top-2 right-2 z-20 w-7 h-7 flex items-center justify-center rounded-full bg-white/80 backdrop-blur shadow-sm">
                        <i class="fa fa-heart text-gray-300 text-[10px]"></i>
                    </a>
                @endauth
                
                {{-- STAR RATINGS OVERLAY (Bottom-Left of Image) --}}
                @php 
                    $avgRating = $product->reviews_avg_rating ?? $product->reviews()->avg('rating') ?? 0;
                    $reviewCount = $product->reviews_count ?? $product->reviews()->count() ?? 0;
                @endphp
                @if($reviewCount > 0)
                <div class="absolute bottom-2 left-2 z-20 flex items-center gap-1 bg-white px-1.5 py-0.5 rounded shadow-sm border border-gray-100">
                    <div class="flex text-yellow-400 text-[8px] gap-0.5">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fa{{ $i <= round($avgRating) ? '-solid' : '-regular' }} fa-star"></i>
                        @endfor
                    </div>
                    <span class="text-[8px] text-gray-700 font-bold">({{ $reviewCount }})</span>
                </div>
                @else
                <div class="absolute bottom-2 left-2 z-20 flex items-center gap-1 bg-white/90 backdrop-blur-sm px-1.5 py-0.5 rounded shadow-sm shadow-black/5">
                    <div class="flex text-gray-300 text-[8px] gap-0.5">
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <span class="text-[8px] text-gray-400 font-bold">NEW</span>
                </div>
                @endif
            </div>
        </a>
    </div>

    {{-- 8 MINS TAG --}}
    <span class="w-fit inline-flex items-center gap-1 bg-orange-50 text-yellow-900 text-xs font-semibold px-2.5 py-0.5 rounded-full mt-3">
        <svg class="w-3.5 h-3.5 text-yellow-700" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-12.75a.75.75 0 00-1.5 0v4.19l-2.2 2.2a.75.75 0 101.06 1.06l2.39-2.39V5.25z" clip-rule="evenodd" />
        </svg>
        8 MINS
    </span>

    {{-- PRODUCT INFO --}}
    <div class="mt-2 flex-1">
        <p class="text-sm font-semibold text-gray-900 leading-tight line-clamp-1 mt-1">
            {{ $product->name }}
        </p>

        {{-- STOCK QUANTITY LABEL (Red Text Only) --}}
        @if(isset($product->stock_quantity) && $product->stock_quantity > 0)
            <p class="text-[11px] font-semibold text-red-500 mt-1 uppercase tracking-tight">{{ $product->stock_quantity }} items in stock</p>
        @elseif(isset($product->stock_quantity) && $product->stock_quantity <= 0)
            <p class="text-[11px] font-semibold text-red-600 mt-1 uppercase tracking-tight">Out of stock</p>
        @endif

        @if($product->size)
           <p class="text-[11px] text-gray-400 mt-1">{{ $product->size }}</p>
        @endif
    </div>

    {{-- PRICE & ACTION --}}
    <div class="mt-2 flex items-center justify-between ">
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
                class="cart-btn px-2 py-1.5 border border-green-600 rounded-lg text-xs font-bold
                {{ $product->cartItem ? 'bg-green-100 text-green-600' : 'text-green-600 hover:bg-green-50' }}"
                data-product-id="{{ $product->id }}"
            >
                {{ $product->cartItem ? 'ADDED' : 'ADD' }}
            </button>

        @else
                                
            <a href="{{ route('login') }}"
                class="cart-btn px-2 py-1.5 border border-green-600 rounded-lg text-xs font-bold text-green-600">
                ADD
            </a>
        @endauth
    </div>
</div>