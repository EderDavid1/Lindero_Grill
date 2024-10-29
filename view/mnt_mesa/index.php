<?php
/* Llamamos al archivo de conexion.php */
require_once("../../config/conexion.php");
if (isset($_SESSION["usua_id_pdvlg"])) {
  ?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <?php require_once("../html/mainHead.php"); ?>

    <title>MPCH::Mantenimiento de Mesas</title>
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
                <h3 class="card-title">Registro de Mesas</h3>
                <!-- Button to Open Modal -->
                <button type="button" class="btn btn-primary float-right" onclick="nuevo()">
                  <i class="fa fa-plus"></i> Agregar Mesa
                </button>
              </div>
              <div class="card-body">
               

              </div>

            </div>
            <div class="row" id="MesaContainer">
                  <!-- Aquí se insertarán las tarjetas de las mesas desde el JS -->
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
    <?php require_once("modal_mesa.php"); ?>
    <?php require_once("../html/mainjs.php"); ?>
    <script type="text/javascript" src="mesa.js"></script>
    <script>
      function nuevo() {
        // Resetea el formulario y abre el modal
        $("#formMesa")[0].reset();
        $("#mesa_id").val("");
        $("#modal_mesa").modal("show");
      }

      document.addEventListener('DOMContentLoaded', function () {
        // Inicializar las funciones cuando cargue la página
        listarMesas();
      });
    </script>
  </body>

  </html>
  <?php
} else {
  header("Location: " . Conectar::ruta() . "index.php");
}
?>