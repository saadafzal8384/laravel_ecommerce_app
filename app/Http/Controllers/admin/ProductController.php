<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Colors;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', ['products' => $products]);
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Colors::where('status', '0')->get();
        return view('admin.products.create', ['categories' => $categories, 'brands' => $brands, 'colors' => $colors]);
    }

    public function store(ProductFormRequest $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
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
                'meta_keywords' => $validatedData['meta_keyword'],
                'meta_description' => $validatedData['meta_description'],
            ]);

            $this->saveProductImages($request, $product);

            if($request->colors)
            {
                foreach ($request->colors as $key =>  $color) {
                    $product->productColors()->create([
                        'product_id' => $product->id,
                        'color_id' => $color,
                        'quantity' => $request->color_quantity[$key] ?? 0,
                    ]);
                }
            }

            return redirect('admin/products')->with('success', 'Product created successfully');

        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function edit(int $product_id)
    {
        $product = Product::with('productImages')->find($product_id);
        $categories = Category::all();
        $brands = Brand::all();
        $product_colors = $product->productColors->pluck('color_id')->toArray();
        $colors = Colors::whereNotIn('id', $product_colors)->get();
        return view('admin.products.edit', ['product' => $product, 'categories' => $categories, 'brands' => $brands, 'colors' => $colors]);
    }

    public function update(int $product_id, ProductFormRequest $request)
    {
        $validatedData = $request->validated();
        $product = Category::findOrFail($validatedData['category_id'])->products()->where('id', $product_id)->first();
        if ($product) {
            $product->update([
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
                'meta_keyword' => $validatedData['meta_keyword'],
                'meta_description' => $validatedData['meta_description'],
            ]);

            $this->saveProductImages($request, $product);
            return redirect('admin/products')->with('success', 'Product updated successfully');

        } else {
            return redirect('admin/products')->with('error', 'No Such Product Found');
        }
    }

    /**
     * @param ProductFormRequest $request
     * @param $product
     * @return void
     */
    public function saveProductImages(ProductFormRequest $request, $product): void
    {
        if ($request->hasFile('image')) {
            $uploadPath = 'uploads/products/';
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
    }

    public function destroyImage(int $product_image_id): RedirectResponse
    {
        $productImage = ProductImage::findOrFail($product_image_id);
        if ($productImage) {
            if (file_exists($productImage->image)) {
                unlink($productImage->image);
            }
            $productImage->delete();
            return redirect()->back()->with('success', 'Product image deleted successfully');
        } else {
            return redirect()->back()->with('error', 'No such product image found');
        }
    }

    public function destroy(int $product_id)
    {
        $product = Product::findOrFail($product_id);
        if ($product) {
            if ($product->productImages) {
                foreach ($product->productImages as $productImage) {
                    if (file_exists($productImage->image)) {
                        unlink($productImage->image);
                    }
                    $productImage->delete();
                }
            }
            $product->delete();
            return redirect()->back()->with('success', 'Product deleted successfully');
        } else {
            return redirect()->back()->with('error', 'No such product found');
        }
    }
}
