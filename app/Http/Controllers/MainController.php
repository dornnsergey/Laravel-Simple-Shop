<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterRequest;
use App\Models\Category;
use App\Models\Product;


class MainController extends Controller
{
    public function index(FilterRequest $request)
    {
        $query = Product::query()->with('category', 'labels');

        if ($request->filled('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }
        if ($request->filled('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }
        if ($request->has('labels')) {
            foreach ($request->labels as $label) {
                $query->whereRelation('labels', 'name', $label);
            }
        }

        $products = $query->paginate(6)->withPath('?' . $request->getQueryString());

        return view('index', compact('products'));
    }

    public function categories()
    {
        $categories = Category::all();

        return view('categories', compact('categories'));
    }

    public function category($category)
    {
        $category = Category::where('code', $category)->firstOrFail();
        $products = Product::with('labels')->where('category_id', $category->id)->get();

        return view('category', compact('category', 'products'));
    }

    public function product($category, $product = null)
    {
        $product = Product::where('code', $product)->firstOrFail();

        return view('product', compact('product'));
    }
}
