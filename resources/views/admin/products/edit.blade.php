@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Update Product
                        <a href="{{url('admin/products')}}" class="btn btn-warning btn-sm text-white float-end">Back</a>
                    </h3>
                   @if(session('success'))
                           <div class="alert alert-success">
                               {{session('success')}}
                           </div>
                   @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="card-body" style="background: #e9ebeb;">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">{{$error}}</div>
                        @endforeach
                    @endif
                    <form action="{{url('admin/products/'.$product->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#home"
                                        type="button" role="tab" aria-controls="home" aria-selected="true">Home
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo"
                                        type="button" role="tab" aria-controls="seo" aria-selected="false">SEO Tags
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details"
                                        type="button" role="tab" aria-controls="details" aria-selected="false">Details
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="images-tab" data-bs-toggle="tab" data-bs-target="#images"
                                        type="button" role="tab" aria-controls="images" aria-selected="false">Product
                                    Images
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content p-3" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="mb-3 row">
                                    <label for="category_id" class="mb-2">Category</label>
                                    <select name="category_id" class="form-select form-select-md mb-3">
                                        @foreach($categories as $category)
                                            <option
                                                value="{{$category->id}}" {{$category->id === $product->category_id ? 'selected':''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 row">
                                    <label for="name" class="mb-2">Product Name</label>
                                    <input type="text" name="name" value="{{$product->name}}" class="form-control">
                                </div>
                                <div class="mb-3 row">
                                    <label for="slug" class="mb-2">Product Slug</label>
                                    <input type="text" name="slug" value="{{$product->slug}}" class="form-control">
                                </div>
                                <div class="mb-3 row">
                                    <label for="brand" class="mb-2">Brands</label>
                                    <select name="brand" class="form-select form-select-md mb-3">
                                        @foreach($brands as $brand)
                                            <option
                                                value="{{$brand->name}}" {{$brand->name === $product->brand ? 'selected':''}}>{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 row">
                                    <label for="small_description" class="mb-2">Small Description (Max. 500
                                        words)</label>
                                    <textarea name="small_description" class="form-control" id="small_description"
                                              cols="30" rows="10">{{$product->small_description}}</textarea>
                                </div>
                                <div class="mb-3 row">
                                    <label for="description" class="mb-2">Description (Max. 1000 words)</label>
                                    <textarea name="description" class="form-control" id="description" cols="30"
                                              rows="10">{{$product->description}}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                                <div class="mb-3 row">
                                    <label for="meta_title" class="mb-2">Meta Title</label>
                                    <input type="text" value="{{$product->meta_title}}" name="meta_title"
                                           class="form-control">
                                </div>
                                <div class="mb-3 row">
                                    <label for="meta_description" class="mb-2">Meta Description</label>
                                    <textarea name="meta_description" class="form-control" id="meta_description"
                                              cols="30" rows="10">{{$product->meta_description}}</textarea>
                                </div>
                                <div class="mb-3 row">
                                    <label for="meta_keywords" class="mb-2">Meta Keywords</label>
                                    <textarea name="meta_keyword" class="form-control" id="meta_keywords" cols="30"
                                              rows="10">{{$product->meta_keyword}}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="original_price" class="mb-2">Original Price</label>
                                            <input type="text" value="{{$product->original_price}}"
                                                   name="original_price" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="selling_price" class="mb-2">Selling Price</label>
                                            <input type="text" value="{{$product->selling_price}}" name="selling_price"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="quantity" class="mb-2">Quantity</label>
                                            <input type="number" value="{{$product->quantity}}" name="quantity"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="trending" class="mb-2">Trending</label>
                                            <input type="checkbox"
                                                   name="trending" {{$product->trending === '1' ? 'checked': ''}}>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="status" class="mb-2">Status</label>
                                            <input type="checkbox"
                                                   name="status" {{$product->status === '1' ? 'checked': ''}} />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="product_image" class="mb-2">Please Upload Product Images</label>
                                        <input type="file" id="images" name="image[]" class="form-control" multiple/>
                                    </div>
                                    <div>
                                        @if($product->productImages)
                                            <div class="row">
                                                @foreach($product->productImages as $image)
                                                    <div class="col-md-2">
                                                        <img class="me-4 border" src="{{asset($image->image)}}"
                                                             style="height: 100px; width: 100px;" alt="product image">
                                                        <a class="d-block"
                                                           href="{{url('admin/product-image/'.$image->id.'/delete')}}">Remove</a>
                                                    </div>

                                                @endforeach

                                            </div>

                                        @else
                                            <h4>No Images Found</h4>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success btn-lg float-end">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
