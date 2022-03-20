@extends('layouts.admin.roles')
@section('title')
    Show Role
@endsection

@section('content')
<div class="card mb-5 shadow">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h4>Role Detail </h4>
            <a href="{{route('roles.create')}}" class="btn btn-outline-primary">Add Roles</a>
        </div>
    </div>

    <div class="card-body">
        <div class="col mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" value="{{$role->name}}" readonly>
        </div>

        <div class="col mb-3">
            <label class="form-label">Permission</label>
            <div>
                @if(!empty($rolePermissions))
                @foreach($rolePermissions as $permission)
                    <span class="fs-6 badge bg-success shadow mb-2 me-1">{{ $permission->name }}</span>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection