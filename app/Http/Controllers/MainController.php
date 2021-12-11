<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;


class MainController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(6);

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

        return view('category', compact('category'));
    }

    public function product($category, $product = null)
    {
        $product = Product::where('code', $product)->firstOrFail();

        return view('product', compact('product'));
    }
}
