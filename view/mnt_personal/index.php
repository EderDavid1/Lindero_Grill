<?php
/* Llamamos al archivo de conexion.php */
require_once("../../config/conexion.php");
if (isset($_SESSION["usua_id_pdvlg"])) {
?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <?php require_once("../html/mainHead.php"); ?>
    <title>Mantenimiento de Personal</title>
  </head>

  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
      <?php require_once("../html/menu.php"); ?>
      <?php require_once("../html/mainProfile.php"); ?>
      <div class="content-wrapper">
        <section class="content">
          <div class="container-fluid">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Registro de Personal</h3>
                <button type="button" class="btn btn-primary float-right" onclick="nuevo()">Agregar Persona</button>
              </div>
              
              <div class="card-body">

                <div class="row" id="PersonaContainer"></div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <!-- Modal para agregar y editar persona -->
      <div class="modal fade" id="modal_persona" tabindex="-1" aria-labelledby="modal_personaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal_personaLabel">Agregar Persona</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="formPersona">
              <div class="modal-body">
                <input type="hidden" id="pers_id" name="pers_id">

                <div class="row">
                  <!-- Primera columna -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="pers_nombre">Nombre</label>
                      <input type="text" class="form-control" id="pers_nombre" name="pers_nombre" required>
                    </div>

                    <div class="form-group">
                      <label for="pers_apelpat">Apellido Paterno</label>
                      <input type="text" class="form-control" id="pers_apelpat" name="pers_apelpat" required>
                    </div>

                    <div class="form-group">
                      <label for="pers_apelmat">Apellido Materno</label>
                      <input type="text" class="form-control" id="pers_apelmat" name="pers_apelmat" required>
                    </div>

                    <div class="form-group">
                      <label for="pers_doc">Documento</label>
                      <input type="text" class="form-control" id="pers_doc" name="pers_doc" maxlength="9" required>
                      <small id="docHelp" class="form-text text-muted">Máximo 9 caracteres.</small>
                    </div>

                    <div class="form-group">
                      <label for="pers_est">Estado</label>
                      <select class="form-control" id="pers_est" name="pers_est">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                      </select>
                    </div>
                  </div>

                  <!-- Segunda columna -->
                  <div class="col-md-6">
                    <div class="form-group text-center">
                      <label for="pers_foto">Foto</label>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="pers_foto" name="pers_foto" accept="image/*" onchange="previewImage(event)">
                        <label class="custom-file-label" for="pers_foto">Seleccionar imagen</label>
                      </div>
                      <div class="mt-3">
                        <img id="foto_preview" src="" alt="Vista previa de la foto" class="img-fluid img-thumbnail" style="display:none; max-height:200px;">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <?php require_once("../html/footer.php"); ?>
    </div>
    <?php require_once("../html/mainjs.php"); ?>
    <script type="text/javascript" src="persona.js"></script>
  </body>

  </html>
<?php
} else {
  header("Location: " . Conectar::ruta() . "index.php");
}
?>