@extends('layouts.admin.users')
@section('title')
    Create User
@endsection

@section('content')
<div class="card mb-1 shadow">
    <div class="card-header">
        <h4>Create User</h4>
    </div>

    <div class="card-body">
        <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
            <div class="container">
                @csrf
                <div class="col mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Jane Doe" value="{{old('name')}}" >
                    <span class="text-danger">@error('name'){{$message}}@enderror</span>
                </div>

                <div class="row">
                    <div class="col-md mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{old('email')}}" >
                        <span id="emailErrMsg" class="text-danger">@error('email'){{$message}}@enderror</span>
                    </div>
                    <div class="col-md mb-3">
                        <label class="form-label">Telephone</label>
                        <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="" value="{{old('telephone')}}" >
                        <span class="text-danger">@error('telephone'){{$message}}@enderror</span>
                    </div>
                </div>

                <div class="col mb-3">
                    <label class="form-label">Gender</label>
                    <select class="form-select" id="gender" name="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <span class="text-danger">@error('gender'){{$message}}@enderror</span>
                </div>

                <div class="col mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <span class="text-danger">@error('password'){{$message}}@enderror</span>
                </div>

                <div class="col mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    <span class="text-danger">@error('password_confirmation'){{$message}}@enderror</span>
                </div>
                <hr>
                <div class="col mb-3">
                    <button type="submit" class="btn btn-success float-end">Create User </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection