<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('admin.products.form', compact('categories'));
    }


    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        if ($request->has('image')) {
            $data['image'] = Storage::disk('public')->put('/images', $data['image']);
        }

        Product::create($data);

        return redirect()->route('products.index');
    }


    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }


    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('admin.products.form', compact('product', 'categories'));
    }


    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->has('image')) {
            Storage::disk('public')->delete($product->image);
            $data['image'] = Storage::disk('public')->put('/images', $data['image']);
        }

        $product->update($data);

        return redirect()->route('products.index');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
