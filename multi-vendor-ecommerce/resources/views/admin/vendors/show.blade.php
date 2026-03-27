@extends('layouts.admin.app')

@section('content')
<div class="sm:px-6 lg:px-8 pb-20">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
        <div class="flex items-center gap-5">
            <div class="w-16 h-16 rounded-3xl bg-emerald-600 shadow-xl shadow-emerald-100 flex items-center justify-center text-white text-2xl font-black">
                {{ substr($vendor->vendorProfile->store_name ?? $vendor->name, 0, 1) }}
            </div>
            <div>
                <h2 class="text-3xl font-black text-emerald-900 tracking-tight leading-none">{{ $vendor->vendorProfile->store_name ?? 'Unnamed Store' }}</h2>
                <div class="flex items-center gap-2 mt-2">
                    <span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-md text-[10px] font-black uppercase tracking-widest">{{ $vendor->vendorProfile->status }}</span>
                    <span class="text-xs text-gray-400 font-medium">Vendor ID: #VN-{{ $vendor->id }}</span>
                </div>
            </div>
        </div>
        <div class="flex gap-3">
             <a href="{{ route('admin.vendors.index') }}" class="px-5 py-2.5 bg-white border border-gray-200 rounded-xl font-black text-[10px] text-gray-400 uppercase tracking-widest hover:text-gray-600 transition">Back to List</a>
             <button class="px-5 py-2.5 bg-emerald-600 text-white rounded-xl font-black text-[10px] uppercase tracking-widest shadow-lg shadow-emerald-100 hover:bg-emerald-700 transition">Export Analytics</button>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Lifetime Revenue</p>
            <h3 class="text-3xl font-black text-emerald-600 tracking-tighter">₹{{ number_format(data_get($salesData, 'total_revenue', 0), 0) }}</h3>
            <div class="mt-4 h-1.5 w-full bg-gray-50 rounded-full overflow-hidden">
                <div class="h-full bg-emerald-500 rounded-full" style="width: 70%"></div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-gray-50 shadow-sm">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Orders</p>
            <h3 class="text-3xl font-black text-emerald-900 tracking-tighter">{{ data_get($salesData, 'total_orders', 0) }}</h3>
            <p class="text-[10px] text-emerald-500 font-bold mt-2 flex items-center">
                <svg class="w-3 h-3 me-1" fill="currentColor" viewBox="0 0 20 20"><path d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"></path></svg>
                12% from last month
            </p>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-gray-50 shadow-sm">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Live Products</p>
            <h3 class="text-3xl font-black text-emerald-900 tracking-tighter">{{ $vendor->products_count ?? $vendor->products->count() }}</h3>
            <div class="flex gap-1 mt-3">
                 <div class="w-2 h-2 rounded-full bg-emerald-400"></div>
                 <div class="w-2 h-2 rounded-full bg-emerald-400"></div>
                 <div class="w-2 h-2 rounded-full bg-emerald-100"></div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-gray-50 shadow-sm">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Store Rating</p>
            <div class="flex items-center gap-2">
                <h3 class="text-3xl font-black text-emerald-900 tracking-tighter">4.8</h3>
                <div class="flex text-amber-400">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                </div>
            </div>
            <p class="text-[10px] text-gray-400 font-bold mt-2 tracking-wide uppercase">Top 5% in Category</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Sales History -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                    <h4 class="font-black text-gray-800 uppercase text-xs tracking-widest">Recent Sales History</h4>
                    <span class="text-[10px] text-emerald-600 font-bold uppercase">View All</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50/50">
                            <tr>
                                <th class="p-4 text-[10px] font-black uppercase text-gray-400">Order ID</th>
                                <th class="p-4 text-[10px] font-black uppercase text-gray-400">Product</th>
                                <th class="p-4 text-[10px] font-black uppercase text-gray-400">Amount</th>
                                <th class="p-4 text-[10px] font-black uppercase text-gray-400">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50/50">
                            @foreach($recentOrders as $item)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="p-4">
                                    <span class="text-xs font-bold text-gray-900">#{{ data_get($item, 'order.order_number') ?? 'ORD-'.data_get($item, 'order_id') }}</span>
                                    <div class="text-[9px] text-gray-400 font-mono">{{ optional(data_get($item, 'created_at'))->format('M d, Y') ?? 'Lately' }}</div>
                                </td>
                                <td class="p-4">
                                    <div class="text-xs font-bold text-gray-700 leading-tight">{{ $item->product_name }}</div>
                                    <div class="text-[9px] text-gray-400">Qty: {{ $item->quantity }}</div>
                                </td>
                                <td class="p-4">
                                    <div class="text-xs font-black text-gray-900">₹{{ number_format($item->total_price, 2) }}</div>
                                </td>
                                <td class="p-4">
                                    <span class="px-2 py-0.5 bg-gray-100 text-gray-500 rounded-md text-[9px] font-black uppercase">{{ data_get($item, 'order.status', 'unknown') }}</span>
                                </td>
                            </tr>
                            @endforeach
                            @if($recentOrders->isEmpty())
                                <tr><td colspan="4" class="p-10 text-center text-gray-400 italic text-xs">No recent sales found.</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Store Details & Actions -->
        <div class="space-y-6">
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                <h4 class="font-black text-gray-800 uppercase text-xs tracking-widest mb-6">Contact & Store Info</h4>
                <div class="space-y-5">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-tighter mb-1">Email Address</label>
                        <p class="text-sm font-bold text-gray-700">{{ $vendor->email }}</p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-tighter mb-1">Phone Number</label>
                        <p class="text-sm font-bold text-gray-700">{{ $vendor->vendorProfile->phone ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-tighter mb-1">Store Address</label>
                        <p class="text-xs font-medium text-gray-600 leading-relaxed">{{ $vendor->vendorProfile->address ?? 'No address provided' }}</p>
                    </div>
                </div>

                <div class="mt-8 pt-8 border-t border-gray-50 flex flex-col gap-3">
                    @if($vendor->vendorProfile->status !== 'approved')
                    <form action="{{ route('admin.vendors.approve', $vendor->id) }}" method="POST">
                        @csrf
                        <button class="w-full bg-emerald-600 text-white py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-emerald-700 transition shadow-lg shadow-emerald-100">Approve Store</button>
                    </form>
                    @endif
                    @if($vendor->vendorProfile->status !== 'rejected')
                    <form action="{{ route('admin.vendors.reject', $vendor->id) }}" method="POST">
                        @csrf
                        <button class="w-full bg-white border border-red-100 text-red-500 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-red-50 transition">Reject Store</button>
                    </form>
                    @endif
                </div>
            </div>

            <div class="bg-emerald-50 p-6 rounded-3xl border border-emerald-100">
                <div class="flex gap-3">
                    <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-emerald-800 uppercase mb-1">Admin Note</p>
                        <p class="text-[11px] text-emerald-700 leading-relaxed font-medium">Verify documents before approval. This vendor is active in the "Groceries" category.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
