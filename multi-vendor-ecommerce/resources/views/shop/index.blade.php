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
                                    <img src="{{ asset('public/storage/' . $category->image) }}" class="w-9 h-9 object-contain">
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
                
                {{-- 1. Sort & Count Header --}}
                <div class="sticky top-0 z-20 bg-white/90 backdrop-blur-md py-1 flex items-center justify-between border-b border-gray-50 mb-1">
                    <h1 class="text-sm font-bold text-gray-800 px-2">
                        {{ $filters['category'] ?? 'All Products' }} 
                        <span class="text-gray-400 font-normal ml-1">({{ $products->total() }})</span>
                    </h1>
                    
                    <form id="sort-form" method="GET" action="{{ route('shop.index') }}">
                        <select id="sort-select" name="sort" class="text-[11px] font-bold border-none bg-gray-50 rounded-lg px-2 py-1 focus:ring-0">
                            <option value="">Sort</option>
                            <option value="price_low_high" {{ request('sort') == 'price_low_high' ? 'selected' : '' }}>Price ↑</option>
                            <option value="price_high_low" {{ request('sort') == 'price_high_low' ? 'selected' : '' }}>Price ↓</option>
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Newest</option>
                        </select>
                        @foreach(request()->except('page', 'sort') as $name => $value)
                            <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                        @endforeach
                    </form>
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
                                    <div class="group relative bg-white rounded-xl border border-gray-100 hover:border-green-200 hover:shadow-sm transition-all p-2 flex flex-col">
                                        
                                        {{-- Featured Badge --}}
                                        <!-- <div class="absolute top-2 left-2 z-10">
                                            <span class="bg-indigo-600 text-white text-[8px] font-black px-1.5 py-0.5 rounded-md shadow-sm">FEATURED</span>
                                        </div> -->

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