<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function cart()
    {
        $order = session('order')->load('products');

        return view('shop.cart.index', compact('order'));
    }

    public function order()
    {
        $order = session('order');

        return view('shop.cart.order', compact('order'));
    }

    public function addToCart(Product $product)
    {
        $order = session('order');

        if ($order->products->contains($product)) {
            ($order->products()->find($product)->pivot->increment('count'));
        } else {
            $order->products()->attach($product);
        }

        if (Auth::check()) {
            $order->user_id = Auth::id();
            $order->save();
        }
        return redirect()->route('cart')->with('message', "Product $product->name has been added successfully");
    }

    public function removeFromCart(Product $product)
    {
        $order = session('order');

        $productPivot = $order->products()->find($product)->pivot;
        $count = $productPivot->count;
        if ($count >= 2) {
            ($productPivot->decrement('count'));
        } else {
            $order->products()->detach($product);
        }

        return redirect()->route('cart')->with('message', "Product $product->name has been deleted from cart.");
    }

    public function orderPost(CreateOrderRequest $request)
    {
        $order = session('order');
        $order->update($request->validated() + ['status' => 1]);

        session()->forget('order');

        return redirect()->route('home')->with('success', 'Order has been sent successfully.');
    }
}
