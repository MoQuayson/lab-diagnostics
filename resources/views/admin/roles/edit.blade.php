@extends('layouts.admin.roles')
@section('title')
    Edit Role
@endsection

@section('content')
<div class="card mb-5 shadow">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h4>Edit Role</h4>
            <a href="{{route('roles.index')}}" class="btn btn-outline-primary">View Roles</a>
        </div>
    </div>

    <div class="card-body">
        <form action="{{route('roles.update',['role'=>$role->id]);}}" method="POST" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            <div class="container">
                @csrf
                <div class="col mb-3">
                    <label class="form-label fw-bold h4">Role Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$role->name}}" required>
                    <span class="text-danger">@error('name'){{$message}}@enderror</span>
                </div>

                <div class="col mb-3">
                    <label class="form-label fw-bold h4">Permission</label>
                    <div class="row row-cols-md-4 ms-0">
                        <?php $status = '';?>
                        @foreach ($permission as $item)
                        @if (in_array($item->id, $rolePermissions))
                            <?php $status = 'checked';?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{$item->id}}" id="permission[]" name="permission[]" {{$status}}>
                                <label class="form-check-label">{{$item->name}}</label>
                            </div>
                        @else
                        <?php $status = '';?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{$item->id}}" id="permission[]" name="permission[]" {{$status}}>
                            <label class="form-check-label">{{$item->name}}</label>
                        </div>
                        @endif

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