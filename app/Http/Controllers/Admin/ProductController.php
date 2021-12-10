<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with('category')->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    public function store(CreateProductRequest $request)
    {
        $product = $request->validated();
        if ($request->has('image')) {
            $filename = time() . $request->file('image')->getClientOriginalName();
            $product['image'] = $request->file('image')->storeAs('products', $filename, 'public');
        }

        Product::create($product);

        return redirect()->route('admin.products.index')->with('message', 'Product has been created.');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(EditProductRequest $request, Product $product)
    {
        $newData = $request->validated();
        if ($request->has('image')) {
            Storage::delete($product->image);

            $filename = time() . $request->file('image')->getClientOriginalName();
            $newData['image'] = $request->file('image')->storeAs('products', $filename, 'public');
        }

        $product->update($newData);

        return redirect()->route('admin.products.index')->with('message', 'Product has been updated.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('message', 'Product has been deleted.');
    }
}
