<?php
/* Llamamos al archivo de conexion.php */
require_once("../../config/conexion.php");
if (isset($_SESSION["usua_id_sidc"])) {
  ?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <?php require_once("../html/mainHead.php"); ?>

    <title>MPCH::Bandeja Solicitudes</title>
  </head>

  <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
      <?php require_once("../html/menu.php"); ?>
      <?php require_once("../html/mainProfile.php"); ?>

      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <!-- Data Table -->
            <div class="card">

              <div class="card-header">
                <h3 class="card-title">Aprobacion de solicitudes </h3>
                <!-- Button to Open Modal -->
                <button type="button" class="btn btn-primary float-right" onclick="nuevo()">
                  <i class="fa fa-plus"></i> Agregar Solicitud
                </button>
              </div>
              <div class="card-body">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" id="search" name="de_raz_soc_otr" placeholder="Buscar..."
                    style="text-transform: uppercase;" />
                  <div class="input-group-append">
                    <button class="btn btn-primary" id="btnBuscar" type="button">
                      <i class="fa fa-search"></i>
                    </button>
                  </div>
                </div>
                <div class="btn-group w-100 mb-2">
                  <a class="btn btn-info" href="javascript:void(0)" data-filter="all"> Todos </a>
                  <a class="btn btn-info" href="javascript:void(0)" data-filter="1"> Pendientes </a>
                  <a class="btn btn-info" href="javascript:void(0)" data-filter="2"> Completadas </a>
                  <a class="btn btn-info" href="javascript:void(0)" data-filter="3"> Aceptadas </a>
                  <a class="btn btn-info" href="javascript:void(0)" data-filter="4"> Improcedentes </a>
                </div>
                <div style="    overflow-x: scroll;">
                  <table id="SolicitudTable" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>RUC</th>
                        <th>Razón Social</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Aquí se cargarán los datos de la base de datos dinámicamente -->
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
          </div>
        </section>
        <!-- /.content -->
      </div>

      <?php require_once("../html/footer.php"); ?>
      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
    </div>
    <?php require_once("modal_form.php"); ?>
    <?php require_once("../html/mainjs.php"); ?>
    <script type="text/javascript" src="solicitud_controller.js"></script>
    <script>
      function nuevo() {
        $("#aprobarSolicitudModal").modal("show");
      }
    
      document.addEventListener('DOMContentLoaded', function () {
        window.stepper = new Stepper(document.querySelector('.bs-stepper'))
      })
    </script>
    <script>
      $(document).ready(function () {
        // Apply iCheck to checkboxes and radio buttons
        $('input.icheck-primary').iCheck({
          checkboxClass: 'icheckbox_flat-primary',
          radioClass: 'iradio_flat-primary'
        });
      });
    </script>

  </body>

  </html>
  <?php
} else {
  header("Location: " . Conectar::ruta() . "index.php");
}
?>