<div class="relative" x-data="{
    dropdownOpen: false,
    toggleDropdown() {
        this.dropdownOpen = !this.dropdownOpen;
    },
    closeDropdown() {
        this.dropdownOpen = false;
    }
}" @click.away="closeDropdown()">
    <!-- User Button -->
    <button
        class="flex items-center gap-3 py-1 group transition-all"
        @click.prevent="toggleDropdown()"
        type="button"
    >
        <div class="relative overflow-hidden rounded-2xl h-11 w-11 border-2 border-emerald-50 group-hover:border-emerald-200 transition-all shadow-sm">
            @if(auth()->user()->image_url)
                <img src="@storageUrl('uploads/' . auth()->user()->image_url)" alt="User" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                <div class="hidden absolute inset-0 bg-emerald-600 items-center justify-center text-white text-xs font-black uppercase tracking-tighter">
                    {{ substr(auth()->user()->name, 0, 1) }}{{ auth()->user()->last_name ? substr(auth()->user()->last_name, 0, 1) : substr(auth()->user()->name, 1, 1) }}
                </div>
            @else
                <div class="absolute inset-0 bg-emerald-600 flex items-center justify-center text-white text-xs font-black uppercase tracking-tighter shadow-inner">
                    {{ substr(auth()->user()->name, 0, 1) }}{{ auth()->user()->last_name ? substr(auth()->user()->last_name, 0, 1) : substr(auth()->user()->name, 1, 1) }}
                </div>
            @endif
        </div>

       <div class="hidden text-left xl:block">
           <span class="block text-xs font-black text-emerald-900 uppercase tracking-widest leading-none">{{ auth()->user()->name }}</span>
           <span class="block mt-1 text-[9px] font-black text-gray-400 uppercase tracking-tighter leading-none">{{ strtoupper(auth()->user()->role) }} NODE</span>
       </div>

        <!-- Chevron Icon -->
        <svg
            class="w-4 h-4 text-gray-400 transition-transform duration-300 group-hover:text-emerald-600"
            :class="{ 'rotate-180': dropdownOpen }"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    <!-- Dropdown Start -->
    <div
        x-show="dropdownOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95 -translate-y-2"
        x-transition:enter-end="transform opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="transform opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="transform opacity-0 scale-95 -translate-y-2"
        class="absolute right-0 mt-4 flex w-[280px] flex-col rounded-3xl border border-gray-100 bg-white p-4 shadow-2xl z-[999]"
        style="display: none;"
    >
        <!-- User Info -->
        <div class="pb-4 border-b border-gray-50 flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600 text-lg font-black uppercase">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
            <div>
                <span class="block font-black text-emerald-900 text-sm uppercase tracking-tighter leading-none">{{ auth()->user()->name }}</span>
                <span class="mt-1.5 block text-[10px] font-bold text-gray-400 lowercase tracking-tight truncate max-w-[180px]">{{ auth()->user()->email }}</span>
            </div>
        </div>

        <!-- Menu Items -->
        <ul class="flex flex-col gap-1 py-3 border-b border-gray-50">
            <li>
                <a href="{{ route('admin.profile.index') }}" class="flex items-center gap-4 px-3 py-3 rounded-2xl group hover:bg-emerald-50 transition-all">
                    <div class="w-8 h-8 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-white group-hover:text-emerald-600 transition-all shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </div>
                    <span class="text-xs font-black text-gray-700 uppercase tracking-widest group-hover:text-emerald-900 transition-colors">Edit Profile</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-4 px-3 py-3 rounded-2xl group hover:bg-emerald-50 transition-all">
                    <div class="w-8 h-8 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-white group-hover:text-emerald-600 transition-all shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </div>
                    <span class="text-xs font-black text-gray-700 uppercase tracking-widest group-hover:text-emerald-900 transition-colors">System Settings</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.support.index') }}" class="flex items-center gap-4 px-3 py-3 rounded-2xl group hover:bg-emerald-50 transition-all">
                    <div class="w-8 h-8 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-white group-hover:text-emerald-600 transition-all shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </div>
                    <span class="text-xs font-black text-gray-700 uppercase tracking-widest group-hover:text-emerald-900 transition-colors">Help Desk</span>
                </a>
            </li>
        </ul>

        <!-- Sign Out -->
        <form method="POST" action="{{ route('logout') }}" class="pt-3">
            @csrf
            <button
                type="submit"
                class="flex items-center w-full gap-4 px-3 py-3 rounded-2xl group hover:bg-rose-50 transition-all text-left"
                @click="closeDropdown()"
            >
                <div class="w-8 h-8 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-white group-hover:text-rose-600 transition-all shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </div>
                <span class="text-xs font-black text-gray-700 uppercase tracking-widest group-hover:text-rose-900 transition-colors">Sign out Protocol</span>
            </button>
        </form>
    </div>
    <!-- Dropdown End -->
</div>
