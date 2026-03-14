<x-layouts.site :title="config('app.name', 'Speedly Shop')">
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        .category-card:hover img {
            transform: scale(1.1);
        }

        @media (max-width: 767px) {
            .sticky-header{
            display:none;
            }
           
        }
    </style>

    {{-- 1. Promo Banner --}}
    {{--
    <div class="p-4">
        @if($categoryAds && $categoryAds->ads->count() > 0)
            <div class="rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                <img src="{{ asset('public/storage/'.$categoryAds->ads->first()->banner_image) }}" class="w-full object-cover h-32 md:h-48">
            </div>
        @endif
    </div>
    --}}

    {{-- 2. Grouped Sections (Parent -> Children) --}}
    <div class="space-y-8">
        @foreach($parentCategories as $parent)
            <section class="mt-6">
                <div class="px-4 flex justify-between items-center mb-4">
                    <h2 class="text-lg font-extrabold text-gray-900 flex items-center gap-2">
                        {{ $parent->name }}
                        <span class="h-1 w-1 bg-gray-300 rounded-full"></span>
                        <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Sub-categories</span>
                    </h2>
                </div>

                <div class="flex overflow-x-auto gap-4 px-4 pb-2 no-scrollbar">
                    @foreach($parent->children as $child)
                        <a href="{{ route('shop.index', ['category' => $child->slug]) }}" class="min-w-[110px] max-w-[110px] text-center group category-card">
                            <div class="w-24 h-24 mx-auto bg-gray-50 rounded-3xl flex items-center justify-center p-4 group-hover:bg-white group-hover:shadow-xl group-hover:shadow-green-100/50 transition-all duration-300 border border-gray-100 group-hover:border-green-100">
                                <img src="{{ asset('public/storage/'.$child->image) }}" class="max-h-full object-contain transition-transform duration-300 ease-out" loading="lazy">
                            </div>
                            <div class="mt-3 px-1">
                                <p class="text-[13px] font-bold text-gray-800 leading-tight group-hover:text-green-600 transition-colors">
                                    {{ $child->name }}
                                </p>
                                <p class="text-[10px] text-gray-400 font-semibold mt-1 bg-gray-100 inline-block px-2 py-0.5 rounded-full">
                                    {{ $child->products_count }} Items
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endforeach
    </div>

    {{-- 3. Standalone Categories Section --}}
    @if($standaloneCategories->count() > 0)
        <section class="mt-12 px-4">
            <div class="mb-6">
                <h2 class="text-lg font-extrabold text-gray-900">More Categories</h2>
                <p class="text-xs text-gray-400 font-medium uppercase tracking-widest mt-1">Explore specialized collections</p>
            </div>

            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-4">
                @foreach($standaloneCategories as $cat)
                    <a href="{{ route('shop.index', ['category' => $cat->slug]) }}" class="text-center group category-card">
                        <div class="aspect-square bg-gray-50 rounded-2xl flex items-center justify-center p-3 border border-gray-100 group-hover:bg-white group-hover:shadow-lg transition-all">
                            <img src="{{ asset('public/storage/'.$cat->image) }}" class="max-h-full object-contain" loading="lazy">
                        </div>
                        <p class="mt-2 text-[11px] font-bold text-gray-700 leading-tight truncate px-1 group-hover:text-green-600">
                            {{ $cat->name }}
                        </p>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    {{-- 4. Brands Section --}}
    <section class="bg-gray-50 py-10 mt-12 mb-20">
        <div class="px-4 mb-6">
            <h2 class="font-extrabold text-gray-900 text-lg">Shop by Brand</h2>
        </div>
        <div class="flex gap-4 overflow-x-auto px-4 no-scrollbar">
            @foreach($brands as $brand)
                <a href="{{ route('products.all', ['brand' => $brand->slug]) }}" 
                class="bg-white min-w-[100px] h-24 rounded-2xl flex items-center justify-center p-4 shadow-sm border border-gray-100 hover:border-green-200 transition-all">
                    <img src="{{ asset('public/storage/'.$brand->logo) }}" class="max-h-full object-contain" alt="{{ $brand->name }}">
                </a>
            @endforeach
        </div>
    </section>

</x-layouts.site>