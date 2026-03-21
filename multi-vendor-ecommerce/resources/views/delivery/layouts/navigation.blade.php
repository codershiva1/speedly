<!-- Mobile Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-20 hidden md:hidden glassmorphism-overlay transition-opacity"></div>

<!-- Sidebar properly configured for mobile with transform classes -->
<div id="sidebar" class="fixed inset-y-0 left-0 z-30 w-72 bg-gradient-to-b from-[#256c36] to-[#1e5229] shadow-2xl text-white flex flex-col transform -translate-x-full transition-transform duration-300 md:relative md:translate-x-0 md:flex border-r border-[#318b45]">
    
    <!-- Logo Header -->
    <div class="px-6 py-8 flex items-center justify-center relative shadow-sm border-b border-[#318b45]/30">
        <svg class="w-10 h-10 text-white mr-2" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm-1 2.5L17.5 9H13V4.5zM12 18c-2.21 0-4-1.79-4-4h2c0 1.1.9 2 2 2s2-.9 2-2c0-1.1-.9-2-2-2-2.14 0-4-1.81-4-4s1.79-4 4-4 4 1.79 4 4h-2c0-1.1-.9-2-2-2s-2 .9-2 2 .9 2 2 2 2.14 0 4 1.81 4 4s-1.8 4-4 4z"></path></svg>
        <div class="relative">
            <h1 class="text-3xl tracking-tight font-extrabold text-white uppercase italic" style="text-shadow: 1px 2px 4px rgba(0,0,0,0.2);">Speedly</h1>
        </div>
        <!-- Close button mobile -->
        <button id="close-sidebar" class="md:hidden absolute top-4 right-4 text-green-200 hover:text-white bg-[#1a4a24] rounded-full p-1 border border-transparent hover:border-[#4caf50] transition active:scale-95">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    <!-- Navigation List -->
    <nav class="flex-1 px-4 space-y-3 mt-6 text-sm font-semibold tracking-wide">
        <!-- Dashboard Item -->
        <a href="{{ route('delivery.dashboard') }}" class="flex items-center px-4 py-3.5 {{ request()->routeIs('delivery.dashboard') ? 'bg-white text-[#256c36] shadow-lg transform -translate-y-0.5' : 'text-green-100 hover:bg-[#348a48] hover:text-white' }} rounded-2xl transition-all duration-200">
            <svg class="w-5 h-5 mr-4 {{ request()->routeIs('delivery.dashboard') ? 'text-[#256c36]' : 'text-green-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Home / Dashboard
        </a>
        
        <!-- Active Orders item -->
        <a href="{{ route('delivery.orders.index') }}" class="flex items-center px-4 py-3.5 {{ request()->routeIs('delivery.orders.*') ? 'bg-white text-[#256c36] shadow-lg transform -translate-y-0.5' : 'text-green-100 hover:bg-[#348a48] hover:text-white' }} rounded-2xl transition-all duration-200">
            <svg class="w-5 h-5 mr-4 {{ request()->routeIs('delivery.orders.*') ? 'text-[#256c36]' : 'text-green-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            Active Orders 
            <!-- Optionally insert dynamically active orders tally badge later -->
            <span class="ml-auto bg-[#ff9800] text-[10px] font-bold py-0.5 px-2 rounded-full text-white shadow-sm border border-[#fff]/20">2</span>
        </a>

        <!-- Earnings item -->
        <a href="{{ route('delivery.earnings') }}" class="flex items-center px-4 py-3.5 {{ request()->routeIs('delivery.earnings') ? 'bg-white text-[#256c36] shadow-lg transform -translate-y-0.5' : 'text-green-100 hover:bg-[#348a48] hover:text-white' }} rounded-2xl transition-all duration-200">
            <svg class="w-5 h-5 mr-4 {{ request()->routeIs('delivery.earnings') ? 'text-[#256c36]' : 'text-green-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Earnings
        </a>

        <!-- Performance item -->
        <a href="{{ route('delivery.performance') }}" class="flex items-center px-4 py-3.5 {{ request()->routeIs('delivery.performance') ? 'bg-white text-[#256c36] shadow-lg transform -translate-y-0.5' : 'text-green-100 hover:bg-[#348a48] hover:text-white' }} rounded-2xl transition-all duration-200">
            <svg class="w-5 h-5 mr-4 {{ request()->routeIs('delivery.performance') ? 'text-[#256c36]' : 'text-green-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
            Performance
        </a>

        <!-- Profile item -->
        <a href="{{ route('delivery.profile') }}" class="flex items-center px-4 py-3.5 {{ request()->routeIs('delivery.profile') ? 'bg-white text-[#256c36] shadow-lg transform -translate-y-0.5' : 'text-green-100 hover:bg-[#348a48] hover:text-white' }} rounded-2xl transition-all duration-200">
            <svg class="w-5 h-5 mr-4 {{ request()->routeIs('delivery.profile') ? 'text-[#256c36]' : 'text-green-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            Profile
        </a>
        
        <!-- Support -->
        <div class="pt-6 mt-4 border-t border-[#318b45]/40 text-xs font-semibold text-green-300 uppercase tracking-wider px-4 mb-2">Help & Safety</div>
        
        <a href="{{ route('delivery.support') }}" class="flex items-center px-4 py-3.5 {{ request()->routeIs('delivery.support') ? 'bg-white text-[#256c36] shadow-lg transform -translate-y-0.5' : 'text-green-100 hover:bg-[#348a48] hover:text-white' }} rounded-2xl transition-all duration-200">
            <svg class="w-5 h-5 mr-4 {{ request()->routeIs('delivery.support') ? 'text-[#256c36]' : 'text-green-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            Help Support
        </a>

        <a href="{{ route('delivery.training') }}" class="flex items-center px-4 py-3.5 {{ request()->routeIs('delivery.training') ? 'bg-white text-[#256c36] shadow-lg transform -translate-y-0.5' : 'text-green-100 hover:bg-[#348a48] hover:text-white' }} rounded-2xl transition-all duration-200">
            <svg class="w-5 h-5 mr-4 {{ request()->routeIs('delivery.training') ? 'text-[#256c36]' : 'text-green-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            Training SOP
        </a>
    </nav>

    <!-- Bottom Actions box -->
    <div class="p-4 mt-auto">
        <div class="bg-[#1e5229]/80 rounded-2xl p-4 shadow-inner border border-[#318b45]/30">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center justify-center w-full px-4 py-3 bg-[#e53935] text-white rounded-xl shadow-md hover:bg-red-700 hover:shadow-lg transition font-bold tracking-wide active:scale-95">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // Include logic to close sidebar using mobile close button
    document.addEventListener('DOMContentLoaded', function() {
        const closeBtn = document.getElementById('close-sidebar');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        
        if(closeBtn && sidebar && sidebarOverlay) {
            closeBtn.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            });
        }
    });
</script>
