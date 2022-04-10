<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use function view;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::where('status',1)->get();
        return view('admin.orders.orders', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }
}
