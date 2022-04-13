<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{

    public function basket()
    {
        $orderId = session('orderId');
        $order = Order::find($orderId);
        return view('basket', compact('order'));
    }


    public function basketAdd(Product $product)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::findOrFail($orderId);
        }
        if ($order->products->contains($product->id)) {
            $pivotRow = $order->products()->where('product_id', $product->id)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        } else {
            $order->products()->attach($product->id);
        }

        if (Auth::check()) {
            $order->user_id = Auth::id();
            $order->save();
        }

        Order::changeFullSumm($product->price);

        session()->flash('addProduct', 'Товар "' . $product->name . '" добавлен в корзину');
        return redirect()->route('basket');
    }


    public function basketPlace($order)
    {
        $orderId = session('orderId');
        $order = Order::findOrFail($orderId);
        return view('order', compact('order'));
    }


    public function basketConfirm(OrderRequest $request)
    {
        $data = $request->validated();

        $orderId = session('orderId');

        $order = Order::findOrFail($orderId);

//dd(auth()->user());
        $result = $order->saveOrder($data);

        if ($result) {
            session()->flash('success', 'Ваш заказ принят на оформление!');
        } else {
            session()->flash('danger', 'Что пошло не так!');
        }

        Order::eraseOrderSumm();
        return redirect()->route('main');
    }


    public function basketRemove(Product $product)
    {
        $orderId = session('orderId');
        $order = Order::findOrFail($orderId);

        if ($order->products->contains($product->id)) {
            $pivotRow = $order->products()->where('product_id', $product->id)->first()->pivot;
            if ($pivotRow->count < 2) {
                $order->products()->detach($product->id);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }

        Order::changeFullSumm(-$product->price);

        session()->flash('removeProduct', 'Товар "' . $product->name . '" удален из корзины');
        return redirect()->route('basket');
    }
}
