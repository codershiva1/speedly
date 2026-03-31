@forelse ($products as $product)
    <div class="group relative bg-white rounded-xl border border-gray-100 hover:border-green-200 hover:shadow-sm transition-all p-2 flex flex-col">
        {{-- Wishlist Icon --}}
        @auth
            <button class="absolute top-2 right-2 z-10 w-7 h-7 flex items-center justify-center rounded-full bg-white/80 shadow-sm wishlist-btn" data-product-id="{{ $product->id }}">
                <i class="fa fa-heart {{ auth()->user()->wishlist->contains('product_id', $product->id) ? 'text-red-500' : 'text-gray-300' }} text-xs"></i>
            </button>
        @endauth

        {{-- Image --}}
        <a href="{{ route('shop.show', $product->slug) }}" class="block mb-2">
            <div class="w-full h-32 rounded-lg overflow-hidden flex items-center justify-center bg-gray-50/50">
                @php $img = $product->images->first(); @endphp
                <img src="{{ $img ? asset('public/storage/' . $img->path) : asset('public/storage/placeholder.png') }}" 
                     class="w-full h-full object-contain p-2 group-hover:scale-105 transition-transform" 
                     alt="{{ $product->name }}">
            </div>
        </a>

        {{-- Info --}}
        <div class="flex-1">
            <span class="text-[9px] font-bold text-orange-600 bg-orange-50 px-1.5 py-0.5 rounded uppercase">8 Mins</span>
            <h3 class="text-[12px] font-bold text-gray-800 leading-tight mt-1 line-clamp-2 h-8">{{ $product->name }}</h3>
            <p class="text-[11px] text-gray-400 mt-0.5">{{ $product->size ?? 'Unit' }}</p>
        </div>

        {{-- Price & Add --}}
        <div class="mt-3 flex items-center justify-between">
            <div class="flex flex-col">
                <span class="text-xs font-black text-gray-900">₹{{ $product->price }}</span>
                @if($product->discount_price)
                    <span class="text-[10px] text-gray-400 line-through">₹{{ $product->discount_price }}</span>
                @endif
            </div>
             {{-- ADD BUTTON --}}
            @auth
            <button class="cart-btn px-2 py-1.5 border border-green-600 rounded-lg text-sm font-semibold {{ $product->cartItem ? 'bg-green-100 text-green-600' : 'text-green-600 hover:bg-green-50' }}" data-product-id="{{ $product->id }}">
                {{ $product->cartItem ? 'ADDED' : 'ADD' }}
            </button>
            @else
            <a href="{{ route('login') }}" class="cart-btn px-2 py-1.5 border border-green-600 rounded-lg text-sm font-semibold"> ADD </a>
            @endauth
        </div>
    </div>
@empty
    <div class="col-span-full py-20 text-center text-gray-400">No products found in this category.</div>
@endforelse
