@extends('layouts.admin.users')
@section('title')
    Edit User
@endsection

@section('content')
<div class="card mb-1 shadow">
    <div class="card-header">
        <h4>Create User</h4>
    </div>

    <div class="card-body">
        <form action="{{route('users.update',['user'=>$user->id])}}" method="POST" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            <div class="container">
                @csrf
                <div class="col mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Jane Doe" value="{{$user->name}}">
                    <span class="text-danger">@error('name'){{$message}}@enderror</span>
                </div>

                <div class="row">
                    <div class="col-md mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" >
                        <span id="emailErrMsg" class="text-danger">@error('email'){{$message}}@enderror</span>
                    </div>
                    <div class="col-md mb-3">
                        <label class="form-label">Telephone</label>
                        <input type="tel" class="form-control" id="telephone" name="telephone" value="{{$user->telephone}}" >
                        <span class="text-danger">@error('telephone'){{$message}}@enderror</span>
                    </div>
                </div>

                <div class="col mb-3">
                    <label class="form-label">Gender</label>
                    <input type="text" class="form-control" list="datalistOptions" id="gender" name="gender" value="{{$user->gender}}">
                    <datalist id="datalistOptions">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="others">Others</option>
                    </datalist>
                    <span class="text-danger">@error('gender'){{$message}}@enderror</span>
                </div>

                <div class="col mb-3">
                    <label class="form-label">User Privilege</label>
                    <input type="text" class="form-control" list="roleslistOptions" id="role" name="role" value="{{$user->privilege}}">
                    <datalist id="roleslistOptions">
                        @if (count($roles) != 0)
                            @foreach ($roles as $role)
                            <option value="{{$role->name}}">{{$role->name}}</option>
                            @endforeach
                        @endif
                    </datalist>
                </div>
                <hr>
                <div class="col mb-3">
                    <button type="submit" class="btn btn-success float-end">Confirm Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection