<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.category.index');
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.category.create');
    }

    public function store(CategoryFormRequest $request)
    {
        try {
            $categoryData = $request->validated();
            $category = new Category();
            $category->name = $categoryData['name'];
            $category->slug = Str::slug($categoryData['slug']);
            $category->description = $categoryData['description'];
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move('uploads/category/', $imageName);
                $category->image = $imageName;
            }
            $category->status = $request->status === true ? '1' : '0';
            $category->meta_title = $categoryData['meta_title'];
            $category->meta_keyword = $categoryData['meta_keywords'];
            $category->meta_description = $categoryData['meta_description'];
            $category->save();
            return redirect('admin/category/create')->with('message', 'Category created successfully');
        } catch (\Exception $e) {
            return redirect('admin/category/create')->with('message', 'Category creation Failed !');
        }
    }

    public function edit(Category $category): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryFormRequest $request, Category $category)
    {
        $categoryData = $request->validated();
        $category = Category::findOrFail($category->id);
        $category->name = $categoryData['name'];
        $category->slug = Str::slug($categoryData['slug']);
        $category->description = $categoryData['description'];
        if ($request->hasFile('image')) {
            if (File::exists('uploads/category/' . $category->image)) {
                File::delete('uploads/category/' . $category->image);
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move('uploads/category/', $imageName);
            $category->image = $imageName;
        }
        $category->status = $request->status === true ? '1' : '0';
        $category->meta_title = $categoryData['meta_title'];
        $category->meta_keyword = $categoryData['meta_keywords'];
        $category->meta_description = $categoryData['meta_description'];
        $category->save();
        return redirect('admin/category/')->with('message', 'Category Updated successfully');
    }
}
