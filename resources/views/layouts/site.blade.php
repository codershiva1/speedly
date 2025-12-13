<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Speedly Shop') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600;700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-900">
        <div class="min-h-screen flex flex-col">
            <!-- Public header -->
            <header class="bg-white border-b border-gray-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
                    <div class="flex items-center space-x-6">
                        <a href="{{ route('home') }}" class="flex items-center space-x-2">
                            <x-application-logo class="h-8 w-auto text-indigo-600" />
                            <span class="font-semibold text-gray-900 hidden sm:inline">{{ config('app.name', 'Speedly Shop') }}</span>
                        </a>
                        <nav class="hidden md:flex items-center space-x-4 text-sm font-medium">
                            <a href="{{ route('shop.index') }}" class="px-2 py-1 rounded {{ request()->routeIs('home') || request()->routeIs('shop.*') ? 'text-indigo-600' : 'text-gray-600 hover:text-gray-900' }}">Shop</a>
                            <a href="{{ route('vendors.index') }}" class="px-2 py-1 rounded {{ request()->routeIs('vendors.*') ? 'text-indigo-600' : 'text-gray-600 hover:text-gray-900' }}">Vendors</a>
                        </nav>
                    </div>

                    <div class="flex items-center space-x-3">
                        <form method="GET" action="{{ route('shop.index') }}" class="hidden sm:flex items-center bg-gray-50 border border-gray-200 rounded-full px-3 py-1 text-xs">
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search products" class="bg-transparent focus:outline-none text-gray-700 placeholder-gray-400 w-40" />
                            <button type="submit" class="ml-1 text-gray-400 hover:text-indigo-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11.25 6.75a4.5 4.5 0 100 9 4.5 4.5 0 000-9z" />
                                </svg>
                            </button>
                        </form>

                        @auth
                            <a href="{{ route('account.cart.index') }}" class="relative text-gray-500 hover:text-indigo-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25h11.218a1.125 1.125 0 001.1-.883l1.5-7.5A1.125 1.125 0 0020.218 4.5H5.106M7.5 14.25L5.106 4.5M7.5 14.25L6 18.75m1.5-4.5h9.75m0 0L18 18.75m-9.75 0A1.125 1.125 0 109.375 18.75 1.125 1.125 0 008.25 17.625zm9.75 0a1.125 1.125 0 101.125 1.125A1.125 1.125 0 0018 17.625z" />
                                </svg>
                            </a>
                            <a href="{{ route('dashboard') }}" class="hidden sm:inline-flex items-center px-3 py-1.5 text-xs font-semibold rounded-full border border-gray-200 text-gray-700 hover:bg-gray-50">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-xs font-semibold text-gray-700 hover:text-indigo-600">Login</a>
                            <a href="{{ route('register') }}" class="hidden sm:inline-flex items-center px-3 py-1.5 text-xs font-semibold rounded-full bg-indigo-600 text-white hover:bg-indigo-500">Sign up</a>
                        @endauth
                    </div>
                </div>
            </header>

            <!-- Main content -->
            <main class="flex-1">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-100 mt-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-xs text-gray-500 flex flex-col sm:flex-row items-center justify-between space-y-2 sm:space-y-0">
                    <p>&copy; {{ date('Y') }} {{ config('app.name', 'Speedly Shop') }}. All rights reserved.</p>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('shop.index') }}" class="hover:text-gray-700">Shop</a>
                        <a href="{{ route('vendors.index') }}" class="hover:text-gray-700">Vendors</a>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
