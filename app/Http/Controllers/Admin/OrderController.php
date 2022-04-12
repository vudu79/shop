<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use function view;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('status',1)->paginate(10);
        return view('admin.orders.orders', compact('orders'));
    }

    public function show(Order $order)
    {
        $products = $order->products()->withTrashed()->get();
        return view('admin.orders.show', compact('order', 'products'));
    }
}
