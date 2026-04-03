<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Speedly Rider Panel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 flex h-screen overflow-hidden">
    <!-- Sidebar -->
    @include('delivery.layouts.navigation')

    <!-- Main Content -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        <!-- Top Header -->
        <header class="bg-white shadow-sm z-10 relative border-b border-gray-100">
            <div class="px-6 py-4 flex justify-between items-center">
                <div class="flex items-center">
                    <button id="sidebar-toggle" class="mr-4 text-green-800 focus:outline-none md:hidden bg-green-50 p-1.5 rounded-lg active:bg-green-100 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <h2 class="text-xl font-bold text-gray-800 hidden sm:block">
                        {{ $header ?? 'Dashboard' }}
                    </h2>
                </div>
                
                <div class="flex items-center space-x-4">
                    <!-- Status Toggle Placeholder -->
                    <div class="flex items-center bg-gray-50 px-3 py-1.5 rounded-full border border-gray-100 shadow-inner">
                        <span class="mr-2 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden sm:block">Status</span>
                        <label class="inline-flex relative items-center cursor-pointer">
                            <input type="checkbox" id="online-toggle" class="sr-only peer" {{ auth()->user()->deliveryBoyProfile?->is_online ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:shadow-sm after:transition-all peer-checked:bg-green-500"></div>
                            <span id="online-text" class="ml-2 text-sm font-bold {{ auth()->user()->deliveryBoyProfile?->is_online ? 'text-green-600' : 'text-gray-400' }}">
                                {{ auth()->user()->deliveryBoyProfile?->is_online ? 'Online' : 'Offline' }}
                            </span>
                        </label>
                    </div>

                    <!-- Notifications -->
                    <a href="{{ route('delivery.notifications') }}" class="relative p-2 text-gray-400 hover:text-green-600 focus:outline-none transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="absolute top-1.5 right-1.5 block h-2.5 w-2.5 rounded-full bg-red-500 ring-2 ring-white"></span>
                        @endif
                    </a>

                    <!-- Profile Dropdown (Basic) -->
                    <div class="relative pl-2 border-l border-gray-200">
                        <a href="{{ route('delivery.profile') }}" class="flex items-center cursor-pointer space-x-2 border-2 border-transparent hover:border-green-500 rounded-full transition-all focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2">
                            @if(auth()->user()->image_url)
                                <img src="@storageUrl(auth()->user()->image_url)" alt="Profile" class="w-10 h-10 rounded-full object-cover shadow-sm bg-white border border-gray-100">
                            @else
                                <div class="w-10 h-10 rounded-full bg-green-100 text-green-700 flex items-center justify-center font-extrabold shadow-sm border border-green-200 text-sm">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1) . substr(auth()->user()->last_name ?? '', 0, 1)) }}
                                </div>
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-4 sm:p-6 w-full relative pb-24 md:pb-6">
            {{ $slot }}
        </main>

<!-- Premium Mobile Bottom Navigation -->
<div class="fixed bottom-0 left-0 right-0 z-50 md:hidden px-6 pb-6 mt-10">
    <div class="bg-[#dcfce7]/60 backdrop-blur-xl border border-white/40 shadow-[0_12px_40px_rgba(0,0,0,0.12)] rounded-[32px] flex items-center justify-around py-4 px-2">
        <!-- Home -->
        <a href="{{ route('delivery.dashboard') }}" class="flex flex-col items-center group {{ request()->routeIs('delivery.dashboard') ? 'text-green-600' : 'text-green-700/60' }}">
            <div class="relative transition-transform group-active:scale-95">
                <svg class="w-7 h-7 mb-1" fill="{{ request()->routeIs('delivery.dashboard') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
            </div>
            <span class="text-[10px] font-extrabold uppercase tracking-widest">Home</span>
        </a>

        <!-- Orders -->
        <a href="{{ route('delivery.orders.index') }}" class="flex flex-col items-center group {{ request()->routeIs('delivery.orders.*') ? 'text-green-600' : 'text-green-700/60' }}">
            <div class="relative transition-transform group-active:scale-95">
                <svg class="w-7 h-7 mb-1" fill="{{ request()->routeIs('delivery.orders.*') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
            <span class="text-[10px] font-extrabold uppercase tracking-widest">Orders</span>
        </a>

        <!-- Earnings / Wallet -->
        <a href="{{ route('delivery.earnings') }}" class="flex flex-col items-center group {{ request()->routeIs('delivery.earnings') ? 'text-green-600' : 'text-green-700/60' }}">
            <div class="relative transition-transform group-active:scale-95">
                <svg class="w-7 h-7 mb-1" fill="{{ request()->routeIs('delivery.earnings') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <span class="text-[10px] font-extrabold uppercase tracking-widest">Wallet</span>
        </a>

        <!-- Support -->
        <a href="{{ route('delivery.support') }}" class="flex flex-col items-center group {{ request()->routeIs('delivery.support') ? 'text-green-600' : 'text-green-700/60' }}">
            <div class="relative transition-transform group-active:scale-95">
                <svg class="w-7 h-7 mb-1" fill="{{ request()->routeIs('delivery.support') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
            <span class="text-[10px] font-extrabold uppercase tracking-widest">Help</span>
        </a>
    </div>
</div>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        if(sidebarToggle && sidebar && sidebarOverlay) {
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
                sidebarOverlay.classList.toggle('hidden');
            });

            sidebarOverlay.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            });
        }
    });

    document.getElementById('online-toggle').addEventListener('change', function() {
        const isOnline = this.checked;
        const textSpan = document.getElementById('online-text');
        
        fetch('{{ route("delivery.profile.toggle-status") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ is_online: isOnline })
        }).then(response => response.json())
          .then(data => {
              if (isOnline) {
                  textSpan.textContent = 'Online';
                  textSpan.className = 'ml-2 text-sm font-bold text-green-600';
              } else {
                  textSpan.textContent = 'Offline';
                  textSpan.className = 'ml-2 text-sm font-bold text-gray-400';
              }
          }).catch(error => {
              console.error('Error:', error);
              // Revert UI on error
              this.checked = !isOnline;
          });
    });
</script>
</html>
