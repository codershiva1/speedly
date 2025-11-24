<x-layouts.site :title="config('app.name', 'Speedly Shop')">

    @push('styles')
        @vite(['resources/css/homeslider.css'])
    @endpush

    @push('scripts')
        @vite(['resources/js/homeslider.js'])
    @endpush

    @php
        $heroProduct = $featuredProducts->first();
    @endphp


    {{-- HERO AREA --}}
    <section class="mb-6">
        <x-homeslider />
    </section>



    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 space-y-8">


         <!-- {{-- ================= TOP FEATURE ICON ROW ================= --}}
            <section class="grid grid-cols-2 md:grid-cols-5 gap-4">
                <div class="bg-white rounded-lg shadow-sm px-4 py-3 flex items-start space-x-3 text-xs">
                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-amber-100 text-amber-600 text-lg">🚚</div>
                    <div>
                        <p class="font-semibold text-gray-900">Free Delivery</p>
                        <p class="text-gray-500">Free shipping on all orders</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-sm px-4 py-3 flex items-start space-x-3 text-xs">
                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-amber-100 text-amber-600 text-lg">💰</div>
                    <div>
                        <p class="font-semibold text-gray-900">Big Saving Shop</p>
                        <p class="text-gray-500">Save big every single order</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-sm px-4 py-3 flex items-start space-x-3 text-xs">
                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-amber-100 text-amber-600 text-lg">⏰</div>
                    <div>
                        <p class="font-semibold text-gray-900">Online Support 24/7</p>
                        <p class="text-gray-500">We’re here day and night</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-sm px-4 py-3 flex items-start space-x-3 text-xs">
                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-amber-100 text-amber-600 text-lg">🔁</div>
                    <div>
                        <p class="font-semibold text-gray-900">Money Back Return</p>
                        <p class="text-gray-500">Guarantee under 7 days</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-sm px-4 py-3 flex items-start space-x-3 text-xs">
                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-amber-100 text-amber-600 text-lg">🎁</div>
                    <div>
                        <p class="font-semibold text-gray-900">Member Discount</p>
                        <p class="text-gray-500">On orders over $120.00</p>
                    </div>
                </div>
            </section> -->

         {{-- ================= ICONS SLIDER SECTION (shows 3 at a time, slides by 1) ================= --}}
            <section class="icons-carousel-section max-w-7xl mx-auto ">
                <div class="relative border border-gray-200  overflow-hidden">

                    <!-- Swiper container -->
                    <div class="swiper iconSwiper">
                        <div class="swiper-wrapper">
                            <!-- Slide 1 -->
                            <div class="swiper-slide">
                                <div class="icon-card">
                                    <div class="icon">🚚</div>
                                    <div class="meta">
                                        <p class="font-semibold text-gray-900 iconcardp1">Free Delivery</p>
                                        <p class="text-gray-500 text-xs">Free shipping on all orders</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Slide 2 -->
                            <div class="swiper-slide">
                                <div class="icon-card">
                                    <div class="icon">💰</div>
                                    <div class="meta">
                                        <p class="font-semibold text-gray-900 iconcardp1">Big Saving Shop</p>
                                        <p class="text-gray-500 text-xs">Save big every single order</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Slide 3 -->
                            <div class="swiper-slide">
                                <div class="icon-card">
                                    <div class="icon">⏰</div>
                                    <div class="meta">
                                        <p class="font-semibold text-gray-900 iconcardp1">Online Support 24/7</p>
                                        <p class="text-gray-500 text-xs">We’re here day and night</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Slide 4 -->
                            <div class="swiper-slide">
                                <div class="icon-card">
                                    <div class="icon">🔁</div>
                                    <div class="meta">
                                        <p class="font-semibold text-gray-900 iconcardp1">Money Back Return</p>
                                        <p class="text-gray-500 text-xs">Guarantee under 7 days</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Slide 5 -->
                            <div class="swiper-slide">
                                <div class="icon-card">
                                    <div class="icon">🎁</div>
                                    <div class="meta">
                                        <p class="font-semibold text-gray-900 iconcardp1">Member Discount</p>
                                        <p class="text-gray-500 text-xs">On orders over $120.00</p>
                                    </div>
                                </div>
                            </div>

                            <!-- You can add more slides here; content preserved -->
                        </div>

                        <!-- Navigation (visible outside the bordered box) -->
                        <div class="swiper-button-prev grt icon-swiper-prev"></div>
                        <div class="swiper-button-next grt icon-swiper-next"></div>
                    </div>
                </div>
            </section>

            <!-- ---------------------------------------------------------------------- -->

            {{-- ================= THREE COLOUR BANNERS ================= --}}
            <section class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class=" overflow-hidden bg-indigo-600 text-white flex items-center p-5 banner">
                    <div class="flex-1">
                        <span class="text-[11px] font-semibold uppercase bg-amber-400 text-gray-900 px-2 py-0.5 rounded">
                            Smart Phones
                        </span>
                        <h3 class="mt-2 text-lg font-bold">OnePlus 8</h3>
                        <p class="mt-1 text-xs">128 GB Green in 2013</p>
                        <p class="mt-3 text-sm">From <span class="text-yellow-300 font-semibold">$60.99/-</span></p>
                    </div>
                </div>
                <div class=" overflow-hidden bg-orange-500 text-white flex items-center p-5 banner">
                    <div class="flex-1">
                        <span class="text-[11px] font-semibold uppercase bg-yellow-300 text-gray-900 px-2 py-0.5 rounded">
                            Smart Watches
                        </span>
                        <h3 class="mt-2 text-lg font-bold">Apple Watch Series 4</h3>
                        <p class="mt-3 text-sm">From <span class="text-gray-900 font-semibold">$14.99/-</span></p>
                    </div>
                </div>
                <div class=" overflow-hidden bg-blue-700 text-white flex items-center p-5 banner">
                    <div class="flex-1">
                        <span class="text-[11px] font-semibold uppercase bg-amber-400 text-gray-900 px-2 py-0.5 rounded">
                            Popular Product
                        </span>
                        <h3 class="mt-2 text-lg font-bold">Polaroid Now Instant i-Type</h3>
                        <p class="mt-3 text-sm">From <span class="text-yellow-300 font-semibold">$90.99/-</span></p>
                    </div>
                </div>
            </section>

            {{-- ================= HERO + TOP NAV BAR AREA ================= --}}
            <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                {{-- LEFT: MAIN HERO SLIDER STYLE --}}
                <div class="lg:col-span-9 bg-white rounded-lg shadow-sm overflow-hidden flex flex-col md:flex-row">
                    <div class="w-full md:w-2/3 p-6 flex flex-col justify-center">
                        <p class="inline-flex items-center text-xs font-semibold uppercase tracking-wide bg-amber-500 text-white px-3 py-1 rounded-full mb-4">
                            Weekend Discounts
                        </p>

                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">
                            The New Branded<br>
                            <span class="text-gray-800">Home Wireless Speaker</span>
                        </h1>

                        <p class="mt-3 text-sm text-gray-600">
                            Experience premium sound quality with modern, minimalist design — perfect for your living room, office, or studio.
                        </p>

                        <p class="mt-4 text-sm text-gray-800">
                            From <span class="text-red-500 text-xl font-bold">$29.99/-</span>
                        </p>

                        <div class="mt-5">
                            <a href="{{ $heroProduct ? route('shop.show', $heroProduct->slug) : route('shop.index') }}"
                               class="inline-flex items-center px-5 py-2.5 bg-sky-700 hover:bg-sky-800 text-sm font-semibold text-white rounded shadow-sm">
                                SHOP NOW
                            </a>
                        </div>
                    </div>

                    <div class="w-full md:w-1/3 bg-gray-100 flex items-center justify-center">
                        @php
                            $image = $heroProduct?->images->first();
                        @endphp
                        @if($image)
                            <img src="{{ asset('storage/'.$image->path) }}"
                                 alt="{{ $heroProduct->name }}"
                                 class="w-full h-full object-cover">
                        @else
                            {{-- placeholder hero image --}}
                            <img src="{{ asset('images/demo/hero-speaker.jpg') }}"
                                 alt="Wireless speaker"
                                 class="w-full h-full object-cover">
                        @endif
                    </div>
                </div>

                {{-- RIGHT: VERTICAL QUICK ACTION ICONS (FAKE WIDGET LIKE DEMO) --}}
                <div class="lg:col-span-3 flex lg:flex-col gap-3 justify-end">
                    <div class="flex lg:flex-col gap-3">
                        @foreach (['🏠','🧩','❤','⬆'] as $emoji)
                            <button class="flex items-center justify-center w-10 h-10 bg-white shadow rounded-full text-gray-700 hover:bg-gray-100 text-lg">
                                {{ $emoji }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </section>


          

            

            <!-- {{-- ================= HORIZONTAL OFFER STRIP ================= --}}
            <section class="bg-indigo-700 text-[11px] text-white rounded-lg shadow-sm flex flex-wrap items-center justify-between px-4 py-2">
                <p>Mega offers now on Amazon Fresh | Up to 40% off</p>
                <p>FREE delivery over ₹499. Fulfilled by Amazon.</p>
                <p>Flat $10 instant cashback on wallet &amp; UPI transactions</p>
            </section> -->

            {{-- ================= MOVING OFFER STRIP ================= --}}
            <section class="w-full overflow-hidden">
                <div class="bg-indigo-700 text-white rounded-lg shadow-sm py-2 relative">

                    <div class="marquee whitespace-nowrap flex items-center text-[12px]">

                        <span class="mx-6 flex items-center gap-1">
                            <span class="text-amber-300">&#9733;</span>
                            Mega offers now on Amazon Fresh | Up to 40% off
                        </span>

                        <span class="mx-6 flex items-center gap-1">
                            <span class="text-green-300">&#10003;</span>
                            FREE delivery over ₹499. Fulfilled by Amazon.
                        </span>

                        <span class="mx-6 flex items-center gap-1">
                            <span class="text-yellow-300">&#128179;</span>
                            Flat $10 instant cashback on wallet & UPI transactions
                        </span>

                        {{-- Duplicate content for infinite loop --}}
                        <span class="mx-6 flex items-center gap-1">
                            <span class="text-amber-300">&#9733;</span>
                            Mega offers now on Amazon Fresh | Up to 40% off
                        </span>

                        <span class="mx-6 flex items-center gap-1">
                            <span class="text-green-300">&#10003;</span>
                            FREE delivery over ₹499. Fulfilled by Amazon.
                        </span>

                        <span class="mx-6 flex items-center gap-1">
                            <span class="text-yellow-300">&#128179;</span>
                            Flat $10 instant cashback on wallet & UPI transactions
                        </span>

                    </div>
                </div>
            </section>


            {{-- ================= CATEGORY STRIP ================= --}}
            <!-- <section class="bg-white rounded-lg shadow-sm p-4">
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4 text-xs">
                    @foreach($topCategories->take(8) as $category)
                        <a href="{{ route('shop.index',['category'=>$category->slug]) }}"
                           class="flex flex-col items-center md:items-start border border-gray-100 rounded-lg px-3 py-3 hover:border-indigo-500 transition">
                            <div class="h-10 w-10 rounded-full bg-gray-50 flex items-center justify-center mb-2">
                                <span class="text-[11px] font-semibold text-indigo-600">
                                    {{ strtoupper(substr($category->name,0,2)) }}
                                </span>
                            </div>
                            <p class="font-semibold text-gray-900">{{ $category->name }}</p>
                            <p class="text-gray-500 text-[11px]">{{ $category->products_count }} Items</p>
                        </a>
                    @endforeach
                </div>
            </section> -->

            {{-- ================= TWO-ROW CATEGORY SLIDER ================= --}}
{{-- ================= CATEGORY SLIDER (2 ROWS) ================= --}}
<section class="category-slider-section max-w-7xl mx-auto my-8">
    <div class="relative border border-gray-200  overflow-hidden bg-white">

        <div class="swiper categorySwiper">
            <div class="swiper-wrapper ">

                {{-- Chunk the categories in pairs (2 per slide) --}}
                @foreach($topCategories->chunk(2) as $pair)
                    <div class="swiper-slide twocategory-slide h-full">
                        <div class="flex flex-col  category-slide">

                            @foreach($pair as $category)
                                <a href="{{ route('shop.index',['category'=>$category->slug]) }}"
                                   class="cat-card flex items-center gap-3 border border-gray-100 p-3 category-slidelink">
                                    
                                    <div class="cat-icon">
                                        <span>{{ strtoupper(substr($category->name,0,2)) }}</span>
                                    </div>

                                    <div>
                                        <p class="cat-title">{{ $category->name }}</p>
                                        <p class="cat-items">{{ $category->products_count }} Items</p>
                                    </div>
                                    <div class="cat-img-wrapper bg-white p-1 transition-all duration-300">

                                        <img class="cat-img transition-transform duration-300"
                                            style="height:50px; width:50px;"
                                            src="{{ $category->image ? asset('storage/'.$category->image) : 'https://via.placeholder.com/50' }}"
                                            alt="{{ $category->name }}">

                                    </div>
                                </a>
                            @endforeach

                        </div>
                    </div>
                @endforeach

            </div>

            <div class="swiper-button-prev cat-prev"></div>
            <div class="swiper-button-next cat-next"></div>

        </div>
    </div>
</section>



            {{-- ================= DEALS / NEW / FEATURED ROW ================= --}}
            <section class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                {{-- LEFT BIG FEATURE CARD (DEAL OF THE DAY) --}}
                <div class="lg:col-span-1 bg-white rounded-lg shadow-sm p-4 flex flex-col">
                    <h2 class="text-sm font-semibold text-gray-900 mb-2">Deals of the Day</h2>
                    @php $highlight = $dealsOfDay->first(); @endphp
                    @if($highlight)
                        <div class="border border-amber-400 rounded-lg overflow-hidden flex-1 flex flex-col">
                            <div class="h-44 bg-gray-100 flex items-center justify-center overflow-hidden">
                                @php $image = $highlight->images->first(); @endphp
                                @if($image)
                                    <img src="{{ asset('storage/'.$image->path) }}" alt="{{ $highlight->name }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-gray-400 text-xs">No image</span>
                                @endif
                            </div>
                            <div class="p-3 text-xs flex-1 flex flex-col">
                                <p class="text-[11px] text-gray-500 mb-1">{{ optional($highlight->category)->name }}</p>
                                <h3 class="font-semibold text-gray-900 mb-1 line-clamp-2">{{ $highlight->name }}</h3>
                                <ul class="list-disc list-inside text-[11px] text-gray-600 space-y-0.5">
                                    <li>Portable computing for work and play.</li>
                                    <li>High resolution display for immersive visuals.</li>
                                    <li>Long-lasting battery life for on-the-go use.</li>
                                </ul>
                                <p class="mt-2 font-bold text-red-500">₹{{ $highlight->discount_price ?? $highlight->price }}</p>
                            </div>
                        </div>
                    @else
                        <p class="text-xs text-gray-500">No deals available.</p>
                    @endif
                </div>

                {{-- RIGHT: ROW OF PRODUCTS WITH TABS TITLES (STATIC LIKE DEMO) --}}
                <div class="lg:col-span-3 bg-white rounded-lg shadow-sm p-4">
                    <div class="flex items-center justify-between mb-3 text-sm">
                        <div class="flex items-center space-x-6">
                            <span class="font-semibold text-gray-900 border-b-2 border-indigo-600 pb-1">
                                Deals of the Day
                            </span>
                            <span class="text-gray-500">New Products</span>
                            <span class="text-gray-500">Featured Products</span>
                        </div>
                        <a href="{{ route('shop.index') }}" class="text-xs text-indigo-600 hover:underline">View all</a>
                    </div>

                    <div class="flex space-x-4 overflow-x-auto scrollbar-thin pb-1">
                        @forelse($dealsOfDay as $product)
                            <a href="{{ route('shop.show',$product->slug) }}"
                               class="flex-shrink-0 w-48 bg-white border border-gray-100 rounded-lg overflow-hidden hover:shadow-sm transition flex flex-col">
                                <div class="h-28 bg-gray-100 flex items-center justify-center overflow-hidden">
                                    @php $image = $product->images->first(); @endphp
                                    @if($image)
                                        <img src="{{ asset('storage/'.$image->path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-gray-400 text-xs">No image</span>
                                    @endif
                                </div>
                                <div class="p-2 text-xs flex-1 flex flex-col">
                                    <p class="text-[11px] text-gray-500 mb-1">{{ optional($product->category)->name }}</p>
                                    <p class="font-semibold text-gray-900 line-clamp-2 flex-1">{{ $product->name }}</p>
                                    <p class="mt-1 font-bold text-indigo-600">₹{{ $product->discount_price ?? $product->price }}</p>
                                </div>
                            </a>
                        @empty
                            <p class="text-xs text-gray-500">No products in deals list.</p>
                        @endforelse
                    </div>
                </div>
            </section>

            {{-- ================= BANNER + CATEGORY & PRODUCTS ================= --}}
            <section class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                {{-- TWO WIDE TOP BANNERS (LIKE SURFACE KEYBOARD / SPEAKER) --}}
                <div class="lg:col-span-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="rounded-lg bg-blue-700 text-white p-5 flex items-center">
                        <div class="flex-1">
                            <span class="text-[11px] font-semibold uppercase bg-amber-400 text-gray-900 px-2 py-0.5 rounded">
                                Popular Product
                            </span>
                            <h3 class="mt-2 text-lg font-bold">Microsoft Surface Wireless Keyboard</h3>
                            <p class="mt-2 text-xs">From <span class="text-yellow-300 font-semibold">$37.85/-</span></p>
                        </div>
                    </div>
                    <div class="rounded-lg bg-gray-900 text-white p-5 flex items-center">
                        <div class="flex-1">
                            <span class="text-[11px] font-semibold uppercase bg-amber-400 text-gray-900 px-2 py-0.5 rounded">
                                Popular Product
                            </span>
                            <h3 class="mt-2 text-lg font-bold">Bang &amp; Olufsen Beoplay A1 Speaker</h3>
                            <p class="mt-2 text-xs">From <span class="text-emerald-300 font-semibold">$10.99/-</span></p>
                        </div>
                    </div>
                </div>

                {{-- BELOW: CATEGORIES SIDEBAR + ROW OF PRODUCTS --}}
                <div class="lg:col-span-4 grid grid-cols-1 lg:grid-cols-4 gap-4 mt-2">
                    {{-- LEFT SIDEBAR CATEGORIES --}}
                    <aside class="lg:col-span-1 bg-white rounded-lg shadow-sm p-4 text-xs">
                        <h2 class="text-sm font-semibold text-gray-900 mb-3">Shop By Categories</h2>
                        <ul class="space-y-1">
                            @foreach ($categories->take(6) as $category)
                                <li>
                                    <a href="{{ route('shop.index',['category'=>$category->slug]) }}"
                                       class="flex items-center justify-between px-2 py-1 rounded hover:bg-gray-50">
                                        <span class="flex items-center space-x-2">
                                            <span class="inline-flex h-6 w-6 rounded-full bg-indigo-50 text-[10px] items-center justify-center text-indigo-600 font-semibold">
                                                {{ strtoupper(substr($category->name, 0, 2)) }}
                                            </span>
                                            <span class="text-gray-700">{{ $category->name }}</span>
                                        </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <button class="mt-3 inline-flex items-center text-indigo-600 text-[11px] hover:underline">
                            + All Category
                        </button>
                    </aside>

                    {{-- RIGHT PRODUCTS STRIP --}}
                    <div class="lg:col-span-3 bg-white rounded-lg shadow-sm p-4">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm font-semibold text-gray-900">Popular Product</span>
                            <a href="{{ route('shop.index') }}" class="text-xs text-indigo-600 hover:underline">View all</a>
                        </div>
                        <div class="flex space-x-4 overflow-x-auto scrollbar-thin pb-1">
                            @forelse($featuredProducts as $product)
                                <a href="{{ route('shop.show',$product->slug) }}"
                                   class="flex-shrink-0 w-44 bg-white border border-gray-100 rounded-lg overflow-hidden hover:shadow-sm transition flex flex-col">
                                    <div class="h-28 bg-gray-100 flex items-center justify-center overflow-hidden">
                                        @php $image = $product->images->first(); @endphp
                                        @if($image)
                                            <img src="{{ asset('storage/'.$image->path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-gray-400 text-xs">No image</span>
                                        @endif
                                    </div>
                                    <div class="p-2 text-xs flex-1 flex flex-col">
                                        <p class="text-[11px] text-gray-500 mb-1">{{ optional($product->category)->name }}</p>
                                        <p class="font-semibold text-gray-900 line-clamp-2 flex-1">{{ $product->name }}</p>
                                        <p class="mt-1 font-bold text-indigo-600">₹{{ $product->discount_price ?? $product->price }}</p>
                                    </div>
                                </a>
                            @empty
                                <p class="text-xs text-gray-500">No products yet.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>

            {{-- ================= LATEST NEWS ================= --}}
            <section class="bg-white rounded-lg shadow-sm p-4">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-sm font-semibold text-gray-900">Latest News</h2>
                    <a href="{{ route('pages.blog') }}" class="text-xs text-indigo-600 hover:underline">View all articles</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    @foreach($latestNews as $article)
                        <article class="bg-white border border-gray-100 rounded-lg overflow-hidden flex flex-col text-xs">
                            <div class="h-28 bg-gray-100 overflow-hidden">
                                <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-full object-cover">
                            </div>
                            <div class="p-3 flex-1 flex flex-col">
                                <p class="text-[11px] text-gray-400 mb-1">{{ $article['date']->format('d M Y') }}</p>
                                <h3 class="font-semibold text-gray-900 mb-1 line-clamp-2">{{ $article['title'] }}</h3>
                                <p class="text-gray-600 line-clamp-3 flex-1">{{ $article['excerpt'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</x-layouts.site>
