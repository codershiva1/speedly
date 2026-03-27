<div class="relative" x-data="{ open: false }">
    <button @click="open = !open" @click.outside="open = false" 
        class="relative flex items-center justify-center text-gray-400 transition-all bg-white border border-gray-100 rounded-2xl h-11 w-11 hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-100 shadow-sm group">
        
        <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
        </svg>

        @if($totalCount > 0)
            <span class="absolute top-0 right-0 flex h-5 w-5 translate-x-1.5 -translate-y-1.5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-5 w-5 bg-rose-600 text-[10px] font-black text-white items-center justify-center shadow-lg shadow-rose-200 border-2 border-white">
                    {{ $totalCount > 99 ? '99+' : $totalCount }}
                </span>
            </span>
        @endif
    </button>

    <div x-show="open" x-cloak 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        class="absolute -right-12 sm:right-0 mt-4 w-[calc(100vw-2rem)] sm:w-80 origin-top-right rounded-3xl bg-white shadow-2xl border border-gray-50 z-[999]">
        
        <div class="p-5 border-b border-gray-50 flex items-center justify-between">
            <h3 class="text-xs font-black text-emerald-900 uppercase tracking-widest">Protocol Alerts</h3>
            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $totalCount }} Active</span>
        </div>

        <div class="max-h-[350px] overflow-y-auto custom-scrollbar">
            @if($totalCount === 0)
                <div class="p-10 text-center">
                    <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-500 mx-auto mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Status: Symmetrized</p>
                </div>
            @else
                {{-- 1. Low Stock Section --}}
                @foreach($lowStockProducts as $product)
                    <a href="{{ route('admin.products.index') }}" class="flex items-start px-5 py-4 hover:bg-emerald-50/30 transition-colors border-b border-gray-50 group">
                        <div class="shrink-0 w-8 h-8 bg-rose-50 text-rose-600 rounded-xl flex items-center justify-center text-xs group-hover:bg-rose-100 transition-colors">⚠️</div>
                        <div class="ml-4">
                            <p class="text-[10px] font-black text-emerald-900 uppercase tracking-tighter leading-none mb-1">Low Stock Inventory</p>
                            <p class="text-[10px] text-gray-500 font-medium leading-relaxed truncate w-[180px]">{{ $product->name }} (Qty: {{ $product->stock_quantity }})</p>
                        </div>
                    </a>
                @endforeach

                {{-- 2. Pending Orders Section --}}
                @foreach($recentOrders as $order)
                    <a href="{{ route('admin.orders.show', $order) }}" class="flex items-start px-5 py-4 hover:bg-emerald-50/30 transition-colors border-b border-gray-50 group">
                        <div class="shrink-0 w-8 h-8 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center text-xs group-hover:bg-amber-100 transition-colors">📦</div>
                        <div class="ml-4">
                            <p class="text-[10px] font-black text-emerald-900 uppercase tracking-tighter leading-none mb-1">Order Authorization</p>
                            <p class="text-[10px] text-gray-500 font-medium leading-relaxed truncate w-[180px]">#{{ $order->order_number }} - Pending Review</p>
                        </div>
                    </a>
                @endforeach

                {{-- 3. New Users Section --}}
                @foreach($recentUsers as $user)
                    <a href="{{ route('admin.users.index') }}" class="flex items-start px-5 py-4 hover:bg-emerald-50/30 transition-colors border-b border-gray-50 group">
                        <div class="shrink-0 w-8 h-8 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xs group-hover:bg-emerald-100 transition-colors">👤</div>
                        <div class="ml-4">
                            <p class="text-[10px] font-black text-emerald-900 uppercase tracking-tighter leading-none mb-1">Node Registration</p>
                            <p class="text-[10px] text-gray-500 font-medium leading-relaxed truncate w-[180px]">{{ $user->name }} joined the lattice.</p>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>

        <div class="p-3 bg-emerald-50/50 rounded-b-3xl">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-center w-full py-2 text-[10px] font-black text-emerald-600 uppercase tracking-widest hover:text-emerald-800 transition-colors">
                Decrypt All Alerts
            </a>
        </div>
    </div>
</div>