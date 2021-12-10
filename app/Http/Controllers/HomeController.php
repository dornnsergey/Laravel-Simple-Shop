<?php

namespace App\Http\Controllers;

use App\Models\Order;

class HomeController extends Controller
{

    public function index()
    {
        $orders = Order::with('products')->where('status', 1)->get();

        return view('orders.index', compact('orders'));
    }
}
