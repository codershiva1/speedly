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
                       class="ajax-link flex flex-col items-center p-2 mb-2 text-center transition-all {{ empty($filters['category']) ? 'category-active' : 'text-gray-500 hover:bg-gray-50' }}">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-gray-100 rounded-full flex items-center justify-center mb-1">
                            <i class="fa fa-grid-2 text-lg"></i>
                        </div>
                        <span class="text-[10px] md:text-xs font-bold leading-tight">All</span>
                    </a>

                    @foreach($categories as $category)
                        @php $isActive = ($filters['category'] ?? null) == $category->slug; @endphp
                        <a href="{{ route('shop.index', array_merge(request()->except('page', 'category'), ['category' => $category->slug])) }}"
                           class="ajax-link flex flex-col items-center p-2 mb-1 text-center transition-all {{ $isActive ? 'category-active' : 'text-gray-500 hover:bg-gray-50' }}">
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
            <main id="main-scroll-container" class="flex-1 overflow-y-auto custom-scroll px-1 pb-2 relative">
                
                {{-- Loading Overlay --}}
                <div id="products-loading" class="hidden absolute inset-0 z-30 bg-white/70 backdrop-blur-sm items-center justify-center">
                    <div class="flex flex-col items-center gap-2">
                        <div class="animate-spin w-8 h-8 border-4 border-green-500 border-t-transparent rounded-full"></div>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Filtering…</span>
                    </div>
                </div>

                {{-- 1. Sort & Count Header (Brand Aware) --}}
                <div class="sticky top-0 z-20 bg-white/95 backdrop-blur-md border-b border-gray-100 mb-1">
                    <div class="pt-2 px-3 flex flex-col">
                        <div class="flex items-center justify-between">
                            <h1 class="text-sm font-black text-gray-900 uppercase tracking-tighter flex items-center gap-2" id="results-count-header">
                                @if(isset($selectedBrands) && $selectedBrands->count() > 0)
                                    <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded text-[10px] font-black mr-1 underline decoration-2 underline-offset-4 decoration-green-400">BRAND{{ $selectedBrands->count() > 1 ? 'S' : '' }} :</span>
                                @elseif($filters['category'])
                                    <span class="bg-gray-100 text-gray-700 px-2 py-0.5 rounded text-[10px] font-black mr-1 uppercase">{{ str_replace('-', ' ', $filters['category']) }}</span>
                                @else
                                    <span class="text-gray-800">ALL COLLECTIONS</span>
                                @endif
                                <span class="text-gray-400 font-bold ml-1 text-[11px] lowercase tracking-normal">({{ $products->total() }})</span>
                            </h1>

                            <div class="flex items-center gap-2">
                                {{-- Sort & Price Dropdown Area --}}
                                @php
                                    $activeSorts = array_filter(explode(',', request('sort', '')));
                                    $sortOptions = [
                                        'latest'       => '🕐 Latest Deals',
                                        'price_asc'    => '↑ Price: Low → High',
                                        'price_desc'   => '↓ Price: High → Low',
                                        'range_0_99'   => '₹0 – ₹99 (Budget)',
                                        'range_99_199' => '₹99 – ₹199',
                                        'range_199_299'=> '₹199 – ₹299',
                                        'range_299_499'=> '₹299 – ₹499',
                                        'range_499_999'=> '₹499 – ₹999',
                                        'range_999_plus'=> '₹999+ (Premium)',
                                    ];
                                @endphp
                                
                                <div class="relative flex-shrink-0 flex justify-end">
                                    <button type="button" onclick="document.getElementById('price-dropdown').classList.toggle('hidden')" class="border border-gray-200 bg-white rounded-full flex items-center justify-center gap-1.5 px-3 py-1.5 text-[10px] font-bold text-gray-700 shadow-sm relative hover:bg-gray-50 transition-colors">
                                        <i class="fa fa-filter text-green-600"></i> Price
                                        @if(count($activeSorts) > 0)
                                            <a href="{{ route('shop.index', request()->except('page', 'sort')) }}" class="ajax-link absolute -top-1.5 -right-1.5 bg-red-500 hover:bg-red-600 border border-white text-white w-4 h-4 rounded-full flex items-center justify-center text-[8px] font-black z-10 shadow-md" title="Reset Price Filters">
                                                {{ count($activeSorts) }}
                                            </a>
                                        @endif
                                        <i class="fa fa-chevron-down text-[8px] text-gray-400"></i>
                                    </button>
                                    
                                    {{-- Custom Dropdown Menu --}}
                                    <div id="price-dropdown" class="absolute top-8 right-0 w-48 bg-white border border-gray-100 shadow-xl rounded-xl z-50 hidden py-2 max-h-64 overflow-y-auto custom-scroll">
                                        @foreach($sortOptions as $key => $label)
                                            @php 
                                                $isActive = in_array($key, $activeSorts); 
                                                if ($isActive) {
                                                    $newSortSlugs = array_diff($activeSorts, [$key]);
                                                } else {
                                                    $newSortSlugs = $activeSorts;
                                                    $newSortSlugs[] = $key;
                                                }
                                                $newSortStr = implode(',', array_filter($newSortSlugs));
                                            @endphp
                                            <a href="{{ route('shop.index', array_merge(request()->except('page', 'sort'), ['sort' => $newSortStr])) }}" 
                                               class="ajax-link flex items-center px-4 py-2 hover:bg-green-50 transition-colors group">
                                                <div class="w-3.5 h-3.5 border rounded flex items-center justify-center mr-2 transition-colors {{ $isActive ? 'bg-green-500 border-green-500' : 'border-gray-300' }}">
                                                    @if($isActive)<i class="fa fa-check text-white text-[8px]"></i>@endif
                                                </div>
                                                <span class="text-[10px] font-bold {{ $isActive ? 'text-gray-900' : 'text-gray-600 group-hover:text-gray-800' }}">{{ $label }}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- 1b. Horizontal Brands QuickFilter --}}
                        <div class="flex items-center mt-2 pb-1">
                            @if($brands && $brands->count() > 0)
                                <div class="flex items-center gap-2 overflow-x-auto custom-scroll no-scrollbar scroll-smooth w-full">
                                    @php
                                        $activeBrandSlugs = array_filter(explode(',', request('brand', '')));
                                    @endphp
                                    
                                    @if(count($activeBrandSlugs) > 0)
                                        <a href="{{ route('shop.index', request()->except('page', 'brand')) }}" 
                                           class="ajax-link flex-shrink-0 text-[10px] font-black text-red-600 bg-red-50 border border-red-100 px-3 py-1.5 rounded-full hover:bg-red-100 transition-all flex items-center gap-1.5 shadow-sm">
                                            <i class="fa fa-times-circle"></i> Reset Brands
                                        </a>
                                    @else
                                        <a href="{{ route('shop.index', array_merge(request()->except('page', 'brand'), ['brand' => null])) }}" 
                                           class="ajax-link flex-shrink-0 whitespace-nowrap px-3 py-1.5 rounded-full text-[10px] font-bold border transition-all bg-green-600 text-white border-green-600 shadow-sm">
                                            ALL BRANDS
                                        </a>
                                    @endif
                                    
                                    @foreach($Brands ?? $brands->take(15) as $brand)
                                        @php 
                                            $isBrandActive = in_array($brand->slug, $activeBrandSlugs); 
                                            if ($isBrandActive) {
                                                $newBrandSlugs = array_diff($activeBrandSlugs, [$brand->slug]);
                                            } else {
                                                $newBrandSlugs = $activeBrandSlugs;
                                                $newBrandSlugs[] = $brand->slug;
                                            }
                                            $newBrandStr = implode(',', array_filter($newBrandSlugs));
                                        @endphp
                                        <a href="{{ route('shop.index', array_merge(request()->except('page', 'brand'), ['brand' => $newBrandStr])) }}" 
                                           class="ajax-link flex-shrink-0 flex items-center gap-1.5 whitespace-nowrap px-3 py-1.5 rounded-full text-[10px] font-bold border transition-all {{ $isBrandActive ? 'bg-white text-green-600 border-green-200 shadow-sm ring-1 ring-green-100 scale-105' : 'bg-white text-gray-500 border-gray-100 hover:border-green-100 hover:text-green-600 shadow-sm' }}">
                                            @if($brand->logo)
                                                <img src="@storageUrl($brand->logo)" class="w-4 h-4 object-contain {{ $isBrandActive ? '' : 'grayscale opacity-70 group-hover:grayscale-0' }}">
                                            @endif
                                            {{ strtoupper($brand->name) }}
                                            @if($isBrandActive)
                                                <i class="fa fa-times ml-1 text-xs opacity-60 hover:opacity-100"></i>
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- 2. Main Product Grid --}}
                <div id="product-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-2">
                    @include('shop.partials.product_list', ['products' => $products])
                </div>

                {{-- 3. Loading Spinner (Trigger for Infinite Scroll) --}}
                <div id="loading-spinner" data-next-page="{{ $products->nextPageUrl() }}" class="py-10 flex justify-center {{ $products->hasMorePages() ? '' : 'hidden' }}">
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
            const loadingOverlay = document.getElementById('products-loading');

            // 1. AJAX Filtering (Category, Brand, Sort via .ajax-link)
            document.body.addEventListener('click', function(e) {
                const link = e.target.closest('.ajax-link');
                if (link) {
                    e.preventDefault();
                    const url = link.href;

                    // Show loading overlay
                    if(loadingOverlay) loadingOverlay.classList.remove('hidden');
                    if(loadingOverlay) loadingOverlay.classList.add('flex');
                    if(grid) grid.style.opacity = '0.5';

                    fetch(url) // Fetch full HTML page
                    .then(res => res.text())
                    .then(html => {
                        const doc = new DOMParser().parseFromString(html, 'text/html');

                        // Replace dynamic parts
                        document.querySelector('aside').innerHTML = doc.querySelector('aside').innerHTML;
                        const thisSticky = document.querySelector('.sticky.top-0');
                        const newSticky = doc.querySelector('.sticky.top-0');
                        if (thisSticky && newSticky) {
                            thisSticky.innerHTML = newSticky.innerHTML;
                        }
                        const newGrid = doc.getElementById('product-grid');
                        if (grid && newGrid) {
                            grid.innerHTML = newGrid.innerHTML;
                            grid.style.opacity = '1';
                        }
                        
                        // Update infinite scroll params
                        const newSpinner = doc.getElementById('loading-spinner');
                        if (newSpinner) {
                            nextPageUrl = newSpinner.getAttribute('data-next-page');
                            
                            // Replace spinner definition to update classes
                            if (spinner) {
                                spinner.className = newSpinner.className;
                                spinner.setAttribute('data-next-page', nextPageUrl || '');
                            }
                        }

                        // Toggle visibility of spinner and featured section
                        const newFeatured = doc.getElementById('featured-section-end');
                        if (featuredSection && newFeatured) {
                            featuredSection.className = newFeatured.className;
                            featuredSection.innerHTML = newFeatured.innerHTML;
                        }
                        
                        if (nextPageUrl) {
                            observer.observe(spinner); // Re-observe in case it was unobserved
                        }

                    })
                    .catch(err => { console.error(err); })
                    .finally(() => {
                        if(loadingOverlay) loadingOverlay.classList.add('hidden');
                        if(loadingOverlay) loadingOverlay.classList.remove('flex');
                        history.pushState(null, '', url);
                    });
                }
            });

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