<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\AdPlacement;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function index()
    {
        $ads = Ad::with('adPlacement')->latest()->paginate(15);
        return view('admin.ads.index', compact('ads'));
    }

    public function create()
    {
        $placements = AdPlacement::all();
        $categories = Category::all();
        $products = Product::select('id', 'name')->get();
        return view('admin.ads.create', compact('placements', 'categories', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ad_placement_id' => 'required|exists:ad_placements,id',
            'title' => 'required|string|max:255',
            'banner_image' => 'required|image|max:2048',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date|after_or_equal:starts_at',
            'is_active' => 'required|boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('banner_image')) {
            $imageName = time().'.'.$request->banner_image->extension();
            $request->banner_image->move(public_path('uploads/ads'), $imageName);
            $data['banner_image'] = 'uploads/ads/'.$imageName;
        }

        Ad::create($data);

        return redirect()->route('admin.ads.index')->with('success', 'Ad created successfully.');
    }

    public function edit(Ad $ad)
    {
        $placements = AdPlacement::all();
        $categories = Category::all();
        $products = Product::select('id', 'name')->get();
        return view('admin.ads.edit', compact('ad', 'placements', 'categories', 'products'));
    }

    public function update(Request $request, Ad $ad)
    {
        $request->validate([
            'ad_placement_id' => 'required|exists:ad_placements,id',
            'title' => 'required|string|max:255',
            'banner_image' => 'nullable|image|max:2048',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date|after_or_equal:starts_at',
            'is_active' => 'required|boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('banner_image')) {
            $imageName = time().'.'.$request->banner_image->extension();
            $request->banner_image->move(public_path('uploads/ads'), $imageName);
            $data['banner_image'] = 'uploads/ads/'.$imageName;
        }

        $ad->update($data);

        return redirect()->route('admin.ads.index')->with('success', 'Ad updated successfully.');
    }

    public function destroy(Ad $ad)
    {
        $ad->delete();
        return back()->with('success', 'Ad deleted.');
    }
}
