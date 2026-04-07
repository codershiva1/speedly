{{-- STORE PRODUCTS PARTIAL (used for both full page & AJAX renders) --}}
@php $sectionIndex = 0; @endphp

@forelse($products as $categoryName => $items)
    <section class="px-4 py-3">
        <div class="flex items-center justify-between mb-3 px-1">
            <h2 class="font-extrabold text-gray-800 text-xl tracking-tight">{{ $categoryName }}</h2>
            <div class="h-px flex-1 bg-gray-100 mx-4"></div>
            <span class="text-[10px] font-black text-gray-300 uppercase tracking-widest">{{ $items->count() }} Items</span>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($items as $product)
                @include('partials.product-card', ['product' => $product, 'isAd' => false])
            @endforeach
        </div>
    </section>

    {{-- SPONSORED BREAK (Injected after every 2 categories) --}}
    @php $sectionIndex++; @endphp
    @if($sectionIndex % 2 == 0 && $inlineAds->isNotEmpty())
        <div class="my-1 py-4 bg-gradient-to-b from-gray-50 to-white border-y border-gray-100">
            <div class="px-5 mb-4 flex justify-between items-end">
                <div>
                    <span class="bg-amber-100 text-amber-700 text-[9px] font-black px-2 py-0.5 rounded uppercase tracking-tighter shadow-sm">Promoted</span>
                    <h3 class="text-xl font-black text-gray-800 mt-1">Featured For You</h3>
                </div>
            </div>
            <div class="flex gap-4 overflow-x-auto px-5 no-scrollbar">
                @foreach($inlineAds->shuffle()->take(6) as $ad)
                    @if($ad->target)
                        <div class="min-w-[170px] md:min-w-[200px] flex-shrink-0 max-w-[200px]">
                            @include('partials.product-card', ['product' => $ad->target, 'isAd' => true])
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

@empty
    <div class="flex flex-col items-center justify-center py-24 text-center">
        <i class="bi bi-bag-x text-6xl text-gray-200 mb-4"></i>
        <p class="text-lg font-black text-gray-400">No products found</p>
        <p class="text-sm text-gray-300 mt-1 font-medium">Try a different search term or filter</p>
    </div>
@endforelse
