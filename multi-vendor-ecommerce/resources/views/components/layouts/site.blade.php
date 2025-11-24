@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Speedly Shop') }}</title>

        <!-- Fonts -->
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600;700&display=swap" rel="stylesheet" />

       <!-- AOS CSS -->
       <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('styles')

    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-900" style="overflow-x: hidden;">
        <div class="min-h-screen flex flex-col">
            <!-- Public header -->
            <div class="bg-slate-900 text-slate-100 text-[11px]">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-8">
                    <p class="hidden sm:block">Welcome to our multi-vendor marketplace. Free shipping on selected items.</p>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('pages.find-store') }}" class="hover:text-amber-300">Find a store</a>
                        <a href="{{ route('pages.service') }}" class="hover:text-amber-300">Customer service</a>
                        <a href="{{ route('pages.faq') }}" class="hover:text-amber-300">Help &amp; FAQ</a>
                    </div>
                </div>
            </div>
            <!-- <header class="bg-white border-b border-gray-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
                    <div class="flex items-center space-x-6">
                        <a href="{{ route('home') }}" class="flex items-center space-x-2">
                            <x-application-logo class="h-8 w-auto text-indigo-600" />
                            <span class="font-semibold text-gray-900 hidden sm:inline">{{ config('app.name', 'Speedly Shop') }}</span>
                        </a>
                        <nav class="flex flex-wrap items-center space-x-3 md:space-x-4 text-[13px] font-medium">
                            <a href="{{ route('home') }}" class="inline-flex items-center h-8 px-2 border-b-2 {{ request()->routeIs('home') ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-600 hover:text-gray-900 hover:border-indigo-500' }}">Home</a>
                            <a href="{{ route('shop.index') }}" class="inline-flex items-center h-8 px-2 border-b-2 {{ request()->routeIs('shop.*') ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-600 hover:text-gray-900 hover:border-indigo-500' }}">Shop</a>
                            <a href="{{ route('vendors.index') }}" class="inline-flex items-center h-8 px-2 border-b-2 {{ request()->routeIs('vendors.*') ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-600 hover:text-gray-900 hover:border-indigo-500' }}">Vendors</a>
                            <a href="{{ route('pages.about') }}" class="inline-flex items-center h-8 px-2 border-b-2 {{ request()->routeIs('pages.about') ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-600 hover:text-gray-900 hover:border-indigo-500' }}">About</a>
                            <a href="{{ route('pages.service') }}" class="inline-flex items-center h-8 px-2 border-b-2 {{ request()->routeIs('pages.service') ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-600 hover:text-gray-900 hover:border-indigo-500' }}">Service</a>
                            <a href="{{ route('pages.find-store') }}" class="inline-flex items-center h-8 px-2 border-b-2 {{ request()->routeIs('pages.find-store') ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-600 hover:text-gray-900 hover:border-indigo-500' }}">Find a Store</a>
                            <a href="{{ route('pages.faq') }}" class="inline-flex items-center h-8 px-2 border-b-2 {{ request()->routeIs('pages.faq') ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-600 hover:text-gray-900 hover:border-indigo-500' }}">FAQ's</a>
                            <a href="{{ route('pages.wishlist') }}" class="inline-flex items-center h-8 px-2 border-b-2 {{ request()->routeIs('pages.wishlist') ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-600 hover:text-gray-900 hover:border-indigo-500' }}">Wishlist</a>
                            <a href="{{ route('pages.blog') }}" class="inline-flex items-center h-8 px-2 border-b-2 {{ request()->routeIs('pages.blog') ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-600 hover:text-gray-900 hover:border-indigo-500' }}">Blog</a>
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
            </header> -->

            <style>
                body { margin: 0; font-family: Arial, sans-serif; }

            .top-bar {
                background: #f2c400;
                padding: 15px 40px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                flex-wrap: wrap;
            }

            .logo { font-size: 30px; font-weight: bold; }

            .menu-toggle {
                background: #222;
                color: #fff;
                padding: 10px 15px;
                border-radius: 5px;
                margin-right: 20px;
                cursor: pointer;
                font-size: 20px;
            }

            .search-area {
                display: flex;
                flex: 1;
                max-width: 600px;
                margin-left: 20px;
            }

            .search-area select,
            .search-area input,
            .search-area button {
                padding: 10px;
                border: 1px solid #ccc;
            }

            .search-area select { border-right: none; border-radius: 5px 0 0 5px; }
            .search-area input { flex: 1; border-left: none; border-right: none; }
            .search-area button { background: #222; color: #fff; border-radius: 0 5px 5px 0; cursor: pointer; }

            .top-right { display: flex; align-items: center; gap: 25px; }

            .nav-bar {
                display: flex;
                padding: 15px 40px;
                align-items: center;
                gap: 35px;
                border-bottom: 1px solid #eee;
                background: #fff;
            }

            .nav-link { text-decoration: none; color: #222; cursor: pointer; position: relative; }
            .nav-link.active { background: #222; color: #fff; padding: 8px 18px; border-radius: 5px; }

            .dropdown-menu {
                display: none;
                position: absolute;
                top: 40px;
                left: 0;
                background: #fff;
                border: 1px solid #ddd;
                border-radius: 5px;
                min-width: 160px;
                padding: 10px 0;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                z-index: 100;
            }

            .dropdown-menu a {
                display: block;
                padding: 10px 15px;
                text-decoration: none;
                color: #222;
            }

            .dropdown-menu a:hover { background: #f3f3f3; }

            .cart-icon { position: relative; cursor: pointer; }
            .notif {
                background: red;
                width: 16px;
                height: 16px;
                color: #fff;
                font-size: 11px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                position: absolute;
                top: -5px;
                right: -8px;
            }

            /* Mobile Menu Hidden */
            .mobile-menu {
                display: none;
                background: #333;
                padding: 15px;
            }
            .mobile-menu a {
                display: block;
                padding: 10px;
                color: #fff;
                text-decoration: none;
                border-bottom: 1px solid #444;
            }
            .hero-slider {
            width: 100%;
            height: 500px;
            display: flex;
            position: relative;
            overflow: hidden;
            background: #f6f6f6;
            border-radius: 10px;
        }

            </style>

            <div class="top-bar">
            <div style="display:flex; align-items:center;">
                <div class="logo">eGadgets <span style="font-size:12px;">Best Buy</span></div>

                <div class="menu-toggle" id="menuToggle"><i class="bi bi-list"></i></div>

                <div class="search-area">
                    <select><option>All Collection</option></select>
                    <input id="searchInput" type="text" placeholder="Search for products...">
                    <button id="searchBtn"><i class="bi bi-search"></i> Search</button>
                </div>
            </div>

            <div class="top-right">
                <div style="display:flex; align-items:center; gap:8px;">
                    <i class="bi bi-headphones" style="font-size:22px;"></i>
                    <div>
                        <strong>(+001) 123-456-7890</strong>
                        <span>sales@yourcompany.com</span>
                    </div>
                </div>

                <i id="userBtn" class="bi bi-person" style="font-size:24px; cursor:pointer;"></i>

                <div id="cartBtn" class="cart-icon">
                    <i class="bi bi-bag" style="font-size:24px;"></i>
                    <div class="notif">1</div>
                </div>
            </div>
        </div>

        <!-- NAVIGATION BAR -->
        <div class="nav-bar">
            <div class="nav-link active">Home</div>

            <div class="nav-link dropdown">
                Shop <i class="bi bi-caret-down-fill"></i>
                <div class="dropdown-menu">
                    <a href="#">Smartphones</a>
                    <a href="#">Laptops</a>
                    <a href="#">Accessories</a>
                </div>
            </div>

            <div class="nav-link dropdown">
                Categories <i class="bi bi-caret-down-fill"></i>
                <div class="dropdown-menu">
                    <a href="#">Men</a>
                    <a href="#">Women</a>
                    <a href="#">Kids</a>
                </div>
            </div>

            <div class="nav-link dropdown">
                Products <i class="bi bi-caret-down-fill"></i>
                <div class="dropdown-menu">
                    <a href="#">New Arrivals</a>
                    <a href="#">Trending</a>
                    <a href="#">Discounted</a>
                </div>
            </div>

            <div class="nav-link dropdown">Features <i class="bi bi-caret-down-fill"></i>
                <div class="dropdown-menu">
                    <a href="#">Free Shipping</a>
                    <a href="#">Premium Service</a>
                </div>
            </div>

            <div class="nav-link dropdown">Pages <i class="bi bi-caret-down-fill"></i>
                <div class="dropdown-menu">
                    <a href="#">About Us</a>
                    <a href="#">Contact Us</a>
                </div>
            </div>

            <div class="nav-link dropdown">Blog <i class="bi bi-caret-down-fill"></i>
                <div class="dropdown-menu">
                    <a href="#">Latest Posts</a>
                    <a href="#">Tech Updates</a>
                </div>
            </div>
        </div>

        <!-- MOBILE MENU -->
        <div id="mobileMenu" class="mobile-menu">
            <a href="#">Home</a>
            <a href="#">Shop</a>
            <a href="#">Categories</a>
            <a href="#">Products</a>
            <a href="#">Features</a>
            <a href="#">Pages</a>
            <a href="#">Blog</a>
        </div>

            <!-- Main content -->
            <main class="flex-1">
                {{ $slot }}
            </main>

            
            <!-- Footer -->
            <footer class="bg-slate-900 text-slate-100 mt-8" data-aos="fade-up">
                <div class="border-b border-slate-800">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 grid grid-cols-1 md:grid-cols-3 gap-6 text-sm">
                        <div>
                            <h3 class="text-sm font-semibold mb-2">Sign up to our Newsletter</h3>
                            <p class="text-xs text-slate-300 mb-3">Get updates about new products, offers, and marketplace tips.</p>
                            <form action="#" method="POST" class="flex flex-col sm:flex-row gap-2 max-w-md">
                                <input type="email" name="email" placeholder="Enter your e-mail address" class="flex-1 px-3 py-2 rounded-md text-xs bg-slate-800 border border-slate-700 placeholder-slate-400 text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 rounded-md bg-amber-400 text-slate-900 text-xs font-semibold hover:bg-amber-300">Subscribe</button>
                            </form>
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold mb-2">Follow Us</h3>
                            <p class="text-xs text-slate-300 mb-3">Stay connected across your favourite social networks.</p>
                            <div class="flex items-center space-x-3 text-slate-300">
                                <a href="#" class="h-8 w-8 rounded-full bg-slate-800 flex items-center justify-center hover:bg-indigo-500"><span class="text-xs font-semibold">f</span></a>
                                <a href="#" class="h-8 w-8 rounded-full bg-slate-800 flex items-center justify-center hover:bg-sky-500"><span class="text-xs font-semibold">in</span></a>
                                <a href="#" class="h-8 w-8 rounded-full bg-slate-800 flex items-center justify-center hover:bg-rose-500"><span class="text-xs font-semibold">ig</span></a>
                                <a href="#" class="h-8 w-8 rounded-full bg-slate-800 flex items-center justify-center hover:bg-sky-400"><span class="text-xs font-semibold">x</span></a>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold mb-2">Download App</h3>
                            <p class="text-xs text-slate-300 mb-3">Soon available on the App Store and Google Play.</p>
                            <div class="flex flex-wrap gap-3">
                                <a href="#" class="flex items-center px-3 py-2 rounded-md bg-slate-800 border border-slate-700 text-xs">
                                    <span class="mr-2 text-lg">▶</span>
                                    <div class="flex flex-col leading-tight">
                                        <span class="text-[10px] text-slate-400">GET IT ON</span>
                                        <span class="font-semibold text-slate-100">Google Play</span>
                                    </div>
                                </a>
                                <a href="#" class="flex items-center px-3 py-2 rounded-md bg-slate-800 border border-slate-700 text-xs">
                                    <span class="mr-2 text-lg"></span>
                                    <div class="flex flex-col leading-tight">
                                        <span class="text-[10px] text-slate-400">Download on the</span>
                                        <span class="font-semibold text-slate-100">App Store</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-b border-slate-800">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 grid grid-cols-1 md:grid-cols-4 gap-6 text-xs">
                        <div class="space-y-2">
                            <h4 class="text-sm font-semibold">Contact Information</h4>
                            <p class="text-slate-300">Call on Order? We are here 24/7</p>
                            <p class="text-amber-400 font-semibold">(+001) 123-456-7890</p>
                            <p class="text-slate-300 mt-2">7515 Carriage Court, Coachella, CA, 92236 USA</p>
                            <p class="text-slate-300">sales@yourcompany.com</p>
                        </div>

                        <div class="space-y-2">
                            <h4 class="text-sm font-semibold">Quick view</h4>
                            <ul class="space-y-1">
                                <li><a href="{{ route('pages.service') }}" class="hover:text-amber-400">Service</a></li>
                                <li><a href="{{ route('pages.find-store') }}" class="hover:text-amber-400">Find a Store</a></li>
                                <li><a href="{{ route('pages.faq') }}" class="hover:text-amber-400">FAQ's</a></li>
                                <li><a href="{{ route('pages.about') }}" class="hover:text-amber-400">About Us</a></li>

                                 <!-- New Policy / Legal Pages -->
                                <li><a href="{{ route('pages.privacy') }}" class="hover:text-amber-400">Privacy Policy</a></li>
                                <li><a href="{{ route('pages.terms') }}" class="hover:text-amber-400">Terms & Conditions</a></li>
                                <li><a href="{{ route('pages.return-refund') }}" class="hover:text-amber-400">Return & Refund Policy</a></li>
                                <li><a href="{{ route('pages.shipping') }}" class="hover:text-amber-400">Shipping Policy</a></li>
                                <li><a href="{{ route('pages.cookie') }}" class="hover:text-amber-400">Cookie Policy</a></li>
                                <li><a href="{{ route('pages.vendor-agreement') }}" class="hover:text-amber-400">Vendor Agreement</a></li>
                                <li><a href="{{ route('pages.cancellation') }}" class="hover:text-amber-400">Cancellation</a></li>
                            </ul>
                        </div>

                        <div class="space-y-2">
                            <h4 class="text-sm font-semibold">Information</h4>
                            <ul class="space-y-1">
                                <li><a href="{{ route('pages.wishlist') }}" class="hover:text-amber-400">Wishlist</a></li>
                                <li>
                                    <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="hover:text-amber-400">My account</a>
                                </li>
                                <li>
                                    <a href="{{ auth()->check() ? route('account.checkout.index') : route('login') }}" class="hover:text-amber-400">Checkout</a>
                                </li>
                                <li>
                                    <a href="{{ auth()->check() ? route('account.cart.index') : route('login') }}" class="hover:text-amber-400">Cart</a>
                                </li>
                            </ul>
                        </div>

                        <div class="space-y-2">
                            <h4 class="text-sm font-semibold">Popular tags</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach (['ElectraWave', 'EnergoTech', 'NexusElectronics', 'SparkFlare', 'QuantumElectro', 'PulseTech', 'CircuitMasters', 'TechNova', 'AmpereFusion', 'VoltVibe'] as $tag)
                                    <span class="px-2 py-1 rounded-full bg-slate-800 text-[11px] text-slate-200">{{ $tag }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="py-4">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 text-[11px] text-slate-400">
                        <div class="flex items-center space-x-4">
                            <span>F-Secure</span>
                            <span>SiteLock</span>
                            <span>McAfee</span>
                        </div>
                        <p class="text-slate-400">Copyright {{ date('Y') }}. All rights reserved.</p>
                        <div class="flex items-center space-x-2">
                            <span class="px-2 py-1 rounded bg-slate-800">AMEX</span>
                            <span class="px-2 py-1 rounded bg-slate-800">Apple Pay</span>
                            <span class="px-2 py-1 rounded bg-slate-800">GPay</span>
                            <span class="px-2 py-1 rounded bg-slate-800">Visa</span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>


        <!-- Scroll to Top Button -->
        <button id="scrollToTopBtn" title="Go to top">
            ↑
        </button>


        
        @stack('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {

            // Mobile Menu Toggle
            const menuToggle = document.getElementById("menuToggle");
            const mobileMenu = document.getElementById("mobileMenu");

            menuToggle.addEventListener("click", () => {
                mobileMenu.style.display = mobileMenu.style.display === "block" ? "none" : "block";
            });

            // Dropdown Menus
            document.querySelectorAll(".dropdown").forEach(drop => {
                drop.addEventListener("click", function(e) {
                    const menu = this.querySelector(".dropdown-menu");
                    const isOpen = menu.style.display === "block";

                    // Close all dropdowns first
                    document.querySelectorAll(".dropdown-menu").forEach(m => m.style.display = "none");

                    // Toggle this dropdown
                    menu.style.display = isOpen ? "none" : "block";

                    e.stopPropagation();
                });
            });

            // Close dropdowns when clicking outside
            document.addEventListener("click", () => {
                document.querySelectorAll(".dropdown-menu").forEach(m => m.style.display = "none");
            });

            // Search Button Click
            document.getElementById("searchBtn").addEventListener("click", () => {
                let q = document.getElementById("searchInput").value;
                alert("Searching for: " + q);
            });

            // User Icon Click
            document.getElementById("userBtn").addEventListener("click", () => {
                alert("User Profile Clicked!");
            });

            // Cart Click
            document.getElementById("cartBtn").addEventListener("click", () => {
                alert("Opening Cart...");
            });

        });
        </script>



        <!-- AOS JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

        <script>
            // Initialize AOS
            AOS.init({
                duration: 1000, // animation duration in ms
                once: true,     // animation happens only once
                easing: 'ease-out-cubic',
            });
        </script>

    </body>
</html>
