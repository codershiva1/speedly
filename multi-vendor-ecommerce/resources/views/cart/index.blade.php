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

{{-- DELIVERY HEADER --}}
<div class="bg-white shadow-sm p-3 rounded-xl mb-3 flex items-center justify-between border border-green-50">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 bg-green-50 rounded-full flex items-center justify-center shrink-0">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <div>
            <h3 class="text-sm font-black text-gray-900 leading-none">Delivery in 8-10 mins</h3>
            <p class="text-[11px] text-gray-500 font-bold mt-1 uppercase tracking-tight">
                Delivering to 
                <span class="text-gray-900">
                    @if(auth()->check() && auth()->user()->addresses->first())
                         {{ Str::limit(auth()->user()->addresses->first()->address_line_1, 30) }}
                    @else
                        Current Location
                    @endif
                </span>
            </p>
        </div>
    </div>
    <a href="{{ route('profile.edit') }}" class="text-[10px] font-black text-green-600 border border-green-200 px-3 py-1 rounded-full hover:bg-green-50 transition-all uppercase tracking-widest">
        Change
    </a>
</div>

<div class="bg-white shadow-sm p-3 rounded-xl flex items-center justify-between">
    <h1 class="text-lg font-black text-gray-900 uppercase italic tracking-tighter">
        🛒 My Cart
        <span class="text-xs text-gray-400 font-bold normal-case italic ml-1">
            ({{ $cart->items->count() }} items)
        </span>
    </h1>
</div>

@foreach ($cart->items as $item)
@php 
    $img = $item->product->images->first(); 
    $unit = $item->product->size;
@endphp

<div class="bg-white rounded-xl shadow-sm p-3 flex gap-4 cart-item border border-transparent hover:border-green-50 transition-all"
    data-id="{{ $item->id }}"
    data-unit="{{ $item->unit_price }}">

    {{-- Product Image --}}
    <div class="w-20 h-20 bg-gray-50 rounded-xl overflow-hidden flex-shrink-0 border border-gray-100 p-1">
        <img src="@storageUrl($img ? $img->path : 'placeholder.png')"
             class="w-full h-full object-contain mix-blend-multiply">
    </div>

    {{-- Product Info --}}
    <div class="flex-1 flex flex-col justify-between">
        <div>
            <h2 class="text-sm font-black text-gray-900 leading-tight line-clamp-2 uppercase italic tracking-tighter">
                {{ $item->product->name }}
            </h2>
            @if($unit)
                <p class="text-[10px] font-bold text-gray-400 mt-0.5 uppercase tracking-wide">{{ $unit }}</p>
            @endif
        </div>

        <div class="flex items-center justify-between mt-2">
            <div>
                <span class="text-sm font-black text-gray-900 leading-none">₹{{ number_format($item->unit_price, 2) }}</span>
                @if($item->product->price > $item->unit_price)
                    <span class="text-[10px] text-gray-400 line-through font-bold ml-1">₹{{ number_format($item->product->price, 2) }}</span>
                @endif
            </div>

            <div class="flex items-center bg-green-600 rounded-lg overflow-hidden shadow-sm shadow-green-200">
                <button
                    onclick="updateQty({{ $item->id }}, -1)"
                    class="w-7 h-7 flex items-center justify-center text-white text-base hover:bg-green-700 transition-colors">
                    −
                </button>

                <input
                    id="qty-{{ $item->id }}"
                    value="{{ $item->quantity }}"
                    readonly
                    class="w-8 text-center text-xs font-black bg-white text-green-700 border-0 h-7">

                <button
                    onclick="updateQty({{ $item->id }}, 1)"
                    class="w-7 h-7 flex items-center justify-center text-white text-base hover:bg-green-700 transition-colors">
                    +
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

    {{-- UPSELL SECTION --}}
    @if($trendingProducts->isNotEmpty())
    <div class="mt-8 bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xs font-black text-gray-900 uppercase tracking-widest flex items-center gap-2">
                <i class="bi bi-stars text-yellow-500"></i> Before you checkout
            </h3>
            <span class="text-[9px] font-bold text-gray-400 uppercase tracking-tight">People also bought</span>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
            @foreach($trendingProducts as $tProduct)
            <div class="bg-gray-50 rounded-xl p-2 border border-transparent hover:border-green-100 transition-all group flex flex-col justify-between h-full">
                <div class="relative">
                    <div class="w-full h-20 overflow-hidden mb-2 rounded-lg bg-white p-1">
                        <img src="@storageUrl($tProduct->images->first()?->path ?? 'placeholder.png')" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="space-y-0.5">
                        <h4 class="text-[10px] font-black text-gray-900 leading-tight uppercase italic line-clamp-1 tracking-tighter">{{ $tProduct->name }}</h4>
                        <p class="text-[9px] text-gray-400 font-bold">{{ $tProduct->size }}</p>
                    </div>
                </div>
                
                <div class="flex items-center justify-between mt-2 pt-2 border-t border-gray-100">
                    <span class="text-[10px] font-black text-gray-900">₹{{ number_format($tProduct->discount_price ?? $tProduct->price, 0) }}</span>
                    <button 
                        class="cart-btn bg-white border border-green-600 text-green-600 px-3 py-1 rounded-lg text-xs font-black hover:bg-green-600 hover:text-white transition-all transform active:scale-95"
                        data-product-id="{{ $tProduct->id }}">
                        ADD
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- DELIVERY INSTRUCTIONS --}}
    <div class="mt-4 bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
        <h3 class="text-xs font-black text-gray-900 uppercase tracking-widest flex items-center gap-2 mb-4">
            <i class="bi bi-chat-left-text text-green-500"></i> Delivery Instructions
        </h3>
        <div class="flex flex-wrap gap-2">
            <button class="instruction-btn flex items-center gap-2 px-3 py-2 bg-gray-50 border border-gray-100 rounded-xl text-[10px] font-bold text-gray-600 hover:border-green-200 hover:bg-green-50 transition-all">
                <i class="bi bi-bell-slash"></i> Don't ring bell
            </button>
            <button class="instruction-btn flex items-center gap-2 px-3 py-2 bg-gray-50 border border-gray-100 rounded-xl text-[10px] font-bold text-gray-600 hover:border-green-200 hover:bg-green-50 transition-all">
                <i class="bi bi-door-closed"></i> Leave at gate
            </button>
            <button class="instruction-btn flex items-center gap-2 px-3 py-2 bg-gray-50 border border-gray-100 rounded-xl text-[10px] font-bold text-gray-600 hover:border-green-200 hover:bg-green-50 transition-all">
                <i class="bi bi-telephone"></i> Call me
            </button>
            <button class="instruction-btn flex items-center gap-2 px-3 py-2 bg-gray-50 border border-gray-100 rounded-xl text-[10px] font-bold text-gray-600 hover:border-green-200 hover:bg-green-50 transition-all">
                <i class="bi bi-shield-check"></i> No-contact
            </button>
        </div>
    </div>

    <div class="pt-4 text-center">
        <a href="{{ route('shop.index') }}"
           class="inline-flex items-center gap-2 text-[10px] font-black text-green-600 uppercase tracking-widest hover:underline decoration-2 underline-offset-4">
           <i class="fa fa-arrow-left"></i> Continue Shopping
        </a>
    </div>
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
    rounded-t-3xl lg:rounded-2xl
    shadow-2xl lg:shadow-none
    max-h-[90vh] overflow-y-auto border border-gray-100">

<div class="p-6">
    {{-- MOBILE HEADER --}}
    <div class="flex justify-between items-center mb-6 lg:hidden">
        <h2 class="text-lg font-black text-gray-900 uppercase italic tracking-tighter">Bill Summary</h2>
        <button onclick="togglePriceDetails()" class="w-8 h-8 flex items-center justify-center bg-gray-100 rounded-full text-gray-500">✕</button>
    </div>

    {{-- TIPPING SECTION --}}
    <div class="mb-4 bg-white rounded-2xl p-5 border border-gray-100 shadow-sm relative overflow-hidden">
        <div class="absolute -top-4 -right-4 w-16 h-16 bg-red-50 rounded-full flex items-center justify-center">
            <i class="bi bi-heart-fill text-red-500 text-xs mt-2 ml-1"></i>
        </div>
        <h3 class="text-xs font-black text-gray-900 uppercase tracking-widest flex items-center gap-2 mb-2">
            Tip your delivery partner
        </h3>
        <p class="text-[10px] text-gray-400 font-bold mb-4 uppercase tracking-tight leading-tight">100% of the tip goes to your delivery partner</p>
        
        <div class="flex gap-2">
            <button onclick="setTip(10)" class="tip-btn flex-1 py-2 px-1 border border-gray-100 rounded-xl bg-gray-50 text-[10px] font-black text-gray-600 hover:border-green-500 hover:text-green-600 transition-all uppercase">₹10</button>
            <button onclick="setTip(20)" class="tip-btn flex-1 py-2 px-1 border border-gray-100 rounded-xl bg-gray-50 text-[10px] font-black text-gray-600 hover:border-green-500 hover:text-green-600 transition-all uppercase">₹20</button>
            <button onclick="setTip(30)" class="tip-btn flex-1 py-2 px-1 border border-gray-100 rounded-xl bg-gray-50 text-[10px] font-black text-gray-600 hover:border-green-500 hover:text-green-600 transition-all uppercase">₹30</button>
            <button onclick="setTip(50)" class="tip-btn flex-1 py-2 px-1 border border-gray-100 rounded-xl bg-gray-50 text-[10px] font-black text-gray-600 hover:border-green-500 hover:text-green-600 transition-all uppercase">₹50</button>
        </div>
        <input type="hidden" name="tip_amount" id="tip-amount" value="0">
    </div>

    <h2 class="text-base font-black text-gray-900 uppercase italic tracking-tighter mb-6 hidden lg:block border-b pb-3">
        Bill Summary
    </h2>

    <div class="space-y-4">
        {{-- BILL BREAKDOWN --}}
        <div class="space-y-3 pb-4 border-b border-dashed">
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-500 font-bold uppercase tracking-tight flex items-center gap-2">
                    <i class="bi bi-receipt text-blue-500"></i> Item Total
                </span>
                <span id="cart-subtotal" class="text-sm font-black text-gray-900">
                    ₹{{ number_format($subtotal, 2) }}
                </span>
            </div>

            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-500 font-bold uppercase tracking-tight flex items-center gap-2">
                    <i class="bi bi-bicycle text-green-500"></i> Delivery Fee
                </span>
                <div class="text-right">
                    <span class="text-[10px] text-gray-400 line-through font-bold mr-1">₹25.00</span>
                    <span class="text-sm font-black text-green-600">FREE</span>
                </div>
            </div>

            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-500 font-bold uppercase tracking-tight flex items-center gap-2">
                    <i class="bi bi-hand-thumbs-up text-orange-500"></i> Handling Charge
                </span>
                <div class="text-right">
                    <span class="text-[10px] text-gray-400 line-through font-bold mr-1">₹5.00</span>
                    <span class="text-sm font-black text-green-600">FREE</span>
                </div>
            </div>
            <div id="tip-line" class="hidden flex justify-between items-center transition-all duration-300">
                <span class="text-sm text-gray-500 font-bold uppercase tracking-tight flex items-center gap-2">
                    <i class="bi bi-heart text-red-500"></i> Partner Tip
                </span>
                <span id="tip-display" class="text-sm font-black text-gray-900">₹0.00</span>
            </div>
        </div>

        {{-- TOTAL --}}
        <div class="pt-2 flex justify-between items-center bg-gray-50 -mx-6 px-6 py-4">
            <span class="text-lg font-black text-gray-900 uppercase italic tracking-tighter">Grand Total</span>
            <span id="cart-total" class="text-xl font-black text-gray-900 tracking-tighter">
                ₹{{ number_format($finalTotal, 2) }}
            </span>
        </div>

        {{-- SAVINGS BADGE --}}
        @if($discount > 0 || $subtotal > 0)
        <div class="bg-green-50 border border-green-100 rounded-xl p-3 flex items-center gap-3">
            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                <i class="bi bi-piggy-bank-fill"></i>
            </div>
            <p class="text-[11px] font-black text-green-700 uppercase tracking-tight leading-tight">
                You are saving ₹{{ number_format($discount + 25 + 5, 2) }} <br>
                <span class="text-[9px] opacity-70">with free delivery & coupons</span>
            </p>
        </div>
        @endif
    </div>

    {{-- PAYMENT BUTTON --}}
    <a href="{{ route('account.checkout.index') }}" 
       class="block w-full mt-6 bg-green-600 hover:bg-green-700 text-white text-center py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-lg shadow-green-100 transition-all hover:scale-[1.02] active:scale-95">
        Proceed to Checkout
    </a>
</div>

{{-- COUPONS AREA (Moved below primary bill for Blinkit style) --}}
@if(!session('applied_coupon') && $coupons->count())
<div class="mt-4 bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
    <div class="flex items-center gap-2 mb-4">
        <div class="w-6 h-1 w-8 bg-green-500 rounded-full"></div>
        <h3 class="text-xs font-black text-gray-900 uppercase tracking-widest">Available Coupons</h3>
    </div>
    <div class="space-y-3">
        @foreach($coupons as $coupon)
            <button onclick="applyCoupon('{{ $coupon->code }}')" class="w-full group">
                <div class="border-2 border-dashed border-green-100 rounded-xl p-3 flex justify-between items-center group-hover:border-green-500 transition-all bg-green-50/10">
                    <div class="text-left">
                        <span class="text-sm font-black text-green-600 uppercase">{{ $coupon->code }}</span>
                        <p class="text-[10px] text-gray-400 font-bold mt-0.5">Save ₹{{ $coupon->value }} on this order</p>
                    </div>
                    <span class="text-[10px] font-black text-green-600 uppercase tracking-widest group-hover:underline">Apply</span>
                </div>
            </button>
        @endforeach
    </div>
</div>
@endif

@if(session('applied_coupon'))
<div class="mt-4 bg-green-600 rounded-2xl p-4 flex items-center justify-between shadow-lg shadow-green-100 text-white">
    <div class="flex items-center gap-3">
        <i class="bi bi-patch-check-fill text-xl"></i>
        <div>
            <p class="text-[10px] font-bold opacity-80 uppercase tracking-widest leading-none mb-1">Coupon Applied</p>
            <h4 class="text-sm font-black uppercase">{{ session('applied_coupon.code') }}</h4>
        </div>
    </div>
    <form action="{{ route('account.coupon.remove') }}" method="POST">
        @csrf
        <button type="submit" class="text-[10px] font-black uppercase tracking-widest border border-white/30 px-3 py-1.5 rounded-full hover:bg-white/10">Remove</button>
    </form>
</div>
@endif

    {{-- CANCELLATION POLICY --}}
    <div class="mt-4 bg-gray-50 rounded-2xl p-4 border border-gray-100 mb-6">
        <div class="flex gap-3">
            <i class="bi bi-info-circle text-gray-400 text-sm"></i>
            <div>
                <p class="text-[10px] font-black text-gray-900 uppercase tracking-widest leading-none mb-1">Cancellation Policy</p>
                <p class="text-[10px] text-gray-500 font-bold leading-tight">Orders cannot be cancelled once packed for delivery. In case of unexpected delays, please contact support.</p>
            </div>
        </div>
    </div>
</div>

</div>

</div>


{{-- MOBILE BOTTOM BAR --}}
<div id="veiw-details-btn"
    class="fixed bottom-0 left-0 right-0 py-3 px-4 bg-white border-t border-gray-100 flex justify-between items-center lg:hidden shadow-[0_-10px_30px_rgba(0,0,0,0.05)] z-[60]">
    <div class="flex flex-col">
        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none">To Pay</span>
        <span id="mobile-total" class="text-lg font-black text-gray-900 tracking-tighter mt-1">
            ₹{{ number_format($finalTotal, 2) }}
        </span>
    </div>
    
    <button onclick="togglePriceDetails()" 
        class="bg-green-600 text-white px-6 py-3 rounded-2xl font-black text-xs uppercase tracking-widest flex items-center gap-2 shadow-lg shadow-green-100 active:scale-95 transition-all">
        View Bill
        <i class="fa fa-chevron-up text-[10px] opacity-70"></i>
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

if(document.getElementById('mobile-total')) {
    document.getElementById('mobile-total').innerText = '₹'+data.total.toFixed(2);
}

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

// --- NEW LOGIC ---

// Instruction Toggles
document.querySelectorAll('.instruction-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        this.classList.toggle('bg-green-50');
        this.classList.toggle('border-green-200');
        this.classList.toggle('text-green-600');
    });
});

// Tipping Logic
function setTip(amount) {
    const tipInput = document.getElementById('tip-amount');
    const tipLine = document.getElementById('tip-line');
    const tipDisplay = document.getElementById('tip-display');
    const cartTotalEl = document.getElementById('cart-total');
    const mobileTotalEl = document.getElementById('mobile-total');
    
    // Get base total (without previous tip)
    let currentTotalStr = cartTotalEl.innerText.replace('₹', '').replace(',', '');
    let currentTip = parseFloat(tipInput.value) || 0;
    let baseTotal = parseFloat(currentTotalStr) - currentTip;

    // Toggle logic: if same amount clicked, remove tip
    let newAmount = (currentTip === amount) ? 0 : amount;
    
    // Update buttons UI
    document.querySelectorAll('.tip-btn').forEach(btn => {
        if (parseFloat(btn.innerText.replace('₹', '')) === newAmount) {
            btn.classList.add('bg-green-600', 'text-white', 'border-green-600');
            btn.classList.remove('bg-gray-50', 'text-gray-600');
        } else {
            btn.classList.add('bg-gray-50', 'text-gray-600');
            btn.classList.remove('bg-green-600', 'text-white', 'border-green-600');
        }
    });

    // Update Values
    tipInput.value = newAmount;
    if (newAmount > 0) {
        tipLine.classList.remove('hidden');
        tipDisplay.innerText = '₹' + newAmount.toFixed(2);
    } else {
        tipLine.classList.add('hidden');
    }

    // Update Totals
    let finalTotal = baseTotal + newAmount;
    cartTotalEl.innerText = '₹' + finalTotal.toLocaleString(undefined, {minimumFractionDigits: 2});
    if(mobileTotalEl) mobileTotalEl.innerText = '₹' + finalTotal.toLocaleString(undefined, {minimumFractionDigits: 2});
}

</script>

</x-layouts.site>