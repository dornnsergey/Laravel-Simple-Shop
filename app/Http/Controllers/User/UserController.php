<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;


class UserController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()
            ->where('status', 1)
            ->paginate(10);

        return view('user.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if (! auth()->user()->orders->contains($order)) {
            return redirect()->route('user.orders.index');
        }

        return view('user.orders.show', compact('order'));
    }
}
