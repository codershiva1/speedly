<x-layouts.site :title="config('app.name', 'Speedly Shop')">
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        .category-card:hover img {
            transform: scale(1.1);
        }

    </style>

    {{-- 1. Promo Banner --}}
    {{--
    <div class="p-4">
        @if($categoryAds && $categoryAds->ads->count() > 0)
            <div class="rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                <img src="@storageUrl($categoryAds->ads->first()->banner_image)" class="w-full object-cover h-32 md:h-48">
            </div>
        @endif
    </div>
    --}}

    {{-- Unified Categories Grid --}}
    <section class="mt-10 px-4">
        <div class="mb-8">
            <h1 class="text-2xl font-black text-gray-900 italic uppercase tracking-tighter">Shop by Category</h1>
            <div class="h-1 w-20 bg-green-600 mt-2 rounded-full"></div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
            @foreach($allTopCategories as $cat)
                <a href="{{ route('shop.index', ['category' => $cat->slug]) }}" class="group block">
                    <div class="bg-white rounded-3xl p-4 shadow-sm border border-gray-100 group-hover:shadow-2xl group-hover:shadow-green-900/10 group-hover:border-green-200 transition-all duration-500 flex flex-col items-center">
                        {{-- Image Container --}}
                        <div class="w-full aspect-square bg-gray-50 rounded-2xl flex items-center justify-center p-4 mb-4 group-hover:bg-white transition-colors duration-500 overflow-hidden">
                            <img src="@storageUrl($cat->image)" 
                                 class="max-h-full object-contain transform group-hover:scale-110 transition-transform duration-700" 
                                 loading="lazy" 
                                 alt="{{ $cat->name }}">
                        </div>
                        
                        {{-- Meta Info --}}
                        <div class="text-center w-full">
                            <h3 class="text-sm font-black text-gray-900 uppercase italic tracking-tighter group-hover:text-green-600 transition-colors truncate">
                                {{ $cat->name }}
                            </h3>
                            <div class="mt-2 text-[10px] font-bold text-gray-400 uppercase tracking-widest inline-flex items-center gap-1.5 bg-gray-50 px-3 py-1 rounded-full group-hover:bg-green-50 group-hover:text-green-700 transition-all">
                                <span>{{ $cat->products_count }}</span>
                                <span class="h-1 w-1 bg-gray-300 rounded-full group-hover:bg-green-300"></span>
                                <span>Items</span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    {{-- 4. Brands Section --}}
    <section class="bg-gray-50 py-10 mt-12 mb-20">
        <div class="px-4 mb-6">
            <h2 class="font-extrabold text-gray-900 text-lg">Shop by Brand</h2>
        </div>
        <div class="flex gap-4 overflow-x-auto px-4 no-scrollbar">
            @foreach($brands as $brand)
                <a href="{{ route('products.all', ['brand' => $brand->slug]) }}" 
                class="bg-white min-w-[100px] h-24 rounded-2xl flex items-center justify-center p-4 shadow-sm border border-gray-100 hover:border-green-200 transition-all">
                    <img src="@storageUrl($brand->logo)" class="max-h-full object-contain" alt="{{ $brand->name }}">
                </a>
            @endforeach
        </div>
    </section>

</x-layouts.site>
