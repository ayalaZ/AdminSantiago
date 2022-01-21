<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administracion</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <style>
        body {
            font-family: "Lato", sans-serif;
        }



        .main-head {
            height: 150px;
            background: #FFF;

        }

        .sidenav {
            height: 100%;
            background-color: #000;
            overflow-x: hidden;
            padding-top: 20px;
            border-right: 5px solid red;
        }


        .main {
            padding: 0px 10px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }
        }

        @media screen and (max-width: 450px) {
            .login-form {
                margin-top: 10%;
            }

            .register-form {
                margin-top: 10%;
            }
        }

        @media screen and (min-width: 768px) {
            .main {
                margin-left: 40%;
            }

            .sidenav {
                width: 40%;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
            }

            .login-form {
                margin-top: 80%;
            }

            .register-form {
                margin-top: 20%;
            }
        }


        .login-main-text {
            margin-top: 20%;
            padding: 60px;
            color: #fff;
        }

        .login-main-text h2 {
            font-weight: 300;
        }

        .btn-black {
            background-color: #000 !important;
            color: #fff;
        }

        .form-control:focus {
            outline: none !important;
            border-color: none;
            box-shadow: 0 0 5px none;
        }
        #logo{
            width: 80px!important;
            height: 80px!important;
        }
    </style>
</head>

<body>
    <div class="sidenav">
        <div class="login-main-text" style="text-align: center!important;">
            <h2>Administracion</h2>
            <p>Inicia sesion para tener acceso.</p>
            <img src="{{ asset('img/logo.png')}}" alt="CABLE SAT" id="logo"><br><br>
            <p>Sucursal Santiago de Maria</p>
        </div>
    </div>
    <div class="main">
        <div class="col-md-6 col-sm-12">
            <div class="login-form">
                <form method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Usuario</label>
                        <input type="text" class="form-control" placeholder="Usuario" name="name" autocomplete="off" value="{{ old('name')}}" autofocus required>
                        <span style="color: red;">@error('name'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label>Clave</label>
                        <input type="password" class="form-control" placeholder="Clave" name="password" autocomplete="off" required>
                        <span style="color: red;">@error('password'){{ $message }}@enderror</span>
                    </div>
                    <button type="submit" class="btn btn-black">Ingresar</button>
                </form>
                @if (session('status'))
                    <br>
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>

</html>
