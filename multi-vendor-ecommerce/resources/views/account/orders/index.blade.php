<x-layouts.site :title="__('My Orders')">
<div class="py-10 bg-gray-50 min-h-screen">
    <div class="max-w-6xl mx-auto px-4">
        
        <div class="mb-8">
            <h1 class="text-3xl font-black text-gray-900 italic">MY <span class="text-green-600">ORDERS</span></h1>
            <p class="text-gray-500 text-sm mt-1 font-medium">Track and manage your recent purchases</p>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50/50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-[11px] font-black uppercase tracking-widest text-gray-400">Order Details</th>
                            <th class="px-6 py-4 text-[11px] font-black uppercase tracking-widest text-gray-400">Items</th>
                            <th class="px-6 py-4 text-[11px] font-black uppercase tracking-widest text-gray-400">Status</th>
                            <th class="px-6 py-4 text-[11px] font-black uppercase tracking-widest text-gray-400">Total</th>
                            <th class="px-6 py-4 text-right"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($orders as $order)
                        <tr class="hover:bg-gray-50/80 transition-all group">
                            {{-- COLUMN 1: ID & DATE --}}
                            <td class="px-6 py-6">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-indigo-600 mb-1">#{{ $order->order_number }}</span>
                                    <span class="text-xs text-gray-400 font-medium">
                                        <i class="bi bi-calendar3 mr-1"></i> {{ $order->created_at->format('d M, Y') }}
                                    </span>
                                </div>
                            </td>

                            {{-- COLUMN 2: VISUAL ITEM SUMMARY (The identification boost) --}}
                            <td class="px-6 py-6">
                                <div class="flex items-center">
                                    <div class="flex -space-x-3 overflow-hidden">
                                        @foreach($order->items->take(3) as $item)
                                            @php $img = $item->product->images->first(); @endphp
                                            <div class="inline-block h-10 w-10 rounded-full ring-2 ring-white bg-gray-100 overflow-hidden">
                                                <img src="{{ $img ? asset('storage/'.$img->path) : asset('images/no-image.png') }}" class="h-full w-full object-cover">
                                            </div>
                                        @endforeach
                                    </div>
                                    @if($order->items->count() > 3)
                                        <span class="ml-3 text-xs font-bold text-gray-400">+{{ $order->items->count() - 3 }} more</span>
                                    @endif
                                    <div class="ml-4 hidden md:block">
                                        <p class="text-xs font-bold text-gray-700 truncate max-w-[150px]">
                                            {{ $order->items->first()->product_name }}
                                        </p>
                                        <p class="text-[10px] text-gray-400 uppercase font-black">{{ $order->payment_method }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- COLUMN 3: STATUS --}}
                            <td class="px-6 py-6">
                                @php
                                    $statusClasses = [
                                        'completed' => 'bg-green-50 text-green-600 border-green-100',
                                        'pending' => 'bg-amber-50 text-amber-600 border-amber-100',
                                        'cancelled' => 'bg-red-50 text-red-600 border-red-100',
                                        'processing' => 'bg-blue-50 text-blue-600 border-blue-100',
                                    ][$order->status] ?? 'bg-gray-50 text-gray-600 border-gray-100';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[10px] bg-green-100 font-black uppercase tracking-tighter border {{ $statusClasses }}">
                                    {{ $order->status }}
                                </span>
                            </td>

                            {{-- COLUMN 4: TOTAL --}}
                            <td class="px-6 py-6">
                                <span class="text-sm font-black text-gray-900">₹{{ number_format($order->total_amount, 2) }}</span>
                            </td>

                            {{-- COLUMN 5: ACTIONS --}}
                            <td class="px-6 py-6 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    {{-- REORDER BUTTON --}}
                                    <form action="{{ route('account.orders.reorder', $order) }}" method="POST">
                                        @csrf
                                        <button type="submit" title="Order Again" class="p-2  text-green-600 hover:text-green-700 hover:bg-green-100 rounded-xl transition-all">
                                            <i class="bi bi-arrow-repeat text-lg"></i>
                                           <span slass="text-green-600"> Reorder </span>
                                        </button>
                                    </form>
                                    
                                    {{-- VIEW DETAILS --}}
                                    <a href="{{ route('account.orders.show', $order) }}" class="px-4 py-2 bg-gray-900 text-white text-xs font-black rounded-xl hover:bg-indigo-600 transition-all shadow-sm">
                                        DETAILS
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                        <i class="bi bi-box-seam text-3xl text-gray-300"></i>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-800">No orders yet</h3>
                                    <p class="text-gray-400 text-sm">Your shopping journey starts here!</p>
                                    <a href="/" class="mt-6 px-6 py-2 bg-green-600 text-white font-black rounded-full text-xs">START SHOPPING</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="mt-8">
            {{ $orders->links() }}
        </div>
    </div>
</div>
</x-layouts.site>