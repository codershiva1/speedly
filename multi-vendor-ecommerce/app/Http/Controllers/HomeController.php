<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = Category::where('status', true)
            ->orderBy('name')
            ->get();

        $topCategories = Category::withCount('products')
            ->where('status', true)
            ->orderByDesc('products_count')
            ->take(20)
            ->get();

        $baseProductQuery = Product::with([
        'images',
        'category',
        ...(auth()->check() ? ['cartItem'] : [])
        ])
        ->where('status', 'active');

        $dealsOfDay = (clone $baseProductQuery)
            ->orderByDesc('discount_price')
            ->take(10)
            ->get();

        $newProducts = (clone $baseProductQuery)
            ->latest()
            ->take(10)
            ->get();

        $featuredProducts = (clone $baseProductQuery)
            ->where('is_featured', true)
            ->take(10)
            ->get();

        $latestNews = [
            [
                'title' => 'The ultimate guide to finding the right gadget',
                'excerpt' => 'Learn how to compare specs, reviews, and prices so you always pick the perfect device.',
                'image' => 'https://about.fb.com/wp-content/uploads/2024/02/Facebook-News-Update_US_AU_Header.jpg',
                'date' => now()->subDays(1),
            ],
            [
                'title' => 'Inalienable part of India: MEA responds after China defends detention of Arunachal woman',
                'excerpt' => 'Pem Wang Thongdok, a UK-based Indian citizen, had her passport declared "invalid" solely because it listed Arunachal Pradesh as her birthplace.',
                'image' => 'https://media.newindianexpress.com/newindianexpress%2F2025-11-25%2F8q3kbchl%2FArunachal-woman.jpg?rect=0%2C30%2C400%2C225&w=1024&auto=format%2Ccompress&fit=max',
                'date' => now()->subDays(3),
            ],
            [
                'title' => 'Must-have items for your home office setup',
                'excerpt' => 'Create a productive workspace with monitors, accessories, and smart speakers.',
                'image' => 'https://cdn.pixabay.com/photo/2017/06/26/19/03/news-2444778_1280.jpg',
                'date' => now()->subDays(7),
            ],
            [
                'title' => 'How to choose the right headphones for you',
                'excerpt' => 'From gaming to music, here is how to choose the right pair for every situation.',
                'image' => 'https://thumbs.dreamstime.com/b/bright-blue-orange-text-displays-breaking-news-digital-screen-surrounded-abstract-data-visualization-elements-386391298.jpg',
                'date' => now()->subDays(10),
            ],
        ];

        return view('home', [
            'categories' => $categories,
            'topCategories' => $topCategories,
            'dealsOfDay' => $dealsOfDay,
            'newProducts' => $newProducts,
            'featuredProducts' => $featuredProducts,
            'latestNews' => $latestNews,
        ]);
    }
}
