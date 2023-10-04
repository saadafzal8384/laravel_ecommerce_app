@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Category
                        <a href="{{url('admin/category')}}" class="btn btn-warning btn-sm text-white float-end">Back</a>
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
                <div class="card-body" style="background: #ccc;">
                    <form action="{{url('admin/category')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="name" class="mb-1">Name</label>
                                <input type="text" name="name" class="form-control"/>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="slug" class="mb-1">Slug</label>
                                <input type="text" name="slug" class="form-control"/>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="description" class="mb-1">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="10"></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="image" class="mb-1">Image</label>
                                <input type="file" name="image" class="form-control"/>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status" class="mb-1">Status</label>
                                <input type="checkbox" name="status"/>
                            </div>

                            <div class="col-md-12 mt-2 mb-2">
                                <h4>SEO Tags</h4>
                                <hr>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="meta_title" class="mb-1">Meta Title</label>
                                <input type="text" name="meta_title" class="form-control"/>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="meta_keywords" class="mb-1">Meta Keywords</label>
                                <textarea class="form-control" name="meta_keywords" id="meta_keywords"
                                          rows="3"></textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="meta_description" class="mb-1">Meta Description</label>
                                <textarea class="form-control" name="meta_description" id="meta_description"
                                          rows="3"></textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-lg btn-success text-white fw-bold float-end">Save
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
