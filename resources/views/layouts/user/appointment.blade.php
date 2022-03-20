<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{asset('assets/images/diagnostic.png')}}">
    <title>Appointments || Lab Diagnostics</title>

    <!--Bootstap -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css');}}">
    <link rel="stylesheet" href="{{asset('bootstrap/bootstrap-icons/bootstrap-icons.css');}}">

    <!--Font Awesome -->
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css');}}">
    <script src="{{asset('fontawesome/js/all.min.js');}}"></script>


    <link rel="stylesheet" href="{{URL::asset('assets/css/main.css');}}">


</head>
<body>
    <header id="header" class="navbar sticky-top navbar-light shadow">
        <div class="container-fluid">
            <a href="#" class="sidebar-brand col-md-3 col-lg-2 me-0 px-3">
                <h4>Lab Diagnostics</h4>
            </a>
            <button class="navbar-toggler float-end d-md-none collapsed me-3" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <ul class="nav align-content-between">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fs-6 text-white" href="#" id="user_dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      {{Auth::user()->name}}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="#user_dropdown">
                      <li><a class="dropdown-item" href="#">Profile</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="/sign-out">Sign-out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="sidebar-nav flex-column">
                        <li class="sidebar-item">
                            <a class="page" href="{{route('dashboard.index')}}">
                                <i class="bi bi-grid-fill me-2"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item active">
                            <a href="#" role="button" class="btn-toggle align-items-center rounded collapsed"
                            data-bs-toggle="collapse" data-bs-target="#appointment-collapse" aria-expanded="false">
                            <i class="fas fa-clipboard-list me-2"></i>Appointment<i class="bi bi-chevron-down float-end ms-auto"></i>
                            </a>

                            <div class="collapse" id="appointment-collapse">
                                <ul class="btn-toggle-nav list-unstyled">
                                    <li class="sub-sidebar-item active">
                                        <a href="{{route('appointment.index')}}">
                                            <i class="far fa-calendar-check me-3"></i><span>Appointment List</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('appointment-history.index')}}">
                                            <i class="fas fa-history me-3"></i><span>Appointment History</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        @can('test-create')
                        <li class="sidebar-item">
                            <a class="page" href="{{route('lab-test.index')}}">
                                <i class="fas fa-microscope me-2"></i>
                                <span>Lab Test</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </nav>

          <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h4>Appointment</h4>
                <a href="#" role="button" class="btn btn-outline-primary" data-bs-target="#NewAppointment" data-bs-toggle="modal">Create an Appointment</a>
            </div>
            @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show mb-3 m-auto" role="alert">
                {{Session::get('success')}}
                <button id="close" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if (Session::get('fail'))
            <div class="alert alert-danger alert-dismissible fade show mb-3 m-auto" role="alert">
                {{Session::get('fail')}}
                <button id="close" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @yield('content')
          </main>
        </div>
    </div>

    <div class="modal fade" id="NewAppointment" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{route('appointment.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="assignment_title">Schedule Appointment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body p-3">
                        <div class="container">
                            @can('test-create')
                            <div class="col-md mb-3">
                                <label class="form-label">Client</label>
                                <input type="text" class="form-control" list="datalistOptions" id="user_id" name="user_id" required>
                                <datalist id="datalistOptions">
                                    @if (count($users) != 0)
                                        @foreach ($users as $user)
                                        <option value="{{$user->email}}">{{$user->name}} || {{$user->email}}</option>
                                        @endforeach
                                    @endif
                                </datalist>
                                <span style="color:red">@error('user_id'){{$message}}@enderror</span>
                            </div>
                            @endcan


                            <div class="col mb-3">
                                <label class="form-label">Schedule</label>
                                <input type="date" class="form-control" id="schedule" name="schedule" required>
                                <span style="color:red">@error('schedule'){{$message}}@enderror</span>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-block btn-danger" onclick="ClearInputs()" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-block btn-success">Confirm Appointment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @yield('scripts')
</body>
</html>
