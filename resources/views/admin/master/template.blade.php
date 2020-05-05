<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Agro-System</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url(asset('front/assets/plugins/fontawesome-free/css/all.min.css'))}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@hasSection('css')
    @yield('css')
@endif
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{url(asset('front/assets/dist/css/adminlte.css'))}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
      @include('admin.includes.menuSuperior')
    <!-- /.navbar -->

    <!-- begin main menu -->
    @include('admin.includes.menu')
    <!-- End main menu -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->

            @yield('content')

            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('admin.includes.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{url(asset('front/assets/plugins/jquery/jquery.min.js'))}}"></script>
<!-- Bootstrap 4 -->
<script src="{{url(asset('front/assets/plugins/bootstrap/js/bootstrap.bundle.min.js'))}}"></script>
<!-- AdminLTE App -->
<script src="{{url(asset('front/assets/dist/js/adminlte.min.js'))}}"></script>

@hasSection('javascript')
    @yield('javascript')
@endif
</body>
</html>
