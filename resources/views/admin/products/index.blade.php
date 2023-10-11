@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Products
                        <a href="{{url('admin/products/create')}}"
                           class="btn btn-inverse-success btn-sm text-black float-end">Add Products</a>
                    </h3>
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
                    <table class="table table-bordered table-striped align-middle">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Category</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $key => $product)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$product->category->name}}</td>
                                <td>{{$product->name}}</td>
                                <td class="fw-bold">{{$product->selling_price}} Euros</td>
                                <td>{{$product->quantity}}</td>
                                @if ($product->status === 0)
                                    <td class="text-success fw-bold">Active</td>
                                @else
                                    <td class="text-danger fw-bold">In-Active</td>
                                @endif
                                <td>
                                    <a href="{{url('admin/products/'.$product->id.'/edit')}}"
                                       class="btn btn-inverse-warning text-black fw-bold btn-lg mb-2">Edit</a>
                                        <a href="{{url('admin/products/'.$product->id.'/delete')}}"
                                                onclick="return confirm('Are you sure you want to delete this product?')"
                                                class="btn btn-inverse-danger text-black fw-bold btn-lg mb-2">Delete
                                        </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
