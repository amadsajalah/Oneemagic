<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = \App\Models\Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'history' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('magic_lab', 'public');
        }

        \App\Models\Category::create($validated);
        return back()->with('success', 'Kategori Magic Lab berhasil ditambahkan.');
    }

    public function update(Request $request, \App\Models\Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'history' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            if ($category->image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($category->image_path)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($category->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('magic_lab', 'public');
        }

        $category->update($validated);
        return back()->with('success', 'Kategori Magic Lab berhasil diperbarui.');
    }

    public function destroy(\App\Models\Category $category)
    {
        if ($category->image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($category->image_path)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($category->image_path);
        }
        $category->delete();
        return back()->with('success', 'Kategori Magic Lab berhasil dihapus.');
    }
}
