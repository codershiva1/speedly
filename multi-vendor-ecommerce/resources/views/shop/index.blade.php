<x-layouts.site :title="__('Shop')">
    <style>
        /* Modern, Thin, Light Green Scrollbar */
        .custom-scroll::-webkit-scrollbar { width: 4px; }
        .custom-scroll::-webkit-scrollbar-track { background: transparent; }
        .custom-scroll::-webkit-scrollbar-thumb { 
            background: #bbf7d0; 
            border-radius: 20px; 
        }
        .custom-scroll {
            scrollbar-width: thin;
            scrollbar-color: #bbf7d0 transparent;
            -ms-overflow-style: none;
        }

        /* Active Category Styling */
        .category-active {
            background-color: #f0fdf4; 
            border-right: 3px solid #22c55e; 
            color: #15803d !important; 
        }
    </style>

    <div class="mx-auto px-1 py-1">
        <div class="flex gap-1 h-[calc(100vh-80px)] overflow-hidden">
            
            {{-- Sidebar --}}
            <aside class="w-16 sm:w-24 md:w-28 bg-white flex flex-col border-r border-gray-100">
                <div class="flex flex-col overflow-y-auto custom-scroll h-full py-2">
                    <a href="{{ route('shop.index', array_merge(request()->except('page', 'category'), ['category' => null])) }}" 
                       class="flex flex-col items-center p-2 mb-2 text-center transition-all {{ empty($filters['category']) ? 'category-active' : 'text-gray-500 hover:bg-gray-50' }}">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-gray-100 rounded-full flex items-center justify-center mb-1">
                            <i class="fa fa-grid-2 text-lg"></i>
                        </div>
                        <span class="text-[10px] md:text-xs font-bold leading-tight">All</span>
                    </a>

                    @foreach($categories as $category)
                        @php $isActive = ($filters['category'] ?? null) == $category->slug; @endphp
                        <a href="{{ route('shop.index', array_merge(request()->except('page', 'category'), ['category' => $category->slug])) }}"
                           class="flex flex-col items-center p-2 mb-1 text-center transition-all {{ $isActive ? 'category-active' : 'text-gray-500 hover:bg-gray-50' }}">
                            <div class="w-10 h-10 md:w-12 md:h-12 rounded-full flex items-center justify-center transition-transform {{ $isActive ? 'scale-110' : '' }}">
                                @if($category->image)
                                    <img src="@storageUrl($category->image)" class="w-9 h-9 object-contain">
                                @else
                                    <div class="w-9 h-9 bg-gray-100 rounded-full"></div>
                                @endif
                            </div>
                            <span class="text-[10px] md:text-[11px] mt-1 font-medium leading-tight">{{ $category->name }}</span>
                        </a>
                    @endforeach
                </div>
            </aside>

            {{-- Main Content Area --}}
            <main id="main-scroll-container" class="flex-1 overflow-y-auto custom-scroll px-1 pb-2">
                
                {{-- 1. Sort & Count Header (Brand Aware) --}}
                <div class="sticky top-0 z-20 bg-white/95 backdrop-blur-md border-b border-gray-100 mb-1">
                    <div class="py-2 px-3 flex items-center justify-between">
                        <h1 class="text-sm font-black text-gray-900 uppercase tracking-tighter flex items-center gap-2">
                            @if($selectedBrand)
                                <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded text-[10px] font-black mr-1 underline decoration-2 underline-offset-4 decoration-green-400">BRAND :</span>
                                <span class="text-green-600">{{ $selectedBrand->name }}</span>
                            @elseif($filters['category'])
                                <span class="bg-gray-100 text-gray-700 px-2 py-0.5 rounded text-[10px] font-black mr-1 uppercase">{{ str_replace('-', ' ', $filters['category']) }}</span>
                            @else
                                <span class="text-gray-800">ALL COLLECTIONS</span>
                            @endif
                            <span class="text-gray-400 font-bold ml-1 text-[11px] lowercase tracking-normal">({{ $products->total() }})</span>
                        </h1>
                        
                        <form id="sort-form" method="GET" action="{{ route('shop.index') }}">
                            <select id="sort-select" name="sort" class="text-[11px] font-black border-none bg-gray-100/50 rounded-full px-4 py-1.5 focus:ring-1 focus:ring-green-400 transition-all outline-none cursor-pointer">
                                <option value="">SORT BY</option>
                                <option value="price_low_high" {{ request('sort') == 'price_low_high' ? 'selected' : '' }}>PRICE: LOW TO HIGH</option>
                                <option value="price_high_low" {{ request('sort') == 'price_high_low' ? 'selected' : '' }}>PRICE: HIGH TO LOW</option>
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>NEWEST DEALS</option>
                            </select>
                            {{-- PERSIST ALL FILTERS --}}
                            @foreach(request()->except('page', 'sort') as $name => $value)
                                <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                            @endforeach
                        </form>
                    </div>

                    {{-- 1b. Horizontal Brands QuickFilter --}}
                    <div class="flex items-center gap-3 px-3 pb-2 overflow-x-auto custom-scroll no-scrollbar scroll-smooth">
                        <a href="{{ route('shop.index', array_merge(request()->except('page', 'brand'), ['brand' => null])) }}" 
                           class="whitespace-nowrap px-3 py-1 rounded-full text-[10px] font-bold border transition-all {{ empty($filters['brand']) ? 'bg-green-600 text-white border-green-600 shadow-sm' : 'bg-gray-50 text-gray-500 border-gray-100 hover:bg-gray-100 hover:text-gray-700' }}">
                            ALL BRANDS
                        </a>
                        @foreach($brands->take(15) as $brand)
                            @php $isBrandActive = ($filters['brand'] ?? null) == $brand->slug; @endphp
                            <a href="{{ route('shop.index', array_merge(request()->except('page', 'brand'), ['brand' => $brand->slug])) }}" 
                               class="flex items-center gap-2 whitespace-nowrap px-3 py-1 rounded-full text-[10px] font-bold border transition-all {{ $isBrandActive ? 'bg-white text-green-600 border-green-200 shadow-md ring-1 ring-green-100 scale-105' : 'bg-white text-gray-500 border-gray-100 hover:border-green-100 hover:text-green-600 shadow-sm' }}">
                                @if($brand->logo)
                                    <img src="@storageUrl($brand->logo)" class="w-4 h-4 object-contain {{ $isBrandActive ? '' : 'grayscale opacity-70 group-hover:grayscale-0' }}">
                                @endif
                                {{ strtoupper($brand->name) }}
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- 2. Main Product Grid --}}
                <div id="product-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-2">
                    @include('shop.partials.product_list', ['products' => $products])
                </div>

                {{-- 3. Loading Spinner (Trigger for Infinite Scroll) --}}
                <div id="loading-spinner" class="py-10 flex justify-center {{ $products->hasMorePages() ? '' : 'hidden' }}">
                    <div class="animate-spin w-8 h-8 border-4 border-green-500 border-t-transparent rounded-full"></div>
                </div>

                {{-- 4. Featured Products Section (Hidden until End of Scroll) --}}
                <div id="featured-section-end" class="{{ $products->hasMorePages() ? 'hidden' : '' }}">
                   
                    @if($featuredProducts->isNotEmpty())
                        <section class="mt-2 pt-2 border-t border-gray-100">
                            <div class="flex items-center justify-between mb-1 px-1">
                                <div>
                                    <h2 class="text-sm font-black uppercase tracking-tighter text-gray-900">Featured Items</h2>
                                    <p class="text-[10px] text-gray-400 font-medium">Handpicked for you</p>
                                </div>
                                <a href="#" class="text-xs font-bold text-green-600 bg-green-50 px-3 py-1 rounded-full hover:bg-green-100 transition-colors">View All</a>
                            </div>

                            {{-- Same Grid as Main Content --}}
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-2">
                                @foreach ($featuredProducts as $product)
                                    <div class="group relative bg-white rounded-xl border border-gray-100 hover:border-green-200 hover:shadow-sm transition-all p-2 flex flex-col overflow-hidden">
                                        
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
                                            <h3 class="text-sm font-bold text-gray-800 leading-tight mt-1 line-clamp-2">{{ $product->name }}</h3>

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
                                                @if ($product->discount_price && $product->discount_price > 0)
                                                    <span class="text-sm font-black text-gray-900">₹{{ $product->discount_price }}</span>
                                                    <span class="text-[9px] text-gray-400 line-through">₹{{ $product->price }}</span>
                                                @else
                                                    <span class="text-sm font-black text-gray-900">₹{{ $product->price }}</span>
                                                @endif
                                            </div>
                                             {{-- ADD BUTTON --}}
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
                            </div>
                        </section>
                    @endif
                </div>

            </main>
        </div>
    </div>

    <script>
        window.wishlistToggleUrl = "{{ route('wishlist.toggle', ':id') }}";
        window.CartToggleUrl = "{{ route('account.cart.toggle', ':id') }}";

        document.addEventListener('DOMContentLoaded', function () {
            let nextPageUrl = '{{ $products->nextPageUrl() }}';
            let isLoading = false;
            const spinner = document.getElementById('loading-spinner');
            const grid = document.getElementById('product-grid');
            const mainContainer = document.getElementById('main-scroll-container');
            const featuredSection = document.getElementById('featured-section-end');

            // 1. AJAX Sorting
            const sortSelect = document.getElementById('sort-select');
            if (sortSelect) {
                sortSelect.addEventListener('change', function() {
                    const form = document.getElementById('sort-form');
                    const url = new URL(form.action);
                    const params = new URLSearchParams(new FormData(form));
                    url.search = params.toString();

                    grid.style.opacity = '0.5';
                    fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
                    .then(res => res.json())
                    .then(data => {
                        grid.innerHTML = data.html;
                        nextPageUrl = data.next_page;
                        grid.style.opacity = '1';
                        history.pushState(null, '', url.toString());
                        
                        // Reset visibility based on new page state
                        if (nextPageUrl) {
                            spinner.classList.remove('hidden');
                            featuredSection.classList.add('hidden');
                        } else {
                            spinner.classList.add('hidden');
                            featuredSection.classList.remove('hidden');
                        }
                    });
                });
            }

            // 2. Infinite Scroll
            if (spinner && grid) {
                const observer = new IntersectionObserver((entries) => {
                    if (entries[0].isIntersecting && !isLoading && nextPageUrl) {
                        isLoading = true;
                        spinner.classList.remove('hidden');

                        fetch(nextPageUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
                        .then(res => res.json())
                        .then(data => {
                            grid.insertAdjacentHTML('beforeend', data.html);
                            nextPageUrl = data.next_page; 
                            isLoading = false;

                            if (!nextPageUrl) {
                                spinner.classList.add('hidden');
                                featuredSection.classList.remove('hidden'); // Show featured items at end
                                observer.unobserve(spinner);
                            }
                        })
                        .catch(() => isLoading = false);
                    }
                }, { 
                    root: mainContainer,
                    rootMargin: '300px' 
                });

                observer.observe(spinner);
            }
        });
    </script>
</x-layouts.site>