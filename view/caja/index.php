<?php
require_once("../../config/conexion.php");
if (isset($_SESSION["usua_id_pdvlg"])) {
?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <?php require_once("../html/mainHead.php"); ?>
    <title>MPCH::Registro de Cobros</title>

  </head>

  <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
      <?php require_once("../html/menu.php"); ?>
      <?php require_once("../html/mainProfile.php"); ?>

      <div class="content-wrapper">
        <section class="content">
          <div class="container-fluid">
            <div class="card card-warning">
              <div class="card-header" style="background-color: #ff8200;">
                <h3 class="card-title">Registro de Cobros</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <!-- Filtros -->
                <div class="row mb-3">
                  <div class="col-md-3">
                    <label for="fechaInicio">Fecha Inicio:</label>
                    <input type="date" id="fechaInicio" class="form-control">
                  </div>
                  <div class="col-md-3">
                    <label for="fechaFin">Fecha Fin:</label>
                    <input type="date" id="fechaFin" class="form-control">
                  </div>
                  <div class="col-md-2">
                    <label for="mesa">Mesa:</label>
                    <select id="mesa" class="form-control">
                      <option value="">Todas</option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label for="tipoComprobante">Tipo de Comprobante:</label>
                    <select id="tipoComprobante" class="form-control">
                      <option value="">Todos</option>
                      <option value="1">Boleta</option>
                      <option value="2">Factura</option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label for="tipoComprobante" style="color:white">Tipo de Comprobante:</label>
                    <button class="btn btn-primary" onclick="filtrarCobros()" style="width: 100%">
                      <i class="fas fa-filter"></i> Filtrar
                    </button>

                  </div>
                </div>


                <!-- Resumen del Día -->
                <div class="mt-4">
                  <h5>Resumen del Día</h5>
                  <p id="resumenCobros"></p>
                </div>

                <!-- Tabla de Cobros con DataTable -->
                <table id="tablaCobros" class="table table-bordered table-striped mt-3">
                  <thead>
                    <tr>
                      <th>ID Cobro</th>
                      <th>Pedido ID</th>
                      <th>Total</th>
                      <th>Ingreso</th>
                      <th>Vuelto</th>
                      <th>Tipo Comprobante</th>
                      <th>Cliente</th>
                      <th>Fecha</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody id="cobrosContainer">
                    <!-- Los cobros se cargarán aquí mediante AJAX -->
                  </tbody>
                  <tfoot>
                    <tr>
                      <th colspan="2">Total</th>
                      <th id="totalMonto">0.00</th>
                      <th colspan="6"></th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </section>
      </div>

      <?php require_once("../html/footer.php"); ?>
    </div>

    <?php require_once("../html/mainjs.php"); ?>

    <script src="cobro.js"></script>
  </body>

  </html>
<?php
} else {
  header("Location: " . Conectar::ruta() . "index.php");
}
?>