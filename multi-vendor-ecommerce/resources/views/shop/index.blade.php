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
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach ($featuredProducts as $product)
                        <a href="{{ route('shop.show', $product->slug) }}" class="bg-white rounded-lg shadow-sm hover:shadow-md transition overflow-hidden flex flex-col">
                            <div class="h-40 bg-gray-100 flex items-center justify-center overflow-hidden">
                                @php $primaryImage = $product->images->first(); @endphp
                                @if ($primaryImage)
                                    <img src="{{ asset('storage/'.$primaryImage->path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-gray-400 text-xs">{{ __('No Image') }}</span>
                                @endif
                            </div>
                            <div class="p-3 flex-1 flex flex-col">
                                <p class="text-xs text-gray-500 mb-1">{{ optional($product->category)->name }}</p>
                                <h3 class="text-sm font-semibold text-gray-900 line-clamp-2 flex-1">{{ $product->name }}</h3>
                                <div class="mt-2 flex items-baseline space-x-2">
                                    <span class="text-base font-bold text-indigo-600">₹{{ $product->discount_price ?? $product->price }}</span>
                                    @if ($product->discount_price)
                                        <span class="text-xs line-through text-gray-400">₹{{ $product->price }}</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        <section class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Filters -->
            <aside class="md:col-span-1 bg-white rounded-lg shadow-sm p-4 text-sm space-y-4">
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">Filter by category</h3>
                    <div class="space-y-1 max-h-48 overflow-auto text-xs">
                        <a href="{{ route('shop.index', array_merge(request()->except('page', 'category'), ['category' => null])) }}" class="block px-2 py-1 rounded {{ empty($filters['category']) ? 'bg-indigo-50 text-indigo-700' : 'hover:bg-gray-50 text-gray-700' }}">All categories</a>
                        @foreach ($categories as $category)
                            <a href="{{ route('shop.index', array_merge(request()->except('page'), ['category' => $category->slug])) }}" class="block px-2 py-1 rounded {{ ($filters['category'] ?? null) === $category->slug ? 'bg-indigo-50 text-indigo-700' : 'hover:bg-gray-50 text-gray-700' }}">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-3">
                    <h3 class="font-semibold text-gray-900 mb-2">Price range</h3>
                    <form method="GET" action="{{ route('shop.index') }}" class="space-y-2">
                        <div class="flex items-center space-x-2 text-xs">
                            <input type="number" name="min_price" value="{{ $filters['min_price'] ?? '' }}" placeholder="Min" class="w-20 px-2 py-1 border border-gray-200 rounded" />
                            <span>-</span>
                            <input type="number" name="max_price" value="{{ $filters['max_price'] ?? '' }}" placeholder="Max" class="w-20 px-2 py-1 border border-gray-200 rounded" />
                        </div>
                        @foreach (request()->except('page', 'min_price', 'max_price') as $name => $value)
                            <input type="hidden" name="{{ $name }}" value="{{ $value }}" />
                        @endforeach
                        <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-indigo-600 text-white rounded text-xs font-semibold hover:bg-indigo-500">Apply</button>
                    </form>
                </div>
            </aside>

            <!-- Products grid -->
            <div class="md:col-span-3">
                <div class="flex items-center justify-between mb-4 text-xs text-gray-600">
                    <p>{{ $products->total() }} products found</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @forelse ($products as $product)
                        <a href="{{ route('shop.show', $product->slug) }}" class="block bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition flex flex-col">
                            <div class="h-44 bg-gray-100 flex items-center justify-center overflow-hidden">
                                @php $primaryImage = $product->images->first(); @endphp
                                @if ($primaryImage)
                                    <img src="{{ asset('storage/'.$primaryImage->path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-gray-400 text-xs">{{ __('No Image') }}</span>
                                @endif
                            </div>
                            <div class="p-3 flex-1 flex flex-col">
                                <p class="text-[11px] text-gray-500 mb-1">{{ optional($product->category)->name }}</p>
                                <h2 class="font-semibold text-gray-900 text-sm line-clamp-2 flex-1">{{ $product->name }}</h2>
                                <p class="mt-1 text-xs text-gray-500 line-clamp-1">{{ $product->short_description }}</p>
                                <div class="mt-2 flex items-baseline space-x-2">
                                    <span class="text-base font-bold text-indigo-600">₹{{ $product->discount_price ?? $product->price }}</span>
                                    @if ($product->discount_price)
                                        <span class="text-xs line-through text-gray-400">₹{{ $product->price }}</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @empty
                        <p class="text-gray-500 text-sm">{{ __('No products available yet.') }}</p>
                    @endforelse
                </div>

                <div class="mt-6">
                    {{ $products->links() }}
                </div>
            </div>
        </section>
    </div>
</x-layouts.site>
