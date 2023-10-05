@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Update Category
                        <a href="{{url('admin/category')}}" class="btn btn-warning btn-sm text-white float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body" style="background: #ccc;">
                    <form action="{{url('admin/category/'.$category->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="mb-1">Name</label>
                                <input type="text" name="name" value="{{$category->name}}" class="form-control"/>
                                @error('name')<small class="text-danger">{{$message}}</small>@enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="slug" class="mb-1">Slug</label>
                                <input type="text" name="slug" value="{{$category->slug}}" class="form-control"/>
                                @error('slug')<small class="text-danger">{{$message}}</small>@enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="description" class="mb-1">Description</label>
                                <textarea class="form-control" name="description" id="description"
                                          rows="10">{{$category->description}}</textarea>
                                @error('description')<small class="text-danger">{{$message}}</small>@enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="image" class="mb-1">Image</label>
                                <input type="file" name="image" class="form-control"/>
                                <img src="{{asset('uploads/category/'.$category->image)}}" class="img-fluid mt-2"
                                     width="100px"/>
                                @error('image')<small class="text-danger">{{$message}}</small>@enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status" class="mb-1">Status</label>
                                <input type="checkbox" name="status" {{$category->status === '1' ? 'checked' : ''}} />
                                @error('status')<small class="text-danger">{{$message}}</small>@enderror
                            </div>

                            <div class="col-md-12 mt-2 mb-2">
                                <h4>SEO Tags</h4>
                                <hr>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="meta_title" class="mb-1">Meta Title</label>
                                <input type="text" name="meta_title" value="{{$category->meta_title}}"
                                       class="form-control"/>
                                @error('meta_title')<small class="text-danger">{{$message}}</small>@enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="meta_keywords" class="mb-1">Meta Keywords (Write keywords comma
                                    seperated)</label>
                                <textarea class="form-control" name="meta_keywords" id="meta_keywords"
                                          rows="3">{{$category->meta_keyword}}</textarea>
                                @error('meta_keywords')<small class="text-danger">{{$message}}</small>@enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="meta_description" class="mb-1">Meta Description</label>
                                <textarea class="form-control" name="meta_description" id="meta_description"
                                          rows="3">{{$category->meta_description}}</textarea>
                                @error('meta_description')<small class="text-danger">{{$message}}</small>@enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-lg btn-success text-white fw-bold float-end">Update
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
