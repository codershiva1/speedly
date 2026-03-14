<style>
@media (max-width:767px){
.sticky-header{
display:none;
}
}
</style>

<x-layouts.site :title="__('My Orders')">

<div class="py-10 bg-gray-50 min-h-screen">

<div class="max-w-6xl mx-auto px-4">

<div class="mb-8">
<h1 class="text-3xl font-black text-gray-900 italic">
MY <span class="text-green-600">ORDERS</span>
</h1>

<p class="text-gray-500 text-sm mt-1 font-medium">
Track and manage your recent purchases
</p>
</div>

{{-- ================= DESKTOP TABLE ================= --}}
<div class="hidden md:block bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">

<div class="overflow-x-auto">

<table class="w-full text-left">

<thead class="bg-gray-50 border-b">

<tr>
<th class="px-6 py-4 text-xs font-bold text-gray-400">Order</th>
<th class="px-6 py-4 text-xs font-bold text-gray-400">Items</th>
<th class="px-6 py-4 text-xs font-bold text-gray-400">Status</th>
<th class="px-6 py-4 text-xs font-bold text-gray-400">Total</th>
<th class="px-6 py-4"></th>
</tr>

</thead>

<tbody class="divide-y">

@foreach($orders as $order)

<tr class="hover:bg-gray-50">

<td class="px-6 py-5">

<p class="font-bold text-indigo-600">
#{{ $order->order_number }}
</p>

<p class="text-xs text-gray-400">
{{ $order->created_at->format('d M Y') }}
</p>

</td>

<td class="px-6 py-5">

<div class="flex -space-x-3">

@foreach($order->items->take(3) as $item)

@php $img = $item->product->images->first(); @endphp

<img
src="{{ $img ? asset('public/storage/'.$img->path) : asset('images/no-image.png') }}"
class="w-10 h-10 rounded-full object-cover border">

@endforeach

</div>

</td>

<td class="px-6 py-5">

<span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
{{ $order->status }}
</span>

</td>

<td class="px-6 py-5 font-bold">

₹{{ number_format($order->total_amount,2) }}

</td>

<td class="px-6 py-5 text-right">

<div class="flex justify-end gap-3">

<form action="{{ route('account.orders.reorder',$order) }}" method="POST">
@csrf

<button class="text-green-600 text-sm font-semibold">
Reorder
</button>

</form>

<a
href="{{ route('account.orders.show',$order) }}"
class="px-4 py-2 bg-gray-900 text-white text-xs rounded-lg">

Details

</a>

</div>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

{{-- ================= MOBILE CARDS ================= --}}
<div class="md:hidden space-y-4">

@forelse($orders as $order)

<div class="bg-white rounded-2xl shadow-sm p-4">

<div class="flex justify-between items-center mb-2">

<p class="font-bold text-indigo-600 text-sm">
#{{ $order->order_number }}
</p>

<span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">
{{ $order->status }}
</span>

</div>

<p class="text-xs text-gray-400 mb-3">
{{ $order->created_at->format('d M Y') }}
</p>

<div class="flex items-center gap-3 mb-3">

<div class="flex -space-x-2">

@foreach($order->items->take(3) as $item)

@php $img = $item->product->images->first(); @endphp

<img
src="{{ $img ? asset('public/storage/'.$img->path) : asset('images/no-image.png') }}"
class="w-9 h-9 rounded-full border object-cover">

@endforeach

</div>

@if($order->items->count() > 3)

<span class="text-xs text-gray-400">
+{{ $order->items->count()-3 }} items
</span>

@endif

</div>

<div class="flex justify-between items-center mb-3">

<p class="text-sm font-bold">
₹{{ number_format($order->total_amount,2) }}
</p>

<p class="text-xs text-gray-500">
{{ strtoupper($order->payment_method) }}
</p>

</div>

<div class="flex gap-2">

<form
action="{{ route('account.orders.reorder',$order) }}"
method="POST"
class="flex-1">

@csrf

<button
class="w-full py-2 bg-green-600 text-white text-sm rounded-lg">

Reorder

</button>

</form>

<a
href="{{ route('account.orders.show',$order) }}"
class="flex-1 text-center py-2 bg-gray-900 text-white text-sm rounded-lg">

Details

</a>

</div>

</div>

@empty

<div class="text-center py-20">

<p class="text-gray-500 mb-4">
No orders yet
</p>

<a
href="/"
class="px-6 py-2 bg-green-600 text-white rounded-lg">

Start Shopping

</a>

</div>

@endforelse

</div>

<div class="mt-8">
{{ $orders->links() }}
</div>

</div>

</div>

</x-layouts.site>