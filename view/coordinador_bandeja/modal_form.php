<div class="modal fade" id="inspeccionModal" tabindex="-1" role="dialog" aria-labelledby="inspeccionModallabel"
  aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="inspeccionModallabel">Asignar Inspectores</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- Primera columna: Información de la solicitud y documentos -->
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-user"></i> Información de la Solicitud
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>

              <!-- Contenido del formulario -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <!-- Información del DNI -->
                    <div class="form-group">
                      <label>DNI:</label>
                      <p id="dni">12345678</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <!-- Información del Nombre -->
                    <div class="form-group">
                      <label>Nombre Solicitante:</label>
                      <p id="nombre">Juan Pérez</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <!-- Información del Tipo de Solicitante -->
                    <div class="form-group">
                      <label>Tipo de Solicitante:</label>
                      <p id="tipoSolicitante">Propietario</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <!-- Información del RUC -->
                    <div class="form-group">
                      <label>RUC:</label>
                      <p id="ruc">20123456789</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <!-- Información de la Razón Social -->
                    <div class="form-group">
                      <label>Razón Social Solicitante:</label>
                      <p id="razonSocial">Empresa XYZ S.A.C.</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <!-- Información del Nivel de Riesgo -->
                    <div class="form-group">
                      <label>Nivel de Riesgo:</label>
                      <div class="row">
                        <!-- Card para Nivel de Riesgo de Incendio -->
                        <div class="col-md-6">
                          <div class="info-box mb-3 bg-danger" style="min-height: 50px;">
                            <span class="info-box-icon" style="width: 20px;"><i class="fas fa-fire"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-text">Incendio</span>
                              <span class="info-box-number" id="riesgo_incendio"></span>
                            </div>
                          </div>
                        </div>
                        <!-- Card para Nivel de Riesgo de Colapso -->
                        <div class="col-md-6">
                          <div class="info-box mb-3 bg-info" style="min-height: 50px;">
                            <span class="info-box-icon" style="width: 20px;"><i class="fas fa-house-damage"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-text">Colapso</span>
                              <span class="info-box-number" id="riesgo_colapso"></span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>



            <h6>Documentos Adjuntos</h6>
            <div class="col-md-12">
              <div class="card card-success collapsed-card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-file-alt"></i> Vista de Documento
                  </h3>

                  <div class="card-tools">

                    <button type="button" class="btn btn-tool" data-card-widget="maximize">
                      <i class="fas fa-expand"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-plus"></i>
                    </button>

                  </div>
                </div>
                <div class="card-body">
                  <!-- PDF embebido o enlace aquí -->
                  <embed src="ruta_al_pdf.pdf" type="application/pdf" width="100%" height="400px" />
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="card card-warning collapsed-card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-paperclip"></i> Vista de Anexos
                  </h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="maximize">
                      <i class="fas fa-expand"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-plus"></i>
                    </button>

                  </div>
                </div>
                <div class="card-body">
                  <!-- PDF embebido o enlace aquí -->
                  <embed src="ruta_al_pdf.pdf" type="application/pdf" width="100%" height="400px" />
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="card card-danger collapsed-card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-file-alt"></i> Vista de Licencia de Funcionamiento
                  </h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="maximize">
                      <i class="fas fa-expand"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-plus"></i>
                    </button>

                  </div>
                </div>
                <div class="card-body">
                  <!-- PDF embebido o enlace aquí -->
                  <embed src="ruta_al_pdf.pdf" type="application/pdf" width="100%" height="400px" />
                </div>
              </div>
            </div>
          </div>

          <!-- Segunda columna: Agregar inspectores y fecha/hora de inspección -->
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-6">
                <label for="fechaInspeccion">Fecha de Inspección</label>
                <input type="date" class="form-control" id="fechaInspeccion">
              </div>
              <div class="col-md-6">
                <label for="horaInspeccion">Hora de Inspección</label>
                <input type="time" class="form-control" id="horaInspeccion">
              </div>
              <div class="col-md-12" style="margin-top: 10px;">
                <div class="card card-danger">
                  <div class="card-header">
                    <h3 class="card-title">
                      <i class="fas fa-file-alt"></i> Agregar Inspectores
                    </h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="maximize">
                        <i class="fas fa-expand"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>

                    </div>
                  </div>
                  <div class="card-body">
                    <label for="nombreInspector">Nombre del Inspector</label>
                    <div class="row">
                      <div class="col-md-10">
                        <select class="form-control select2" id="nombreInspector" style="width: 100%;">
                          <option value="" disabled selected>Seleccione un inspector</option>
                          <option value="1">Inspector 1</option>
                          <option value="2">Inspector 2</option>
                          <option value="3">Inspector 3</option>
                          <!-- Más opciones -->
                        </select>
                      </div>
                      <div class="col-md-2">
                        <button type="button" class="btn btn-primary mb-2" id="addInspector">Agregar</button>
                      </div>
                    </div>
                    <!-- Tabla de inspectores -->
                    <table class="table table-bordered" id="inspectoresTable">
                      <thead>
                        <tr>
                          <th>Inspector</th>
                          <th>Rol</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- Fila de ejemplo -->

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- modal-body -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->