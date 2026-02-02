<x-layouts.site :title="__('Shop')">
    <div class="bg-gradient-to-r from-indigo-600 via-indigo-500 to-sky-500 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex flex-col md:flex-row items-center gap-8">
            <div class="flex-1">
                <h1 class="text-3xl sm:text-4xl font-semibold">Discover products from multiple vendors in one place.</h1>
                <p class="mt-3 text-sm sm:text-base text-indigo-100">Search across categories, compare prices, and checkout securely with a simple cart and cash-on-delivery option.</p>

                <form method="GET" action="{{ route('shop.index') }}" class="mt-5 flex flex-col sm:flex-row gap-3">
                    <input type="text" name="q" value="{{ $filters['q'] ?? '' }}" placeholder="Search for products, brands, or categories" class="flex-1 px-3 py-2 rounded-md text-sm text-gray-900 placeholder-gray-400 border border-indigo-300 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-white" />
                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-white text-indigo-700 font-semibold text-xs rounded-md shadow hover:bg-indigo-50">Search</button>
                </form>
            </div>

            <div class="flex-1 grid grid-cols-2 gap-3 text-xs">
                <div class="bg-white/10 border border-white/20 rounded-lg p-3 backdrop-blur-sm">
                    <p class="font-semibold">Curated categories</p>
                    <p class="mt-1 text-indigo-100">Explore electronics, fashion, home & kitchen and more.</p>
                </div>
                <div class="bg-white/10 border border-white/20 rounded-lg p-3 backdrop-blur-sm">
                    <p class="font-semibold">Trusted vendors</p>
                    <p class="mt-1 text-indigo-100">Single dashboard to manage orders from multiple sellers.</p>
                </div>
                <div class="bg-white/10 border border-white/20 rounded-lg p-3 backdrop-blur-sm">
                    <p class="font-semibold">Cash on delivery</p>
                    <p class="mt-1 text-indigo-100">Simple checkout and pay when the product arrives.</p>
                </div>
                <div class="bg-white/10 border border-white/20 rounded-lg p-3 backdrop-blur-sm">
                    <p class="font-semibold">Easy returns</p>
                    <p class="mt-1 text-indigo-100">Basic flow in place to extend with your business rules.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
        @if($featuredProducts->isNotEmpty())
            <section>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">Featured products</h2>
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
                                            ? 'http://localhost/speedly_wind/multi-vendor-ecommerce/public/storage/' . $img->path 
                                            : null;
                                    @endphp

                                    @if ($img)
                                        <img src="http://localhost/speedly_wind/multi-vendor-ecommerce/public/storage/uploads/categories/3/image1.avif" 
                                            class="w-full h-full object-contain"
                                            alt="{{ $product->name }}" style="object-fit: fill;">
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

        <section class="grid grid-cols-1 md:grid-cols-6 gap-4">
            <!-- Filters -->
           <aside class="md:col-span-1 bg-white rounded-xl border border-gray-200 p-4 text-sm space-y-6 sticky top-8 bottom-8 h-fit overflow-y-auto
">

    <!-- CATEGORY FILTER -->
    <div>
        <h3 class="font-semibold text-gray-900 mb-3 text-sm">Filter by Category</h3>

        <div class="space-y-1.5 max-h-56 overflow-y-auto pr-1">

            {{-- ALL CATEGORY --}}
            <a href="{{ route('shop.index', array_merge(request()->except('page', 'category'), ['category' => null])) }}"
               class="block px-3 py-1.5 rounded-lg text-xs font-medium 
               {{ empty($filters['category']) 
                    ? 'bg-indigo-50 text-indigo-700 border border-indigo-100' 
                    : 'hover:bg-gray-50 text-gray-700 border border-transparent' }}">
                All Categories
            </a>

            {{-- CATEGORY LIST --}}
            @foreach ($categories as $category)
                <a href="{{ route('shop.index', array_merge(request()->except('page'), ['category' => $category->slug])) }}"
                   class="block px-3 py-1.5 rounded-lg text-xs font-medium 
                   {{ ($filters['category'] ?? null) === $category->slug
                        ? 'bg-indigo-50 text-indigo-700 border border-indigo-100'
                        : 'hover:bg-gray-50 text-gray-700 border border-transparent' }}">
                    {{ $category->name }}
                </a>
            @endforeach

        </div>
    </div>

    <!-- PRICE RANGE FILTER -->
    <div class="border-t border-gray-100 pt-4">
    <h3 class="font-semibold text-gray-900 mb-3 text-sm">Price Range</h3>

    <form method="GET" action="{{ route('shop.index') }}" class="space-y-3">

        <!-- MIN – MAX INPUTS -->
        <div class="flex items-center gap-1 w-full">

            <input type="number"
                   name="min_price"
                   value="{{ $filters['min_price'] ?? '' }}"
                   placeholder="Min"
                   class="flex-1 px-3 py-1.5 border border-gray-200 rounded-lg text-xs 
                          focus:ring-indigo-200 focus:border-indigo-400 w-full" />

            <span class="text-gray-400 text-sm">—</span>

            <input type="number"
                   name="max_price"
                   value="{{ $filters['max_price'] ?? '' }}"
                   placeholder="Max"
                   class="flex-1 px-3 py-1.5 border border-gray-200 rounded-lg text-xs
                          focus:ring-indigo-200 focus:border-indigo-400 w-full" />
        </div>

        {{-- KEEP OTHER FILTERS --}}
        @foreach (request()->except('page', 'min_price', 'max_price') as $name => $value)
            <input type="hidden" name="{{ $name }}" value="{{ $value }}">
        @endforeach

        <!-- APPLY BUTTON -->
        <button type="submit"
                class="w-full inline-flex items-center justify-center px-4 py-2 bg-indigo-600 
                       text-white rounded-lg text-xs font-semibold shadow-sm hover:bg-indigo-500">
            Apply
        </button>
    </form>
</div>



</aside>


            <!-- Products grid -->
            <div class="md:col-span-5">
                <div class="flex items-center justify-between mb-4 text-xs text-gray-600">

    <!-- PRODUCTS COUNT -->
    <p>{{ $products->total() }} products found</p>

    <!-- SORT DROPDOWN -->
    <form method="GET" action="{{ route('shop.index') }}">
        <select name="sort"
                onchange="this.form.submit()"
                class="border border-gray-300 rounded-lg px-2 py-1 bg-white text-xs text-gray-700 cursor-pointer">
            
            <option value="">Sort By</option>
            <option value="price_low_high" {{ request('sort') == 'price_low_high' ? 'selected' : '' }}>
                Price: Low to High
            </option>
            <option value="price_high_low" {{ request('sort') == 'price_high_low' ? 'selected' : '' }}>
                Price: High to Low
            </option>
            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>
                Latest
            </option>
            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                Oldest
            </option>
        </select>

        {{-- KEEP OTHER FILTERS --}}
        @foreach(request()->except('page', 'sort') as $name => $value)
            <input type="hidden" name="{{ $name }}" value="{{ $value }}">
        @endforeach
    </form>

</div>

                 <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                    @foreach ($products as $product)
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
                                            ? 'http://localhost/speedly_wind/multi-vendor-ecommerce/public/storage/' . $img->path 
                                            : null;
                                    @endphp

                                    @if ($img)
                                        <img src="http://localhost/speedly_wind/multi-vendor-ecommerce/public/storage/uploads/categories/3/image1.avif" 
                                            class="w-full h-full object-contain"
                                            alt="{{ $product->name }}" style="object-fit: fill;">
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

                <div class="mt-6">
                    {{ $products->links() }}
                </div>
            </div>
        </section>
    </div>

    <script>
        window.wishlistToggleUrl = "{{ route('wishlist.toggle', ':id') }}";
        window.CartToggleUrl = "{{ route('account.cart.toggle', ':id') }}";
    </script>

</x-layouts.site>
