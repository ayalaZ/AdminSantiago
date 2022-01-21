<?php
use Illuminate\Support\Facades\Auth;
$user = Auth::user();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <style>
        html {
  min-height: 100%;
  position: relative;
}
body {
  margin: 0;
  margin-bottom: 40px;
}
        footer {
            background-color:white;
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 40px;
            color: black;
            text-align: center;
        }

    </style>

    <title>Admininistracion</title>
</head>

<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0" id="barraNavegacion">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ route('home') }}">Administracion</a>
        <ul class="navbar-nav" style="padding-right: 25px">
            <li class="nav-item text-nowrap">
                <form action="/logout" method="POST" style="display: inline;">
                    @csrf
                    <a class="nav-link" href="#" onclick="this.closest('form').submit()"><i
                            class="fas fa-power-off"></i></a>
                </form>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        @if (session('status'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">
                                    {{ session('status') }}{{ $user->name }}
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">
                                <i class="fas fa-home"></i>
                                Inicio <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        @php
                            $tipouser = $user->tipouser;
                        @endphp
                        @if ($tipouser == 1 || $tipouser === 2)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('unidades') }}">
                                    <i class="fas fa-truck"></i>
                                    Unidades
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('tecnicos') }}">
                                    <i class="fas fa-wrench"></i>
                                    Tecnicos
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('programacion') }}">
                                <i class="fas fa-calendar-alt"></i>
                                Cronograma
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('ordenes') }}">
                                <i class="fas fa-file-alt"></i>
                                Ordenes
                            </a>
                        </li>
                        @if ($tipouser == 1 || $tipouser == 2)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('nodos') }}">
                                    <i class="fas fa-project-diagram"></i>
                                    Nodos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('historial') }}">
                                    <i class="fas fa-history"></i>
                                    Historial
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cobros') }}">
                                <i class="fas fa-handshake"></i>
                                Cobros
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <ul class="nav flex-column mb-2">
                        @if ($tipouser == 1)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('usuarios') }}">
                                    <i class="fas fa-users"></i>
                                    Usuarios
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reportes') }}">
                                <i class="fas fa-file-pdf"></i>
                                Reportes
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    @yield('contenidoprincipal')
    <footer>
        <div class="row">
            <p class="text-muted small">Copyright &copy; 2021 Zenón Ayala. All rights reserved.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            //agregar datatable a la tabla empleados y pasandola a español
            $('#tabla').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                }
            });
            $('#fechayencargado').select2();
            $('#municipio').select2();
            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>
</body>

</html>
