<?php
/* Llamamos al archivo de conexion.php */
require_once("../../config/conexion.php");
if (isset($_SESSION["usua_id_sidc"])) {
  ?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <?php require_once("../html/mainHead.php"); ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>MPCH::Calendario de actividades</title>

  </head>

  <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
      <?php require_once("../html/menu.php"); ?>
      <?php require_once("../html/mainProfile.php"); ?>

      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content" style="margin-top:10px">
          <div class="container-fluid">
            <!-- Calendar Card -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Calendario</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>

      <?php require_once("../html/footer.php"); ?>
      <?php require_once("modal_form.php"); ?>

      <?php require_once("../html/mainjs.php"); ?>


      <script type="text/javascript" src="calendar_controller.js"></script>

    </div>
  </body>

  </html>
  <?php
} else {
  header("Location: " . Conectar::ruta() . "index.php");
}
?>