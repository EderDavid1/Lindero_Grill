<?php
/* Llamamos al archivo de conexion.php */
require_once("../../config/conexion.php");
if (isset($_SESSION["usua_id_pdvlg"])) {
  ?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <?php require_once("../html/mainHead.php"); ?>
    <title>Gestión de Personal</title>
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
                <h3 class="card-title">Gestión de Usuarios</h3>
                <!-- Button to Open Modal -->
                <button type="button" class="btn btn-primary float-right" onclick="nuevoUsuario()">
                  <i class="fa fa-plus"></i> Agregar Usuario
                </button>
              </div>
              <div class="card-body">
                <table id="usuarioTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Apellido Paterno</th>
                      <th>Apellido Materno</th>
                      <th>Documento</th>
                      <th>Foto</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>

            <!-- Vista en Tarjetas -->
            <div class="row" id="UsuarioContainer">
              <!-- Aquí se insertarán las tarjetas de los usuarios desde el JS -->
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

    <!-- Modal para crear/editar usuario -->
    <?php require_once("modal_usuario.php"); ?>
    <?php require_once("../html/mainjs.php"); ?>
    <script type="text/javascript" src="usuarios.js"></script>
    <script>
      function nuevoUsuario() {
        // Resetea el formulario y abre el modal
        $("#formUsuario")[0].reset();
        $("#pers_id").val("");
        $("#modal_usuario").modal("show");
      }

      document.addEventListener('DOMContentLoaded', function () {
        // Inicializar las funciones cuando cargue la página
        listarUsuarios();
      });
    </script>
  </body>

  </html>
  <?php
} else {
  header("Location: " . Conectar::ruta() . "index.php");
}
?>
