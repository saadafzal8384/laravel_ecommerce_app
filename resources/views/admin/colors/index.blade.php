@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Colors
                        <a href="{{url('admin/colors/create')}}"
                           class="btn btn-inverse-success btn-sm text-black float-end">Add Color</a>
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
                            <th>Sr #</th>
                            <th>Color Name</th>
                            <th>Color Code</th>
                            <th>Color Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($colors as $key => $color)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$color->name}}</td>
                                <td>{{$color->code}}</td>
                                @if ($color->status === 0)
                                    <td class="text-success fw-bold">Active</td>
                                @else
                                    <td class="text-danger fw-bold">In-Active</td>
                                @endif
                                <td>
                                    <a href="{{url('admin/colors/'.$color->id. '/edit')}}"
                                       class="btn btn-inverse-warning btn-sm text-black">Edit</a>
                                    <a href="{{url('admin/colors/'.$color->id. '/delete')}}"
                                       class="btn btn-inverse-danger btn-sm text-black">Delete</a>
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
