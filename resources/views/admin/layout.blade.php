<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"
          rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('/adminlte/css/adminlte.min.css')}}">
    <link href="{{ asset('/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.admin.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/sweetalert2.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/sweetalert2.min.js')}}"></script>
    <title>Halaman Admin | Heli Farm</title>
    @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="lazy-backdrop" id="overlay-loading">
    <div class="d-flex flex-column justify-content-center align-items-center">
        <div class="spinner-border text-light" role="status">
        </div>
        <p class="text-light">Sedang Menyimpan Data...</p>
    </div>
</div>
<nav class="main-header navbar navbar-expand custom-navbar">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link navbar-link-item" data-widget="pushmenu" href="#" role="button">
                <i class='bx bx-menu'></i>
            </a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="{{ route('admin.logout') }}" class="nav-link navbar-link-item">Logout</a>
        </li>
    </ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary custom-sidebar">
    <div class="sidebar">
        <div class="sidebar-brand-container">
            <a href="#" class="sidebar-brand">
                <img src="{{ asset('/assets/image/logo.png') }}" alt="brand-image">
                <p class="color-dark">Heli Farm</p>
            </a>
        </div>
        <div class="sidebar-item-container">
            <ul class="nav nav-sidebar nav-pills flex-column" style="gap: 0.25rem">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                       class="nav-link d-flex align-items-center sidebar-item {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
                        <i class="bx bxs-dashboard"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.category') }}"
                       class="nav-link d-flex align-items-center sidebar-item {{ request()->is('admin/kategori*') ? 'active' : '' }}">
                        <i class='bx bx-label'></i>
                        <p>Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.product') }}"
                       class="nav-link d-flex align-items-center sidebar-item {{ request()->is('admin/product*') ? 'active' : '' }}">
                        <i class='bx bxs-component'></i>
                        <p>Product</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.order') }}"
                       class="nav-link d-flex align-items-center sidebar-item {{ request()->is('admin/pesanan*') ? 'active' : '' }}">
                        <i class='bx bx-shopping-bag'></i>
                        <p>Pesanan</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
<div class="content-wrapper p-4">
    @yield('content')
</div>


<script src="https://code.jquery.com/jquery-3.7.0.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset ('/adminlte/js/adminlte.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
@yield('js')
</body>
</html>
