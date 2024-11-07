<?php
require_once("../../config/conexion.php");
if (isset($_SESSION["usua_id_pdvlg"])) {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php require_once("../html/mainHead.php"); ?>
        <title>Registrar Pedido</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css">

        <style>
            body {
                font-size: 0.9rem;
                /* Disminuir el tamaño de letra */
            }

            .card-title {
                font-size: 1.25rem;
                /* Ajustar tamaño de título de la tarjeta */
            }

            .table th,
            .table td {
                font-size: 0.85rem;
                /* Ajustar tamaño de la tabla */
            }

            .custom-search {
                width: 100%;
                /* Hacer el buscador más grande */
                padding: 0.375rem 0.75rem;
                font-size: 1rem;
                /* Tamaño del texto del buscador */
            }

            /* Cambia el color de la fila seleccionada */
            .selected {
                background-color: #a878ff !important;
            }
        </style>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <?php require_once("../html/menu.php"); ?>
            <?php require_once("../html/mainProfile.php"); ?>
            <div class="content-wrapper">
                <section class="content">
                    <div class="container-fluid">
                        <div class="card card-warning">
                            <div class="card-header" style="background-color: #ff8200;">
                                <h3 class="card-title">Registrar Pedido</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-2" style="text-align: center;">
                                        <img src="../../public/img/logo3.png" width="120">
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="mesa_id">Mesa</label>
                                            <select id="mesa_id" class="form-control">
                                                <!-- Aquí se llenarán las mesas -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="tipro_id">Tipo de Productos</label>
                                            <select id="tipro_id" class="form-control select2">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <!-- Tarjeta para la lista de productos -->
                                        <div class="card mb-4 card-purple">
                                            <div class="card-header" >
                                                <h3 class="card-title">Lista de Productos</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                                        <i class="fas fa-expand"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body" style="overflow-x: scroll;">
                                                <input style="border-radius: 5px; border-bottom: 1px solid #6f42c1;"
                                                    type="text" id="customSearch" class="custom-search"
                                                    placeholder=" 🔎 Buscar productos...">

                                                <table id="productosTable" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Descripción</th>
                                                            <th>Precio</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Aquí se cargarán los datos dinámicamente -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card mb-4 card-warning">
                                            <div class="card-header" style="background-color: #ff8200;">
                                                <h4 class="card-title">Productos Seleccionados</h4>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                                        <i class="fas fa-expand"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body" style="overflow-x: scroll;">
                                                <table id="selectedProductsTable" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                         
                                                            <th>Descripción</th>
                                                            <th>P.Unit</th>
                                                            <th style="min-width: 85px !important;">Cant</th>
                                                            <th>Importe</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="resumenContainer">
                                                        <!-- Aquí se cargarán los productos seleccionados -->
                                                    </tbody>
                                                </table>
                                                <h4>Monto Total: <span id="montoTotal">0</span></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button style="width: 100%;" class="btn btn-primary" id="registrarPedido">
                                    <i class="fas fa-check"></i> Registrar Pedido
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <?php require_once("../html/footer.php"); ?>
        </div>

        <?php require_once("../html/mainjs.php"); ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.select2').select2();
                listarMesas();
                cargarCategorias();
                listarProductos();

                $('#customSearch').on('keyup', function() {
                    const value = $(this).val().toLowerCase(); // Capturamos el valor y lo pasamos a minúsculas
                    $("#productosTable tbody tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1) // Filtra las filas según el texto
                    });
                });

                $('#tipro_id').on('change', function() {
                    listarProductos();
                });


            });

            function listarMesas() {
                $.ajax({
                    url: "../../controller/mesa.php?op=listar_mesas_combo",
                    type: "GET",
                    success: function(data) {
                        let mesas = JSON.parse(data);
                        mesas.forEach(mesa => {
                            $("#mesa_id").append(`<option value="${mesa.mesa_id}">${mesa.mesa_nmr}</option>`);
                        });
                    }
                });
            }

            function cargarCategorias() {
                $.ajax({
                    url: "../../controller/producto.php?op=get_categorias",
                    method: "GET",
                    dataType: "json",
                    success: function(response) {
                        $.each(response, function(index, item) {
                            $('#tipro_id').append(new Option(item.cate_nom, item.cate_prod_id));
                        });
                    },
                    error: function() {
                        console.error('Error al cargar las categorías.');
                    }
                });
            }




            function listarProductos() {
                let categoriaId = $('#tipro_id').val();
                if (!categoriaId) {
                    categoriaId = 1;
                }
                $.ajax({
                    url: "../../controller/producto.php?op=listar_productos",
                    type: "POST",
                    data: {
                        categoria_id: categoriaId
                    },
                    success: function(data) {
                        try {
                            const response = JSON.parse(data);
                            const productos = response.data;
                            const tbody = $("#productosTable tbody");
                            tbody.empty();

                            productos.forEach((producto, index) => {
                                tbody.append(`
                                                <tr data-producto-id="${producto.producto_id}">
                                                    <td>${index + 1}</td>
                                                    <td>${producto.producto_nom}</td>
                                                    <td>${producto.producto_precio}</td>
                                                </tr>
                                            `);
                            });

                            // Evento de selección de fila
                            tbody.find("tr").on("click", function() {
                                const descripcion = $(this).find("td:eq(1)").text();
                                const precio = parseFloat($(this).find("td:eq(2)").text());
                                const productoId = $(this).data("producto-id");
                                // Intentar agregar el producto y verificar si fue exitoso
                                const productoAgregado = agregarProductoSeleccionado(descripcion, precio, $(this),productoId);

                                // Solo aplicar la clase "selected" si el producto fue agregado
                                if (productoAgregado) {
                                    $(this).addClass("selected");
                                }
                            });

                        } catch (error) {
                            console.error('Error al procesar los datos de productos:', error);
                        }
                    }
                });
            }

            function agregarProductoSeleccionado(descripcion, precio, filaOriginal, productoId) {
                // Verificar si el producto ya está en la lista
                const productoExiste = $("#resumenContainer tr").filter(function() {
                    return $(this).find("td:eq(0)").text() === descripcion;
                }).length > 0;

                if (productoExiste) {
                    // Mostrar Toastr y retornar false para no cambiar la clase
                    toastr.warning("El producto ya se encuentra en la lista.", "Producto duplicado");
                    return false;
                }

                // Agregar el producto si no está duplicado
                const nuevaFila = $(`
                    <tr data-producto-id="${productoId}" data-row="${filaOriginal.index()}">
                        <td>${descripcion}</td>
                        <td>${precio.toFixed(2)}</td>
                        <td class="cantidad" style="text-align: center;">
                            <button style="background: #ea0000; color: white;"  class="btn btn-sm btn-light" onclick="cambiarCantidad(this, -1, ${precio})">-</button>
                            <span>1</span>
                            <button style="background: #34ed00; color: white;" class="btn btn-sm btn-light" onclick="cambiarCantidad(this, 1, ${precio})">+</button>
                        </td>
                        <td>${precio.toFixed(2)}</td>
                        <td style="text-align: center;"><button class="btn btn-danger btn-sm remove-product"><i class="fas fa-trash"></i></button></td>
                    </tr>
                `);

                $("#resumenContainer").append(nuevaFila);
                actualizarMontoTotal();

                // Evento para eliminar producto y quitar la clase de selección en la fila original
                nuevaFila.find(".remove-product").on("click", function() {
                    filaOriginal.removeClass("selected"); // Remueve la clase de selección
                    nuevaFila.remove();
                    actualizarMontoTotal();
                });

                return true; // Indicar que el producto fue agregado exitosamente
            }



            function cambiarCantidad(button, cambio, precio) {
                const cantidadSpan = $(button).siblings("span");
                let cantidad = parseInt(cantidadSpan.text());
                cantidad = Math.max(1, cantidad + cambio); // Asegurarse de que la cantidad no sea menor a 1
                cantidadSpan.text(cantidad);

                const importe = precio * cantidad;
                $(button).closest("tr").find("td:eq(3)").text(importe.toFixed(2));
                actualizarMontoTotal();
            }


            function actualizarImporte(input, precio) {
                const cantidad = parseInt($(input).val());
                const importe = precio * cantidad;
                $(input).closest("tr").find("td:eq(3)").text(importe.toFixed(2));
                actualizarMontoTotal();
            }

            function actualizarMontoTotal() {
                let total = 0;
                $("#resumenContainer tr").each(function() {
                    total += parseFloat($(this).find("td:eq(3)").text());
                });
                $("#montoTotal").text(total.toFixed(2));
            }
            $("#registrarPedido").click(function() {
                let mesaId = $("#mesa_id").val();
                

                let productos = [];

                // Iterar por cada fila de producto seleccionada
                $("#resumenContainer tr").each(function() {
                    let productoId = $(this).attr("data-producto-id");
                    let descripcion = $(this).find('td:eq(0)').text();
                    let cantidadText = $(this).find('.cantidad span').text();
                    let precioUnitarioText = $(this).find("td:eq(1)").text();
                    let importeText = $(this).find("td:eq(3)").text();

                    let cantidad = parseInt(cantidadText);
                    let precioUnitario = parseFloat(precioUnitarioText);
                    let importe = parseFloat(importeText);

                    console.log("Producto detectado:");
                    console.log("ID:", productoId);
                    console.log("Descripción:", descripcion);
                    console.log("Cantidad:", cantidad);
                    console.log("Precio Unitario:", precioUnitario);
                    console.log("Importe Total:", importe);

                    if (productoId && !isNaN(cantidad) && !isNaN(precioUnitario) && !isNaN(importe)) {
                        productos.push({
                            producto_id: productoId,
                            descripcion: descripcion,
                            cantidad: cantidad,
                            precio_unitario: precioUnitario,
                            monto_total: importe
                        });
                    } else {
                        console.warn("Producto no agregado debido a datos incompletos o inválidos:", {
                            productoId,
                            descripcion,
                            cantidadText,
                            precioUnitarioText,
                            importeText
                        });
                    }
                });

           

                if (productos.length === 0) {
                    toastr.warning("Error: No se seleccionaron productos. Selecciona al menos un producto.");
                     return;
                }

                const pedidoData = {
                    pedido: {
                        mesa_id: mesaId,
                        pers_id: 1,
                        pedido_est: 1
                    },
                    productos: productos
                };

             

                fetch('../../controller/pedido.php?op=registrar_pedido', {
                        method: 'POST',
                        body: JSON.stringify(pedidoData),
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "success") {
                            toastr.success("Pedido registrado correctamente");
                            
                            // Limpiar la tabla de productos seleccionados y el monto total
                            $("#resumenContainer").empty();
                            $("#montoTotal").text("0.00");

                            // Opcional: Restablecer otros campos si es necesario
                            $("#mesa_id").val(null).trigger("change");
                            $("#tipro_id").val(null).trigger("change");

                        } else {
                            toastr.error("Error al registrar el pedido: " + data.message);
                        }
                    })
                    .catch(error => {
                        console.error("Error en la solicitud:", error);
                        toastr.error("Error al enviar el pedido al servidor.");
                    });
            });
        </script>
    </body>

    </html>
<?php
} else {
    header("Location: ../../index.php");
}
?>