<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class BasketController extends Controller
{

    public function basket()
    {
        $orderId = session('orderId');
        if (!is_null($orderId)) {
            $order = Order::find($orderId);
        } else {
            $order = null;
        }

        return view('basket', compact('order'));
    }


    public function basketAdd($product)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }

        if ($order->products->contains($product)) {
            $pivotRow = $order->products()->where('product_id', $product)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        } else {
            $order->products()->attach($product);
        }

        session()->flash('addProduct', 'Товар "'.Product::find($product)->name.'" добавлен в корзину');
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

        $result = $order->saveOrder($data);

        if ($result){
            session()->flash('success','Ваш заказ принят на оформление!');
        }else{
            session()->flash('danger','Что пошло не так!');
        }

        return redirect()->route('main');
    }


    public function basketRemove($product)
    {
        $orderId = session('orderId');

        if (is_null($orderId)) {
            return redirect()->route('basket');
        }

        $order = Order::find($orderId);

        if ($order->products->contains($product)) {
            $pivotRow = $order->products()->where('product_id', $product)->first()->pivot;
            if ($pivotRow->count < 2) {
                $order->products()->detach($product);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }

        session()->flash('removeProduct', 'Товар "'.Product::find($product)->name.'" удален из корзины');
        return redirect()->route('basket');
    }



}
