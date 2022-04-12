<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.categories.index', compact('categories'));
    }


    public function create()
    {
        return view('admin.categories.form');
    }


    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        if ($request->has('image')){
            $data['image'] =Storage::disk('public')->put('/categories', $data['image']);
        }

        Category::create($data);

        return redirect()->route('categories.index');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }


    public function edit(Category $category)
    {
        return view('admin.categories.form', compact('category'));
    }



    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();

        if ($request->has('image')){
            Storage::disk('public')->delete($category->image);
            $data['image'] =Storage::disk('public')->put('/images', $data['image']);
        }

        $category->update($data);

        return redirect()->route('categories.index');
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
