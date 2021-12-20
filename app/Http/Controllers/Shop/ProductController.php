<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(FilterRequest $request)
    {
        $products = Product::with('category', 'labels')
            ->when($request->price_from, function ($query, $min) {
                $query->where('price', '>=', $min);
            })
            ->when($request->price_to, function ($query, $max) {
                $query->where('price', '<=', $max);
            })
            ->when($request->labels, function ($query, $labels) {
                foreach ($labels as $label) {
                    $query->whereRelation('labels', 'name', $label);
                }
            })
            ->paginate(12)->withQueryString($request->getQueryString());

        return view('shop.index', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        return view('shop.products.show', compact('product'));
    }
}
