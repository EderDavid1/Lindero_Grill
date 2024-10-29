<!-- Modal para Aprobar Solicitud -->
<div class="modal fade" id="aprobarSolicitudModal" tabindex="-1" role="dialog"
  aria-labelledby="aprobarSolicitudModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="aprobarSolicitudModalLabel">Aprobar Solicitud</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">


          <!-- Tabla con información adicional -->
          <div class="col-md-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-table"></i> Detalles de la Solicitud
                </h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>RUC</th>
                      <th>Razón Social</th>
                      <th>Nombre Comercial</th>
                      <th>Representante</th>
                      <th>Tipo</th>
                      <th>Nivel de Riesgo</th>
                      <th>Fecha de Creación</th>
                      <th>Giro</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td id="rucDetalle">20123456789</td>
                      <td id="razonSocialDetalle">Empresa XYZ S.A.C.</td>
                      <td id="nombreComercialDetalle">XYZ</td>
                      <td id="representanteDetalle">Juan Pérez</td>
                      <td id="tipoDetalle">Comercial</td>
                      <td id="nivelRiesgoDetalle">Alto</td>
                      <td id="fechaCreacionDetalle">2024-09-16</td>
                      <td id="giroDetalle">Retail</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="direccionInspeccion">Dirección de la Inspección:</label>
              <input type="text" id="direccionInspeccion" name="direccionInspeccion" class="form-control"
                placeholder="Ingrese la dirección de la inspección">
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="capacidadMaxima">Capacidad Máxima EDIF.:</label>
                  <input type="number" id="capacidadMaxima" name="capacidadMaxima" class="form-control"
                    placeholder="Ingrese la capacidad máxima">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="areaEDIF">Área EDIF.:</label>
                  <input type="text" id="areaEDIF" name="areaEDIF" class="form-control"
                    placeholder="Ingrese el área del edificio">
                </div>
              </div>
            </div>

          </div>

          <!-- Opciones de Proceso y Confirmación -->
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fechaRenovacion">Fecha de Renovación:</label>
                  <input type="date" id="fechaRenovacion" name="fechaRenovacion" class="form-control"
                    value="<?php echo date('Y-m-d'); ?>">
                </div>
              </div>
              <div class="col-md-6">
              <div class="form-group">
                  <label for="num_informe">INFORME VCCS Nº:</label>
                  <input type="text" id="num_informe" name="num_informe" class="form-control"
                    placeholder="Nº informe">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label>Tipo de Proceso:</label><br>
              <!-- Radio buttons with iCheck -->
              <div class="icheck-primary d-inline">
                <input type="radio" id="ordinario" name="tipoProceso" value="Ordinario">
                <label for="ordinario">Ordinario</label>
              </div>
              <div class="icheck-primary d-inline">
                <input type="radio" id="reconsiderar" name="tipoProceso" value="Reconsiderar">
                <label for="reconsiderar">Reconsiderar</label>
              </div>
              <div class="icheck-primary d-inline">
                <input type="radio" id="apelacion" name="tipoProceso" value="Apelación">
                <label for="apelacion">Apelación</label>
              </div>
            </div>
            <div class="form-group" style="text-align: right;">
              <!-- Switch with Bootstrap Switch -->
              <label for="cumpleCondiciones">Cumple las Condiciones:</label>
              <input type="checkbox" id="cumpleCondiciones" name="cumpleCondiciones" checked data-bootstrap-switch
                data-off-color="danger" data-on-color="success" data-off-text="No" data-on-text="Sí">
            </div>
          </div>


        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="guardarSolicitud">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Script para SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.getElementById('guardarSolicitud').addEventListener('click', function () {
    Swal.fire({
      title: 'Confirmar',
      text: '¿Está seguro de que desea guardar los cambios?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sí, guardar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        // Aquí puedes agregar la lógica para guardar la solicitud
        Swal.fire(
          'Guardado!',
          'La solicitud ha sido guardada.',
          'success'
        )
      }
    })
  });

</script>