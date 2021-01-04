</head>

<body class="hold-transition layout-top-nav">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <a href="" class="navbar-brand">
          <img src="<?php echo base_url() . 'assets/dist/img/UIW_logo.png'; ?>" alt="AdminLTE Logo" class="brand-image">
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

            <div class="alert alert-dismissible animate__animated animate__fadeIn">

              <h5><i class="icon fas fa-info"></i><strong>Bienvenido</strong></h5>

              <strong>Como medida de seguridad debido a la contingencia sanitaria COVID-19 y para cuidar la salud de los alumnos, padres de familia y colaboradores de la Universidad, hemos habilitado este módulo de citas por internet en el que podrás agendar tus visitas con anticipación.</strong> 

            </div>

          </div>



          <div class="col-lg-12">

            <div class="alert alert-warning alert-dismissible animate__animated animate__fadeIn">

              <h5><i class="icon fas fa-exclamation-triangle"></i><strong>Información importante</strong></h5>
                <strong>Es muy importante respetar el horario de tu cita ya que es un tiempo que se te está asignando a ti. En caso no de cumplir, puedes volver a crear tu cita.
                Recuerda, obedece las medidas sanitarias dentro de la Universidad.</strong>
            </div>

          </div>

            <div class="col-lg-12">

              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h5 class="card-title m-0">Llena el formulario para crear tu cita</h5>
                </div>
                <?php if ( validation_errors() ) { ?>
                  <div class="alert alert-danger alert-dismissible" style="margin:15px;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> No se pudo crear tu cita</h5>
                      <?php echo validation_errors();?>
                  </div>
                <?php } ?>
                <div class="card-body">
                  <form class="form-horizontal" action="<?php echo base_url().'index.php/Cita/';?>" method="POST" id="crear-cita-form">
                    <div class="card-body">
                      <div class="form-group row">
                        <label for="solicitante" class="col-sm-12 col-form-label">Persona que visitará el campus a realizar el pago</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" minlength="15" maxlength="50" id="solicitante" name="solicitante" placeholder="Nombre de la persona" required="">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="mail" class="col-sm-12 col-form-label">Correo eléctronico para agendar su cita</label>
                        <div class="col-sm-12">
                          <input type="email" class="form-control" minlength="15" maxlength="50" id="mail" name="correo_solicitante" placeholder="Correo eléctronico" required="">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="fecha-solicitada" class="col-sm-12 col-form-label">Selecciona tu día para ver las horas disponibles (clic en el icono del calendario para seleccionar tu día)</label>
                        <div class="col-sm-12">
                          <input type="date" class="form-control" id="fecha-solicitada" name="fecha_solicitada" max="2021-12-17" placeholder="Ingresa el día" required="">
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