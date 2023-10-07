<div>
    @include('livewire.admin.brand.modal-form')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h4>Brand List</h4>
                    <a href="#" class="btn btn-inverse-success text-black fw-bolder btn-sm float-end" data-bs-toggle="modal"
                       data-bs-target="#addBrandModal">Add Brands</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Brand Name</th>
                            <th>Brand Slug</th>
                            <th>Brand Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($brands as $key => $brand)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$brand->name}}</td>
                                <td>{{$brand->slug}}</td>
                                @if ($brand->status === 0)
                                    <td class="text-success fw-bold">Active</td>
                                @else
                                    <td class="text-danger fw-bold">In-Active</td>
                                @endif
                                <td>
                                    <a href="#" class="btn btn-inverse-warning text-black fw-bold btn-sm mb-2">Edit</a>
                                    <a href="#" class="btn btn-inverse-danger text-black fw-bold btn-sm mb-2">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3 mb-3">
                        {{ $brands->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#addBrandModal').modal('hide');
        })
    </script>
@endpush
