@php
    use App\Helpers\MenuHelper;
    $menuGroups = MenuHelper::getMenuGroups();
@endphp

<aside id="sidebar"
    class="fixed flex flex-col mt-0 top-0 px-5 left-0 bg-white dark:bg-gray-900 dark:border-gray-800 text-gray-900 h-screen transition-all duration-300 ease-in-out z-99999 border-r border-gray-200"
    x-data="{
        openSubmenus: {},
        init() {
            this.initializeActiveMenus();
        },
        initializeActiveMenus() {
            @foreach ($menuGroups as $groupIndex => $menuGroup)
                @foreach ($menuGroup['items'] as $itemIndex => $item)
                    @if (isset($item['subItems']))
                        @foreach ($item['subItems'] as $subItem)
                            @if (!empty($subItem['route']) && MenuHelper::isActiveRoute($subItem['route']))
                                this.openSubmenus['{{ $groupIndex }}-{{ $itemIndex }}'] = true;
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @endforeach
        },
        toggleSubmenu(groupIndex, itemIndex) {
            const key = groupIndex + '-' + itemIndex;
            this.openSubmenus = { [key]: !this.openSubmenus[key] };
        },
        isSubmenuOpen(groupIndex, itemIndex) {
            return this.openSubmenus[groupIndex + '-' + itemIndex] || false;
        }
    }"
    :class="{
        'w-[290px]': $store.sidebar.isExpanded || $store.sidebar.isMobileOpen || $store.sidebar.isHovered,
        'w-[90px]': !$store.sidebar.isExpanded && !$store.sidebar.isHovered,
        'translate-x-0': $store.sidebar.isMobileOpen,
        '-translate-x-full xl:translate-x-0': !$store.sidebar.isMobileOpen
    }"
    @mouseenter="if (!$store.sidebar.isExpanded) $store.sidebar.setHovered(true)"
    @mouseleave="$store.sidebar.setHovered(false)"
>

    <!-- Logo -->
    <div class="pt-2 pb-7 flex justify-center">
        <a href="{{ route('home') }}">
            <img class="w-[150px]"
                 src="{{ asset('storage/uploads/logo/speedly_logo3.png') }}"
                 alt="logo">
        </a>
    </div>

    <!-- Navigation -->
    <div class="flex flex-col overflow-y-auto no-scrollbar">
        <nav class="mb-6">
            <div class="flex flex-col gap-4">

                @foreach ($menuGroups as $groupIndex => $menuGroup)
                    <div>

                        <!-- Group Title -->
                        <h2 class="mb-4 text-xs uppercase text-gray-800"
                            x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen">
                            {{ $menuGroup['title'] }}
                        </h2>

                        <ul class="flex flex-col gap-1">

                            @foreach ($menuGroup['items'] as $itemIndex => $item)
                                <li>

                                    {{-- ITEM WITH SUBMENU --}}
                                    @if (isset($item['subItems']))

                                        <button
                                            @click="toggleSubmenu({{ $groupIndex }}, {{ $itemIndex }})"
                                            class="menu-item group w-full"
                                            :class="isSubmenuOpen({{ $groupIndex }}, {{ $itemIndex }})
                                                ? 'menu-item-active'
                                                : 'menu-item-inactive'">

                                            <span class="menu-item-icon">
                                                {!! MenuHelper::getIconSvg($item['icon']) !!}
                                            </span>

                                            <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                                                  class="menu-item-text">
                                                {{ $item['name'] }}
                                            </span>

                                            <svg x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                                                class="ml-auto w-5 h-5 transition-transform"
                                                :class="{ 'rotate-180': isSubmenuOpen({{ $groupIndex }}, {{ $itemIndex }}) }"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-width="2" d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </button>

                                        <!-- Submenu -->
                                        <div x-show="isSubmenuOpen({{ $groupIndex }}, {{ $itemIndex }})">
                                            <ul class="mt-2 ml-9 space-y-1">
                                                @foreach ($item['subItems'] as $subItem)
                                                    <li>
                                                        <a href="{{ route($subItem['route']) }}"
                                                           class="menu-dropdown-item
                                                           {{ MenuHelper::isActiveRoute($subItem['route']) ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive' }}">
                                                            {{ $subItem['name'] }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>

                                    {{-- SIMPLE ITEM --}}
                                    @else
                                        @php
                                            $itemRoute = $item['route'] ?? null;
                                        @endphp

                                        @if ($itemRoute)
                                            <a href="{{ route($itemRoute) }}"
                                            class="menu-item group
                                            {{ MenuHelper::isActiveRoute($itemRoute) ? 'menu-item-active' : 'menu-item-inactive' }}">
                                        @else
                                            <a href="#"
                                            class="menu-item group menu-item-inactive cursor-not-allowed opacity-60">
                                        @endif


                                            <span class="menu-item-icon">
                                                {!! MenuHelper::getIconSvg($item['icon']) !!}
                                            </span>

                                            <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                                                  class="menu-item-text">
                                                {{ $item['name'] }}
                                            </span>
                                        </a>
                                    @endif

                                </li>
                            @endforeach

                        </ul>
                    </div>
                @endforeach

            </div>
        </nav>

        <!-- Sidebar Widget -->
        <div x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
             class="mt-auto">
            @include('layouts.admin.sidebar-widget')
        </div>
    </div>
</aside>

<!-- Mobile Overlay -->
<div x-show="$store.sidebar.isMobileOpen"
     @click="$store.sidebar.setMobileOpen(false)"
     class="fixed inset-0 z-50 bg-gray-900/50">
</div>
