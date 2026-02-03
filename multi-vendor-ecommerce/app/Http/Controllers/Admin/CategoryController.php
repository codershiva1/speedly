<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Sabhi categories dikhane ke liye (Search aur Pagination ke saath)
     */
    public function index(Request $request): View
    {
        $searchTerm = $request->input('search');

        $categories = Category::query()
            ->with('parent') 
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('name', 'LIKE', "%{$searchTerm}%")
                             ->orWhereHas('parent', function($q) use ($searchTerm) {
                                 $q->where('name', 'LIKE', "%{$searchTerm}%");
                             });
            })
            ->latest()
            ->paginate(10);

        $categories->appends(['search' => $searchTerm]);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Create form dikhane ke liye
     */
    public function create(): View
    {
        // Sabhi categories ko fetch kar rahe hain dropdown ke liye (Parent Category select karne ke liye)
        $parents = Category::orderBy('name')->pluck('name', 'id');
        return view('admin.categories.create', compact('parents'));
    }

    /**
     * Nayi category save karne ke liye (Saare fields ke saath)
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'             => ['required', 'string', 'max:255'],
            'parent_id'        => ['nullable', 'exists:categories,id'],
            'description'      => ['nullable', 'string'],
            'image'            => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'meta_title'       => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords'    => ['nullable', 'string', 'max:255'],
            'status'           => ['nullable', 'boolean'],
        ]);

        $data['slug'] = Str::slug($data['name']);
        
        // Image Upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        // Status handle (Agar checkbox unchecked hai toh false)
        $data['status'] = $request->has('status') ? 1 : 0;

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('status', 'Category created successfully!');
    }

    /**
     * Edit form dikhane ke liye
     */
    public function edit(Category $category): View
    {
        // Apne aap ko parent nahi bana sakte, isliye current ID exclude ki hai
        $parents = Category::where('id', '!=', $category->id)->orderBy('name')->pluck('name', 'id');
        return view('admin.categories.edit', compact('category', 'parents'));
    }

    /**
     * Data update karne ke liye
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $data = $request->validate([
            'name'             => ['required', 'string', 'max:255'],
            'parent_id'        => ['nullable', 'exists:categories,id'],
            'description'      => ['nullable', 'string'],
            'image'            => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'meta_title'       => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords'    => ['nullable', 'string', 'max:255'],
            'status'           => ['nullable', 'boolean'],
        ]);

        $data['slug'] = Str::slug($data['name']);

        // Image Update & Delete Old
        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $data['status'] = $request->has('status') ? 1 : 0;

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('status', 'Category updated successfully!');
    }

    /**
     * Category delete karne ke liye
     */
    public function destroy(Category $category): RedirectResponse
    {
        // Image delete from storage
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('status', 'Category deleted successfully!');
    }
}