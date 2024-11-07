<?php
require_once("../../config/conexion.php");


if (isset($_SESSION["usua_id_pdvlg"])) {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php require_once("../html/mainHead.php"); ?>
        <title>MPCH::Gestión de Productos</title>

        <style>
            /* Reduce el tamaño de la letra de la tabla */
            #productosTable {
                font-size: 0.9rem;
                /* Tamaño de fuente más pequeño */
            }
        </style>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
        <div class="wrapper">
            <?php require_once("../html/mainProfile.php"); ?>
            <?php require_once("../html/menu.php"); ?>

            <div class="content-wrapper">
                <section class="content">
                    <div class="container-fluid">
                        <div class="card card-purple" style="margin-top: 10px">
                            <div class="card-header">
                                <h2 class="card-title">Lista de Productos</h2>

                            </div>
                            <div class="card-body">
                                <style>
                                    #productosTable_filter {
                                        display: none;
                                        /* Oculta el cuadro de búsqueda predeterminado de DataTables */
                                    }
                                </style>

                                <div class="row">
                                    <div class="col-lg-4" style="margin-top: 5px;">
                                        <select id="categoriaSelect" class="form-control select2"
                                            style="width: 100%; display: inline-block;">
                                            <option value="">Todas las categorías</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6" style="margin-top: 5px;">
                                        <input type="text" id="searchInput" placeholder="Buscar..." class="form-control"
                                            style="width: 100%; display: inline-block; border: 2px solid #ff6c00;">

                                    </div>
                                    <div class="col-lg-2" style="margin-top: 5px;">
                                        <button type="button" style="width: 100%;" class="btn btn-primary float-right"
                                            onclick="nuevo()">
                                            <i class="fa fa-plus"></i> Agregar Producto
                                        </button>
                                    </div>


                                </div>

                                <div class="container_tabla" style="overflow-x: scroll;">
                                    <table id="productosTable" class="table table-bordered table-hover">
                                        <thead style="    background: #ff6c00;">
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Descripción</th>
                                                <th>Precio</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Aquí se cargarán los datos de los productos dinámicamente -->
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <?php require_once("../html/footer.php"); ?>
        </div>

        <?php require_once("modal_producto.php"); ?>
        <?php require_once("../html/mainjs.php"); ?>


        <script>
            $(document).ready(function() {
                $('.select2').select2();

                // Cargar categorías
                $.ajax({
                    url: '../../controller/producto.php?op=get_categorias',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $.each(response, function(index, item) {
                            $('#categoriaSelect').append(new Option(item.cate_nom, item.cate_prod_id));
                            $('#cate_producto_id').append(new Option(item.cate_nom, item.cate_prod_id));
                        });
                    },
                    error: function() {
                        console.error('Error al cargar las categorías.');
                    }
                });

                var table = $('#productosTable').DataTable({
                    "ajax": {
                        "url": "../../controller/producto.php?op=listar_productos",
                        "type": "POST",
                        "data": function(d) {
                            d.categoria_id = $('#categoriaSelect').val();
                        }
                    },
                    "pageLength": 8,
                    "lengthChange": false,
                    "columns": [{
                            "data": "producto_id"
                        },
                        {
                            "data": "producto_nom"
                        },
                        {
                            "data": "producto_desc"
                        },
                        {
                            "data": "producto_precio"
                        },
                        {
                            "data": "plato_est",
                            "render": function(data) {
                                return data === 1 ? 'Activo' : 'Inactivo';
                            }
                        },
                        {
                            "data": null,
                            "render": function(data, type, row) {
                                return `<button class='btn btn-warning btn-sm' title='Editar' onclick='editar(${row.producto_id})'><i class='fa fa-edit'></i></button>
                            <button class='btn btn-danger btn-sm' title='Eliminar' onclick='eliminar(${row.producto_id})'><i class='fa fa-trash'></i></button>`;
                            }
                        }
                    ]
                });

                // Búsqueda personalizada
                $('#searchInput').on('keyup', function() {
                    table.search(this.value).draw();
                });

                $('#categoriaSelect').on('change', function() {
                    table.ajax.reload();
                });

                $("#productoForm").submit(function(event) {
                    event.preventDefault();
                    let action = $('#producto_id').val() === '' ? 'guardar_producto' : 'guardar_producto';
                    $.ajax({
                        url: '../../controller/producto.php?op=' + action,
                        method: 'POST',
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function(response) {
                            toastr.success(response.message);
                            table.ajax.reload();
                            $("#productoModal").modal("hide");
                        },
                        error: function() {
                            toastr.error("Error al guardar el producto.");
                        }
                    });
                });
            });
            function nuevo() {
                $("#productoModal").modal("show");
                clearModalInputs();
            }

            function clearModalInputs() {
                $('#producto_id').val('');
                $('#producto_nom').val('');
                $('#producto_desc').val('');
                $('#producto_precio').val('');
                $('#cate_producto_id').val('').trigger('change');
            }
            function editar(id) {
                $.ajax({
                    url: '../../controller/producto.php?op=obtener_producto',
                    method: 'GET',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#producto_id').val(data.producto_id);
                        $('#producto_nom').val(data.producto_nom);
                        $('#producto_desc').val(data.producto_desc);
                        $('#producto_precio').val(data.producto_precio);
                        $('#cate_producto_id').val(data.cate_producto_id).trigger('change');
                        $("#productoModal").modal("show");
                    }
                });
            }

            function eliminar(id) {
                Swal.fire({
                    title: '¿Está seguro?',
                    text: "No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post('../../controller/producto.php?op=eliminar_producto', {
                            producto_id: id
                        }, function(response) {
                            toastr.success(response.message);
                            $('#productosTable').DataTable().ajax.reload();
                        }, 'json');
                    }
                });
            }
        </script>
    </body>

    </html>
<?php
} else {
    header("Location: " . Conectar::ruta() . "index.php");
}
