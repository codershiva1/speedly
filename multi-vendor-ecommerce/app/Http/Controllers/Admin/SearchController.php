<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Product, Category, Brand, ProductImage};
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class SearchController extends Controller
{

   public function globalSearch(Request $request) {
        $query = $request->input('query');
        
        $results = [
            'users' => User::where('name', 'LIKE', "%$query%")->limit(5)->get(),
            'products' => Product::where('name', 'LIKE', "%$query%")->limit(5)->get(),
            'orders' => Order::where('order_number', 'LIKE', "%$query%")->limit(5)->get(),
        ];

        return view('admin.search-results', compact('results', 'query'));
    }

}