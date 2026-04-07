<x-layouts.site :title="$title">
    <div class="bg-gray-50 min-h-screen pb-20">
        {{-- Loading Overlay --}}
        <div id="products-loading" class="hidden fixed inset-0 z-[60] bg-white/70 backdrop-blur-sm items-center justify-center">
            <div class="flex flex-col items-center gap-2">
                <div class="animate-spin w-8 h-8 border-4 border-green-500 border-t-transparent rounded-full"></div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Filtering…</span>
            </div>
        </div>

        {{-- Sticky Header (Title, Sort, Brands) --}}
        <div class="sticky top-0 z-30 bg-white/95 backdrop-blur-md border-b border-gray-100 mb-4 px-2 sm:px-4 shadow-sm transition-all pb-1" id="catalog-sticky-header">
            <div class="max-w-7xl mx-auto flex flex-col gap-2 pt-2">
                
                {{-- Row 1: Title, Filters & Back Button --}}
                <div class="flex items-center justify-between">
                    <h1 class="text-lg font-black text-gray-800 tracking-tight" id="results-title">
                        @if(isset($selectedBrands) && $selectedBrands->count() > 0)
                            <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded text-[10px] font-black mr-1 underline decoration-2 underline-offset-4 decoration-green-400">BRAND{{ $selectedBrands->count() > 1 ? 'S' : '' }} :</span>
                        @endif
                        {{ $title }}
                        @if($isFiltered && $products)
                            <span class="text-gray-400 font-bold ml-1 text-xs lowercase tracking-normal">({{ $products->total() }})</span>
                        @endif
                    </h1>
                    
                    <div class="flex items-center gap-2">
                        @if($isFiltered)
                            <a href="{{ route('products.all') }}" class="ajax-link text-[10px] font-bold text-gray-500 flex items-center bg-gray-100 px-3 py-1.5 rounded-full hover:bg-gray-200 transition-colors">
                                <i class="fa fa-arrow-left mr-1"></i> Catalog
                            </a>
                        @endif

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
                                    <a href="{{ route('products.all', request()->except('page', 'sort')) }}" class="ajax-link absolute -top-1.5 -right-1.5 bg-red-500 hover:bg-red-600 border border-white text-white w-4 h-4 rounded-full flex items-center justify-center text-[8px] font-black z-10 shadow-md" title="Reset Price Filters">
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
                                    <a href="{{ route('products.all', array_merge(request()->except('page', 'sort'), ['sort' => $newSortStr])) }}" 
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

                {{-- Row 2: Unified Brands Row --}}
                <div class="flex items-center mt-2 py-1">
                    {{-- Brands Scroll Area --}}
                    @if($brands && $brands->count() > 0)
                        <div class="flex items-center gap-2 overflow-x-auto no-scrollbar scroll-smooth w-full py-1">
                            @php
                                $activeBrandSlugs = array_filter(explode(',', request('brand', '')));
                            @endphp
                            
                            @if(count($activeBrandSlugs) > 0)
                                <a href="{{ route('products.all', request()->except('page', 'brand')) }}" 
                                   class="ajax-link flex-shrink-0 text-[10px] font-black text-red-600 bg-red-50 border border-red-100 px-3 py-1.5 rounded-full hover:bg-red-100 transition-all flex items-center gap-1.5 shadow-sm">
                                    <i class="fa fa-times-circle"></i> Reset Brands
                                </a>
                            @else
                                <a href="{{ route('products.all', array_merge(request()->except('page', 'brand'), ['brand' => null])) }}" 
                                   class="ajax-link flex-shrink-0 whitespace-nowrap px-3 py-1.5 rounded-full text-[10px] font-bold border transition-all bg-green-600 text-white border-green-600 shadow-sm">
                                    ALL BRANDS
                                </a>
                            @endif
                            
                            @foreach($brands as $brand)
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
                                <a href="{{ route('products.all', array_merge(request()->except('page', 'brand'), ['brand' => $newBrandStr])) }}" 
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

        <div class="max-w-7xl mx-auto px-2 sm:px-4">
            @if($isFiltered)
                {{-- FLAT GRID VIEW (When View All/Filter is clicked) --}}
                <div id="product-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-2">
                    @include('products.partials.flat_grid', ['products' => $products])
                </div>

                {{-- Loading Spinner (Trigger for Infinite Scroll) --}}
                <div id="loading-spinner" data-next-page="{{ $products->nextPageUrl() }}" class="py-10 flex justify-center {{ $products->hasMorePages() ? '' : 'hidden' }}">
                    <div class="animate-spin w-8 h-8 border-4 border-green-500 border-t-transparent rounded-full"></div>
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

                                    <a href="{{ route('shop.show', $product->slug) }}" class="block mb-2">
                                        <div class="w-full h-32 rounded-lg overflow-hidden flex items-center justify-center bg-gray-50/50">
                                            @php $img = $product->images->first(); @endphp
                                            <img src="@storageUrl($img ? $img->path : 'placeholder.png')" 
                                                 class="w-full h-full object-contain p-2 group-hover:scale-105 transition-transform" 
                                                 alt="{{ $product->name }}">
                                        </div>
                                    </a>

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
                        </div>
                    </section>
                @endforeach
                <div id="product-grid" class="hidden"></div>
                <div id="loading-spinner" class="hidden" data-next-page=""></div>
            @endif
        </div>
    </div>

    {{-- SCRIPTS FOR AJAX AND INFINITE SCROLL --}}
    <script>
        window.wishlistToggleUrl = "{{ route('wishlist.toggle', ':id') }}";
        window.CartToggleUrl = "{{ route('account.cart.toggle', ':id') }}";

        document.addEventListener('DOMContentLoaded', function () {
            let nextPageUrl = document.getElementById('loading-spinner')?.getAttribute('data-next-page') || '';
            let isLoading = false;
            const spinner = document.getElementById('loading-spinner');
            const grid = document.getElementById('product-grid');
            const loadingOverlay = document.getElementById('products-loading');

            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting && !isLoading && nextPageUrl) {
                    isLoading = true;
                    if(spinner) spinner.classList.remove('hidden');

                    fetch(nextPageUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
                    .then(res => res.json())
                    .then(data => {
                        if(grid) grid.insertAdjacentHTML('beforeend', data.html);
                        nextPageUrl = data.next_page; 
                        isLoading = false;

                        if(spinner) spinner.setAttribute('data-next-page', nextPageUrl || '');

                        if (!nextPageUrl) {
                            if(spinner) spinner.classList.add('hidden');
                            observer.unobserve(spinner);
                        }
                    })
                    .catch(() => isLoading = false);
                }
            }, { 
                rootMargin: '300px' 
            });

            if (spinner && nextPageUrl) {
                observer.observe(spinner);
            }

            // 1. AJAX Filtering (Category, Brand, Sort via .ajax-link)
            document.body.addEventListener('click', function(e) {
                const link = e.target.closest('.ajax-link');
                if (link) {
                    e.preventDefault();
                    executeAjaxFilter(link.href);
                }
            });

            // 1b. AJAX Dropdown change logic
            document.body.addEventListener('change', function(e) {
                if (e.target.classList.contains('ajax-link-select')) {
                    e.preventDefault();
                    executeAjaxFilter(e.target.value);
                }
            });

            // Reusable AJAX execution logic
            function executeAjaxFilter(url) {
                if(loadingOverlay) loadingOverlay.classList.remove('hidden');
                if(loadingOverlay) loadingOverlay.classList.add('flex');
                if(grid) grid.style.opacity = '0.5';

                fetch(url) // Fetch full HTML page
                .then(res => res.text())
                .then(html => {
                    const doc = new DOMParser().parseFromString(html, 'text/html');

                    // Replace sticky header
                    const thisSticky = document.getElementById('catalog-sticky-header');
                    const newSticky = doc.getElementById('catalog-sticky-header');
                    if (thisSticky && newSticky) {
                        thisSticky.innerHTML = newSticky.innerHTML;
                    }

                    // Replace grid or sections container
                    const thisMainContent = document.querySelector('.max-w-7xl.mx-auto.px-2.sm\\:px-4');
                    const newMainContent = doc.querySelector('.max-w-7xl.mx-auto.px-2.sm\\:px-4');
                    if (thisMainContent && newMainContent) {
                        thisMainContent.innerHTML = newMainContent.innerHTML;
                    }

                    // Re-fetch spinner and grid handles after replacement
                    const newSpinner = document.getElementById('loading-spinner');
                    if (newSpinner) {
                        nextPageUrl = newSpinner.getAttribute('data-next-page');
                        if (nextPageUrl) {
                            observer.observe(newSpinner);
                        }
                    }
                })
                .catch(err => { console.error(err); })
                .finally(() => {
                    window.scrollTo(0, 0); // scroll to top on filter change
                    if(loadingOverlay) loadingOverlay.classList.add('hidden');
                    if(loadingOverlay) loadingOverlay.classList.remove('flex');
                    history.pushState(null, '', url);
                });
            }
        });
    </script>
</x-layouts.site>