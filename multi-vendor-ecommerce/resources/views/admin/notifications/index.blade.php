@extends('layouts.admin.app')

@section('content')
<div class="p-6 mx-auto max-w-7xl sm:p-8 lg:p-10">
    <div class="mb-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
        <div>
            <h1 class="text-2xl font-black text-emerald-900 uppercase tracking-tighter">System Alert Protocol</h1>
            <p class="mt-2 text-xs font-bold text-gray-500 uppercase tracking-widest">Lattice Synchronization & Event Monitoring</p>
        </div>
        <div class="inline-flex items-center px-6 py-3 bg-white border border-emerald-100 shadow-xl shadow-emerald-50 rounded-2xl text-[10px] font-black text-emerald-600 uppercase tracking-[0.2em] transform hover:scale-105 transition-transform">
            <span class="relative flex h-3 w-3 mr-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-600"></span>
            </span>
            Active Sync: {{ $totalCount }} Alerts
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        <!-- Pending Orders Card -->
        <div class="group flex flex-col bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden hover:border-emerald-100 hover:shadow-xl hover:shadow-emerald-50/50 transition-all duration-500">
            <div class="p-6 border-b border-gray-50 flex items-center justify-between bg-emerald-50/20">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-emerald-100 text-emerald-600 rounded-2xl shadow-inner">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <h2 class="text-xs font-black text-emerald-900 uppercase tracking-widest">Order Queues</h2>
                </div>
                <span class="text-[10px] font-black bg-emerald-600 text-white px-3 py-1 rounded-xl shadow-lg shadow-emerald-100">{{ $recentOrders->count() }}</span>
            </div>
            
            <div class="p-6 space-y-5 flex-1 bg-white">
                @forelse($recentOrders as $order)
                <div class="relative p-5 rounded-3xl border border-gray-50 hover:border-emerald-200 transition-all duration-300 bg-gray-50/30 shadow-sm group/item">
                    <div class="flex justify-between items-start mb-3">
                        <span class="text-xs font-black text-emerald-900 uppercase tracking-tighter">#{{ $order->order_number }}</span>
                        <span class="text-xs font-black text-emerald-600">{{ $order->currency }} {{ number_format($order->total_amount, 0) }}</span>
                    </div>
                    <div class="flex items-center text-[9px] font-black text-gray-400 uppercase tracking-widest mb-4">
                        <svg class="w-3 h-3 mr-1.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Pending since {{ $order->created_at->diffForHumans() }}
                    </div>
                    <a href="{{ route('admin.orders.show', $order) }}" class="block w-full text-center py-3 text-[10px] font-black text-white bg-emerald-600 rounded-2xl opacity-0 group-hover/item:opacity-100 transition-all transform translate-y-2 group-hover/item:translate-y-0 shadow-lg shadow-emerald-100">Synchronize Order</a>
                </div>
                @empty
                <div class="text-center py-16 opacity-50 grayscale">
                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Queue Depleted</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Inventory Alerts Card -->
        <div class="group flex flex-col bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden hover:border-rose-100 hover:shadow-xl hover:shadow-rose-50/50 transition-all duration-500">
            <div class="p-6 border-b border-gray-50 flex items-center justify-between bg-rose-50/20">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-rose-100 text-rose-600 rounded-2xl shadow-inner">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <h2 class="text-xs font-black text-rose-900 uppercase tracking-widest">Critical Stock</h2>
                </div>
                <span class="text-[10px] font-black bg-rose-600 text-white px-3 py-1 rounded-xl shadow-lg shadow-rose-100">{{ $lowStockProducts->count() }}</span>
            </div>

            <div class="p-6 space-y-4 bg-white">
                @forelse($lowStockProducts as $product)
                <div class="flex items-center p-5 rounded-3xl bg-gray-50/30 border border-transparent hover:border-rose-200 hover:bg-rose-50/30 transition-all group/item">
                    <div class="flex-1">
                        <h4 class="text-xs font-black text-emerald-900 uppercase tracking-tighter truncate w-40">{{ $product->name }}</h4>
                        <div class="flex items-center mt-2">
                             <span class="px-2 py-0.5 bg-rose-100 text-rose-600 text-[8px] font-black rounded-lg uppercase tracking-tighter">Stock Crushed</span>
                             <span class="ml-2 text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ $product->stock_quantity }} Remaining</span>
                        </div>
                    </div>
                    <a href="{{ route('admin.products.edit', $product) }}" class="ml-4 p-3 bg-white text-gray-400 hover:text-emerald-600 hover:shadow-md rounded-xl transition-all shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </a>
                </div>
                @empty
                <div class="text-center py-16 opacity-50 grayscale">
                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Inventory Balanced</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- New Nodes Card -->
        <div class="group flex flex-col bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden hover:border-blue-100 hover:shadow-xl hover:shadow-blue-50/50 transition-all duration-500">
            <div class="p-6 border-b border-gray-50 flex items-center justify-between bg-blue-50/20">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-blue-100 text-blue-600 rounded-2xl shadow-inner">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    </div>
                    <h2 class="text-xs font-black text-blue-900 uppercase tracking-widest">New Entities</h2>
                </div>
                <span class="text-[10px] font-black bg-blue-600 text-white px-3 py-1 rounded-xl shadow-lg shadow-blue-100">{{ $recentUsers->count() }}</span>
            </div>

            <div class="p-6 bg-white overflow-hidden">
                <div class="space-y-4">
                    @forelse($recentUsers as $user)
                    <div class="flex items-center p-4 hover:bg-blue-50/30 rounded-3xl transition-all group/item border border-transparent hover:border-blue-50">
                        <div class="h-12 w-12 shrink-0 rounded-2xl bg-emerald-600 flex items-center justify-center text-white font-black text-sm shadow-lg shadow-emerald-100 ring-4 ring-white">
                            {{ substr($user->name, 0, 1) }}{{ substr($user->last_name ?? 'X', 0, 1) }}
                        </div>
                        <div class="ml-4">
                            <p class="text-xs font-black text-emerald-900 uppercase tracking-tighter leading-none mb-1">{{ $user->name }}</p>
                            <p class="text-[9px] text-gray-400 uppercase tracking-[0.15em] font-black">Registered {{ $user->created_at->format('d M') }}</p>
                        </div>
                        <div class="ml-auto p-2 bg-white rounded-xl shadow-sm text-blue-500 opacity-0 group-hover/item:opacity-100 transition-all">
                             <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-16 opacity-50 grayscale">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        </div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">No Recent Registrations</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>
@endsection