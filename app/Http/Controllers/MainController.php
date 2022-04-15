<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailRequest;
use App\Http\Requests\ProductsFilterRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subscription;

class MainController extends Controller
{
    public function index(ProductsFilterRequest $request)
    {
//        session()->forget('full_order_summ');

//        \Debugbar::info("sdfsasdadsasdasdfdsfdsf");
//        Log::channel('single')->info($request->getClientIp());

        $productsQuery = Product::with('category');

        if ($request->filled('price_from')){
            $productsQuery->where('price', '>=', $request['price_from']);
        }

        if ($request->filled('price_to')){
            $productsQuery->where('price', '<=', $request['price_to']);
        }

        foreach (['new', 'hit','recommend'] as $field){
            if ( $request->has($field)){
                $productsQuery->where($field, 1);
            }
        }

        $products = $productsQuery->paginate(6)->withPath('?' . $request->getQueryString());
        return view('index', compact('products'));
    }


    public function categories()
    {
        $categories = Category::all();

        return view('categories', ['categories' => $categories]);
    }


    public function category($code)
    {
        $category = Category::with('products')->where('code', $code)->first();

        return view('category', compact('category'));
    }


    public function product($product = null)
    {
        $product = Product::withTrashed()->find($product);
        return view('product', compact('product'));
    }

    public function subscribe(EmailRequest $request, Product $product)
    {
//        dd($product);

        Subscription::create([
            'email'=>$request['email'],
            'product_id'=>$product->id,
        ]);

        return redirect()->back()->with('success', 'Спасибо, мы сообщим Вам о поступлении товара.');
    }

}
