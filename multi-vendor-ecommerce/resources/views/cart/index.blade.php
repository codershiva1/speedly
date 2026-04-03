<x-layouts.site :title="config('app.name', 'Speedly Shop')">

@push('styles')
@vite(['resources/css/home.css'])
@endpush

@push('scripts')
@vite(['resources/js/homeslider.js'])
@endpush

@php
$subtotal = $cart->items->sum('total_price');
$discount = session('applied_coupon.discount', 0);
$finalTotal = max($subtotal - $discount, 0);
@endphp

<style>
@media (max-width: 767px) {
    .sticky-header{
    display:none;
    }
    #priceDetails{
        margin-bottom:80px;
    }
    #veiw-details-btn
    {
       margin-bottom: 80px;
       border-radius: 30px;
    }
}
@media (max-width: 1023px) {
     #priceDetails{
        z-index: 99999;
    }
}
</style>

<div class="bg-gray-100 min-h-screen py-4 sm:py-8 pb-20">

<div class="max-w-7xl mx-auto px-3 sm:px-4 grid grid-cols-1 lg:grid-cols-5 gap-6">

{{-- LEFT CART --}}
<div class="lg:col-span-3 space-y-3">

<div class="bg-white shadow-sm p-2 rounded-lg">
<h1 class="text-lg font-bold text-gray-800">
🛒 My Cart
<span class="text-sm text-gray-500 font-normal">
({{ $cart->items->count() }} items)
</span>
</h1>
</div>

@foreach ($cart->items as $item)

<div class="bg-white rounded-lg shadow-sm p-3 flex gap-3 cart-item"
data-id="{{ $item->id }}"
data-unit="{{ $item->unit_price }}">

@php $img = $item->product->images->first(); @endphp

<div class="w-20 h-20 bg-gray-100 rounded-md overflow-hidden flex-shrink-0">
<img src="@storageUrl($img ? $img->path : 'placeholder.png')"
class="w-full h-full object-cover">
</div>

<div class="flex-1">

<h2 class="text-sm font-semibold text-gray-800 leading-snug line-clamp-2">
{{ $item->product->name }}
</h2>

<p class="text-sm font-bold text-gray-900 mt-1">
₹{{ number_format($item->unit_price, 2) }}
</p>

<div class="flex items-center justify-between mt-2">

<div class="flex items-center border rounded overflow-hidden">

<button
onclick="updateQty({{ $item->id }}, -1)"
class="px-2 py-1 bg-gray-100 text-sm">
−
</button>

<input
id="qty-{{ $item->id }}"
value="{{ $item->quantity }}"
readonly
class="w-8 text-center text-sm border-0">

<button
onclick="updateQty({{ $item->id }}, 1)"
class="px-2 py-1 bg-gray-100 text-sm">
+
</button>

</div>

<p class="text-sm font-bold text-gray-800">
₹<span id="item-total-{{ $item->id }}">
{{ number_format($item->total_price,2) }}
</span>
</p>

</div>

<form
method="POST"
action="{{ route('account.cart.items.destroy',$item) }}"
class="mt-2">

@csrf
@method('DELETE')

<button
type="submit"
onclick="return confirm('Remove this item?')"
class="text-xs text-red-500 font-medium">

Remove

</button>

</form>

</div>

</div>

@endforeach

<a href="{{ route('shop.index') }}"
class="inline-block bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-5 py-2 rounded-lg transition">

Continue Shopping

</a>

</div>


{{-- PRICE DETAILS --}}
<div
id="priceDetails"
class="lg:col-span-2 lg:sticky lg:top-20
fixed lg:relative
bottom-0 left-0 right-0
bg-white
hidden lg:block
transition-all duration-300
z-50
rounded-t-2xl lg:rounded-none
shadow-xl lg:shadow-none
max-h-[90vh] overflow-y-auto">

<div class="bg-white rounded-xl p-5">

{{-- MOBILE HEADER --}}
<div class="flex justify-between items-center mb-4 lg:hidden">

<h2 class="font-bold text-lg">Price Details</h2>

<button
onclick="togglePriceDetails()"
class="text-gray-500 text-xl">
✕
</button>

</div>

<h2 class="font-bold mb-4 text-gray-800 hidden lg:block">
Price Details
</h2>

<div class="space-y-2 text-sm">

<div class="flex justify-between">
<span>Subtotal</span>

<span id="cart-subtotal">
₹{{ number_format($subtotal, 2) }}
</span>
</div>

<div class="flex justify-between text-green-600">
<span>Delivery</span>
<span>FREE</span>
</div>

@if(!session('applied_coupon'))

<div class="border-t pt-4 mt-3">

<form method="POST"
action="{{ route('account.coupon.apply') }}"
class="flex gap-2">

@csrf

<input
type="text"
name="code"
placeholder="Enter coupon"
required
class="flex-1 border rounded px-3 py-2 text-sm uppercase">

<button
type="submit"
class="bg-green-600 text-white px-4 rounded text-sm">

Apply

</button>

</form>

@error('coupon')
<p class="text-red-500 text-xs mt-1">{{ $message }}</p>
@enderror

</div>

@endif


@if(!session('applied_coupon') && $coupons->count())

<div class="border-t pt-3 mt-3">

<p class="text-sm font-semibold mb-2 text-gray-700">
🎁 Available Coupons
</p>

@foreach($coupons as $coupon)

<button
type="button"
onclick="applyCoupon('{{ $coupon->code }}')"
class="w-full border rounded-lg px-3 py-2 mb-2 text-left hover:bg-green-50 transition">

<div class="flex justify-between items-center">

<span class="font-bold text-green-700">
{{ $coupon->code }}
</span>

<span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded">
APPLY
</span>

</div>

<p class="text-xs text-gray-600 mt-1">

Save ₹{{ $coupon->value }}

@if($coupon->type === 'percentage')
({{ $coupon->value }}%)
@endif

on orders above ₹{{ $coupon->min_cart_value }}

</p>

</button>

@endforeach

</div>

@endif


@if(session('applied_coupon'))

<div class="border-t pt-3">

<div class="flex justify-between items-center text-green-700">

<span>
Coupon
<strong>{{ session('applied_coupon.code') }}</strong>
applied
</span>

<form action="{{ route('account.coupon.remove') }}" method="POST">
@csrf

<button type="submit"
class="text-red-500 text-xs">
Remove
</button>

</form>

</div>

<div class="flex justify-between text-green-700 mt-1">

<span>Discount</span>

<span>
-₹{{ number_format($discount, 2) }}
</span>

</div>

</div>

@endif


<div class="border-t pt-3 flex justify-between font-bold text-base">

<span>Total</span>

<span id="cart-total">
₹{{ number_format($finalTotal, 2) }}
</span>

</div>

</div>

<a
href="{{ route('account.checkout.index') }}"
class="block mt-5 bg-orange-500 text-white text-center py-3 rounded-lg font-semibold hover:bg-orange-600 transition">

PLACE ORDER

</a>

</div>

</div>

</div>

</div>


{{-- MOBILE BOTTOM BAR --}}
<div id="veiw-details-btn"
class="fixed bottom-0 left-0 right-0 h-16 bg-white border-t px-4 flex justify-between items-center lg:hidden shadow-lg z-40">

<div>
<p class="text-xs text-gray-500">Total</p>

<p class="font-bold text-lg">
₹{{ number_format($finalTotal, 2) }}
</p>
</div>

<button
onclick="togglePriceDetails()"
class="bg-green-600 text-white px-6 py-2 rounded-lg font-semibold">

View Details

</button>

</div>


<script>

const updateCartUrl = "{{ route('account.cart.items.update.ajax', ':id') }}";

function updateQty(itemId, change)
{

let qtyInput = document.getElementById('qty-' + itemId);
let qty = parseInt(qtyInput.value) + change;

if (qty < 1) return;

fetch(updateCartUrl.replace(':id', itemId), {

method:'POST',

headers:{
'Content-Type':'application/json',
'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content
},

body:JSON.stringify({quantity:qty})

})

.then(res=>res.json())

.then(data=>{

qtyInput.value = data.quantity;

document.getElementById('item-total-'+itemId).innerText =
data.item_total.toFixed(2);

document.getElementById('cart-subtotal').innerText =
'₹'+data.subtotal.toFixed(2);

document.getElementById('cart-total').innerText =
'₹'+data.total.toFixed(2);

});

}

function applyCoupon(code)
{

fetch("{{ route('account.coupon.apply') }}",{

method:"POST",

headers:{
"Content-Type":"application/json",
"X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').content
},

body:JSON.stringify({code})

})

.then(res=>res.json())
.then(()=>window.location.reload());

}


function togglePriceDetails()
{
let box = document.getElementById("priceDetails");

if(box.classList.contains("hidden"))
{
box.classList.remove("hidden");
}
else
{
box.classList.add("hidden");
}
}

</script>

</x-layouts.site>