<?php

namespace App\Helpers;

class MenuHelper
{
    /* ======================================================
        MENU GROUPS
    ====================================================== */

    public static function getMenuGroups()
    {
        return [
            [
                'title' => 'Menu',
                'items' => self::getMainNavItems(),
            ],
            [
                'title' => 'Others',
                'items' => self::getOthersItems(),
            ],
        ];
    }

    /* ======================================================
        MAIN MENU
    ====================================================== */
        
    public static function getMainNavItems()
    {
        return [
            [
                'icon'  => 'dashboard',
                'name'  => 'Dashboard',
                'route' => 'admin.dashboard',
            ],

            [
                'icon'  => 'users',
                'name'  => 'Users',
                'route' => 'admin.users.index'
            ],
            
            [
                'icon'  => 'authentication', // Vendor icon
                'name'  => 'Vendors',
                'route' => 'admin.vendors.index'
            ],

            [
                'icon'  => 'user-profile', // Delivery boy icon
                'name'  => 'Delivery Boys',
                'route' => 'admin.delivery-boys.index'
            ],

            [
                'icon'  => 'calendar',
                'name'  => 'Calendar',
                'route' => null, // not implemented yet
            ],

            [
                'icon'  => 'user-profile',
                'name'  => 'Profile',
                'route' => 'admin.profile.index',
            ],

            [
                'icon'  => 'tables',
                'name'  => 'Catalog',
                'subItems' => [
                    [
                        'name'  => 'Categories',
                        'route' => 'admin.categories.index',
                    ],
                    [
                        'name'  => 'Brands',
                        'route' => 'admin.brands.index',
                    ],
                    [
                        'name'  => 'Products',
                        'route' => 'admin.products.index',
                    ],
                ],
            ],

            [
                'icon'  => 'task',
                'name'  => 'Orders',
                'route' => 'admin.orders.index',
            ],

            [
                'icon'  => 'presentation-chart-line',
                'name'  => 'Marketing',
                'subItems' => [
                    [
                        'name'  => 'Ad Campaigns',
                        'route' => 'admin.ads.index',
                    ],
                    [
                        'name'  => 'Coupons',
                        'route' => 'admin.coupons.index',
                    ],
                ],
            ],

            [
                'icon'  => 'credit-card',
                'name'  => 'Financial & Support',
                'subItems' => [
                    [
                        'name'  => 'Withdrawal Requests',
                        'route' => 'admin.withdrawals.index',
                    ],
                    [
                        'name'  => 'Support Messages',
                        'route' => 'admin.support.index',
                    ],
                    [
                        'name'  => 'System Settings',
                        'route' => 'admin.settings.index',
                    ],
                    [
                        'name'  => 'Security Logs',
                        'route' => 'admin.logs.index',
                    ],
                ],
            ],
        ];
    }

    /* ======================================================
        OTHERS MENU
    ====================================================== */

    public static function getOthersItems()
    {
        return [
            // [
            //     'icon'  => 'charts',
            //     'name'  => 'Charts',
            //     'route' => null,
            // ],
            // [
            //     'icon'  => 'ui-elements',
            //     'name'  => 'UI Elements',
            //     'route' => null,
            // ],
            // [
            //     'icon'  => 'authentication',
            //     'name'  => 'Authentication',
            //     'route' => null,
            // ],
        ];
    }

    /* ======================================================
        ACTIVE ROUTE CHECK (IMPORTANT)
    ====================================================== */

    public static function isActiveRoute(?string $route): bool
    {
        if (! $route || ! request()->route()) {
            return false;
        }

        $current = request()->route()->getName();

        return $current === $route || str_starts_with($current, $route . '.');
    }

    /* ======================================================
        ICON SVGs (FULL – NOT REMOVED)
    ====================================================== */

    public static function getIconSvg($icon)
    {
        $icons = [

            'dashboard' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8v8m5-3h-3"/>
            </svg>',

            'users' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5.121 17.804A4 4 0 0112 15a4 4 0 016.879 2.804M12 12a4 4 0 100-8 4 4 0 000 8z"/>
            </svg>',

            'calendar' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>',

            'user-profile' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5.121 17.804A4 4 0 0112 15a4 4 0 016.879 2.804M12 12a4 4 0 100-8 4 4 0 000 8z"/>
            </svg>',

            'tables' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 10h18M3 6h18M3 14h18M3 18h18"/>
            </svg>',

            'task' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 5l7 7-7 7"/>
            </svg>',

            'coupens' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 16h-1v-4h-1m1-4h.01M6 12a6 6 0 1112 0 6 6 0 01-12 0z"/>
            </svg>',

            'charts' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h4v12H4zM10 10h4v8h-4zM16 4h4v14h-4z"/>
            </svg>',

            'ui-elements' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <rect width="7" height="7" x="3" y="3" rx="1"/>
                <rect width="7" height="7" x="14" y="3" rx="1"/>
                <rect width="7" height="7" x="14" y="14" rx="1"/>
                <rect width="7" height="7" x="3" y="14" rx="1"/>
            </svg>',

            'authentication' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 12H3m12 0l-4-4m4 4l-4 4m5-9V5a2 2 0 012-2h4a2 2 0 012 2v14a2 2 0 01-2 2h-4a2 2 0 01-2-2v-2"/>
            </svg>',

            'presentation-chart-line' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
            </svg>',

            'credit-card' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
            </svg>',
        ];

        return $icons[$icon] ?? '';
    }
}
