<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\EditCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CreateCategoryRequest $request)
    {
        $data = $request->validated();
        if ($request->has('image')) {
            $filename = time() . $request->file('image')->getClientOriginalName();
            $data['image'] = $request->file('image')->storeAs('categories', $filename, 'public');
        }

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('message', 'Category has been created.');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(EditCategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        if ($request->has('image')) {
            Storage::delete($category->image);

            $filename = time() . $request->file('image')->getClientOriginalName();
            $data['image'] = $request->file('image')->storeAs('categories', $filename, 'public');
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('message', 'Category has been updated.');
    }

    public function destroy(Category $category)
    {
        if ($category->products()->count()) {
            return redirect()->route('admin.categories.index')->with('message', 'Cannot delete, category has products.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('message', 'Category has been deleted.');
    }
}
