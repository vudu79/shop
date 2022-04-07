<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('index', compact('products'));
    }


    public function categories()
    {
        $categories = Category::all();

        return view('categories', ['categories' => $categories]);
    }


    public function category($code)
    {
        $category = Category::where('code', $code)->first();

        return view('category', compact('category'));
    }


    public function product($product = null)
    {
        $product = Product::find($product);
        return view('product', compact('product'));
    }

}
