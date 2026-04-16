@forelse ($products as $product)
    @include('partials.product-card', ['product' => $product, 'isAd' => false])
@empty
    <div class="col-span-full py-20 text-center text-gray-400">No products found in this category.</div>
@endforelse
