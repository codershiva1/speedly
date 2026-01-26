<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{

    public function index()
    {
        $wishlists = auth()->user()
            ->wishlist()
            ->with('product')
            ->latest()
            ->get();

        return view('wishlist.index', compact('wishlists'));
    }

    public function toggle(Product $product)
    {
        $wishlist = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            $status = 'removed';
            $message = 'Removed from wishlist';
        } else {
            Wishlist::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
            ]);
            $status = 'added';
            $message = 'Added to wishlist';
        }

        $count = Wishlist::where('user_id', auth()->id())->count();

        return response()->json([
            'status' => $status,
            'message' => $message,
            'count' => $count,
        ]);
    }



    public function destroy(Wishlist $wishlist)
    {
        abort_unless($wishlist->user_id === auth()->id(), 403);
        $wishlist->delete();

        return back()->with('status', 'Removed from wishlist');
    }
}
