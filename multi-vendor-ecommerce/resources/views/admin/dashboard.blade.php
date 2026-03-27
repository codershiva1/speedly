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
        <h1 class="text-xl font-black text-emerald-900 sm:text-2xl uppercase tracking-tighter">Admin Dashboard</h1>
        <p class="text-xs text-gray-400 sm:text-sm font-medium">Welcome back! Here's what's happening today.</p>
    </div>

    <div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-2 lg:gap-5 lg:grid-cols-4">
        <div class="p-4 bg-white border border-gray-100 shadow-sm rounded-2xl group hover:border-emerald-200 transition">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none">Total Users</p>
            <h3 class="mt-2 text-xl font-black text-emerald-900 leading-none">{{ $totalUsers }}</h3>
        </div>

        <div class="p-4 bg-white border border-gray-100 shadow-sm rounded-2xl group hover:border-emerald-200 transition">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none">Admins</p>
            <h3 class="mt-2 text-xl font-black text-emerald-900 leading-none">{{ $totalAdmins }}</h3>
        </div>

        <div class="p-4 bg-white border border-gray-100 shadow-sm rounded-2xl group hover:border-emerald-200 transition">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none">Vendors</p>
            <h3 class="mt-2 text-xl font-black text-emerald-900 leading-none">{{ $totalVendors }}</h3>
        </div>

        <div class="p-4 bg-white border border-gray-100 shadow-sm rounded-2xl group hover:border-emerald-200 transition">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none">Customers</p>
            <h3 class="mt-2 text-xl font-black text-emerald-900 leading-none">{{ $totalCustomers }}</h3>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 mb-8 md:grid-cols-2 lg:gap-5 lg:grid-cols-4">
        <div class="p-4 bg-white border border-gray-100 shadow-sm rounded-2xl group hover:border-emerald-200 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none">Revenue</p>
                    <h3 class="mt-2 text-xl font-black text-emerald-900 leading-none">
                        ₹{{ number_format($revenue ?? 0, 0) }}
                    </h3>
                </div>
                <div class="p-2 bg-emerald-50 rounded-xl">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>

        <div class="p-4 bg-white border border-gray-100 shadow-sm rounded-2xl group hover:border-emerald-200 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none">Orders</p>
                    <h3 class="mt-2 text-xl font-black text-emerald-900 leading-none">{{ $totalOrders }}</h3>
                </div>
                <div class="p-2 bg-emerald-50 rounded-xl">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
            </div>
        </div>

        <div class="p-4 bg-white border border-gray-100 shadow-sm rounded-2xl group hover:border-emerald-200 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none">Brands</p>
                    <h3 class="mt-2 text-xl font-black text-emerald-900 leading-none">{{ $totalBrands }}</h3>
                </div>
                <div class="p-2 bg-emerald-50 rounded-xl">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                </div>
            </div>
        </div>

        <div class="p-4 bg-white border border-gray-100 shadow-sm rounded-2xl group hover:border-emerald-200 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none">Coupons</p>
                    <h3 class="mt-2 text-xl font-black text-emerald-900 leading-none">{{ $activeCoupons }}</h3>
                </div>
                <div class="p-2 bg-emerald-50 rounded-xl">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 mb-8 lg:grid-cols-3">
        <div class="lg:col-span-2 p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-sm font-black text-emerald-900 uppercase tracking-widest leading-none">Revenue Trend (30 Days)</h3>
                <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md uppercase">Live Analytics</span>
            </div>
            <div class="h-[250px] relative">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
            <h3 class="text-sm font-black text-emerald-900 uppercase tracking-widest leading-none mb-6">Platform Distribution</h3>
            <div class="h-[200px] flex items-center justify-center relative">
                <canvas id="distributionChart"></canvas>
            </div>
            <div class="mt-6 space-y-4">
                <div class="flex items-center justify-between text-[10px] font-black text-gray-400 uppercase tracking-widest">
                    <span>Vendors vs Total</span>
                    <span class="text-emerald-600">{{ number_format(($totalVendors / max($totalUsers, 1)) * 100, 1) }}%</span>
                </div>
                <div class="w-full bg-gray-50 rounded-full h-2 shadow-inner overflow-hidden">
                    <div class="bg-emerald-500 h-full shadow-lg shadow-emerald-100" style="width: {{ ($totalVendors / max($totalUsers, 1)) * 100 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white border border-gray-100 shadow-sm rounded-xl overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-50 flex items-center justify-between">
            <h3 class="text-sm font-black text-emerald-900 uppercase tracking-widest">Recent Orders</h3>
            <a href="{{ route('admin.orders.index') }}" class="text-[10px] font-black text-emerald-600 uppercase tracking-widest hover:underline">View All</a>
        </div>
        
        <!-- Desktop View (Standard Protocol) -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-emerald-50/50 border-b border-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Order ID</th>
                        <th class="hidden px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest md:table-cell">Recipient</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Amount</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($recentOrders as $order)
                    <tr class="hover:bg-emerald-50/20 transition group">
                        <td class="px-6 py-4">
                            <span class="text-xs font-black text-emerald-900 group-hover:text-emerald-600 transition tracking-tighter uppercase">#{{ $order->order_number }}</span>
                        </td>
                        <td class="hidden px-6 py-4 md:table-cell">
                            <span class="text-xs font-bold text-gray-600">{{ $order->shipping_name }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-black text-emerald-900">{{ $order->currency }} {{ number_format($order->total_amount, 0) }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="px-3 py-1 text-[9px] font-black rounded-xl uppercase tracking-widest
                                @if($order->status == 'delivered') bg-emerald-100 text-emerald-700 
                                @elseif($order->status == 'pending') bg-amber-100 text-amber-700 
                                @else bg-gray-100 text-gray-600 @endif">
                                {{ $order->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-[10px] font-black text-gray-300 uppercase tracking-widest italic">No Transactional History Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile View (Zero Scroll Protocol) -->
        <div class="md:hidden divide-y divide-gray-50">
            @forelse($recentOrders as $order)
            <div class="p-5 bg-white hover:bg-emerald-50/10 transition-colors">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">Order #{{ $order->order_number }}</span>
                    <span class="px-2 py-1 text-[8px] font-black rounded-lg uppercase tracking-widest border shadow-sm
                        @if($order->status == 'delivered') bg-emerald-50 text-emerald-700 border-emerald-100
                        @elseif($order->status == 'pending') bg-amber-50 text-amber-700 border-amber-100
                        @else bg-gray-50 text-gray-600 border-gray-100 @endif">
                        {{ $order->status }}
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-gray-900">{{ $order->shipping_name }}</p>
                        <p class="text-[9px] text-gray-400 uppercase tracking-tighter">{{ $order->created_at->diffForHumans() }}</p>
                    </div>
                    <p class="text-sm font-black text-emerald-900">{{ $order->currency }} {{ number_format($order->total_amount, 0) }}</p>
                </div>
            </div>
            @empty
                <div class="p-10 text-center text-[10px] font-black text-gray-300 uppercase tracking-widest italic">No Transactions</div>
            @endforelse
        </div>
>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const salesData = {!! json_encode($salesData) !!};
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: salesData.map(d => d.date),
            datasets: [{
                label: 'Revenue (₹)',
                data: salesData.map(d => d.total),
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 4,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#10b981',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { display: false },
                    ticks: { font: { size: 10, weight: 'bold' } }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 10, weight: 'bold' } }
                }
            }
        }
    });

    // Distribution Chart (Doughnut)
    const dtx = document.getElementById('distributionChart').getContext('2d');
    new Chart(dtx, {
        type: 'doughnut',
        data: {
            labels: ['Admins', 'Vendors', 'Customers'],
            datasets: [{
                data: [{{ $totalAdmins }}, {{ $totalVendors }}, {{ $totalCustomers }}],
                backgroundColor: ['#064e3b', '#10b981', '#6ee7b7'],
                borderWidth: 0,
                cutout: '75%'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { font: { size: 10, weight: 'bold' }, padding: 20 } }
            }
        }
    });
});
</script>
@endpush