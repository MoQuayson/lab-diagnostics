@extends('layouts.admin.roles')
@section('title')
Create Role
@endsection
@section('content')
<div class="card mb-5 shadow">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h4>Create New Role</h4>
            <a href="{{route('roles.index')}}" class="btn btn-outline-primary">View Roles</a>
        </div>
    </div>

    <div class="card-body">
        <form action="{{route('roles.store');}}" method="POST" enctype="multipart/form-data">
            <div class="container">
                @csrf
                <div class="col mb-3">
                    <label class="form-label fw-bold h4">Role Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required>
                    <span class="text-danger">@error('name'){{$message}}@enderror</span>
                </div>

                <div class="col mb-3">
                    <label class="form-label fw-bold h4">Permission</label>
                    <div class="row row-cols-md-4 ms-0">
                        @foreach ($permission as $item)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{$item->id}}" id="permission[]" name="permission[]">
                            <label class="form-check-label">{{$item->name}}</label>
                        </div>
                        @endforeach
                    </div>

                    <span class="text-danger">@error('permmission[]'){{$message}}@enderror</span>
                </div>
                <hr>
                <div class="col mb-3">
                    <button class="btn btn-block btn-primary float-end">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection