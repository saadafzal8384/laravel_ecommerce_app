<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroyCategory">
                    <div class="modal-body">
                        Do you want to delete this category?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-inverse-danger">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end of Modal -->

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @if(session('message'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
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
                                    <td><img src="{{asset('uploads/category/'.$category->image)}}" class="img-fluid"/>
                                    </td>
                                    @if ($category->status === 0)
                                        <td class="text-success fw-bold">Active</td>
                                    @else
                                        <td class="text-danger fw-bold">In-Active</td>
                                    @endif
                                    <td>{{$category->meta_title}}</td>
                                    <td>
                                        @php
                                            $keywords = explode(',', $category->meta_keyword);
                                        @endphp
                                        @foreach ($keywords as $keyword)
                                            @if (!empty(trim($keyword)))
                                                <span class="badge bg-secondary mb-2 mt-2">{{$keyword}}</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{url('admin/category/'.$category->id.'/edit')}}"
                                           class="btn btn-inverse-warning text-black fw-bold btn-sm mb-2">Edit</a>
                                        <a href="#" wire:click="deleteCategory({{ $category->id }})"
                                           data-bs-toggle="modal" data-bs-target="#deleteModal"
                                           class="btn btn-inverse-danger text-black fw-bold btn-sm mb-2">Delete</a>
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

</div>

@push('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#deleteModal').modal('hide');
        })
    </script>
@endpush
