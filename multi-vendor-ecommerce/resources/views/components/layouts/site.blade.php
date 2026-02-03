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
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">




        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('styles')

    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-900" >
        <div class="min-h-screen flex flex-col" style="overflow-x: clip;">
           
            <style>           
            body { margin: 0; font-family: Arial, sans-serif; }

            .top-bar {
                background: #fff;
                padding: 6px 15px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                flex-wrap: wrap; /* allow wrapping */
                gap: 10px; /* space between rows on mobile */
            }

            /* Left section */
            .top-left {
                display: flex;
                align-items: center;
                gap: 14px;
            }

            .location-box {
                display:flex;
                flex-direction:column;
            }

                /* Search center */
            .search-wrapper {
                flex: 1;
                max-width: 500px;
            }

            .top-right {
                display: flex;
                align-items: center;
                gap: 17px;
            }
            .logo {
                width: 300px;
                font-size: 30px;
                font-weight: bold;
            }

            .logo a{
                min-width:120px;
            }

            .searchbar{
                padding:5px;

            }

            #searchInput {
                border: none;
            }

            #locationHeader{
                cursor:pointer;
                /* margin-top:-10px; */
                gap:14%;
            }

            .mobile-bottom-nav {
                display: none;
            }
            /* ========================================================= */
            /*   MOBILE / TABLET VIEW (Below 744px)                       */
            /* ========================================================= */
            @media (max-width: 920px) {
                /* LOGO stays on top-left */
                .top-left {
                    width: 140px;
                    flex-wrap: wrap;
                }
            
                .search-wrapper {
                    max-width: 400px;
                }
            }

                        
            /* Show only on mobile */
            @media (max-width: 768px) {
                .mobile-bottom-nav {
                    display: block;
                }
                .wishlist-icon{
                    display:none;
                }

                /* Give space so content not hidden behind nav */
                body {
                    padding-bottom: 70px;
                }
                /* Hero / Banner / Slider hide (homepage banners) */
                .hero-slider,
                .home-banner,
                .main-banner,
                .slider-banner {
                    display: none !important;
                }
                .hero-slider,
                /* .profile-icon {
                    display: none !important;
                } */
                .top-mobile-header{
                    width:50% !important;
                }
                .logo-image{
                    width: 163px;
                }
                .top-bar{
                    gap:5px;
                }
                .category-bar {
                    top: 64px;
                }
                
            }

            @media (max-width: 764px) {

                .top-bar {
                    flex-wrap: wrap;
                    align-items: flex-start;
                }
                /* LOGO stays on top-left */
                .top-left {
                    order: 1;
                    width: 50%;
                    flex-wrap: nowrap;
                }

                /* LOCATION moves BELOW logo */
                .location-box {
                    /* width: 100%; */
                    margin-top: 4px;
                }

                /* SEARCH goes FULL WIDTH below logo+location */
                .search-wrapper {
                    order: 3;
                    width: 100%;
                    max-width: 100%;
                    margin-top: 6px;
                }

                /* TOP RIGHT stays top-right */
                .top-right {
                    order: 2;
                    margin-left: auto;
                }
                
                /* Logo stays left */
                .logo {
                    order: 1;
                }


                .searchbar{
                    padding-top:0;
                    margin-top:-5px;
                }

                /* Make search bar full width and cleaner */
                #searchBarBox {
                    max-width: 100%;
                    width: 100%;
                }

                #locationHeader{
                margin-top:0px;
                justify-content:space-between;
                }
            }

             /* ----------------------------------------------- */
            /* RESPONSIVE RULES FOR MAX-WIDTH 744px            */
            /* ----------------------------------------------- */
            @media (max-width: 744px) {

                /* Show hamburger */
                #mobilemenuToggle {
                    display: block;
                }

                /* Hide desktop nav-bar */
                .nav-bar {
                    display: none !important;
                }
            }

            @media (max-width: 475px) {
                .top-left {
                    flex-wrap: wrap;
                    /* width: 40% !important; */
                }

                .logo a {
                    width: 120px;
                    
                }

                .top-left {
                    gap: 1px;
                }
            }

            
            /* ------------------ */
            /* Hide hamburger by default */
            #mobilemenuToggle {
                display: none;
                font-size:35px;
            }

            /* Mobile menu popup base */
            .mobile-menu {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100vh;
                background: rgba(0,0,0,0.6);
                display: none;
                z-index: 9999;
            }

            /* Slide box */
            .mobile-menu-content {
                width: 80%;
                height: 100%;
                background: #fff;
                padding: 20px;
                transform: translateX(-100%);
                transition: 0.3s ease;
                position: relative;
            }

            /* Close icon */
            .mobile-menu .close-menu {
                font-size: 24px;
                cursor: pointer;
                position: absolute;
                top:0;
                right: 20px;
            }

            /* MOBILE NAV LINKS */
            .mobile-nav-links .mobile-link {
                padding: 12px 0;
                border-bottom: 1px solid #eee;
                font-size: 18px;
                font-weight: 500;
                display: flex;
                justify-content: space-between;
                align-items: center;
                cursor: pointer;
            }

            .mobile-dropdown {
                display: none;
                padding-left: 10px;
            }
            .mobile-dropdown a {
                display: block;
                padding: 8px 0;
                font-size: 16px;
                color: #444;
            }


           
            /* ---------------------- */
            /* ------------------------header menu---------------------------- */

                        /* .top-right { display: flex; align-items: center; gap: 25px; } */

                        .nav-link.active { background: #222; color: #fff; padding: 8px 18px; border-radius: 5px; }
                        
                        .nav-link {
                            position: relative;
                            display: inline-block; /* Adjust based on your main navigation structure */
                        }

                        /* -------- NAVBAR DROPDOWN FIX -------- */
            .nav-bar {
                position: relative;
                display: flex;
                flex-wrap:wrap;
                /* padding: 15px 40px; */
                align-items: center;
                /* gap: 35px; */
                border-bottom: 1px solid #eee;
                background: #fff;
                z-index: 10;
            }

            .nav-link.dropdown {
                position: relative;
            }

            .menu-button {
                position: relative;
                padding: 8px 18px;
                cursor: pointer;
                overflow: hidden;
                border-radius: 5px;
                z-index: 1;
                color: #222;
                display: inline-flex;
                align-items: center;
                gap: 5px;
            }

            /* Sliding BLACK background */
            .menu-button::before {
                content: "";
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: #000;
                transition: left 0.35s ease;
                z-index: -1;
            }

            .menu-button::after {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: transparent;
                transition: left 0.35s ease;
                z-index: -2;
            }

            .menu-button:hover::before {
                left: 0;
            }

            .menu-button:hover::after {
                left: 100%;
            }

            .menu-button:hover {
                color: #fff !important;
            }

            .menu-button:hover i {
                color: #fff !important;
            }

            .menu-button * {
                position: relative;
                z-index: 3;
            }

            /* Dropdown menus */
            .dropdown-menu,
            .shop-dropdown-menu .dropdown-menu-content {
                display: none;
                position: absolute;
                top: 100%; /* BELOW navbar */
                left: 0;
                background: #fff;
                border: 1px solid #ddd;
                border-radius: 5px;
                padding: 15px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                z-index: 100;
            }

            .dropdown-menu-content {
                display: none;  /* HIDDEN initially */
                position: absolute;
                top: 100%;       /* Below navbar */
                left: 0;
                background: #fff;
                border: 1px solid #ddd;
                border-radius: 5px;
                padding: 20px;
                min-width: 800px;
                gap: 15px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                z-index: 100;
            }

            /* Show dropdown on hover */
            .nav-link.dropdown:hover > .dropdown-menu,
            .nav-link.dropdown:hover > .dropdown-menu-content {
                display: flex;
            
            }
            .nav-link.dropdown:hover > .dropdown-menu {
            
                flex-direction:column;
            }
            .nav-link.dropdown:hover > #pagesdropdown-menu {
            
                flex-direction:row;
            }

            /* Normal dropdown links */
            .dropdown-menu a {
                display: block;
                padding: 10px 15px;
                color: #222;
                text-decoration: none;
                white-space: nowrap;
            }

            .dropdown-menu a:hover {
                background: #f3f3f3;
            }

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
                            /* color: #fff; */
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

                    /* Style for each column */
                    .menu-column {
                        flex: 1; /* Make columns take equal space */
                        padding: 0 15px;
                        min-width: 200px; /* Minimum width for the text columns */
                    }

                    /* Style for the titles (CATEGORY PAGE LAYOUT, etc.) */
                    .menu-title {
                        font-size: 14px;
                        font-weight: bold;
                        color: #333;
                        text-transform: uppercase;
                        margin-bottom: 10px;
                        padding-bottom: 5px;
                        border-bottom: 1px solid #eee; /* Separator line like in the image */
                    }

                    /* Style for the list of links */
                    .menu-list {
                        list-style: none;
                        padding: 0;
                        margin: 0 0 20px 0;
                    }

                    .menu-list li {
                        padding: 5px 0;
                    }

                    .menu-list li a {
                        text-decoration: none;
                        color: #666; /* Light gray for the text links */
                        font-size: 14px;
                        display: block;
                    }

                    .menu-list li a:hover {
                        color: #000; /* Darker on hover */
                    }

                    /* Separator line for the lists */
                    .menu-list .separator {
                        height: 1px;
                        background-color: #eee;
                        margin: 10px 0;
                        list-style: none; /* Hide bullet point */
                    }

                    /* Banner Column Styling */
                    .menu-banners {
                        display: flex;
                        flex-direction: column;
                        gap: 10px; 
                    }

                    .menu-banner {
                        flex: 1;
                        display: flex;
                        flex-direction: column;
                        justify-content: flex-end; /* Text at the bottom */
                        padding: 15px;
                        color: #ffffff;
                        background-size: cover;
                        background-position: center;
                        min-height: 200px; /* Height for the banners */
                        border-radius: 5px; /* Optional: subtle rounding */
                    }

                    .banner-text {
                        font-size: 14px;
                        font-weight: 300;
                        line-height: 1.2;
                    }

                    .banner-text-large {
                        font-size: 24px;
                        font-weight: bold;
                        line-height: 1;
                        margin-bottom: 5px;
                    }

                    /* Specific Banner Backgrounds (You need to use your own images here) */
                    .smartphone-banner {
                        /* Use your smartphone image URL */
                        background-image: url('path/to/your/smartphone-image.jpg'); 
                        background-color: #4CAF50; /* Fallback color */
                    }

                    .speaker-banner {
                        /* Use your speaker image URL */
                        background-image: url('path/to/your/speaker-image.jpg');
                        background-color: #8C8A79; /* The khaki/grey color from the image */
                        justify-content: center; /* Center the text for the speaker banner */
                        text-align: center;
                    }
                    .speaker-text {
                        color: #333; /* Darker text for the speaker banner */
                    }

                    /*mobile bottom menu  Hide bottom navbar by default */


.sticky-header {
    position: sticky;
    top: 0;
    z-index: 10000;
    background: #fff;
}
.category-bar {
    position: sticky;
    top: 70px; /* header height ke hisab se */
    z-index: 9999;
    background: #fff;
}


</style>


            <div class="top-bar sticky-header" style="border-bottom:1px solid #eee;">
                
                <div class="top-left logo top-mobile-header" >
                    <a href="{{ route('home') }}"><img  class="logo-image" src="{{asset('storage/uploads/logo/speedlylogo4.png')}}" alt=""></a>
                    <div class="location-box " id="mainlocationHeader">
                        <span class="delivery-text flex items-center gap-1 text-sm font-semibold text-gray-700" style="width:155px">
                            Delivery in 8 minutes
                            <i class="bi bi-lightning-charge-fill text-yellow-500"></i>
                        </span>

                        <span class="location-text text-muted" style="margin-top:-2px; font-size:15px;">
                            Laxmangarh, Sikar...
                            <i class="bi bi-caret-down-fill"></i>
                        </span>
                    </div>
                </div>

                <div class="search-wrapper">
                    <div class="w-full bg-white searchbar">
                        <div id="searchBarBox" onclick="window.location='{{ route('search.index') }}'" class="relative w-full max-w-3xl mx-auto flex items-center bg-gray-100 rounded-full px-4 py-1 shadow-sm cursor-pointer">

                            <!-- Search Icon -->
                            <i class="bi bi-search text-gray-500 text-lg mr-3"></i>

                            <!-- Animated placeholder -->
                            <div class="relative w-full overflow-hidden h-6 pointer-events-none" id="placeholderContainer">
                                <div id="placeholderWrapper" class="relative transition-transform duration-700 ease-out">
                                    <!-- Spans will be added by JS -->
                                </div>
                            </div>
                            <!-- Search input (clickable but readonly on home page) -->
                            <input 
                                id="searchInput"
                                type="text"
                                class="bg-transparent focus:outline-none text-gray-700 placeholder-transparent pointer-events-none"
                                readonly
                            >

                            <!-- Voice Search -->
                            <button class="ml-3 text-blue-400 hover:text-blue-500" title="Voice Search">
                                <i class="bi bi-mic-fill text-xl"></i>
                            </button>
                            

                            <!-- Image Search -->
                            <button class="ml-3 text-green-400 hover:text-green-500" title="Image Search">
                                <i class="bi bi-image-fill text-xl"></i>
                            </button>
                        </div>
                    </div>
                
                </div>

                <div class="top-right">
                    <!-- Cart Icon -->
                        <div id="cartBtn" class="cart-icon">
                            <a href="{{ auth()->check() ? route('account.cart.index') : route('login') }}">
                                <i class="bi bi-bag" style="font-size:20px;"></i>
                                <span class="absolute  bg-[#ff0000] text-white cart-count
                                text-xs rounded-full px-1.5 min-w-[18px] text-center" id="cart-count" style="top: -8px;right: -10px;">{{ $cartCount }}</span>
                            </a>
                        </div>

                   <!-- AUTH CHECK -->
                    @auth
                        <div id="wishlistbtn" class="wishlist-icon">
                            <a href="{{ route('wishlist.index') }}" class="relative">
                                <i class="fa fa-heart text-xl"></i>

                                <span id="wishlist-count" 
                                    class="wishlist-count absolute -top-4 -right-2 bg-[#ff0000] text-white
                                            text-xs rounded-full px-1.5 min-w-[18px] text-center">
                                    {{ $wishlistCount }}
                                </span>
                            </a>

                        </div>
                
                        <!-- ================= Logged In User ================= -->
                        <x-dropdown align="right" width="48">

                            <x-slot name="trigger">
                                <button
                                    class="profile-icon inline-flex items-center gap-2 py-2 transition focus:outline-none">

                                    <!-- User Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-7 w-7 text-lime-600"
                                        viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M12 2a10 10 0 100 20 10 10 0 000-20zm0 6a3 3 0 110 6 3 3 0 010-6zm0 12a7.963 7.963 0 01-5.33-2.03c.03-1.77 3.56-2.74 5.33-2.74 1.77 0 5.3.97 5.33 2.74A7.963 7.963 0 0112 20z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <x-dropdown-link 
                                    :href="auth()->user()->role === 'admin' 
                                        ? route('admin.dashboard') 
                                        : route('account.dashboard')">
                                    {{ __('Dashboard') }}
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>

                        </x-dropdown>

                    @else
                        <!-- ================= Guest User ================= -->
                      {{--  <a href="{{ route('login') }}"
                            class="px-4 py-2 rounded-full bg-green-600 text-white font-medium hover:bg-green-700 transition">
                            Login
                        </a> --}}
                    @endauth

                </div>

            </div>
       


                <!-- LOCATION HEADER -->
            <!-- <div class="d-flex align-items-center px-4 bg-white" id="locationHeader">
                <div class="d-flex flex-column" id="mainlocationHeader">
                    <span class="flex items-center gap-1 text-sm font-semibold text-gray-700">
                        Delivery in 8 minutes
                    <i class="bi bi-lightning-charge-fill text-yellow-500"></i>
                    </span>

                    <span class="text-muted" style="margin-top:-2px; font-size:15px;">
                        Laxmangarh, Sikar...
                        <i class="bi bi-caret-down-fill"></i>
                    </span>

                </div> -->
                <!-- ----------- -->

                <!-- <div class="" id="mobilemenuToggle" ><i class="bi bi-list"></i></div>  -->

                <!-- <div class="nav-bar">
                 

                    <div class="nav-link dropdown">
                        <div class="menu-button">
                            Shop <i class="bi bi-caret-down-fill"></i>
                        </div>
                        <div class="dropdown-menu-content">
                            <div class="menu-column">
                                <h3 class="menu-title">CATEGORY PAGE LAYOUT</h3>
                                <ul class="menu-list">
                                    <li><a href="#">Left Sidebar</a></li>
                                    <li><a href="#">Right Sidebar</a></li>
                                    <li><a href="#">Filter Toggle</a></li>
                                    <li><a href="#">Off-Sidebar Left</a></li>
                                    <li><a href="#">Off-Sidebar Right</a></li>
                                    <li class="separator"></li>
                                    <li><a href="#">Shop - Column 3</a></li>
                                    <li><a href="#">Shop - Column 4</a></li>
                                    <li><a href="#">Shop - Column 5</a></li>
                                    <li><a href="#">Shop - Column 6</a></li>
                                </ul>
                            </div>
                            <div class="menu-column">
                                <h3 class="menu-title">PRODUCT PAGE LAYOUT</h3>
                                <ul class="menu-list">
                                    <li><a href="#">Product - Default</a></li>
                                    <li><a href="#">Product - Sticky</a></li>
                                    <li><a href="#">Product - Masonry</a></li>
                                </ul>
                                <h3 class="menu-title product-gallery-title">PRODUCT GALLERY</h3>
                                <ul class="menu-list">
                                    <li><a href="#">Product - Left Gallery</a></li>
                                    <li><a href="#">Product - Right Gallery</a></li>
                                    <li><a href="#">Product - Bottom Gallery</a></li>
                                    <li><a href="#">Product - No Gallery</a></li>
                                </ul>
                            </div>
                            <div class="menu-column menu-banners">
                                <a href="#">
                                    <div class="menu-banner smartphone-banner">
                                        <span class="banner-text">Branded</span>
                                        <span class="banner-text-large">Smart Phone</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="menu-banner speaker-banner">
                                        <span class="banner-text-large speaker-text">BEOPLAY</span>
                                        <span class="banner-text speaker-text">Home Speaker</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="nav-link dropdown">
                        <div class="menu-button">
                            Categories <i class="bi bi-caret-down-fill"></i>
                        </div>
                        <div class="dropdown-menu">
                            <a href="#">Men</a>
                            <a href="#">Women</a>
                            <a href="#">Kids</a>
                        </div>
                    </div>

                    <div class="nav-link dropdown">
                        <div class="menu-button">
                            Products <i class="bi bi-caret-down-fill"></i>
                        </div>
                        <div class="dropdown-menu">
                            <a href="#">New Arrivals</a>
                            <a href="#">Trending</a>
                            <a href="#">Discounted</a>
                        </div>
                    </div>

                    <div class="nav-link dropdown">
                        <div class="menu-button">
                            Features <i class="bi bi-caret-down-fill"></i>
                        </div>
                        <div class="dropdown-menu">
                            <a href="#">Free Shipping</a>
                            <a href="#">Premium Service</a>
                        </div>
                    </div>

                    <div class="nav-link dropdown">
                        <div class="menu-button">
                            Pages <i class="bi bi-caret-down-fill"></i>
                        </div>

                                            
                        <div class="dropdown-menu" id="pagesdropdown-menu">
                            <div>
                                <a href="{{ route('pages.about') }}" class="hover:text-amber-400">About Us</a>
                                <a href="#" class="hover:text-amber-400">Contact Us</a>
                                <a href="{{ route('pages.service') }}" class="hover:text-amber-400">Service</a>
                                <a href="{{ route('pages.find-store') }}" class="hover:text-amber-400">Find a Store</a>
                                <a href="{{ route('pages.faq') }}" class="hover:text-amber-400">FAQ's</a>
                                <a href="{{ route('pages.privacy') }}" class="hover:text-amber-400">Privacy Policy</a>
                            </div>
                            <div>
                                <a href="{{ route('pages.terms') }}" class="hover:text-amber-400">Terms & Conditions</a>
                                <a href="{{ route('pages.return-refund') }}" class="hover:text-amber-400">Return & Refund Policy</a>
                                <a href="{{ route('pages.shipping') }}" class="hover:text-amber-400">Shipping Policy</a>
                                <a href="{{ route('pages.cookie') }}" class="hover:text-amber-400">Cookie Policy</a>
                                <a href="{{ route('pages.vendor-agreement') }}" class="hover:text-amber-400">Vendor Agreement</a>
                                <a href="{{ route('pages.cancellation') }}" class="hover:text-amber-400">Cancellation</a>
                            </div>        
                        </div>
                    </div>

                    <div class="nav-link dropdown">
                        <div class="menu-button">
                            Blog <i class="bi bi-caret-down-fill"></i>
                        </div>
                        <div class="dropdown-menu">
                            <a href="#">Latest Posts</a>
                            <a href="#">Tech Updates</a>
                        </div>
                    </div>
                  
                </div> -->
            <!-- </div> -->

<!-- MOBILE MENU POPUP -->
<div id="mobileMenu" class="mobile-menu">
    <div class="mobile-menu-content">
        <i class="bi bi-x-lg close-menu"></i>

        <!-- Put SAME nav-bar content here -->
        <div class="mobile-nav-links">
            <!-- Copy your nav links here -->

            <div class="mobile-link" data-toggle="shop">
                Shop <i class="bi bi-chevron-down"></i>
            </div>
            <div class="mobile-dropdown" id="drop-shop">
                <a href="#">Left Sidebar</a>
                <a href="#">Right Sidebar</a>
                <a href="#">Filter Toggle</a>
                <a href="#">Off-Sidebar Left</a>
                <a href="#">Off-Sidebar Right</a>
            </div>

            <div class="mobile-link" data-toggle="categories">
                Categories <i class="bi bi-chevron-down"></i>
            </div>
            <div class="mobile-dropdown" id="drop-categories">
                <a href="#">Men</a>
                <a href="#">Women</a>
                <a href="#">Kids</a>
            </div>

            <div class="mobile-link" data-toggle="products">
                Products <i class="bi bi-chevron-down"></i>
            </div>
            <div class="mobile-dropdown" id="drop-products">
                <a href="#">New Arrivals</a>
                <a href="#">Trending</a>
                <a href="#">Discounted</a>
            </div>

            <div class="mobile-link" data-toggle="features">
                Features <i class="bi bi-chevron-down"></i>
            </div>
            <div class="mobile-dropdown" id="drop-features">
                <a href="#">Free Shipping</a>
                <a href="#">Premium Service</a>
            </div>

            <div class="mobile-link" data-toggle="pages">
                Pages <i class="bi bi-chevron-down"></i>
            </div>
            <div class="mobile-dropdown" id="drop-pages">
                <a href="{{ route('pages.about') }}">About Us</a>
                <a href="#">Contact Us</a>
                <a href="{{ route('pages.service') }}">Service</a>
                <a href="{{ route('pages.find-store') }}">Find a Store</a>
                <a href="{{ route('pages.faq') }}">FAQ's</a>
                <a href="{{ route('pages.privacy') }}">Privacy Policy</a>
                <a href="{{ route('pages.terms') }}">Terms & Conditions</a>
            </div>

            <div class="mobile-link" data-toggle="blog">
                Blog <i class="bi bi-chevron-down"></i>
            </div>
            <div class="mobile-dropdown" id="drop-blog">
                <a href="#">Latest Posts</a>
                <a href="#">Tech Updates</a>
            </div>

        </div>
                
    </div>
</div>

<!-- LOCATION POPUP -->
<div class="modal fade" id="locationModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4" style="border-radius:12px;">
            
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="m-0 fw-semibold">Change Location</h5>
                <i class="fa-solid fa-xmark" data-bs-dismiss="modal" style="cursor:pointer;"></i>
            </div>

            <div class="d-flex align-items-center gap-3">

                <!-- Detect My Location Button -->
                <button class="btn btn-success px-4 py-2 fw-semibold" id="detectLocationBtn" style="border-radius:10px;">
                    Detect my location
                </button>

                <!-- OR Divider -->
                <div class="d-flex flex-column align-items-center text-muted fw-semibold">
                    <span>OR</span>
                </div>

                <!-- Search Box -->
                <input 
                    type="text"
                    class="form-control py-2"
                    placeholder="search delivery location"
                    style="border-radius:12px; min-width:220px;"
                >
            </div>

        </div>
    </div>
</div>

<section 
    class="flex items-center gap-2 overflow-x-auto bg-white shadow-sm rounded-lg px-3 py-2 category-bar justify-content-between"
    data-aos="fade-up" 
>
    <!-- All -->

    
    <a href="{{ route('shop.index') }}" class="flex flex-col items-center gap-1 group min-w-[70px]">
        <div class=" flex items-center justify-center text-2xl transition-transform group-hover:scale-110">
            🛍️
        </div>
        <span class="text-xs font-bold text-gray-900 border-b-2 border-black pb-0.5">All</span>
    </a>

    <a href="{{ route('shop.index', ['category' => 'personal-care']) }}" class="flex flex-col items-center gap-1 group min-w-[70px]">
        <div class=" flex items-center justify-center text-2xl transition-transform group-hover:scale-110">
            🧥
        </div>
        <span class="text-xs font-medium text-gray-700">Winter</span>
    </a>

    <a href="{{ route('shop.index', ['category' => 'personal-care']) }}" class="flex flex-col items-center gap-1 group min-w-[70px]">
        <div class=" flex items-center justify-center text-2xl transition-transform group-hover:scale-110">
            💄
        </div>
        <span class="text-xs font-medium text-gray-700">Beauty</span>
    </a>

    <a href="{{ route('shop.index', ['category' => 'personal-care']) }}" class="flex flex-col items-center gap-1 group min-w-[70px]">
        <div class=" flex items-center justify-center text-2xl transition-transform group-hover:scale-110">
            🎧
        </div>
        <span class="text-xs font-medium text-gray-700">Electronics</span>
    </a>

    <a href="{{ route('shop.index', ['category' => 'personal-care']) }}" class="flex flex-col items-center gap-1 group min-w-[70px]">
        <div class=" flex items-center justify-center text-2xl transition-transform group-hover:scale-110">
            👗
        </div>
        <span class="text-xs font-medium text-gray-700">Fashion</span>
    </a>

    <a href="{{ route('shop.index', ['category' => 'personal-care']) }}" class="flex flex-col items-center gap-1 group min-w-[70px]">
        <div class=" flex items-center justify-center text-2xl transition-transform group-hover:scale-110">
            🏠
        </div>
        <span class="text-xs font-medium text-gray-700">Decor</span>
    </a>

    <a href="{{ route('shop.index', ['category' => 'personal-care']) }}" class="flex flex-col items-center gap-1 group min-w-[70px]">
        <div class=" flex items-center justify-center text-2xl transition-transform group-hover:scale-110">
            🚢
        </div>
        <span class="text-xs font-medium text-gray-700">Importers</span>
    </a>

    <a href="{{ route('shop.index', ['category' => 'personal-care']) }}" class="flex flex-col items-center gap-1 group min-w-[70px]">
        <div class=" flex items-center justify-center text-2xl transition-transform group-hover:scale-110">
            🍎
        </div>
        <span class="text-xs font-medium text-gray-700">Fresh</span>
    </a>

    <a href="{{ route('shop.index', ['category' => 'personal-care']) }}" class="flex flex-col items-center gap-1 group min-w-[70px]">
        <div class=" flex items-center justify-center text-2xl transition-transform group-hover:scale-110">
            🧸
        </div>
        <span class="text-xs font-medium text-gray-700">Kids</span>
    </a>

    <a href="{{ route('shop.index', ['category' => 'personal-care']) }}" class="flex flex-col items-center gap-1 group min-w-[70px]">
        <div class=" flex items-center justify-center text-2xl transition-transform group-hover:scale-110">
            🏢
        </div>
        <span class="text-xs font-medium text-gray-700 whitespace-nowrap">Super Mall</span>
    </a>


</section>


        

        <!-- NAVIGATION BAR -->
        <!-- NAVIGATION BAR -->




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


          <!-- Page Heading -->
            @isset($header)
                <header class="">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset


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
                                <li><a href="{{ route('wishlist.index') }}" class="hover:text-amber-400">Wishlist</a></li>
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


@php
    $isHome       = request()->routeIs('home');
    $isShop       = request()->routeIs('shop.*');
    $wishlist     = request()->routeIs('wishlist.*');
    $isCart       = request()->routeIs('account.cart.*');
    $isAccount    = request()->routeIs('account.*');
@endphp


        <!-- MOBILE BOTTOM NAVBAR -->
<nav class="mobile-bottom-nav fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 shadow-lg z-[9999]">
    <div class="flex justify-between px-6 py-2">

        <!-- Home -->
        <a href="{{ route('home') }}" class="flex flex-col items-center text-xs {{ $isHome ? 'text-green-600' : 'text-gray-600' }}">
            <i class="bi bi-house-door text-xl"></i>
            <span>Home</span>
        </a>

        <!-- Categories -->
        <a href="{{ route('shop.index') }}" class="flex flex-col items-center text-xs {{ $isShop ? 'text-green-600' : 'text-gray-600' }}">
            <i class="bi bi-grid text-xl"></i>
            <span>Categories</span>
        </a>

        <!-- Search -->
        {{-- <!-- <button
            onclick="window.location.href='/search'"
            class="flex flex-col items-center text-xs {{ $isSearch ? 'text-green-600' : 'text-gray-600' }}">
            <i class="bi bi-search text-xl"></i>
            <span>Search</span>
        </button> -->  --}}

         <a href="{{ auth()->check() ? route('wishlist.index') : route('login') }}"
            class="relative flex flex-col items-center text-xs {{ $wishlist ? 'text-green-600' : 'text-gray-600' }}">
            <i class="fa fa-heart text-xl"></i>
            <span>Wishlist</span>
            <span class="wishlist-count absolute -top-1 right-1 bg-red-500 text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center">
                {{ $wishlistCount }}
            </span>
        </button></a>

         <!-- <div id="wishlistbtn" class="wishlist-icon">
            <a href="{{ route('wishlist.index') }}" class="relative">
                <i class="fa fa-heart text-xl"></i>

                <span id="wishlist-count"
                    class="absolute -top-4 -right-2 bg-[#ff0000] text-white
                            text-xs rounded-full px-1.5 min-w-[18px] text-center">
                    {{ $wishlistCount }}
                </span>
            </a>

        </div> -->

        <!-- Cart -->
     {{-- 
        <!-- <a href="{{ auth()->check() ? route('account.cart.index') : route('login') }}"
           class="relative flex flex-col items-center text-xs {{ $isCart ? 'text-green-600' : 'text-gray-600' }}">
            <i class="bi bi-bag text-xl"></i>
            <span>Cart</span> -->

            <!-- Cart Count -->
            <!-- <span class="cart-count absolute -top-1 right-1 bg-red-500 text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center">
                {{ $cartCount }}
            </span>
        </a> -->

        <!-- Profile -->
      <!-- <a href="{{ auth()->check() ? route('account.dashboard') : route('login') }}"
           class="flex flex-col items-center text-xs {{ $isAccount ? 'text-green-600' : 'text-gray-600' }}">
            <i class="bi bi-person text-xl"></i>
            <span>Account</span>
        </a> --> --}}

    </div>
</nav>



        
        @stack('scripts')

        <script>
    const menuToggle = document.getElementById("mobilemenuToggle");
    const mobileMenu = document.getElementById("mobileMenu");
    const closeMenu = document.querySelector(".close-menu");
    const content = document.querySelector(".mobile-menu-content");

    // Open menu
    menuToggle.addEventListener("click", () => {
        mobileMenu.style.display = "block";
        setTimeout(() => {
            content.style.transform = "translateX(0)";
        }, 10);
    });

    // Close menu (outside click)
    mobileMenu.addEventListener("click", (e) => {
        if (e.target === mobileMenu) {
            content.style.transform = "translateX(-100%)";
            setTimeout(() => mobileMenu.style.display = "none", 300);
        }
    });

    // Close using X
    closeMenu.addEventListener("click", () => {
        content.style.transform = "translateX(-100%)";
        setTimeout(() => mobileMenu.style.display = "none", 300);
    });

    // Dropdown toggle inside menu
    document.querySelectorAll(".mobile-link").forEach(link => {
        link.addEventListener("click", () => {
            const target = document.getElementById("drop-" + link.dataset.toggle);
            target.style.display = target.style.display === "block" ? "none" : "block";
        });
    });
</script>

        
        <script>
            document.addEventListener("DOMContentLoaded", function() {

            // Mobile Menu Toggle
            // const menuToggle = document.getElementById("menuToggle");
            // const mobileMenu = document.getElementById("mobileMenu");

            // menuToggle.addEventListener("click", () => {
            //     mobileMenu.style.display = mobileMenu.style.display === "block" ? "none" : "block";
            // });

            // Dropdown Menus
            // document.querySelectorAll(".dropdown").forEach(drop => {
            //     drop.addEventListener("click", function(e) {
            //         const menu = this.querySelector(".dropdown-menu");
            //         const isOpen = menu.style.display === "block";

            //         // Close all dropdowns first
            //         document.querySelectorAll(".dropdown-menu").forEach(m => m.style.display = "none");

            //         // Toggle this dropdown
            //         menu.style.display = isOpen ? "none" : "block";

            //         e.stopPropagation();
            //     });
            // });

            // Close dropdowns when clicking outside
            // document.addEventListener("click", () => {
            //     document.querySelectorAll(".dropdown-menu").forEach(m => m.style.display = "none");
            // });

            // Search Button Click
            // document.getElementById("searchBtn").addEventListener("click", () => {
            //     let q = document.getElementById("searchInput").value;
            //     alert("Searching for: " + q);
            // });

            // User Icon Click
            // document.getElementById("userBtn").addEventListener("click", () => {
            //     alert("User Profile Clicked!");
            // });

            // Cart Click
            // document.getElementById("cartBtn").addEventListener("click", () => {
            //     alert("Opening Cart...");
            // });

        });


        const items = [
    'Search "bread"',
    'Search "chips"',
    'Search "hukkas"',
    'Search "milk"',
    'Search "sugar"',
    'Search "coffee"',
    'Search "butter"',
];

let currentIndex = 0;

const wrapper = document.getElementById("placeholderWrapper");
const container = document.getElementById("placeholderContainer");

// Dynamically add placeholders as <span>
wrapper.innerHTML = items.map(text => `<span class="block text-gray-400">${text}</span>`).join("");

// Measure actual row height dynamically
let rowHeight = wrapper.children[0].offsetHeight;

wrapper.style.transform = "translateY(0)";
wrapper.style.transition = "transform 0.7s ease-out";

let animInterval;

function startTicker() {
    animInterval = setInterval(() => {
        currentIndex++;

        wrapper.style.transform = `translateY(-${currentIndex * rowHeight}px)`;

        // Reset to start when finished
        if (currentIndex >= items.length - 1) {
            setTimeout(() => {
                wrapper.style.transition = "none";
                wrapper.style.transform = "translateY(0)";
                currentIndex = 0;

                setTimeout(() => {
                    wrapper.style.transition = "transform 0.7s ease-out";
                }, 20);

            }, 800);
        }

    }, 2500);
}

function stopTicker() {
    clearInterval(animInterval);
}

startTicker();

// On click → open search page
document.getElementById("searchBarBox").addEventListener("click", () => {
    stopTicker();
    // window.location.href = "/search";
});




document.getElementById("mainlocationHeader").addEventListener("click", function() {
    var modal = new bootstrap.Modal(document.getElementById("locationModal"));
    modal.show();
    console.log('model opened');
});


        </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


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
