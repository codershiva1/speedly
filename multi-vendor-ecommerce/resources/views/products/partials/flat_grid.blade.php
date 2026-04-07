@foreach($products as $product)
    {{-- REUSABLE PRODUCT CARD START --}}
    <div class="group relative bg-white rounded-xl border border-gray-100 hover:border-green-200 hover:shadow-sm transition-all p-2 flex flex-col overflow-hidden">
        
        {{-- STOCK SCARCITY --}}
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

        {{-- Wishlist Icon --}}
        @auth
            <button class="absolute top-1 right-1 z-20 w-7 h-7 flex items-center justify-center rounded-full bg-white shadow-sm wishlist-btn hover:scale-105 transition" data-product-id="{{ $product->id }}">
                <i class="fa fa-heart {{ auth()->user()->wishlist->contains('product_id', $product->id) ? 'text-red-500' : 'text-gray-300' }} text-[10px]"></i>
            </button>
        @else
            <a href="{{ route('login') }}" class="absolute top-1 right-1 z-20 w-7 h-7 flex items-center justify-center rounded-full bg-white shadow-sm">
                <i class="fa fa-heart text-gray-400 text-[10px]"></i>
            </a>
        @endauth

        {{-- Image --}}
        <a href="{{ route('shop.show', $product->slug) }}" class="block mb-2">
            <div class="w-full h-32 rounded-lg overflow-hidden flex items-center justify-center bg-gray-50/50">
                @php $img = $product->images->first(); @endphp
                <img src="@storageUrl($img ? $img->path : 'placeholder.png')" 
                     class="w-full h-full object-contain p-2 group-hover:scale-105 transition-transform" 
                     alt="{{ $product->name }}">
            </div>
        </a>

        {{-- Info --}}
        <div class="flex-1">
            <span class="inline-flex items-center gap-1 bg-orange-50 text-yellow-900 text-[9px] font-bold px-1.5 py-0.5 rounded uppercase">
                <i class="fa-solid fa-clock"></i> 8 Mins
            </span>
            <h3 class="text-xs font-bold text-gray-800 leading-tight mt-1 line-clamp-2 h-8">{{ $product->name }}</h3>
            
            {{-- STAR RATINGS --}}
            @php 
                $avgRating = $product->reviews_avg_rating ?? $product->reviews()->avg('rating') ?? 0;
                $reviewCount = $product->reviews_count ?? $product->reviews()->count() ?? 0;
            @endphp
            <div class="flex items-center gap-1 mt-1 mb-1 opacity-90">
                <div class="flex text-yellow-400 text-[8px] gap-0.5">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fa{{ $i <= round($avgRating) ? '-solid' : '-regular' }} fa-star"></i>
                    @endfor
                </div>
                <span class="text-[8px] text-gray-500 font-medium">({{ $reviewCount }})</span>
            </div>

            <p class="text-[11px] text-gray-400 mt-0.5">{{ $product->size ?? 'Unit' }}</p>
        </div>

        {{-- Price & Add --}}
        <div class="mt-3 flex items-center justify-between">
            <div class="flex flex-col leading-tight">
                @if($product->discount_price && $product->discount_price > 0)
                    <span class="text-sm font-black text-gray-900">₹{{ $product->discount_price }}</span>
                    <span class="text-[9px] text-gray-400 line-through">₹{{ $product->price }}</span>
                @else
                    <span class="text-sm font-black text-gray-900">₹{{ $product->price }}</span>
                @endif
            </div>
            @auth
                <button class="cart-btn px-2 py-1 border border-green-600 rounded-lg text-xs font-bold {{ $product->cartItem ? 'bg-green-100 text-green-600' : 'text-green-600 hover:bg-green-50' }}" data-product-id="{{ $product->id }}">
                    {{ $product->cartItem ? 'ADDED' : 'ADD' }}
                </button>
            @else
                <a href="{{ route('login') }}" class="cart-btn px-2 py-1 border border-green-600 rounded-lg text-xs font-bold text-green-600"> ADD </a>
            @endauth
        </div>
    </div>
@endforeach
