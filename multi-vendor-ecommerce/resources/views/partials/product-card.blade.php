@php
    $cardStyle = $isAd 
        ? 'border-2 border-yellow-400 bg-white shadow-[0_4px_20px_rgba(245,158,11,0.08)]' 
        : 'border border-gray-100 bg-white hover:shadow-xl hover:border-transparent';
@endphp

<div class="relative rounded-xl {{ $cardStyle }} p-2 flex flex-col transition-all duration-500 group h-full">
    
    {{-- SPONSORED TAG --}}
    @if($isAd)
        <div class="absolute top-3 left-3 z-10">
            <span class="bg-amber-400 text-white text-[9px] font-black px-2 py-0.5 rounded shadow-sm uppercase">Sponsored</span>
        </div>
    @endif

    {{-- WISHLIST (Same as your code) --}}
    @auth
        <button class="absolute top-3 right-3 z-10 w-8 h-8 flex items-center justify-center rounded-full bg-white/80 backdrop-blur shadow-sm wishlist-btn hover:scale-110 transition"
                data-product-id="{{ $product->id }}">
            <i class="fa fa-heart {{ auth()->user()->wishlist->contains('product_id', $product->id) ? 'text-red-500' : 'text-gray-300' }}"></i>
        </button>
    @else
        <a href="{{ route('login') }}" class="absolute top-3 right-3 z-10 w-8 h-8 flex items-center justify-center rounded-full bg-white/80 backdrop-blur shadow-sm">
            <i class="fa fa-heart text-gray-300"></i>
        </a>
    @endauth

    {{-- PRODUCT IMAGE --}}
    {{-- PRODUCT IMAGE - Fixed aspect-square and forced height --}}

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

    {{-- 8 MINS TAG --}}
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
           <p class="text-sm text-gray-500 mt-1">{{ $product->size }}</p>
         @endif
    </div>

    {{-- PRICE & ACTION --}}
    <div class="mt-2 flex items-center justify-between ">
        <div class="flex flex-col leading-none">
            <span class="text-base font-black text-gray-900">₹{{ $product->price }}</span>
            @if($product->discount_price)
                <span class="text-[10px] text-gray-400 line-through mt-1">₹{{ $product->discount_price }}</span>
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