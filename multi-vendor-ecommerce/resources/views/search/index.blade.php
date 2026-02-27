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
            <div class="relative bg-white rounded-xl border border-gray-200 hover:shadow-md transition-all p-2 flex flex-col">

                <!-- Wishlist -->
                ${
                    window.isLoggedIn
                    ? `<button
                            class="absolute top-2 right-2 z-10 w-8 h-8 flex items-center justify-center
                                rounded-full bg-white shadow-md wishlist-btn"
                            data-product-id="${product.id}">
                            <i class="fa fa-heart ${wishlistIcon}"></i>
                    </button>`
                    : `<a href="/login"
                            class="absolute top-2 right-2 z-10 w-8 h-8 flex items-center
                                justify-center rounded-full bg-white shadow-md">
                            <i class="fa fa-heart text-gray-400"></i>
                    </a>`
                }

                <!-- Image -->
                <a href="${window.APP_URL}/product/${product.slug}">
                    <div class="w-full h-36 bg-gray-100 rounded-lg flex items-center justify-center">
                        <img src="${image}" class="w-full h-full object-contain">
                    </div>
                </a>

                <!-- Delivery -->
                <span class="w-fit inline-flex items-center gap-1 bg-orange-50 text-yellow-900
                            text-xs font-semibold px-2.5 py-0.5 rounded-full mt-3">
                    ⚡ 8 MINS
                </span>

                <!-- Name -->
                <div class="mt-2 flex-1">
                    <p class="text-sm font-semibold text-gray-900 leading-tight line-clamp-1">
                        ${product.name}
                    </p>
                    ${product.size ? `<p class="text-sm text-gray-500 mt-1">${product.size}</p>` : ''}
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
                                class="cart-btn px-2 py-1.5 border border-green-600 rounded-lg
                                    text-sm font-semibold ${cartBtnClass}"
                                data-product-id="${product.id}">
                                ${cartBtnText}
                        </button>`
                        : `<a href="/login"
                                class="cart-btn px-2 py-1.5 border border-green-600 rounded-lg
                                    text-sm font-semibold">
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
