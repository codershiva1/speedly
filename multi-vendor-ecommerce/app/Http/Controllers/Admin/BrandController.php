<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BrandController extends Controller
{
    public function index(Request $request): View
    {
        $query = Brand::query();
    
        // Search filter
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('slug', 'like', '%' . $request->search . '%');
            });
        }
    
        $brands = $query->orderBy('name')->paginate(15)->withQueryString();
    
        return view('admin.brands.index', compact('brands'));
    }
    public function create(): View
    {
        return view('admin.brands.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'   => ['required', 'string', 'max:255', 'unique:brands,name'],
            'logo'   => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'status' => ['nullable', 'boolean'],
        ]);

        $data['slug'] = Str::slug($data['name']);
        
        // Logo Upload Logic
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('brands', 'public');
        }

        Brand::create($data);

        return redirect()->route('admin.brands.index')->with('status', 'Brand created successfully!');
    }

    public function edit(Brand $brand): View
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand): RedirectResponse
    {
        $data = $request->validate([
            'name'   => ['required', 'string', 'max:255', 'unique:brands,name,' . $brand->id],
            'logo'   => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'status' => ['nullable', 'boolean'],
        ]);

        $data['slug'] = Str::slug($data['name']);

        if ($request->hasFile('logo')) {
            // Purana logo delete karein agar naya upload ho raha hai
            if ($brand->logo) {
                Storage::disk('public')->delete($brand->logo);
            }
            $data['logo'] = $request->file('logo')->store('brands', 'public');
        }

        $brand->update($data);

        return redirect()->route('admin.brands.index')->with('status', 'Brand updated successfully!');
    }

    public function destroy(Brand $brand): RedirectResponse
    {
        // Image file ko bhi storage se delete karein
        if ($brand->logo) {
            Storage::disk('public')->delete($brand->logo);
        }
        
        $brand->delete();
        return redirect()->route('admin.brands.index')->with('status', 'Brand deleted successfully.');
    }
}