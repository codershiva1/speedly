<x-layouts.site :title="$product->name">
    <div class="py-8 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white p-6 rounded-lg shadow-sm">
            <div>
                <div class="h-80 bg-gray-100 flex items-center justify-center overflow-hidden rounded">
                    @php $primaryImage = $product->images->first(); @endphp
                    @if ($primaryImage)
                        <img src="{{ asset('storage/'.$primaryImage->path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-gray-400 text-sm">{{ __('No Image') }}</span>
                    @endif
                </div>
            </div>

            <div class="flex flex-col space-y-4">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">{{ $product->name }}</h1>
                    <p class="mt-1 text-xs text-gray-500">SKU: {{ $product->sku }}</p>
                    <p class="mt-1 text-xs text-gray-500">
                        {{ __('Category') }}: {{ optional($product->category)->name }}
                        @if ($product->brand)
                            • {{ __('Brand') }}: {{ $product->brand->name }}
                        @endif
                    </p>
                    @if ($product->vendor && $product->vendor->vendorProfile)
                        <p class="mt-1 text-xs text-gray-500">
                            Sold by:
                            <a href="{{ route('vendors.show', $product->vendor->vendorProfile->slug) }}" class="text-indigo-600 hover:underline">
                                {{ $product->vendor->vendorProfile->store_name ?? $product->vendor->name }}
                            </a>
                        </p>
                    @endif
                </div>

                <div class="flex items-center space-x-4">
                    <div class="flex items-baseline space-x-3">
                        <span class="text-2xl font-bold text-indigo-600">₹{{ $product->discount_price ?? $product->price }}</span>
                        @if ($product->discount_price)
                            <span class="text-base line-through text-gray-400">₹{{ $product->price }}</span>
                        @endif
                    </div>
                    @if ($ratingCount)
                        <div class="flex items-center text-xs text-gray-600">
                            <span class="mr-1">{{ number_format($averageRating, 1) }}</span>
                            <span class="text-yellow-400">★★★★★</span>
                            <span class="ml-1 text-[11px] text-gray-500">({{ $ratingCount }} reviews)</span>
                        </div>
                    @endif
                </div>

                <p class="text-sm text-gray-700 leading-relaxed">{{ $product->description }}</p>

                <div class="mt-2">
                    @auth
                        <form method="POST" action="{{ route('account.cart.store') }}" class="flex items-center space-x-3">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <x-primary-button>
                                {{ __('Add to Cart') }}
                            </x-primary-button>
                            <a href="{{ route('account.cart.index') }}" class="text-xs text-indigo-600 hover:underline">
                                {{ __('View Cart') }}
                            </a>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                            {{ __('Login to Add to Cart') }}
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Reviews list -->
            <section class="md:col-span-2 bg-white rounded-lg shadow-sm p-5 text-sm">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="font-semibold text-gray-900">Customer reviews</h2>
                    @if ($ratingCount)
                        <div class="flex items-center text-xs text-gray-600">
                            <span class="mr-1">{{ number_format($averageRating, 1) }}/5</span>
                            <span class="text-yellow-400">★★★★★</span>
                            <span class="ml-1 text-[11px] text-gray-500">({{ $ratingCount }} ratings)</span>
                        </div>
                    @endif
                </div>

                @forelse ($approvedReviews as $review)
                    <article class="py-3 border-b border-gray-100 last:border-0">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <p class="font-semibold text-xs text-gray-900">{{ $review->user->name }}</p>
                                <p class="text-[11px] text-gray-400">{{ $review->created_at->format('d M Y') }}</p>
                            </div>
                            <div class="text-xs text-yellow-400">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</div>
                        </div>
                        @if ($review->title)
                            <p class="mt-1 text-xs font-semibold text-gray-800">{{ $review->title }}</p>
                        @endif
                        @if ($review->comment)
                            <p class="mt-1 text-xs text-gray-700">{{ $review->comment }}</p>
                        @endif
                    </article>
                @empty
                    <p class="text-xs text-gray-500">No reviews yet. Be the first to review this product.</p>
                @endforelse
            </section>

            <!-- Review form -->
            <section class="bg-white rounded-lg shadow-sm p-5 text-sm">
                <h2 class="font-semibold text-gray-900 mb-2">Write a review</h2>

                @auth
                    <form method="POST" action="{{ route('shop.reviews.store', $product) }}" class="space-y-2">
                        @csrf
                        <div>
                            <label class="block text-xs text-gray-700 mb-1">Rating</label>
                            <select name="rating" class="w-full border border-gray-200 rounded px-2 py-1 text-xs">
                                @for ($i = 5; $i >= 1; $i--)
                                    <option value="{{ $i }}" @selected(old('rating') == $i)>{{ $i }} - {{ str_repeat('★', $i) }}</option>
                                @endfor
                            </select>
                            @error('rating')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs text-gray-700 mb-1">Title (optional)</label>
                            <input type="text" name="title" value="{{ old('title') }}" class="w-full border border-gray-200 rounded px-2 py-1 text-xs" />
                            @error('title')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs text-gray-700 mb-1">Comment (optional)</label>
                            <textarea name="comment" rows="3" class="w-full border border-gray-200 rounded px-2 py-1 text-xs">{{ old('comment') }}</textarea>
                            @error('comment')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <x-primary-button class="mt-1 text-xs">
                            Submit review
                        </x-primary-button>
                    </form>
                @else
                    <p class="text-xs text-gray-500">Please <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">login</a> to write a review.</p>
                @endauth
            </section>
        </div>
    </div>
</x-layouts.site>
