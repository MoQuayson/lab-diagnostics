@extends('layouts.admin.users')
@section('title')
    Show User
@endsection

@section('content')
<div class="card mb-1 shadow">
    <div class="card-header">
        <h4>User Information</h4>
    </div>

    <div class="card-body">
        <div class="container">
            <div class="col mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Jane Doe" value="{{$user->name}}" readonly>
            </div>

            <div class="row">
                <div class="col-md mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{$user->email}}" readonly>

                </div>
                <div class="col-md mb-3">
                    <label class="form-label">Telephone</label>
                    <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="" value="{{$user->telephone}}" readonly>

                </div>
            </div>

            <div class="col mb-3">
                <label class="form-label">Gender</label>
                <input type="tel" class="form-control" id="gender" name="gender" value="{{$user->gender}}" readonly>
            </div>
        </div>
    </div>
</div>
@endsection
