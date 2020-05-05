<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Agro-System</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF TOKEN-->
    <meta name="csrf-token" content="{{csrf_token()}}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url(asset('front/assets/plugins/fontawesome-free/css/all.min.css'))}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{url(asset('front/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css'))}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url(asset('front/assets/dist/css/adminlte.css'))}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="javascript:void(0)">Sua<b>Empresa</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <div id="messageAlert"></div>
            <form action="{{route('source.source.login')}}" id="formLogin" method="post">
                <p class="login-box-msg">Digite usuario e senha para acessar o sistema</p>
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="user" id="user" class="form-control" placeholder="Usuario">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Acessar</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{url(asset('front/assets/plugins/jquery/jquery.min.js'))}}"></script>
<!-- Bootstrap 4 -->
<script src="{{url(asset('front/assets/plugins/bootstrap/js/bootstrap.bundle.min.js'))}}"></script>
<!-- AdminLTE App -->
<script src="{{url(asset('front/assets/dist/js/adminlte.min.js'))}}"></script>

<script type="module">
    import {Login} from './front/assets/scripts/Login.js';
   const login = new Login();

   login.logar();


</script>
</body>
</html>

