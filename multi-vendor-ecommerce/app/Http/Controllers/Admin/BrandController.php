<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->paginate(15);
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('logo')) {
            $imageName = time().'.'.$request->logo->extension();
            $request->logo->move(public_path('uploads/brands'), $imageName);
            $data['logo'] = 'uploads/brands/'.$imageName;
        }

        Brand::create($data);

        return redirect()->route('admin.brands.index')->with('success', 'Brand created successfully.');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('logo')) {
            $imageName = time().'.'.$request->logo->extension();
            $request->logo->move(public_path('uploads/brands'), $imageName);
            $data['logo'] = 'uploads/brands/'.$imageName;
        }

        $brand->update($data);

        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully.');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return back()->with('success', 'Brand deleted.');
    }
}