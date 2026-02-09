@extends('layouts.admin.app')

@section('content')
<div class="p-4 sm:p-6 lg:p-8 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white tracking-tight">System Alerts</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Manage and review all critical business notifications.</p>
        </div>
        <div class="inline-flex items-center px-4 py-2 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 rounded-full text-sm font-bold">
            <span class="relative flex h-3 w-3 mr-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-indigo-500"></span>
            </span>
            Total Notifications: {{ $totalCount }}
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="flex flex-col bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="p-5 border-b border-gray-50 dark:border-gray-700 flex items-center justify-between bg-amber-50/50 dark:bg-amber-900/10">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <h2 class="font-bold text-gray-800 dark:text-white">Pending Orders</h2>
                </div>
                <span class="text-xs font-bold bg-amber-100 dark:bg-amber-900/50 text-amber-700 dark:text-amber-300 px-2.5 py-1 rounded-full">{{ $recentOrders->count() }}</span>
            </div>
            
            <div class="p-4 space-y-4 flex-1">
                @forelse($recentOrders as $order)
                <div class="group relative p-4 rounded-xl border border-gray-100 dark:border-gray-700 hover:border-amber-200 dark:hover:border-amber-800 transition-all duration-200 bg-white dark:bg-gray-800 shadow-sm hover:shadow-md">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-sm font-bold text-gray-900 dark:text-white">#{{ $order->id }}</span>
                        <span class="text-sm font-black text-amber-600 dark:text-amber-400">${{ number_format($order->total_amount, 2) }}</span>
                    </div>
                    <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 italic">
                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $order->created_at->diffForHumans() }}
                    </div>
                    <a href="#" class="mt-3 block text-center py-2 text-xs font-bold text-amber-700 dark:text-amber-400 bg-amber-50 dark:bg-amber-900/20 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity">Process Order</a>
                </div>
                @empty
                <div class="text-center py-10">
                    <p class="text-gray-400 text-sm">No pending orders found.</p>
                </div>
                @endforelse
            </div>
        </div>

        <div class="flex flex-col bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="p-5 border-b border-gray-50 dark:border-gray-700 flex items-center justify-between bg-red-50/50 dark:bg-red-900/10">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <h2 class="font-bold text-gray-800 dark:text-white">Inventory Alerts</h2>
                </div>
                <span class="text-xs font-bold bg-red-100 dark:bg-red-900/50 text-red-700 dark:text-red-300 px-2.5 py-1 rounded-full">{{ $lowStockProducts->count() }}</span>
            </div>

            <div class="p-4 space-y-4">
                @forelse($lowStockProducts as $product)
                <div class="flex items-center p-4 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-transparent hover:border-red-200 dark:hover:border-red-900 transition-all">
                    <div class="flex-1">
                        <h4 class="text-sm font-bold text-gray-900 dark:text-white truncate w-40">{{ $product->name }}</h4>
                        <p class="text-xs text-red-500 font-medium mt-1">Stock: {{ $product->stock_quantity }} units left</p>
                    </div>
                    <button class="ml-4 p-2 text-gray-400 hover:text-red-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </button>
                </div>
                @empty
                <div class="text-center py-10">
                    <p class="text-gray-400 text-sm">Inventory is healthy.</p>
                </div>
                @endforelse
            </div>
        </div>

        <div class="flex flex-col bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="p-5 border-b border-gray-50 dark:border-gray-700 flex items-center justify-between bg-blue-50/50 dark:bg-blue-900/10">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    </div>
                    <h2 class="font-bold text-gray-800 dark:text-white">New Customers</h2>
                </div>
            </div>

            <div class="p-4">
                <div class="space-y-1">
                    @forelse($recentUsers as $user)
                    <div class="flex items-center p-3 hover:bg-blue-50/50 dark:hover:bg-blue-900/10 rounded-xl transition-colors group">
                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-400 to-indigo-600 flex items-center justify-center text-white font-bold text-xs">
                            {{ substr($user->name, 0, 2) }}
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $user->name }}</p>
                            <p class="text-[10px] text-gray-500 uppercase tracking-widest font-semibold">{{ $user->created_at->format('d M, Y') }}</p>
                        </div>
                        <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity">
                            <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                        </div>
                    </div>
                    @empty
                    <p class="text-center py-10 text-gray-400 text-sm">No new users today.</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>
@endsection