<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        return view('pages.about');
    }

    public function faq(): View
    {
        return view('pages.faq');
    }

    public function service(): View
    {
        return view('pages.service');
    }

    public function findStore(): View
    {
        return view('pages.find-store');
    }

    public function wishlist(): View
    {
        return view('pages.wishlist');
    }

    public function blog(): View
    {
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
        return view('pages.blog',[
            'latestNews' => $latestNews,
        ]);
    }

     public function terms(): View
    {
        return view('pages.terms');
    }

     public function search(): View
    {
        return view('search.index');
    }

     public function privacy(): View
    {
        return view('pages.privacy');
    }

     public function refunds(): View
    {
        return view('pages.refunds');
    }

     public function shipping(): View
    {
        return view('pages.shipping');
    }

    public function vendor_policy(): View
    {
        return view('pages.vendor-policy');
    }

     public function cancellation(): View
    {
        return view('pages.cancellation');
    }

    public function cookie_policy(): View
    {
        return view('pages.cookie-policy');
    }
}
