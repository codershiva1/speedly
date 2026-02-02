<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
        {
            // 1. Search term ko request se pakadna
            $searchTerm = $request->input('search');

            // 2. Query builder start karna
            $categories = Category::query()
                ->with('parent') // Eager loading for performance
                ->when($searchTerm, function ($query, $searchTerm) {
                    // Agar search term hai, to name ya parent name se filter karein
                    return $query->where('name', 'LIKE', "%{$searchTerm}%")
                                ->orWhereHas('parent', function($q) use ($searchTerm) {
                                    $q->where('name', 'LIKE', "%{$searchTerm}%");
                                });
                })
                ->latest()
                ->paginate(10);

            // 3. Search results ko pagination ke saath barkarar rakhna (Important!)
            $categories->appends(['search' => $searchTerm]);

            return view('admin.categories.index', compact('categories'));
        }

    public function create(): View
    {
        $parents = Category::orderBy('name')->pluck('name', 'id');

        return view('admin.categories.create', compact('parents'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'parent_id' => ['nullable', 'exists:categories,id'],
            'status' => ['nullable', 'boolean'],
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['status'] = $data['status'] ?? true;

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('status', 'Category created.');
    }

    public function edit(Category $category): View
    {
        $parents = Category::where('id', '!=', $category->id)->orderBy('name')->pluck('name', 'id');

        return view('admin.categories.edit', compact('category', 'parents'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'parent_id' => ['nullable', 'exists:categories,id'],
            'status' => ['nullable', 'boolean'],
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['status'] = $data['status'] ?? true;

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('status', 'Category updated.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('status', 'Category deleted.');
    }
}
