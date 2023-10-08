<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index');
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create', ['categories' => $categories, 'brands' => $brands]);
    }

    public function store(ProductFormRequest $request)
    {
        $validatedData = $request->validated();
        if ($request->validated()) {
            $category = Category::find($validatedData['category_id']);
            $product = $category->products()->create([
                'category_id' => $validatedData['category_id'],
                'name' => $validatedData['name'],
                'slug' => Str::slug($validatedData['slug']),
                'brand' => $validatedData['brand'],
                'small_description' => $validatedData['small_description'],
                'description' => $validatedData['description'],
                'original_price' => $validatedData['original_price'],
                'selling_price' => $validatedData['selling_price'],
                'quantity' => $validatedData['quantity'],
                'trending' => $request->trending ? '1' : '0',
                'status' => $request->status ? '1' : '0',
                'meta_title' => $validatedData['meta_title'],
                'meta_keywords' => $validatedData['meta_keywords'],
                'meta_description' => $validatedData['meta_description'],
            ]);

            if ($request->hasFile('image')) {
                $uploadPath = public_path('uploads/products');
                $i = 1;
                foreach ($request->file('image') as $imageFile) {
                    $extension = $imageFile->getClientOriginalExtension();
                    $fileName = time() . $i++ . '.' . $extension;
                    $imageFile->move($uploadPath, $fileName);
                    $finalImagePathName = $uploadPath . $fileName;

                    $product->productImages()->create([
                        'image' => $finalImagePathName,
                        'product_id' => $product->id,
                    ]);
                }
            }

            return redirect('admin/products')->with('success', 'Product created successfully');

        }

    }
}
