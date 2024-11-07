<!-- Modal para agregar nueva persona -->
<div class="modal fade" id="modalAgregarPersona" tabindex="-1" role="dialog" aria-labelledby="modalAgregarPersonaLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAgregarPersonaLabel">Agregar Nueva Persona</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formAgregarPersona">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="dniInput">DNI:</label>
                <input type="text" class="form-control" id="dniInput" placeholder="Ingrese número de DNI">
              </div>
            </div>
            <div class="col-md-6">
              <div id="personData" style="display: none;">
                <div class="form-group">
                  <label for="nombreCompleto">Nombre Completo:</label>
                  <input type="text" class="form-control" id="nombreCompleto" readonly>
                </div>

              </div>
            </div>
            <div class="col-md-12" style="display: flex; justify-content: space-around;">
              <div class="form-group">
                <img id="fotoPersona" src="" alt="Foto de la persona" class="img-fluid">
              </div>
            </div>
          </div>


        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btnGuardarPersona" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>