<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Models\Category;
use App\Models\Label;
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
        $labels = Label::get('name');


        return view('admin.products.create', compact('categories', 'labels'));
    }

    public function store(CreateProductRequest $request)
    {
        $data = $request->validated();
        if ($request->has('image')) {
            $filename = time() . $request->file('image')->getClientOriginalName();
            $product['image'] = $request->file('image')->storeAs('products', $filename, 'public');
        }

        $product = Product::create($data);

        if ($request->has('labels')) {
            foreach ($request->labels as $labelName) {
                $label = Label::where('name', $labelName)->first();
                $product->labels()->attach($label);
            }
        }

        return redirect()->route('admin.products.index')->with('message', 'Product has been created.');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $labels = Label::all();

        return view('admin.products.edit', compact('product', 'categories', 'labels'));
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


        if ($request->has('labels')) {
            $newLabels = [];
            foreach ($request->labels as $labelName) {
                $label = Label::where('name', $labelName)->first();
                array_push($newLabels, $label->id);
            }
            $product->labels()->sync($newLabels);
        } else {
            $product->labels()->detach();
        }

        return redirect()->route('admin.products.index')->with('message', 'Product has been updated.');
    }

    public function destroy(Product $product)
    {
        $product->labels()->detach();
        $product->delete();

        return redirect()->route('admin.products.index')->with('message', 'Product has been deleted.');
    }
}
