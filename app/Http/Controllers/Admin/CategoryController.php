<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\EditCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
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
        if ($request->has('image')) {
            $filename = time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('categories', $filename, 'public');
        }

        Category::create([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $filename ?? null,
        ]);

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
        if ($request->has('image')) {
            Storage::delete($category->image);

            $filename = time() . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('categories', $filename, 'public');
        }

        $category->update([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $path ?? null,
        ]);

        return redirect()->route('admin.categories.index')->with('message', 'Category has been updated.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('message', 'Category has been deleted.');
    }
}
