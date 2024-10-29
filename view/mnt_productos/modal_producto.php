<div class="modal fade" id="productoModal" tabindex="-1" role="dialog" aria-labelledby="productoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productoModalLabel">Agregar/Editar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="productoForm">
                <div class="modal-body">
                    <input type="hidden" id="producto_id" name="producto_id">
                    <div class="form-group">
                        <label for="producto_nom">Nombre del Producto</label>
                        <input type="text" class="form-control" id="producto_nom" name="producto_nom" required>
                    </div>
                    <div class="form-group">
                        <label for="producto_desc">Descripción</label>
                        <textarea class="form-control" id="producto_desc" name="producto_desc" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="producto_precio">Precio</label>
                        <input type="number" class="form-control" id="producto_precio" name="producto_precio" required>
                    </div>
                    <div class="form-group">
                        <label for="cate_producto_id">Categoría</label>
                        <select class="form-control" id="cate_producto_id" name="cate_producto_id" required>
                            <option value="">Seleccione una categoría</option>
                            <!-- Aquí se cargarán las categorías desde la base de datos -->
                        </select>
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
