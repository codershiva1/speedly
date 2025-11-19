<x-layouts.site :title="$vendor->store_name ?? $vendor->user->name">
    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <section class="bg-white rounded-lg shadow-sm p-6 flex flex-col sm:flex-row items-start sm:items-center gap-4">
            <div class="h-14 w-14 rounded-full bg-indigo-50 flex items-center justify-center text-base font-semibold text-indigo-600">
                {{ strtoupper(substr($vendor->store_name ?? $vendor->user->name, 0, 2)) }}
            </div>
            <div class="flex-1">
                <h1 class="text-xl font-semibold text-gray-900">{{ $vendor->store_name ?? $vendor->user->name }}</h1>
                <p class="mt-1 text-xs text-gray-500">{{ $vendor->city }} {{ $vendor->city && $vendor->country ? '•' : '' }} {{ $vendor->country }}</p>
                <p class="mt-2 text-sm text-gray-700 max-w-2xl">{{ $vendor->description ?: 'Official storefront on Speedly multi-vendor marketplace.' }}</p>
            </div>
            <div class="text-xs text-gray-500">
                <p>{{ $products->total() }} products</p>
            </div>
        </section>

        <section>
            <h2 class="text-sm font-semibold text-gray-900 mb-3">Products from this vendor</h2>
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
                            <h3 class="font-semibold text-gray-900 text-sm line-clamp-2 flex-1">{{ $product->name }}</h3>
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
                    <p class="text-sm text-gray-500">This vendor has not published any products yet.</p>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </section>
    </div>
</x-layouts.site>
