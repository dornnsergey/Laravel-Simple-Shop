<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ShoppingCartController extends Controller
{
    public function cart()
    {
        $orderId = session('orderId');

        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::findOrFail($orderId);
        }

        return view('cart', compact('order'));
    }

    public function order()
    {
        $orderId = session('orderId');
        $order = Order::find($orderId);

        return view('order', compact('order'));
    }

    public function addToCart(Product $product)
    {
        $orderId = session('orderId');

        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::findOrFail($orderId);
        }

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
        $orderId = session('orderId');

        if (is_null($orderId)) {
            $order = Order::create();
            return false;
        }
        $order = Order::find($orderId);

        $productPivot = $order->products()->find($product)->pivot;
        $count = $productPivot->count;
        if ($count >= 2) {
            ($productPivot->decrement('count'));
        } else {
            $order->products()->detach($product);
        }

        return redirect()->route('cart')->with('message', "Product $product->name has been deleted from cart.");
    }

    public function orderPost(Request $request)
    {
        $order = Order::find(session('orderId'));

        if ($order->store($request)) {
            session()->flash('success', 'Order has been send successfully.');
        } else {
            session()->flash('warning', 'Error');
        }

        return redirect()->route('index');
    }
}
