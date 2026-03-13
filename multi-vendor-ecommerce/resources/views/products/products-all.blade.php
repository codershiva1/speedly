<x-layouts.site :title="$title">
    <div class="bg-gray-50 min-h-screen pb-20">
        
        {{-- Sticky Header --}}
        <div class="sticky top-0 z-30 bg-white/90 backdrop-blur-md border-b border-gray-100 px-4 py-3 mb-4">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <h1 class="text-lg font-black text-gray-800 tracking-tight">{{ $title }}</h1>
                @if($isFiltered)
                    <a href="{{ route('products.all') }}" class="text-xs font-bold text-green-600 flex items-center">
                        <i class="fa fa-arrow-left mr-2"></i> Back to Catalog
                    </a>
                @endif
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-2 sm:px-4">
            @if($isFiltered)
                {{-- FLAT GRID VIEW (When View All is clicked) --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-2">
                    @foreach($products as $product)
                        {{-- REUSABLE PRODUCT CARD START --}}
                        <div class="group relative bg-white rounded-xl border border-gray-100 hover:border-green-200 hover:shadow-sm transition-all p-2 flex flex-col">
                            {{-- Wishlist Icon --}}
                            @auth
                                <button class="absolute top-2 right-2 z-10 w-7 h-7 flex items-center justify-center rounded-full bg-white/80 shadow-sm wishlist-btn" data-product-id="{{ $product->id }}">
                                    <i class="fa fa-heart {{ auth()->user()->wishlist->contains('product_id', $product->id) ? 'text-red-500' : 'text-gray-300' }} text-xs"></i>
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="absolute top-2 right-2 z-10 w-7 h-7 flex items-center justify-center rounded-full bg-white/80 shadow-sm">
                                    <i class="fa fa-heart text-gray-300 text-xs"></i>
                                </a>
                            @endauth

                            {{-- Image --}}
                            <a href="{{ route('shop.show', $product->slug) }}" class="block mb-2">
                                <div class="w-full h-32 rounded-lg overflow-hidden flex items-center justify-center bg-gray-50/50">
                                    @php $img = $product->images->first(); @endphp
                                    <img src="{{ $img ? asset('public/storage/' . $img->path) : asset('storage/placeholder.png') }}" 
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
                                    <span class="text-xs font-black text-gray-900">₹{{ $product->discount_price ?? $product->price }}</span>
                                    @if($product->discount_price)
                                        <span class="text-[10px] text-gray-400 line-through">₹{{ $product->price }}</span>
                                    @endif
                                </div>
                                <button class="cart-btn px-3 py-1 border border-green-600 rounded-lg text-[11px] font-black text-green-600 hover:bg-green-600 hover:text-white transition-colors" data-product-id="{{ $product->id }}">
                                    ADD
                                </button>
                            </div>
                        </div>
                        {{-- REUSABLE PRODUCT CARD END --}}
                    @endforeach
                </div>
                <div class="mt-8">
                    {{ $products->links() }}
                </div>

            @else
                {{-- CATEGORY SECTIONED VIEW (Default) --}}
                @foreach($sections as $category)
                    <section class="mb-10">
                        <div class="flex items-center justify-between mb-4 px-1">
                            <div>
                                <h2 class="text-base font-black text-gray-900 uppercase tracking-tight">{{ $category->name }}</h2>
                                <p class="text-[10px] text-gray-400 font-medium">Top picks in this category</p>
                            </div>
                            <a href="{{ route('products.all', ['category' => $category->slug]) }}" 
                               class="text-xs font-bold text-green-600 bg-green-50 px-3 py-1.5 rounded-lg hover:bg-green-100 transition">
                                View All ({{ $category->products->count() }}+)
                            </a>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-2">
                            @foreach($category->products as $product)
                                {{-- REUSABLE PRODUCT CARD START (Same as above) --}}
                                <div class="group relative bg-white rounded-xl border border-gray-100 hover:border-green-200 hover:shadow-sm transition-all p-2 flex flex-col">
                                    @auth
                                        <button class="absolute top-2 right-2 z-10 w-7 h-7 flex items-center justify-center rounded-full bg-white/80 shadow-sm wishlist-btn" data-product-id="{{ $product->id }}">
                                            <i class="fa fa-heart {{ auth()->user()->wishlist->contains('product_id', $product->id) ? 'text-red-500' : 'text-gray-300' }} text-xs"></i>
                                        </button>
                                    @else
                                        <a href="{{ route('login') }}" class="absolute top-2 right-2 z-10 w-7 h-7 flex items-center justify-center rounded-full bg-white/80 shadow-sm">
                                            <i class="fa fa-heart text-gray-300 text-xs"></i>
                                        </a>
                                    @endauth

                                    <a href="{{ route('shop.show', $product->slug) }}" class="block mb-2">
                                        <div class="w-full h-32 rounded-lg overflow-hidden flex items-center justify-center bg-gray-50/50">
                                            @php $img = $product->images->first(); @endphp
                                            <img src="{{ $img ? asset('public/storage/' . $img->path) : asset('storage/placeholder.png') }}" 
                                                 class="w-full h-full object-contain p-2 group-hover:scale-105 transition-transform" 
                                                 alt="{{ $product->name }}">
                                        </div>
                                    </a>

                                    <div class="flex-1">
                                        <span class="text-[9px] font-bold text-orange-600 bg-orange-50 px-1.5 py-0.5 rounded uppercase">8 Mins</span>
                                        <h3 class="text-[12px] font-bold text-gray-800 leading-tight mt-1 line-clamp-2 h-8">{{ $product->name }}</h3>
                                        <p class="text-[11px] text-gray-400 mt-0.5">{{ $product->size ?? 'Unit' }}</p>
                                    </div>

                                    <div class="mt-3 flex items-center justify-between">
                                        <div class="flex flex-col">
                                            <span class="text-xs font-black text-gray-900">₹{{ $product->discount_price ?? $product->price }}</span>
                                            @if($product->discount_price)
                                                <span class="text-[10px] text-gray-400 line-through">₹{{ $product->price }}</span>
                                            @endif
                                        </div>
                                        <button class="cart-btn px-3 py-1 border border-green-600 rounded-lg text-[11px] font-black text-green-600 hover:bg-green-600 hover:text-white transition-colors" data-product-id="{{ $product->id }}">
                                            ADD
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endforeach
            @endif
        </div>
    </div>

    
     <script>
        window.wishlistToggleUrl = "{{ route('wishlist.toggle', ':id') }}";
        window.CartToggleUrl = "{{ route('account.cart.toggle', ':id') }}";
    </script>

</x-layouts.site>