<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        Category::create($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $this->validated($request, $category);

        $category->update($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }

    private function validated(Request $request, ?Category $category = null): array
    {
        $request->merge(['slug' => Str::slug((string) $request->input('name'))]);

        return $request->validate([
            'name' => [
                'required', 'string', 'max:100',
                Rule::unique('categories', 'name')->ignore($category?->id),
            ],
            'slug' => [
                'required',
                Rule::unique('categories', 'slug')->ignore($category?->id),
            ],
            'description' => ['nullable', 'string', 'max:500'],
        ], [
            'name.required'   => 'Nama kategori wajib diisi.',
            'name.max'        => 'Nama kategori maksimal 100 karakter.',
            'name.unique'     => 'Nama kategori sudah digunakan.',
            'slug.required'   => 'Nama kategori harus mengandung huruf atau angka.',
            'slug.unique'     => 'Nama kategori terlalu mirip dengan kategori lain.',
            'description.max' => 'Deskripsi maksimal 500 karakter.',
        ]);
    }
}