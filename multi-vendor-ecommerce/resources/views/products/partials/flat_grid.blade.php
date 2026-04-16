@foreach($products as $product)
    {{-- REUSABLE PRODUCT CARD START --}}
    @include('partials.product-card', ['product' => $product, 'isAd' => false])
@endforeach
