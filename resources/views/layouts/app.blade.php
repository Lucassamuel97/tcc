<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="{{url('assets/img/favicon.png')}}">

    <title>Manutenções Preventivas</title>

    <!-- Custom fonts for this template-->
    <link href="{{url('assets/vendor/font-awesome/5.14.0/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{url('assets/css/style.css')}}" rel="stylesheet">

</head>
<body id="page-top">
    <div id="wrapper">
        <!-- MENU -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-tractor"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Manutenções Preventivas</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i> <span>Home</span>
                </a>
            </li>
            @auth
            <?php if (Auth::user()->is_admin): ?>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('users')}}"><i class="fas fa-users"></i>
                        <span>Usuários</span>
                    </a>
                </li>
            <?php endif ?>
            @endauth
            <li class="nav-item">
                <a class="nav-link" href="{{url('machines')}}"><i class="fas fa-tractor"></i> <span>Maquinários</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{url('selectMachine')}}"><i class="fa fa-cogs" aria-hidden="true"></i> <span>Manutenções</span> </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{url('updateHodometro')}}"><i class="far fa-clock"></i> <span>Lançar Hodômetro</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-file-alt"></i>
                     <span>Relatórios</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{url('report/maintenances')}}">Manutenções</a>
                        <a class="collapse-item" href="{{url('report/maintenances/expenses')}}">Gastos com manutenções</a>
                    </div>
                </div>
            </li>
           
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                <div class="topbar-divider d-none d-sm-block"></div>
                @auth
                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                    <img class="img-profile rounded-circle"
                    src="{{url('assets/img/undraw_profile.svg')}}">
                </a>
                @endauth
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- End of Topbar -->

    <div class="container-fluid">
    	@if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        @yield('content')
    </div>

</div>

<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Samuca 2021</span>
        </div>
    </div>
</footer>

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>


<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Deseja sair?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Selecione "Logout" abaixo se você estiver pronto para encerrar sua sessão atual.</div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Sair</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</div>
</div>

<script src="{{url('assets/vendor/jquery/jquery.min.js')}}"> </script>
<script src="{{url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"> </script>
<script src="{{url('assets/vendor/jquery-easing/jquery.easing.min.js')}}"> </script>
<script src="{{url('assets/js/sb-admin-2.js')}}"> </script>
<script src="{{url('assets/js/javascript.js')}}"></script>
<script src="{{url('assets/js/app.js')}}"></script>

</body>
</html>
