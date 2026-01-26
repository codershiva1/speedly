<x-layouts.site title="My Wishlist">

<div class="max-w-6xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6">❤️ My Wishlist</h1>

    @forelse($wishlists as $wish)
        <div class="bg-white rounded-xl shadow p-4 mb-4 flex justify-between items-center">
            <div>
                @php 
                    $img = $wish->product?->images->first(); 

                    $fullPath = $img 
                        ? asset('storage/' . $img->path) 
                        : asset('storage/uploads/products/1/image3.png');
                @endphp
                <img src="{{ asset('storage/uploads/products/1/image3.png') }}"
                    class="w-16 h-16 object-cover rounded-lg" />

                @if($wish->product->stock == 0)
                    <span class="text-red-500 text-xs">Out of stock</span>
                @endif

                
            </div>
            <div>
                <h2 class="font-semibold">{{ $wish->product->name }}</h2>
                <p class="text-sm text-gray-600">
                    ₹{{ number_format($wish->product->price, 2) }}
                </p>
            </div>

            <div class="flex gap-3">
                <form method="POST" action="{{ route('account.cart.store') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $wish->product->id }}">
                    <button class="px-4 py-2 bg-green-600 text-white rounded-lg">
                        Add to cart
                    </button>
                </form>

                <form method="POST" action="{{ route('wishlist.destroy', $wish) }}">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500">Remove</button>
                </form>
            </div>
        </div>
    @empty
        <p class="text-gray-500">Your wishlist is empty.</p>
    @endforelse
</div>

</x-layouts.site>
