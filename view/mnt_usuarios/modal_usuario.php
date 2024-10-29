<div class="modal fade" id="modal_usuario" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Registrar/Editar Personal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formUsuario">
          <input type="hidden" id="pers_id" name="pers_id">
          <div class="row">
            <div class="col-lg-6">

              <div class="form-group">
                <label for="pers_doc">Documento</label>
                <input type="text" class="form-control" id="pers_doc" name="pers_doc" required>
              </div>

            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="pers_nombre">Nombre</label>
                <input type="text" class="form-control" id="pers_nombre" name="pers_nombre" required>
              </div>
            </div>

            <div class="col-lg-6">

              <div class="form-group">
                <label for="pers_apelpat">Apellido Paterno</label>
                <input type="text" class="form-control" id="pers_apelpat" name="pers_apelpat" required>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="pers_apelmat">Apellido Materno</label>
                <input type="text" class="form-control" id="pers_apelmat" name="pers_apelmat" required>
              </div>

            </div>

            <div class="col-lg-6">
              <div class="form-group">
                <label for="pers_foto">Foto</label>
                <input type="file" class="form-control" id="pers_foto" name="pers_foto" accept="image/*"
                  onchange="convertirImagenBase64(this)">
                <input type="hidden" id="foto_base64" name="pers_foto">
              </div>

            </div>
          </div>
          <button type="button" class="btn btn-primary" onclick="guardarUsuario()">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>