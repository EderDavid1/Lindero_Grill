<div class="modal fade" id="modal_mesa" tabindex="-1" aria-labelledby="modalMesaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMesaLabel">Registrar Mesa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formMesa">
                <div class="modal-body">
                    <input type="hidden" id="mesa_id" name="mesa_id">
                    <div class="form-group">
                        <label for="mesa_nmr">Número de Mesa</label>
                        <input type="text" class="form-control" id="mesa_nmr" name="mesa_nmr" required>
                    </div>
                    <div class="form-group">
                        <label for="mesa_sillas_num">Número de Sillas</label>
                        <input type="text" class="form-control" id="mesa_sillas_num" name="mesa_sillas_num" required>
                    </div>
                    <div class="form-group">
                        <label for="mesa_est">Estado</label>
                        <select class="form-control" id="mesa_est" name="mesa_est">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Mesa</button>
                </div>
            </form>
        </div>
    </div>
</div>
