<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders;
        return view('admin.orders.orders', compact('orders'));
    }

    public function show(Order $order)
    {
        if (!auth()->user()->orders->contains($order)) {
            return back();
        }
        return view('admin.orders.show', compact('order'));
    }

}
