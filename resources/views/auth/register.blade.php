<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{asset('assets/images/diagnostic.png')}}">
    <title>Register || Lab Diagnostics</title>

    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>

    <style>
    body {
        background-color: rgba(5, 87, 158, 0.9);
        padding: 5px;
    }
        main {
            margin: auto;
            margin-top: 3%;
            min-width: 400px;
            max-width: 700px;
        }
    </style>
</head>
<body>
    <main>
        @if (Session::get('fail'))
                    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                        {{Session::get('fail')}}
                        <button id="close" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
        @endif

        @if (Session::get('info'))
                    <div class="alert alert-info alert-dismissible fade show mb-3" role="alert">
                        {{Session::get('expire')}}
                        <button id="close" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
        @endif
        <div class="card shadow">
            <div class="card-header py-3">
                <div class="flex-fill text-center">
                    <h4>Lab Diagnostics</h4>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('register.store')}}" method="POST" enctype="multipart/form-data">

                    <div class="container">
                        <h4 class="text-center mb-4">Create New Account</h4>
                        @csrf
                        <div class="col mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Jane Doe" value="{{old('name')}}" >
                            <span class="text-danger">@error('name'){{$message}}@enderror</span>
                        </div>

                        <div class="row">
                            <div class="col-md mb-4">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{old('email')}}" >
                                <span id="emailErrMsg" class="text-danger">@error('email'){{$message}}@enderror</span>
                            </div>
                            <div class="col-md mb-4">
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

                        <div class="col mb-4">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            <span class="text-danger">@error('password_confirmation'){{$message}}@enderror</span>
                        </div>

                        <div class="col mb-3">
                            <button type="submit" class="btn btn-success btn-lg w-100">Register </button>
                        </div>

                        <div class="col mb-1">
                            <h5 class="text-center">Already a  User? Click <a href="{{route('login.index')}}">Sign In</a></h5>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/js/admin-login.js')}}"></script>
</body>
</html>
