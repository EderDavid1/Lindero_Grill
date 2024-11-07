<div class="modal fade" id="solicitudModal" tabindex="-1" role="dialog" aria-labelledby="solicitudModallabel"
  aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="solicitudModallabel">REGISTRAR NUEVA SOLICITUD</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="bs-stepper">
          <div class="bs-stepper-header" role="tablist" style="display: block;">
            <div class="row">
              <style>
                .line{
                  min-height: 2px;
                  background-color: rgb(7 7 7 / 42%);
                }
              </style>
              <div class="col-md-3">
                <div class="step" data-target="#solicitud-part">
                  <button type="button" class="step-trigger" role="tab" aria-controls="solicitud-part"
                    id="solicitud-part-trigger">
                    <span class="bs-stepper-circle">1</span>
                    <span class="bs-stepper-label">Datos de la Solicitud</span>
                  </button>
                </div>
              </div>
              <div class="col-md-1" style="display: flex;">
                <div class="line"></div>
              </div>
              <div class="col-md-3">
                <div class="step" data-target="#tipo-itse-part">
                  <button type="button" class="step-trigger" role="tab" aria-controls="tipo-itse-part"
                    id="tipo-itse-part-trigger">
                    <span class="bs-stepper-circle">2</span>
                    <span class="bs-stepper-label">Tipo de ITSE y Función</span>
                  </button>
                </div>
              </div>
              <div class="col-md-1" style="display: flex;">
                <div class="line"></div>
              </div>
              <div class="col-md-3">
                <div class="step" data-target="#confirmacion-part">
                  <button type="button" class="step-trigger" role="tab" aria-controls="confirmacion-part"
                    id="confirmacion-part-trigger">
                    <span class="bs-stepper-circle">3</span>
                    <span class="bs-stepper-label">Confirmación</span>
                  </button>
                </div>
              </div>

            </div>
            <!-- Pasos -->





          </div>
          <div class="bs-stepper-content">
            <!-- Contenido del Paso 1: Datos de la solicitud -->
            <div id="solicitud-part" class="content" role="tabpanel" aria-labelledby="solicitud-part-trigger">
              <input type="hidden" name="solicitud_id" id="solicitud_id" />

              <!-- Input para expediente o número de solicitud -->
              <div class="form-group row">
                <label for="numeroSolicitud" class="col-sm-2 col-form-label">N° de Solicitud</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="numeroSolicitud" name="numeroSolicitud"
                    placeholder="Ingrese N° de solicitud o expediente">
                </div>
                <div class="col-sm-2">
                  <button type="button" class="btn btn-primary" id="btnBuscarSolicitud" style="width: 100%;">
                    <i class="fa fa-search"></i> Buscar
                  </button>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <!-- Card para datos del ciudadano -->
                  <div class="col-md-12">
                    <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title">
                          <i class="fas fa-user"></i> Datos del Ciudadano
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
                            <div class="form-group">
                              <label for="dni">DNI:</label>
                              <input type="text" class="form-control" id="dni" name="dni" placeholder="Ingrese el DNI"
                                maxlength="8" required>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <!-- Input para Nombre -->
                            <div class="form-group">
                              <label for="nombre">Nombre:</label>
                              <input type="text" class="form-control" id="nombre" name="nombre"
                                placeholder="Ingrese el nombre completo" required>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <!-- Select para Tipo de Solicitante -->
                            <div class="form-group">
                              <label for="tipoSolicitante">Tipo de Solicitante:</label>
                              <select class="form-control" id="tipoSolicitante" name="tipoSolicitante" required>
                                <option value="" disabled selected>Seleccione el tipo de solicitante</option>
                                <option value="propietario">Propietario</option>
                                <option value="representante_legal">Representante Legal</option>
                                <option value="conductor_administrador">Conductor/Administrador</option>
                                <option value="organizador_promotor">Organizador/Promotor</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <!-- Input para Teléfono -->
                            <div class="form-group">
                              <label for="telefono">Teléfono:</label>
                              <input type="tel" class="form-control" id="telefono" name="telefono"
                                placeholder="Ingrese el número de teléfono" required>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="direccion">Dirección:</label>
                          <input type="text" class="form-control" id="direccion" name="direccion"
                            placeholder="Ingrese la dirección" required>
                        </div>
                      </div>

                    </div>
                  </div>

                  <!-- Card para datos de la empresa -->
                  <div class="col-md-12">
                    <div class="card card-purple">
                      <div class="card-header">
                        <h3 class="card-title">
                          <i class="fas fa-building"></i> Datos de la Empresa
                        </h3>

                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
                        <!-- Información de la empresa -->
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="ruc">RUC</label>
                              <input type="text" class="form-control" id="ruc" placeholder="Ingrese el RUC">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="razonSocial">Razón Social</label>
                              <input type="text" class="form-control" id="razonSocial"
                                placeholder="Ingrese la razón social">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="nombreComercial">Nombre Comercial</label>
                              <input type="text" class="form-control" id="nombreComercial"
                                placeholder="Ingrese el nombre comercial">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="telefonoEmpresa">Teléfono</label>
                              <input type="tel" class="form-control" id="telefonoEmpresa"
                                placeholder="Ingrese el teléfono">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="ubigeo">Ubigeo</label>
                              <input type="text" class="form-control" id="ubigeo" placeholder="Ingrese el ubigeo">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="giroEmpresa">Giro</label>
                              <input type="text" class="form-control" id="giroEmpresa"
                                placeholder="Ingrese el giro de la empresa">
                            </div>
                          </div>
                          <div class="col-md-6">

                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="direccionEmpresa">Dirección</label>
                              <input type="text" class="form-control" id="direccionEmpresa"
                                placeholder="Ingrese la dirección">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="horarioAtencion">Horario de Atención</label>
                              <select class="form-control" id="horarioAtencion">
                                <option value="">Seleccione el horario de atención</option>
                                <option value="24 Horas">24 Horas</option>
                                <option value="08:00 AM - 01:00 PM">08:00 AM - 01:00 PM</option>
                                <option value="08:00 AM - 06:00 PM">08:00 AM - 06:00 PM</option>
                                <option value="09:00 AM - 05:00 PM">09:00 AM - 05:00 PM</option>
                                <option value="10:00 AM - 07:00 PM">10:00 AM - 07:00 PM</option>
                                <option value="12:00 PM - 08:00 PM">12:00 PM - 08:00 PM</option>
                                <option value="06:00 AM - 02:00 PM">06:00 AM - 02:00 PM</option>
                                <option value="02:00 PM - 10:00 PM">02:00 PM - 10:00 PM</option>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="areaOcupada">Área Ocupada (m²)</label>
                              <input type="number" class="form-control" id="areaOcupada"
                                placeholder="Ingrese el área ocupada en m²">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="numPisos">Número de Pisos</label>
                              <input type="number" class="form-control" id="numPisos"
                                placeholder="Ingrese el número de pisos de la edificación">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="pisoUbicado">Piso de inspeccion </label>
                              <input type="number" class="form-control" id="pisoUbicado"
                                placeholder="Ingrese el piso donde se encuentra ubicado">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="col-md-6">
                  <!-- Card para mostrar un PDF -->
                  <div class="col-md-12">
                    <div class="card card-success">
                      <div class="card-header">
                        <h3 class="card-title">
                          <i class="fas fa-file-alt"></i> Vista de Documento
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
              </div>
              <div style="display: flex;justify-content: flex-end;">
                <button class="btn btn-primary" onclick="stepper.next()">Siguiente</button>
              </div>
            </div>

            <!-- Contenido del segundo paso -->
            <div id="tipo-itse-part" class="content" role="tabpanel" aria-labelledby="tipo-itse-part-trigger">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Tipo de ITSE:</label><br>
                    <div class="icheck-primary form-check-inline">
                      <input class="form-check-input" type="radio" name="tipoItse" id="itsePrevia" value="previa">
                      <label class="form-check-label" for="itsePrevia">ITSE Previa</label>
                    </div>
                    <div class="icheck-primary form-check-inline">
                      <input class="form-check-input" type="radio" name="tipoItse" id="itsePosterior" value="posterior">
                      <label class="form-check-label" for="itsePosterior">ITSE Posterior</label>
                    </div>
                    <div class="icheck-primary form-check-inline">
                      <input class="form-check-input" type="radio" name="tipoItse" id="itseEsce" value="esce">
                      <label class="form-check-label" for="itseEsce">ESCE</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="soli_funcion">Función:</label>
                    <select class="form-control" id="soli_funcion">

                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="row">
                      <!-- Card para Nivel de Riesgo de Incendio -->
                      <div class="col-md-6">
                        <div class="info-box mb-3 bg-danger">
                          <span class="info-box-icon" style="width: 50px;"><i class="fas fa-fire"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-text">Incendio</span>
                            <span class="info-box-number" id="riesgo_incendio"></span>
                          </div>
                        </div>
                      </div>
                      <!-- Card para Nivel de Riesgo de Colapso -->
                      <div class="col-md-6">
                        <div class="info-box mb-3 bg-info">
                          <span class="info-box-icon" style="width: 50px;"><i class="fas fa-house-damage"></i></span>
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




              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Subfunciones</h3>
                </div>
                <div class="card-body">
                  <table class="table" id="subfunciones-table" style="background-color: white; border-radius: 5px;">
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
              <div style="display: flex;justify-content: flex-end; gap:20px;">
                <button class="btn btn-primary" onclick="stepper.previous()">Anterior</button>
                <button class="btn btn-primary" onclick="stepper.next()">Siguiente</button>
              </div>

            </div>

            <!-- Contenido del tercer paso -->
            <div id="confirmacion-part" class="content" role="tabpanel" aria-labelledby="confirmacion-part-trigger">
              <div class="form-group">
                <!-- Nivel de riesgo -->

                <div class="form-group">
                  <div class="row">
                    <!-- Card para Nivel de Riesgo de Incendio -->
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-3">
                      <div class="info-box mb-3 bg-danger">
                        <span class="info-box-icon" style="width: 50px;"><i class="fas fa-fire"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Incendio</span>
                          <span class="info-box-number" id="riesgo_incendio">Alto</span>
                        </div>
                      </div>
                    </div>
                    <!-- Card para Nivel de Riesgo de Colapso -->
                    <div class="col-md-3">
                      <div class="info-box mb-3 bg-info">
                        <span class="info-box-icon" style="width: 50px;"><i class="fas fa-house-damage"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Colapso</span>
                          <span class="info-box-number" id="riesgo_colapso"></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">

                    </div>
                  </div>
                </div>

                <!-- Lista de requisitos -->
                <!-- Tabla de Requisitos -->
                <div class="form-group">
                  <label>Requisitos:</label>
                  <table class="table" style="background: #f6f6f6">
                    <thead>
                      <tr>
                        <th>Requisito</th>
                        <th>Confirmar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Solicitud ITSE Anexo 1</td>
                        <td>
                          <div class="icheck-warning d-inline">
                            <input type="checkbox" class="form-check-input bg-success" id="checkboxSolicitudITSE">
                            <label class="form-check-label" for="checkboxSolicitudITSE"></label>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Reporte de Nivel de Riesgo (Anexo 2 y 3)</td>
                        <td>
                          <div class="icheck-warning d-inline">
                            <input type="checkbox" class="form-check-input bg-success" id="checkboxReporteRiesgo">
                            <label class="form-check-label" for="checkboxReporteRiesgo"></label>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Croquis de Ubicación</td>
                        <td>
                          <div class="icheck-warning d-inline">
                            <input type="checkbox" class="form-check-input bg-success" id="checkboxCroquisUbicacion">
                            <label class="form-check-label" for="checkboxCroquisUbicacion"></label>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Plano de arquitectura de la distribución existente y cálculo de aforo</td>
                        <td>
                          <div class="icheck-warning d-inline">
                            <input type="checkbox" class="form-check-input bg-success" id="checkboxPlanoArquitectura">
                            <label class="form-check-label" for="checkboxPlanoArquitectura"></label>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Plano de tableros eléctricos, diagramas unifilares y cuadro de carga</td>
                        <td>
                          <div class="icheck-warning d-inline">
                            <input type="checkbox" class="form-check-input bg-success" id="checkboxPlanoTableros">
                            <label class="form-check-label" for="checkboxPlanoTableros"></label>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Certificado vigente de medición y resistencia del sistema de puesta a tierra</td>
                        <td>
                          <div class="icheck-warning d-inline">
                            <input type="checkbox" class="form-check-input bg-success" id="checkboxCertificadoMedicion">
                            <label class="form-check-label" for="checkboxCertificadoMedicion"></label>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Plan de Seguridad con planos de evacuación y señalización</td>
                        <td>
                          <div class="icheck-warning d-inline">
                            <input type="checkbox" class="form-check-input bg-success" id="checkboxPlanSeguridad">
                            <label class="form-check-label" for="checkboxPlanSeguridad"></label>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Memoria o protocolos de operatividad de equipos de seguridad</td>
                        <td>
                          <div class="icheck-warning d-inline">
                            <input type="checkbox" class="form-check-input bg-success" id="checkboxMemoriaProtocolos">
                            <label class="form-check-label" for="checkboxMemoriaProtocolos"></label>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>

                </div>

                <div style="display: flex; justify-content: flex-end; gap: 10px;">
                  <button class="btn btn-primary" onclick="stepper.previous()">Anterior</button>
                  <button type="submit" class="btn btn-primary">Guardar Solicitud</button>
                </div>
              </div>


            </div>
          </div>
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
  </div><!-- modal -->