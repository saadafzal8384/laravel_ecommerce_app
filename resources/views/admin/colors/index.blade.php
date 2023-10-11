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

                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
