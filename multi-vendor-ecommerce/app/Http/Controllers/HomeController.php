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
            ->take(8)
            ->get();

        $baseProductQuery = Product::with('images', 'category')
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
                'image' => 'https://via.placeholder.com/640x360?text=Latest+News+1',
                'date' => now()->subDays(3),
            ],
            [
                'title' => 'Must-have items for your home office setup',
                'excerpt' => 'Create a productive workspace with monitors, accessories, and smart speakers.',
                'image' => 'https://via.placeholder.com/640x360?text=Latest+News+2',
                'date' => now()->subDays(7),
            ],
            [
                'title' => 'How to choose the right headphones for you',
                'excerpt' => 'From gaming to music, here is how to choose the right pair for every situation.',
                'image' => 'https://via.placeholder.com/640x360?text=Latest+News+3',
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
