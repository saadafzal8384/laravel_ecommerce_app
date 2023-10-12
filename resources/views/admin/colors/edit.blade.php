@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Update Color
                        <a href="{{url('admin/colors')}}" class="btn btn-warning btn-sm text-white float-end">Back</a>
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
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">{{$error}}</div>
                        @endforeach
                    @endif

                    <form action="{{url('admin/colors/'.$color->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="mb-2" for="name">Color Name</label>
                            <input type="text" name="name" value="{{$color->name}}" class="form-control"/>
                        </div>

                        <div class="mb-3">
                            <label class="mb-2" for="name">Color Code</label>
                            <input type="text" name="code" value="{{$color->code}}" class="form-control"
                                   placeholder="#FFFFFF"/>
                        </div>

                        <div class="mb-3">
                            <label class="mb-2" for="status">Status</label>
                            <input type="checkbox" name="status" {{ old('status', $color->status) ? 'checked' : '' }} />
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-lg btn-success text-white fw-bold float-end">Update Color
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
