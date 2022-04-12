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

//        session()->forget('full_order_summ');
        $orderId = session('orderId');
        if (!is_null($orderId)) {
            $order = Order::find($orderId);
        } else {
            $order = null;
        }

        return view('basket', compact('order'));
    }


    public function basketAdd($productId)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }
        if ($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        } else {
            $order->products()->attach($productId);
        }

        if (Auth::check()) {
            $order->user_id = Auth::id();
            $order->save();
        }
        $product = Product::find($productId);

        Order::changeFullSumm($product->price);

        session()->flash('addProduct', 'Товар "' . $product->name . '" добавлен в корзину');
        return redirect()->route('basket');
    }


    public function basketPlace($order)
    {
        $orderId = session('orderId');
//        dd($order);
        if (!is_null($orderId)) {
            $order = Order::find($orderId);

        } else {
            return redirect()->route('basket');
        }

        return view('order', compact('order'));
    }


    public function basketConfirm(OrderRequest $request)
    {
        $data = $request->validated();

        $orderId = session('orderId');

        if (is_null($orderId)) {
            return redirect()->route('basket');
        }
        $order = Order::find($orderId);

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


    public function basketRemove($productId)
    {
        $orderId = session('orderId');

        if (is_null($orderId)) {
            return redirect()->route('basket');
        }

        $order = Order::find($orderId);

        if ($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            if ($pivotRow->count < 2) {
                $order->products()->detach($productId);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }
        $product = Product::find($productId);

        Order::changeFullSumm(-$product->price);


        session()->flash('removeProduct', 'Товар "' . $product->name . '" удален из корзины');
        return redirect()->route('basket');
    }
}
