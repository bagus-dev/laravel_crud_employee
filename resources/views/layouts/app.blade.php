<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name') }} - Dashboard</title>

    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">

    <link rel="stylesheet" href="{{ asset('assets/css/sb-admin-2.min.css') }}">

    <style>
        .form-control:focus {
            color: #6e707e;
            background-color: #fff;
            border-color: #375dce;
            outline: 0;
            box-shadow: none
        }
        .form-group label {
            font-weight: bold
        }
        #wrapper #content-wrapper {
            background-color: #e2e8f0;
            width: 100%;
            overflow-x: hidden;
        }
        .card-header {
            padding: .75rem 1.25rem;
            margin-bottom: 0;
            background-color: #4e73de;
            border-bottom: 1px solid #e3e6f0;
            color: white;
        }
    </style>

    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>  

    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
</head>
<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a href="#" class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon">
                    <i class="fa fa-tachometer-alt"></i>
                </div>
                <div class="sidebar-brand-text mx-3">DASHBOARD</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item {{ Request::is('dashboard/employee*') ? ' active' : '' }}">
                <a href="{{ route('dashboard.employee.index') }}" class="nav-link">
                    <i class="fas fa-users"></i>
                    <span>EMPLOYEES</span>
                </a>
            </li>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    
                </nav>

                @yield('content')
            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Hak Cipta Dilindungi &copy; 2023 Bagus Puji Rahardjo</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <a href="#page-top" class="scroll-to-top rounded">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

    <script>
    //sweetalert for success or error message
        @if(session()->has('success'))
            Swal.fire({
                type: "success",
                icon: "success",
                title: "SUCCESS!",
                text: "{{ session('success') }}",
                timer: 1500,
                showConfirmButton: false,
                showCancelButton: false,
                buttons: false,
            });
        @elseif(session()->has('error'))
            Swal.fire({
                type: "error",
                icon: "error",
                title: "FAILED!",
                text: "{{ session('error') }}",
                timer: 1500,
                showConfirmButton: false,
                showCancelButton: false,
                buttons: false,
            });
        @endif
  </script>
</body>
</html>