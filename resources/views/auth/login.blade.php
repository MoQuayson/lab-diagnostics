<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{asset('assets/images/diagnostic.png')}}">
    <title>Login || Lab Diagnostics</title>

    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>

    <style>
        body {
            background-color: rgba(5, 87, 158, 0.9);;
        }
            main {
                margin: auto;
                margin-top: 3%;
                min-width: 400px;
                max-width: 600px;
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
                        {{Session::get('info')}}
                        <button id="close" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
        @endif
            <div class="card shadow">
                <div class="card-header py-3">
                    <div class="flex-fill text-center">
                        <h4 class="fw-semiBold">Lab Diagnostics</h4>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{route('login.store')}}" method="POST" enctype="multipart/form-data">
                        <div class="container">
                            <h4 class="text-center mb-5">Login to proceed</h4>
                            @csrf
                            <div class="col mb-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{old('email')}}">
                                    <label for="admin_id">Email</label>
                                </div>
                                <span id="emailErrMsg" class="text-danger">@error('email'){{$message}}@enderror</span>
                            </div>

                            <div class="col mb-4">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" >
                                    <label for="password">Password</label>
                                </div>
                                <span id="passwordErrMsg" class="text-danger">@error('password'){{$message}}@enderror</span>
                            </div>

                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="remember me" id="remember_me" name="remember_me">
                                        <label class="form-check-label">
                                          Remember me
                                        </label>
                                      </div>
                                </div>

                                <div class="col">
                                    <a href="#" class=" float-end">Forgot Password?</a>
                                </div>
                            </div>

                            <div class="col mb-4">
                                <button type="submit" class="btn btn-success btn-lg w-100">Authenticate</button>
                            </div>

                            <div class="col mb-4">
                                <h5 class="text-center">New User? Click <a href="{{route('register.index');}}">Register</a>.</h5>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </main>
</body>
</html>
