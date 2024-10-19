<div class="modal fade" id="ciudadanoModal" tabindex="-1" role="dialog" aria-labelledby="ciudadanoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ciudadanoModalLabel">Registro de Ciudadano</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="ciudadanosdetalles_form">
                <div class="modal-body">
                    <input type="hidden" name="ciud_id" id="ciud_id" />
                    <div class="form-group">
                        <div class="row">
                            <!-- Columna derecha -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Número de Documento: <span class="tx-danger">*</span></label>
                                    <input type="number" name="ciudadano_doc" id="ciudadano_doc" class="form-control"
                                        placeholder="Ingresa el número de documento" oninput="limitabuscadni(this)"
                                        required onwheel="this.blur()">
                                    <div>
                                        <label id="ciud_mensaje"
                                            style="display: none; color: green; width: 100%;">Correcto!</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="ciudadano_nombre">Nombre: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control tx-uppercase" id="ciudadano_nombre" type="text"
                                        name="ciudadano_nombre" required />
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="ciudadano_apep">Apellido Paterno: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control tx-uppercase" id="ciudadano_apep" type="text"
                                        name="ciudadano_apep" required />
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="ciudadano_apem">Apellido Materno: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control tx-uppercase" id="ciudadano_apem" type="text"
                                        name="ciudadano_apem" required />
                                </div>

                            </div>

                            <!-- Columna izquierda -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="ciudadano_direccion">Dirección: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" id="ciudadano_direccion" type="text"
                                        name="ciudadano_direccion" required />
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="ciudadano_email">Correo Electrónico: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" id="deemail" type="email" name="deemail"
                                        placeholder="Ingresa el correo electrónico"  />
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="detelefo">Teléfono: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" id="detelefo" type="number" name="detelefo" oninput='limitarDigitos(this,9)'
                                        placeholder="Ingresa el número de teléfono"  />
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        
                                            <label class="form-control-label" for="ciudadano_departamento">Departamento:
                                                <span class="tx-danger">*</span></label>
                                            <select class="form-control select2" id="ciudadano_departamento"
                                                name="ciudadano_departamento" style="width: 100%;" >
                                                <option value="">Selecciona un departamento</option>
                                                <!-- Opciones de departamentos -->
                                            </select>
                                            
                                      
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ciudadano_provincia">Provincia: <span
                                                    class="tx-danger">*</span></label>
                                            <select class="form-control select2" id="ciudadano_provincia"
                                                name="ciudadano_provincia" >
                                                <option value="">Selecciona una provincia</option>
                                                <!-- Opciones de provincias -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ciudadano_distrito">Distrito: <span
                                                    class="tx-danger">*</span></label>
                                            <select class="form-control" id="ciudadano_distrito"
                                                name="ciudadano_distrito" >
                                                <option value="">Selecciona un distrito</option>
                                                <!-- Opciones de distritos -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="action" value="add" id="btnguardar"
                    class="btn btn-primary">
                        <i class="fa fa-check"></i> Guardar
                    </button>
                    <button type="reset"
                        class="btn btn-outline-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"
                        aria-label="Close" aria-hidden="true" data-dismiss="modal">
                        <i class="fa fa-close"></i> Cancelar
                    </button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>