<x-layouts.site :title="__('Vendors')">
    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Vendors</h1>
                <p class="mt-1 text-sm text-gray-500">Browse all approved stores on the marketplace.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse ($vendors as $vendor)
                <a href="{{ route('vendors.show', $vendor->slug) }}" class="bg-white rounded-lg shadow-sm hover:shadow-md transition p-4 flex flex-col">
                    <div class="flex items-center space-x-3">
                        <div class="h-10 w-10 rounded-full bg-indigo-50 flex items-center justify-center text-xs font-semibold text-indigo-600">
                            {{ strtoupper(substr($vendor->store_name ?? $vendor->user->name, 0, 2)) }}
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-gray-900">{{ $vendor->store_name ?? $vendor->user->name }}</h2>
                            <p class="text-xs text-gray-500">{{ $vendor->city }} {{ $vendor->city && $vendor->country ? '•' : '' }} {{ $vendor->country }}</p>
                        </div>
                    </div>
                    <p class="mt-3 text-xs text-gray-600 line-clamp-2 flex-1">{{ $vendor->description ?: 'Trusted multi-vendor store on Speedly.' }}</p>
                    <p class="mt-3 text-[11px] text-gray-500">{{ $vendor->products_count }} products</p>
                </a>
            @empty
                <p class="text-sm text-gray-500">No vendors available yet.</p>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $vendors->links() }}
        </div>
    </div>
</x-layouts.site>
