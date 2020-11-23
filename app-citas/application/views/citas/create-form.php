<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Citas | UIW</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/';?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/';?>/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Animate CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  <link rel="stylesheet" href="<?php echo base_url().'assets/css';?>/spinner.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="" class="navbar-brand">
        <img src="<?php echo base_url().'assets/dist/img/UIW_logo.png';?>" alt="AdminLTE Logo" class="brand-image">
        <span class="brand-text font-weight-light">Universidad Incarnate Word Campus Bajío</span>
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="https://www.uiwbajio.mx/" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Contacto</a>
          </li>
        </ul>

      </div>

    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6 animate__animated animate__fadeIn">
            <h1 class="m-0 text-dark"> Sistema de citas para UIW<small> Campus Bajío</small></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          
          <div class="col-lg-12">
            <div class="alert alert-info alert-dismissible animate__animated animate__fadeIn">
              <h5><i class="icon fas fa-info"></i> Alert!</h5>
              Info alert preview. This alert is dismissable.
            </div>
          </div>

          <div class="col-lg-12">
            <div class="alert alert-warning alert-dismissible animate__animated animate__fadeIn">
              <h5><i class="icon fas fa-info"></i> Alert!</h5>
              Info alert preview. This alert is dismissable.
            </div>
          </div>

          <div class="col-lg-12">

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="card-title m-0">Llena el formulario para crear tu cita</h5>
              </div>
              <div class="card-body">
                <form class="form-horizontal" method="POST" id="crear-cita-form">
                  <div class="card-body">
                    <div class="form-group row">
                      <label for="solicitante" class="col-sm-12 col-form-label">Persona que visitará el campus a realizar el pago</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" minlength="10" maxlength="100" id="solicitante" name="solicitante" placeholder="Nombre de la persona" required="">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="mail" class="col-sm-12 col-form-label">Correo eléctronico para agendar su cita</label>
                      <div class="col-sm-12">
                        <input type="email" class="form-control" minlength="15" maxlength="100" id="mail" name="correo_solicitante" placeholder="Correo eléctronico" required="">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="fecha-solicitada" class="col-sm-12 col-form-label">Selecciona tu día para ver las horas disponibles (clic en el icono del calendario para seleccionar tu día)</label>
                      <div class="col-sm-12">
                        <input type="date" class="form-control" id="fecha-solicitada" name="fecha_solicitada" max="2020-12-18" placeholder="Ingresa el día" required="">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="horas-disponibles" class="col-sm-12 col-form-label">Horas disponibles para el día que selecionaste:</label>
                      <div class="col-sm-12">
                        <select class="form-control" id="horas-disponibles" name="hora_solicitada" required="">
                        </select>
                      </div>
                    </div>

                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-success">Realizar cita</button>
                    <button type="submit" class="btn btn-default float-right">Cancelar</button>
                  </div>
                  <!-- /.card-footer -->
                </form>
              </div>
              <div class="overlay">
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
              </div>              
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Sistema de citas &copy; 2014-2019 <a href="https://adminlte.io">UIW</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo base_url().'assets/';?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url().'assets/';?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url().'assets/';?>dist/js/adminlte.min.js"></script>

<!-- Plugin sweetalert-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="<?php echo base_url().'assets/';?>js/form-cita.js"></script>
</body>
</html>
