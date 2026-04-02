<x-layouts.site :title="__('Search')">

<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { 
        -ms-overflow-style: none; 
        scrollbar-width: none; 
    }
</style>

<div class=" mx-auto px-1 sm:px-4 lg:px-4 py-1 space-y-8">

    {{-- RESULTS --}}
    <div id="searchResults" class="mt-6 space-y-8"></div>

</div>

<script>
    window.isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
</script>


<script>
   window.APP_URL = "{{ url('/') }}";

const input = document.getElementById('mainSearchInput');
const resultsBox = document.getElementById('searchResults');

let debounceTimer = null;

function fetchSearchResults(query = '') {
    fetch(`${window.APP_URL}/api/search?q=${encodeURIComponent(query)}`)
        .then(res => res.json())
        .then(data => renderResults(data));
}

// 2. ADD THIS: Trigger the fetch as soon as the page is ready
document.addEventListener('DOMContentLoaded', function() {
    fetchSearchResults(''); // Fetch defaults immediately
});

input.addEventListener('input', function () {
    let query = this.value.trim();

    clearTimeout(debounceTimer);

    // If query is empty, show default results
    if (query.length === 0) {
        fetchSearchResults(''); 
        return;
    }

    // If query is too short, do nothing (wait for more letters)
    if (query.length < 2) {
        return;
    }

    debounceTimer = setTimeout(() => {
        fetchSearchResults(query);
    }, 300);
});

function renderResults(data) {
    let html = '';

    // Determine the titles based on the is_default flag from your controller
    let categoryHeading = data.is_default ? 'Popular Categories' : 'Categories';
    let productHeading = data.is_default ? 'Trending Products' : 'Products';

    // ---------- CATEGORIES ----------
    if (data.categories.length) {
        html += `
            <section>
                <h3 class="text-lg font-semibold mb-3">${categoryHeading}</h3>
                <div class="flex gap-3 overflow-x-auto pb-2 no-scrollbar">
        `;

        data.categories.forEach(cat => {
            html += `
                <a href="${window.APP_URL}/shop?category=${cat.slug}"
                   class="min-w-[130px] bg-white border rounded-xl p-3 text-center hover:shadow">
                    <img src="${window.APP_URL}/storage/${cat.image}"
                         class="w-12 h-12 mx-auto object-contain">
                    <p class="mt-2 text-sm font-medium">${cat.name}</p>
                </a>
            `;
        });

        html += `
                </div>
            </section>
        `;
    }

    // ---------- PRODUCTS ----------
    if (data.products.length) {
        html += `
            <section>
                <h3 class="text-lg font-semibold mb-3">${productHeading}</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
        `;

        data.products.forEach(product => {

            let image = product.image
                ? `${window.APP_URL}/storage/uploads/products/1/image3.png`
                : 'storage/uploads/products/1/image3.png';

            let wishlistIcon = product.in_wishlist
                ? 'text-red-500'
                : 'text-gray-400';

            let cartBtnText = product.in_cart ? 'ADDED' : 'ADD';
            let cartBtnClass = product.in_cart
                ? 'bg-green-100 text-green-600'
                : 'text-green-600 hover:bg-green-50';

            html += `
            <div class="relative bg-white rounded-xl border border-gray-200 hover:shadow-md transition-all p-2 flex flex-col overflow-hidden">

                <!-- STOCK SCARCITY (DIAGONAL RIBBON) -->
                ${
                    product.stock_quantity > 0 && product.stock_quantity <= 10
                    ? `<div class="absolute -right-[34px] top-[14px] w-[140px] h-[24px] bg-[#1a7a1a] text-white
                        text-[9px] font-black tracking-widest flex items-center justify-center rotate-45 z-1
                        shadow-sm border-y border-white/20 uppercase" style="box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                        ${product.stock_quantity} LEFT
                    </div>`
                    : ''
                }

                <!-- DISCOUNT BADGE -->
                ${
                    product.discount_price && product.price > 0
                    ? `<div class="absolute top-2 left-2 z-10 bg-green-600 text-white text-[9px] font-bold px-1.5 py-0.5 rounded shadow-sm">
                        ${Math.round(((product.price - product.discount_price) / product.price) * 100)}% OFF
                    </div>`
                    : ''
                }

                <!-- Wishlist -->
                ${
                    window.isLoggedIn
                    ? `<button
                            class="absolute top-1 right-1 z-20 w-7 h-7 flex items-center justify-center
                                rounded-full bg-white shadow-sm wishlist-btn hover:scale-105 transition"
                            data-product-id="${product.id}">
                            <i class="fa fa-heart ${wishlistIcon} text-[10px]"></i>
                    </button>`
                    : `<a href="${window.APP_URL}/login"
                            class="absolute top-1 right-1 z-20 w-7 h-7 flex items-center
                                justify-center rounded-full bg-white shadow-sm">
                            <i class="fa fa-heart text-gray-400 text-[10px]"></i>
                    </a>`
                }

                <!-- Image -->
                <a href="${window.APP_URL}/product/${product.slug}">
                    <div class="w-full h-36 rounded-lg flex items-center justify-center">
                        <img src="${image}" class="w-full h-full object-contain p-2">
                    </div>
                </a>

                <!-- Info -->
                <div class="mt-3 flex-1">
                    <span class="inline-flex items-center gap-1 bg-orange-50 text-yellow-900
                                text-[9px] font-bold px-2 py-0.5 rounded-full mb-1">
                        ⚡ 8 MINS
                    </span>
                    <p class="text-sm font-semibold text-gray-900 leading-tight line-clamp-1">
                        ${product.name}
                    </p>
                    
                    <!-- STAR RATINGS -->
                    <div class="flex items-center gap-1 mt-1 mb-1 opacity-90">
                        <div class="flex text-yellow-400 text-[9px] gap-0.5">
                            ${Array.from({length: 5}, (_, i) => `
                                <i class="fa${(i + 1) <= Math.round(product.avg_rating || 0) ? '-solid' : '-regular'} fa-star"></i>
                            `).join('')}
                        </div>
                        <span class="text-[9px] text-gray-500 font-medium">(${product.reviews_count || 0})</span>
                    </div>

                    ${product.size ? `<p class="text-xs text-gray-400 mt-0.5">${product.size}</p>` : ''}
                </div>

                <!-- Price & Cart -->
                <div class="mt-3 flex items-center justify-between">
                    <div class="flex flex-col leading-tight">
                        ${
                            product.discount_price && product.discount_price > 0
                                ? `<span class="text-base font-bold text-gray-900">₹${product.discount_price}</span>
                                <span class="line-through text-xs text-gray-400">₹${product.price}</span>`
                                
                                : `<span class="text-base font-bold text-gray-900">₹${product.price}</span>`
                        }
                    </div>

                    ${
                        window.isLoggedIn
                        ? `<button
                                class="cart-btn px-2 py-1 border border-green-600 rounded-lg
                                    text-xs font-bold ${cartBtnClass}"
                                data-product-id="${product.id}">
                                ${cartBtnText}
                        </button>`
                        : `<a href="${window.APP_URL}/login"
                                class="cart-btn px-2 py-1 border border-green-600 rounded-lg
                                    text-xs font-bold text-green-600">
                                ADD
                        </a>`
                    }

                </div>
            </div>
            `;
        });

        html += `
                </div>
            </section>
        `;
    }


    // Only show "No results" if the user has typed something (not default mode)
    if (!data.categories.length && !data.products.length && !data.is_default) {
        html = `
            <div class="text-center text-gray-400 py-16">
                <p>No results found for your search 😕</p>
            </div>
        `;
    }

    resultsBox.innerHTML = html;

    // rebind
    if (typeof bindWishlistButtons === 'function') bindWishlistButtons();
    if (typeof bindCartButtons === 'function') bindCartButtons();
}

    window.wishlistToggleUrl = "{{ route('wishlist.toggle', ':id') }}";
    window.CartToggleUrl = "{{ route('account.cart.toggle', ':id') }}";

</script>

</x-layouts.site>
