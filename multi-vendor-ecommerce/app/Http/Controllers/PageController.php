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

     public function terms(): View
    {
        return view('pages.terms');
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
