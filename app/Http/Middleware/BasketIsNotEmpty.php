<?php

namespace App\Http\Middleware;

use App\Models\Order;
use Closure;
use Illuminate\Http\Request;

class BasketIsNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
//        session()->flush();
//        die();
        $orderId = session('orderId');

        if (!is_null($orderId) && Order::getFullSumm() > 0) {
            return $next($request);

        }
        session()->flash('emptybasket', "Ваша корзина пуста!");
        return redirect()->route('main');

    }
}
