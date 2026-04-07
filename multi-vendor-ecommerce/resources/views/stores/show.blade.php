<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

    /* Sort pill active state */
    .sort-pill.active {
        background-color: #059669;
        color: #fff;
        border-color: #059669;
    }
    .sort-pill {
        transition: all 0.2s ease;
        white-space: nowrap;
    }
    .sort-pill:hover:not(.active) {
        background-color: #f0fdf4;
        border-color: #86efac;
    }

    /* Loading overlay */
    #products-loading {
        display: none;
    }
    #products-loading.show {
        display: flex;
    }
</style>

<x-layouts.site :title="__('₹'.$price.' Store')">

    {{-- ===================== TOP BANNER STRIP ===================== --}}
    @if($topBanners->isNotEmpty() && !$search)
        <div class="px-3 pt-2 pb-1">
            <div class="flex gap-2 overflow-x-auto no-scrollbar snap-x snap-mandatory">
                @foreach($topBanners as $banner)
                    <div class="min-w-[calc(50%-4px)] md:min-w-[calc(33.33%-6px)] flex-shrink-0 snap-start
                                h-24 sm:h-28 md:h-32 rounded-xl overflow-hidden border border-gray-100 shadow-sm bg-gray-100">
                        <img src="@storageUrl($banner->banner_image)"
                             class="w-full h-full object-cover"
                             alt="Promotion">
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- ===================== STORE HEADER (Title + Search + Sort) ===================== --}}
    <div id="store-sticky-bar"
         class="bg-white border-b border-gray-100 px-4 py-3 sticky top-0 z-[200] backdrop-blur-md bg-white/95
                transition-shadow duration-300">

        {{-- Row 1: Title + Search --}}
        <div class="flex items-center gap-3">
            {{-- Store Title --}}
            <div class="flex-shrink-0">
                <h1 class="text-lg font-black text-gray-900 italic tracking-tight leading-none">
                    ₹{{ $price }} <span class="text-green-600">Store</span>
                </h1>
                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest leading-none mt-0.5 hidden sm:block">
                    Under Budget
                </p>
            </div>

            {{-- Search Box --}}
            <div class="flex-1 relative">
                <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm pointer-events-none"></i>
                <input
                    id="store-search"
                    type="text"
                    value="{{ $search }}"
                    placeholder="Search in ₹{{ $price }} store…"
                    autocomplete="off"
                    class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-9 pr-4 py-2 text-sm font-medium
                           focus:outline-none focus:border-green-400 focus:bg-white transition-all duration-200"
                >
                {{-- Spinner --}}
                <svg id="search-spinner" class="hidden animate-spin absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-green-500"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
            </div>
        </div>

        {{-- Row 2: Sort Pills --}}
        <div class="flex gap-1.5 overflow-x-auto no-scrollbar mt-2.5 pb-0.5">
            @php
                $sortOptions = [
                    'default'      => '🕐 Latest',
                    'price_asc'    => '↑ Low → High',
                    'price_desc'   => '↓ High → Low',
                    'range_0_99'   => '₹0 – ₹99',
                    'range_99_199' => '₹99 – ₹199',
                    'range_199_299'=> '₹199 – ₹299',
                    'range_299_499'=> '₹299 – ₹499',
                    'range_499_999'=> '₹499 – ₹999',
                    'range_999_plus'=> '₹999+',
                ];
            @endphp
            @foreach($sortOptions as $key => $label)
                <button
                    data-sort="{{ $key }}"
                    class="sort-pill flex-shrink-0 text-[10px] font-black uppercase tracking-wider
                           px-3 py-1.5 rounded-full border border-gray-200 text-gray-600
                           {{ $sort === $key ? 'active' : '' }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>
    </div>

    {{-- ===================== PRODUCT LISTINGS ===================== --}}
    <div id="products-wrapper" class="relative min-h-[200px]">

        {{-- Loading Overlay --}}
        <div id="products-loading"
             class="absolute inset-0 z-20 bg-white/70 backdrop-blur-sm items-center justify-center">
            <div class="flex flex-col items-center gap-2">
                <svg class="animate-spin w-8 h-8 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Filtering…</span>
            </div>
        </div>

        {{-- Products Grid (swapped out by AJAX) --}}
        <div id="products-grid">
            @include('partials.store-products', [
                'products'  => $products,
                'inlineAds' => $inlineAds,
            ])
        </div>
    </div>

    {{-- ===================== FLOATING CART ===================== --}}
    @if($cartCount > 0)
        <div id="floating-cart"
             onclick="window.location='{{ route('account.cart.index') }}'"
             class="floatingcart fixed bottom-20 left-2/4 -translate-x-1/2
                    bg-green-600 text-white rounded-full px-3 py-2.5
                    flex items-center gap-3 shadow-2xl cursor-pointer z-50 transition-all duration-300">
            <div class="relative">
                <i class="bi bi-bag-check-fill text-2xl"></i>
                <span class="absolute -top-2 -right-2 bg-white text-green-600 text-[10px] font-black
                             w-5 h-5 rounded-full flex items-center justify-center shadow-sm">
                    {{ $cartCount }}
                </span>
            </div>
            <span class="h-4 w-px bg-green-300"></span>
            <div class="flex flex-col">
                <span class="text-[10px] font-bold uppercase tracking-tighter opacity-80 leading-none">View Cart</span>
                <span class="text-sm font-bold">₹<span class="cartTotal">{{ number_format($cartTotal) }}</span></span>
            </div>
            <i class="bi bi-chevron-right text-xs opacity-50"></i>
        </div>
    @endif

    <script>
        window.wishlistToggleUrl = "{{ route('wishlist.toggle', ':id') }}";
        window.CartToggleUrl     = "{{ route('account.cart.toggle', ':id') }}";

        (function () {
            const AJAX_URL  = window.location.pathname; // e.g. /stores/999
            const MIN_CHARS = 2;

            let currentSearch = '{{ addslashes($search) }}';
            let currentSort   = '{{ addslashes($sort) }}';
            let debounceTimer = null;

            const searchInput   = document.getElementById('store-search');
            const searchSpinner = document.getElementById('search-spinner');
            const productsGrid  = document.getElementById('products-grid');
            const loadingOverlay= document.getElementById('products-loading');
            const sortPills     = document.querySelectorAll('.sort-pill');

            // ── Sticky shadow on scroll ─────────────────────────────────
        const stickyBar = document.getElementById('store-sticky-bar');
        const sentinel  = document.createElement('div');
        sentinel.style.cssText = 'position:absolute;top:0;height:1px;width:1px;pointer-events:none;';
        stickyBar.parentElement.insertBefore(sentinel, stickyBar);

        const observer = new IntersectionObserver(([entry]) => {
            stickyBar.classList.toggle('shadow-md', !entry.isIntersecting);
        }, { threshold: 1 });
        observer.observe(sentinel);

        // ── Fetch products via AJAX ──────────────────────────────────
            function fetchProducts(q, sort) {
                const params = new URLSearchParams({ q, sort });

                // Show loading state
                loadingOverlay.classList.add('show');
                searchSpinner.classList.remove('hidden');

                fetch(`${AJAX_URL}?${params}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    }
                })
                .then(r => r.json())
                .then(data => {
                    productsGrid.innerHTML = data.html;
                    // Re-init cart & wishlist listeners (they use event delegation so this is automatic)
                })
                .catch(err => console.error('Store filter error:', err))
                .finally(() => {
                    loadingOverlay.classList.remove('show');
                    searchSpinner.classList.add('hidden');
                });
            }

            // ── Search input handler (debounced, min 2 chars) ─────────────
            searchInput.addEventListener('input', function () {
                const val = this.value.trim();
                clearTimeout(debounceTimer);

                if (val.length === 0 || val.length >= MIN_CHARS) {
                    debounceTimer = setTimeout(() => {
                        currentSearch = val;
                        fetchProducts(currentSearch, currentSort);
                    }, 400);
                }
            });

            // ── Sort pill handler ─────────────────────────────────────────
            sortPills.forEach(pill => {
                pill.addEventListener('click', function () {
                    sortPills.forEach(p => p.classList.remove('active'));
                    this.classList.add('active');
                    currentSort = this.dataset.sort;
                    fetchProducts(currentSearch, currentSort);
                });
            });
        })();
    </script>

</x-layouts.site>
