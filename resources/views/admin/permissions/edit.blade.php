@extends('layouts.admin.permission')
@section('title')
    Edit Permission
@endsection

@section('content')
<div class="card mb-5 shadow">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h4>Edit Role</h4>
            <a href="{{route('permissions.index')}}" class="btn btn-outline-primary">View Permissions</a>
        </div>
    </div>

    <div class="card-body">
        <form action="{{route('permissions.update',['permission'=>$permission->id]);}}" method="POST" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            <div class="container">
                @csrf
                <div class="col mb-3">
                    <label class="form-label fw-bold h4">Permission Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$permission->name}}" required>
                    <span class="text-danger">@error('name'){{$message}}@enderror</span>
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