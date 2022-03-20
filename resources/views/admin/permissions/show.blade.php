@extends('layouts.admin.permission')
@section('title')
    Show Permission
@endsection

@section('content')
<div class="card mb-5 shadow">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h4>Permission Detail </h4>
            <a href="{{route('permissions.index')}}" class="btn btn-outline-primary">View Permissions</a>
        </div>
    </div>

    <div class="card-body">
        <div class="col mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" value="{{$permission->name}}" readonly>
        </div>
    </div>
</div>
@endsection