<x-layouts.site :title="$product->name">


@php
$productDetails = [
    'Flavour' => 'Chocolate',
    'Storage Tips' => 'Keep refrigerated and away from direct sunlight. Consume within 2.5 months from the date of manufacturing',
    'Energy Per 100 g (kcal)' => '576',
    'Protein Per 100 g (g)' => '10',
    'Total Carbohydrates Per 100 g (g)' => '28',
    'Total Sugar Per 100 g (g)' => '21',
    'Added Sugars Per 100 g (g)' => '21',
    'Total Fat Per 100 g (g)' => '44.8',
    'Cholesterol Per 100 g (g)' => '0',
    'Dietary Fiber Per 100 g (g)' => '11.6',
    'Key Features' => [
        'Plant Based',
        'Gluten Free',
        'Dairy & Lactose Free',
        'Low Carb',
        'Refined Sugar Free',
        'PCOS Friendly',
        'Preservatives Free',
    ],
    'Ingredients' => 'Vegan 70% Dark Chocolate (Cacao, Unrefined Cane Sugar, Cacao Butter) (81%), Almonds (10%), Pumpkin Seeds, Goji Berries (6%), Rose Petals, Sea Salt',
    'Description' => $product->description,
    'Unit' => '50 g',
    'FSSAI License' => '12722055001288',
    'Allergen Information' => 'This product contains nuts. May contain traces of soy',
    'Shelf Life' => '4 months',
    'Country of Origin' => 'India',
];
@endphp


    <div class="bg-gray-50 min-h-screen ">
        <div class="max-w-7xl mx-auto px-4 sm:px-4 lg:px-4 py-4 space-y-8">

            <!-- PRODUCT TOP SECTION -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start bg-white p-2">

                <!-- LEFT COLUMN (IMAGE + DETAILS COLLAPSIBLE) -->
                <div class="space-y-6 md:pr-6 md:border-r md:border-gray-200">

                    <!-- IMAGE -->
                    <div class="relative">
                        <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center">
                            @php $primaryImage = $product->images->first(); @endphp
                            @if ($primaryImage)
                                <img src="https://speedlymart.com/storage/uploads/categories/3/image1.avif"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-cover">
                            @else
                                <span class="text-gray-400 text-sm">No Image</span>
                            @endif
                        </div>

                        @if ($product->discount_price)
                            <span class="absolute top-3 left-3 bg-green-600 text-white text-xs px-2 py-1 rounded-full">
                                SAVE ₹{{ $product->price - $product->discount_price }}
                            </span>
                        @endif
                    </div>

                    <!-- PRODUCT DETAILS (COLLAPSIBLE) -->
                    <div class="bg-white rounded-lg">
                        <button
                            type="button"
                            onclick="toggleProductDetails()"
                            class="w-full flex justify-between items-center px-3 py-3 text-[14px] font-medium text-gray-900">
                            Product Details
                            <span id="productDetailsToggle" class="text-green-600 text-[12px] font-semibold">
                                View more
                            </span>
                        </button>

                        <div id="productDetailsContent"
                            class="hidden border-t px-3 pb-3 text-[12px] text-gray-700 space-y-3">

                            @foreach ($productDetails as $label => $value)
                                <div class="grid grid-cols-2 gap-3">
                                    <p class="text-gray-500">{{ $label }}</p>

                                    @if (is_array($value))
                                        <ul class="list-disc pl-4 space-y-1 text-gray-900">
                                            @foreach ($value as $item)
                                                <li>{{ $item }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-gray-900 leading-relaxed">
                                            {{ $value }}
                                        </p>
                                    @endif
                                </div>
                            @endforeach

                            <!-- DISCLAIMER -->
                            <p class="pt-2 text-[11px] text-gray-400 leading-relaxed">
                                Every effort is made to maintain accuracy of all information. However,
                                actual product packaging and materials may contain more and/or different information.
                            </p>
                        </div>
                    </div>

                </div>

                <!-- RIGHT COLUMN (PRODUCT INFO) - STICKY -->
                <aside class="sticky top-8 self-start space-y-4">

                    <!-- TITLE -->
                    <div>
                        <h1 class="text-xl md:text-2xl font-semibold text-gray-900">
                            {{ $product->name }}
                        </h1>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ optional($product->category)->name }}
                            @if ($product->brand) • {{ $product->brand->name }} @endif
                        </p>
                    </div>

                    <!-- DELIVERY INFO -->
                    <div class="flex items-center gap-1 space-x-2 text-sm bg-green-50 text-green-700 px-3 py-2 rounded-lg w-fit">
                        🚚 Delivery in <span class="font-semibold">8 mins</span>
                    </div>

                    <!-- PRICE & ADD TO CART -->
                    <div class="flex flex-col space-y-3">
                        <div class="flex items-center space-x-3">
                            <span class="text-2xl font-bold text-gray-900">
                                ₹{{ $product->discount_price ?? $product->price }}
                            </span>
                            @if ($product->discount_price)
                                <span class="text-sm text-gray-400 line-through">
                                    ₹{{ $product->price }}
                                </span>
                            @endif
                        </div>

                        @auth
                            <form method="POST" action="{{ route('account.cart.store') }}" class="flex items-center gap-3">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <x-primary-button class="w-full py-3 text-sm rounded-lg">
                                    Add to Cart
                                </x-primary-button>
                            </form>
                        @else
                            <a href="{{ route('login') }}"
                            class="w-full text-center py-3 bg-indigo-600 text-white rounded-lg text-sm font-semibold">
                                Login to Add to Cart
                            </a>
                        @endauth
                    </div>

                    <!-- RATINGS -->
                    @if ($ratingCount)
                        <div class="flex items-center text-sm text-gray-600">
                            <span class="mr-1 font-medium">{{ number_format($averageRating, 1) }}</span>
                            <span class="text-yellow-400">★★★★★</span>
                            <span class="ml-1 text-xs text-gray-500">({{ $ratingCount }})</span>
                        </div>
                    @endif

                    <!-- WHY SHOP FROM BLINKIT / SELLER INFO -->
                    <div class="border-t pt-4 space-y-3 text-xs text-gray-600">
                        <p class="font-semibold text-gray-900">Why shop from SpeedlyMart</p>
                        <div class="space-y-2">
                            <div class="flex items-start gap-2">
                                <span class="text-green-600">⚡</span>
                                <p>
                                    <span class="font-medium text-gray-900">Superfast delivery</span><br>
                                    Get your groceries delivered in minutes
                                </p>
                            </div>

                            <div class="flex items-start gap-2">
                                <span class="text-green-600">💰</span>
                                <p>
                                    <span class="font-medium text-gray-900">Best prices & offers</span><br>
                                    Great deals, discounts & savings everyday
                                </p>
                            </div>

                            <div class="flex items-start gap-2">
                                <span class="text-green-600">🛒</span>
                                <p>
                                    <span class="font-medium text-gray-900">Wide assortment</span><br>
                                    Choose from thousands of products
                                </p>
                            </div>
                        </div>

                        @if ($product->vendor && $product->vendor->vendorProfile)
                            <p class="text-gray-500 mt-2 text-xs">
                                Sold by
                                <a href="{{ route('vendors.show', $product->vendor->vendorProfile->slug) }}"
                                class="text-indigo-600 font-medium">
                                    {{ $product->vendor->vendorProfile->store_name }}
                                </a>
                            </p>
                        @endif
                    </div>

                </aside>

            </div>

            <!-- REVIEWS SECTION -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- REVIEWS LIST -->
                <section class="md:col-span-2 bg-white rounded-xl shadow-sm p-5">
                    <h2 class="font-semibold text-gray-900 mb-4">
                        Customer Reviews
                    </h2>

                    @forelse ($approvedReviews as $review)
                        <div class="border-b py-3 last:border-0">
                            <div class="flex justify-between text-xs">
                                <span class="font-semibold">{{ $review->user->name }}</span>
                                <span class="text-gray-400">{{ $review->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="text-yellow-400 text-xs mt-1">
                                {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                            </div>
                            @if ($review->comment)
                                <p class="text-sm text-gray-700 mt-1">{{ $review->comment }}</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No reviews yet.</p>
                    @endforelse
                </section>

                <!-- REVIEW FORM -->
                <section class="bg-white rounded-xl shadow-sm p-5">
                    <h2 class="font-semibold text-gray-900 mb-3">Write a Review</h2>

                    @auth
                        <form method="POST" action="{{ route('shop.reviews.store', $product) }}" class="space-y-3">
                            @csrf

                            <select name="rating" class="w-full border rounded-lg px-3 py-2 text-sm">
                                @for ($i = 5; $i >= 1; $i--)
                                    <option value="{{ $i }}">{{ $i }} Stars</option>
                                @endfor
                            </select>

                            <textarea name="comment" rows="3"
                                      class="w-full border rounded-lg px-3 py-2 text-sm"
                                      placeholder="Share your experience"></textarea>

                            <x-primary-button class="w-full">
                                Submit Review
                            </x-primary-button>
                        </form>
                    @else
                        <p class="text-sm text-gray-500">
                            Please <a href="{{ route('login') }}" class="text-indigo-600">login</a> to review.
                        </p>
                    @endauth
                </section>

            </div>

                <!-- SIMILAR PRODUCTS -->
            @if($similarProducts->isNotEmpty())
            <section class="mt-10">
                <h2 class="text-lg font-semibold mb-4">Similar Products</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    @foreach ($similarProducts as $product)
                        <div class="bg-white rounded-xl border border-gray-200 hover:shadow-md transition-all p-2 flex flex-col">
                            
                            {{-- IMAGE --}}
                            <a href="{{ route('shop.show', $product->slug) }}" class="block">
                                <div class="w-full h-36 bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center">
                                    @php $img = $product->images->first(); @endphp
                                    @if ($img)
                                        <img src="https://cdn.grofers.com/cdn-cgi/image/f=auto,fit=scale-down,q=70,metadata=none,w=270/da/cms-assets/cms/product/77a1f36d-1024-4d57-bbb1-190c016c134f.png" 
                                            class="w-full h-full object-contain" 
                                            alt="{{ $product->name }}">
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
                                <p class="text-sm font-semibold text-gray-900 leading-tight line-clamp-2">
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
                                    <span class="text-base font-bold text-gray-900">
                                        ₹{{ $product->price }}
                                    </span>

                                    @if ($product->discount_price)
                                        <span class="line-through text-xs text-gray-400">
                                            ₹{{ $product->discount_price }}
                                        </span>
                                    @endif
                                </div>

                                {{-- ADD BUTTON --}}
                                <button class="px-4 py-1.5 border border-green-600 text-green-600 rounded-lg text-sm font-semibold hover:bg-green-50">
                                    ADD
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- TOP 10 PRODUCTS IN THIS CATEGORY -->
            @if($topCategoryProducts->isNotEmpty())
            <section class="mt-10">
                <h2 class="text-lg font-semibold mb-4">Top 10 Products in this Category</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    @foreach ($topCategoryProducts as $product)
                        <div class="bg-white rounded-xl border border-gray-200 hover:shadow-md transition-all p-2 flex flex-col">
                            
                            {{-- IMAGE --}}
                            <a href="{{ route('shop.show', $product->slug) }}" class="block">
                                <div class="w-full h-36 bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center">
                                    @php $img = $product->images->first(); @endphp
                                    @if ($img)
                                        <img src="https://cdn.grofers.com/cdn-cgi/image/f=auto,fit=scale-down,q=70,metadata=none,w=270/da/cms-assets/cms/product/c299d4a9-8e07-4660-a510-f973dcd2cadf.png" 
                                            class="w-full h-full object-contain" 
                                            alt="{{ $product->name }}">
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
                                <p class="text-sm font-semibold text-gray-900 leading-tight line-clamp-2">
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
                                    <span class="text-base font-bold text-gray-900">
                                        ₹{{ $product->price }}
                                    </span>

                                    @if ($product->discount_price)
                                        <span class="line-through text-xs text-gray-400">
                                            ₹{{ $product->discount_price }}
                                        </span>
                                    @endif
                                </div>

                                {{-- ADD BUTTON --}}
                                <button class="px-4 py-1.5 border border-green-600 text-green-600 rounded-lg text-sm font-semibold hover:bg-green-50">
                                    ADD
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            @endif



            <!-- PEOPLE ALSO BOUGHT -->
            @if($peopleAlsoBought->isNotEmpty())
            <section class="mt-10">
                <h2 class="text-lg font-semibold mb-4">People Also Bought</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    @foreach ($peopleAlsoBought as $product)
                        <div class="bg-white rounded-xl border border-gray-200 hover:shadow-md transition-all p-2 flex flex-col">
                            
                            {{-- IMAGE --}}
                            <a href="{{ route('shop.show', $product->slug) }}" class="block">
                                <div class="w-full h-36 bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center">
                                    @php $img = $product->images->first(); @endphp
                                    @if ($img)
                                        <img src="https://cdn.grofers.com/cdn-cgi/image/f=auto,fit=scale-down,q=70,metadata=none,w=270/da/cms-assets/cms/product/2d87e7e0-d84b-4049-bb76-7962e83d9281.png" 
                                            class="w-full h-full object-contain" 
                                            alt="{{ $product->name }}">
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
                                <p class="text-sm font-semibold text-gray-900 leading-tight line-clamp-2">
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
                                    <span class="text-base font-bold text-gray-900">
                                        ₹{{ $product->price }}
                                    </span>

                                    @if ($product->discount_price)
                                        <span class="line-through text-xs text-gray-400">
                                            ₹{{ $product->discount_price }}
                                        </span>
                                    @endif
                                </div>

                                {{-- ADD BUTTON --}}
                                <button class="px-4 py-1.5 border border-green-600 text-green-600 rounded-lg text-sm font-semibold hover:bg-green-50">
                                    ADD
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            @endif

        </div>
    </div>



    <script>
function toggleProductDetails() {
    const content = document.getElementById('productDetailsContent');
    const toggle = document.getElementById('productDetailsToggle');

    const isOpen = !content.classList.contains('hidden');

    if (isOpen) {
        content.classList.add('hidden');
        toggle.innerText = 'View more';
    } else {
        content.classList.remove('hidden');
        toggle.innerText = 'View less';
    }
}
</script>

</x-layouts.site>
