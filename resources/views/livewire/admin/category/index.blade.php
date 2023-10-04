<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Add Category
                    <a href="{{url('admin/category/create')}}" class="btn btn-success text-white btn-sm float-end">Add
                        Category</a>
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive>">
                    <table class="table table-bordered table-striped align-middle">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Meta Title</th>
                            <th>Meta Keywords</th>
                            <th>Action</th>
                        </tr>
                        <tbody>
                        @foreach($categories as $key => $category)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->slug}}</td>
                                <td><img src="{{asset('uploads/category/'.$category->image)}}" class="img-fluid" /></td>
                                @if ($category->status === 0)
                                    <td class="text-success fw-bold">Active</td>
                                @else
                                    <td class="text-danger fw-bold">In-Active</td>
                                @endif
                                <td>{{$category->meta_title}}</td>
                                <td>{{$category->meta_keyword}}</td>
                                <td>
                                    <a href="{{url('admin/category/'.$category->id.'/edit')}}"
                                       class="btn btn-primary btn-sm">Edit</a>
                                    <a href="{{url('admin/category/'.$category->id.'/delete')}}"
                                       class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        {{ $categories->links() }}
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
