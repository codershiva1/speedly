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
        return view('pages.blog');
    }
}
