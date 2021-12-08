<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;


class ShoppingCartController extends Controller
{
    public function cart()
    {
        $orderId = session('orderId');
        if (!is_null($orderId)) {
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

        return redirect()->route('cart');
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

        return redirect()->route('cart');
    }

    public function orderPost(Request $request)
    {
        $order = Order::find(session('orderId'));
        $res = $order->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'status' => 1,
        ]);

        if ($res) {
            session()->flash('success', 'Order has been send successfully.');
        } else {
            session()->flash('warning', 'Error');
        }

        session()->forget('orderId');

        return redirect()->route('index');
    }
}
