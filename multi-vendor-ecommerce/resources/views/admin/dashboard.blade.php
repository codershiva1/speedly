{{--  <!-- <div class="grid grid-cols-12 gap-4 md:gap-6">
    
    <div class="col-span-12 space-y-6 xl:col-span-7">
      <x-ecommerce.ecommerce-metrics 
          :customers="$totalCustomers" 
          :orders="$totalOrders" 
          :growth="$customerGrowth" />
      
      <x-ecommerce.monthly-sale :chartData="$salesData" />
    </div>

    <div class="col-span-12 xl:col-span-5">
        <x-ecommerce.monthly-target />
    </div>

    <div class="col-span-12">
      <x-ecommerce.statistics-chart :salesData="$salesData" />
    </div>

    <div class="col-span-12">
      <x-ecommerce.recent-orders :products="$recentOrders" />
    </div>
    
  </div> --> --}}


@extends('layouts.admin.app')

@section('content')

<div class="p-4 mx-auto max-w-7xl sm:p-6 lg:p-8">
    <div class="mb-6">
        <h1 class="text-xl font-bold text-gray-900 sm:text-2xl dark:text-white">Admin Dashboard</h1>
        <p class="text-xs text-gray-500 sm:text-sm">Welcome back! Here's what's happening today.</p>
    </div>

    <div class="grid grid-cols-2 gap-3 mb-6 lg:gap-5 lg:grid-cols-4">
        <div class="p-3 bg-indigo-600 rounded-xl shadow-sm sm:p-4">
            <p class="text-[10px] font-medium text-indigo-100 uppercase sm:text-xs">Total Users</p>
            <h3 class="mt-1 text-lg font-bold text-white sm:text-2xl">{{ $totalUsers }}</h3>
        </div>

        <div class="p-3 bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-800 dark:border-gray-700 sm:p-4">
            <p class="text-[10px] font-medium text-gray-500 uppercase sm:text-xs">Admins</p>
            <h3 class="mt-1 text-lg font-bold text-gray-900 dark:text-white sm:text-2xl">{{ $totalAdmins }}</h3>
        </div>

        <div class="p-3 bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-800 dark:border-gray-700 sm:p-4">
            <p class="text-[10px] font-medium text-gray-500 uppercase sm:text-xs">Vendors</p>
            <h3 class="mt-1 text-lg font-bold text-gray-900 dark:text-white sm:text-2xl">{{ $totalVendors }}</h3>
        </div>

        <div class="p-3 bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-800 dark:border-gray-700 sm:p-4">
            <p class="text-[10px] font-medium text-gray-500 uppercase sm:text-xs">Customers</p>
            <h3 class="mt-1 text-lg font-bold text-gray-900 dark:text-white sm:text-2xl">{{ $totalCustomers }}</h3>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-3 mb-8 lg:gap-5 lg:grid-cols-4">
        <div class="p-3 bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700 sm:p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-medium text-gray-500 uppercase sm:text-xs">Revenue</p>
                    <h3 class="mt-1 text-base font-bold text-gray-900 dark:text-white sm:text-xl">
                        ₹{{ number_format($revenue ?? 0, 0) }}
                    </h3>
                </div>
                <div class="p-1.5 bg-green-100 rounded-lg dark:bg-green-900/30 sm:p-2">
                    <svg class="w-4 h-4 text-green-600 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>

        <div class="p-3 bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700 sm:p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-medium text-gray-500 uppercase sm:text-xs">Orders</p>
                    <h3 class="mt-1 text-base font-bold text-gray-900 dark:text-white sm:text-xl">{{ $totalOrders }}</h3>
                </div>
                <div class="p-1.5 bg-blue-100 rounded-lg dark:bg-blue-900/30 sm:p-2">
                    <svg class="w-4 h-4 text-blue-600 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
            </div>
        </div>

        <div class="p-3 bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700 sm:p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-medium text-gray-500 uppercase sm:text-xs">Brands</p>
                    <h3 class="mt-1 text-base font-bold text-gray-900 dark:text-white sm:text-xl">{{ $totalBrands }}</h3>
                </div>
                <div class="p-1.5 bg-purple-100 rounded-lg dark:bg-purple-900/30 sm:p-2">
                    <svg class="w-4 h-4 text-purple-600 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                </div>
            </div>
        </div>

        <div class="p-3 bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700 sm:p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-medium text-gray-500 uppercase sm:text-xs">Coupons</p>
                    <h3 class="mt-1 text-base font-bold text-gray-900 dark:text-white sm:text-xl">{{ $activeCoupons }}</h3>
                </div>
                <div class="p-1.5 bg-orange-100 rounded-lg dark:bg-orange-900/30 sm:p-2">
                    <svg class="w-4 h-4 text-orange-600 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700">
        <div class="px-4 py-4 border-b border-gray-200 dark:border-gray-700 sm:px-6">
            <h3 class="text-base font-bold text-gray-900 dark:text-white sm:text-lg">Recent Orders</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 dark:bg-gray-900/50">
                    <tr>
                        <th class="px-4 py-3 text-[10px] font-medium text-gray-500 uppercase sm:text-xs sm:px-6">Order</th>
                        <th class="hidden px-6 py-3 text-xs font-medium text-gray-500 uppercase md:table-cell">Customer</th>
                        <th class="px-4 py-3 text-[10px] font-medium text-gray-500 uppercase sm:text-xs sm:px-6">Amount</th>
                        <th class="px-4 py-3 text-[10px] font-medium text-gray-500 uppercase sm:text-xs sm:px-6">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($recentOrders as $order)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="px-4 py-4 text-xs font-medium text-gray-900 dark:text-white sm:text-sm sm:px-6">
                            #{{ $order->order_number }}
                            <div class="text-[10px] text-gray-400 md:hidden">{{ $order->shipping_name }}</div>
                        </td>
                        <td class="hidden px-6 py-4 text-sm text-gray-500 md:table-cell dark:text-gray-400">{{ $order->shipping_name }}</td>
                        <td class="px-4 py-4 text-xs font-bold text-gray-900 dark:text-white sm:text-sm sm:px-6">{{ $order->currency }} {{ number_format($order->total_amount, 0) }}</td>
                        <td class="px-4 py-4 sm:px-6">
                            <span class="px-2 py-0.5 text-[10px] font-medium rounded-full 
                                @if($order->status == 'delivered') bg-green-100 text-green-700 
                                @elseif($order->status == 'pending') bg-yellow-100 text-yellow-700 
                                @else bg-gray-100 text-gray-700 @endif sm:text-xs">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">No orders found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection