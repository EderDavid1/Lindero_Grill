<?php
require_once("../../config/conexion.php");
if (isset($_SESSION["usua_id_pdvlg"])) {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php require_once("../html/mainHead.php"); ?>
        <title>Pedidos</title>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <?php require_once("../html/menu.php"); ?>
            <?php require_once("../html/mainProfile.php"); ?>
            <div class="content-wrapper">
                <section class="content">
                    <div class="container-fluid" style="padding-top: 30px;">
                        <h3 class="text-center" style="font-family: cursive; color: #ff7500;">Pedidos Activos</h3>

                        <!-- Contenedor para el combo de filtro -->
                        <div class="d-flex justify-content-center">
                            <div class="bg-light p-3 rounded shadow" style="max-width: 300px; width: 100%;">
                               
                                <select id="estadoFiltro" class="form-control mb-3 text-center" onchange="listarPedidos()">
                                    <option value="1">Pendientes</option>
                                    <option value="2">Pagados</option>
                                </select>
                                <button onclick="window.location.href='../nuevo_pedido/'" style="width: 100%;" class="btn btn-warning">
                                    <i class="fa fa-plus"></i> Nuevo Pedido
                                </button>
                            </div>
                        </div>

                        <div class="row mt-4" id="pedidosContainer" style="background: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 1px 5px 11px #343a40b3;"></div>
                    </div>
                </section>
            </div>

            <!-- Modal para Ver Detalle del Pedido -->
            <div class="modal fade modal-primary" id="modalDetallePedido" tabindex="-1" aria-labelledby="modalDetallePedidoLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="background: #007bff; color: white;">
                            <h5 class="modal-title" id="modalDetallePedidoLabel">Detalle del Pedido</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row" style="margin-bottom: 15px;">
                                <div class="col-lg-6" style="border-left: 5px solid #007bff; border-radius: 5px 0px 0px 5px; padding-left: 20px;">
                                    <strong>Numero de pedido: </strong> <span id="pedido_id"></span><br>
                                    <strong>Fecha pedido: </strong> <span id="fechacrea"></span><br>
                                    <strong>Mesa: </strong> <span id="mesa_nmr"></span><br>
                                    <strong>Usuario: </strong> <span id="persona"></span><br>
                                </div>
                                <div class="col-lg-6" style="border-left: 5px solid #007bff; border-radius: 5px 0px 0px 5px; padding-left: 20px;">
                                    <strong>Total Cantidad: </strong> <span id="totalCantidad"></span><br>
                                    <strong>Total Monto: </strong> <span id="totalMonto"></span>
                                </div>
                            </div>
                            <div style="overflow-x: scroll;">
                                <table class="table table-bordered">
                                    <thead style="background: #007bff; color: white;">
                                        <tr>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unitario</th>
                                            <th>Monto Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detallePedidoContainer" style="text-align: center;"></tbody>
                                </table>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-primary" id="btnPagarPedido" onclick="pagarPedido()">
                                Pagar
                            </button> -->

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para Realizar Cobro -->
            <div class="modal fade" id="modalCobro" tabindex="-1" aria-labelledby="modalCobroLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="background: #28a745; color: white;">
                            <h5 class="modal-title" id="modalCobroLabel"><i class="fas fa-cash-register"></i> Realizar Cobro</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <!-- Tipo de Comprobante como Radio Buttons -->
                                <strong><i class="fas fa-file-invoice"></i> Tipo de Comprobante:</strong>
                                <div class="col-lg-12 mt-3">

                                    <div class="form-check form-check-inline ml-2">
                                        <input class="form-check-input" type="radio" name="tipoComprobante" id="boleta" value="1" onchange="toggleFields()">
                                        <label class="form-check-label" for="boleta">Boleta</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipoComprobante" id="factura" value="2" onchange="toggleFields()">
                                        <label class="form-check-label" for="factura">Factura</label>
                                    </div>
                                </div>

                                <!-- Campo DNI -->
                                <div class="col-lg-6 mt-3" id="campoDNI" style="display: none;">
                                    <strong><i class="fas fa-id-card"></i> DNI:</strong>
                                    <input type="text" id="dni" class="form-control" maxlength="8" onblur="obtenerDatosDNI()" pattern="\d*" title="Debe ser un número de 8 dígitos">
                                </div>

                                <!-- Campo Nombre (para Boleta) -->
                                <div class="col-lg-6 mt-3" id="campoNombre" style="display: none;">
                                    <strong><i class="fas fa-id-card"></i> Nombre:</strong>
                                    <input type="text" id="nombreDNI" class="form-control" placeholder="Nombre" disabled>
                                </div>

                                <!-- Campo RUC -->
                                <div class="col-lg-6 mt-3" id="campoRUC" style="display: none;">
                                    <strong><i class="fas fa-building"></i> RUC:</strong>
                                    <input type="text" id="ruc" class="form-control" maxlength="11" onblur="obtenerDatosRUC()" pattern="\d*" title="Debe ser un número de 11 dígitos">
                                </div>

                                <!-- Campo Razón Social (para Factura) -->
                                <div class="col-lg-6 mt-3" id="campoRazon" style="display: none;">
                                    <strong><i class="fas fa-building"></i> Razón Social:</strong>
                                    <input type="text" id="razonSocial" class="form-control" placeholder="Razón Social" disabled>
                                </div>

                                <!-- Total a Pagar -->
                                <div class="col-lg-4 mt-3">
                                    <strong><i class="fas fa-money-bill-wave"></i> Total a Pagar:</strong>
                                    <input type="text" id="totalMonto_cobro" class="form-control" disabled>
                                </div>

                                <!-- Monto Ingresado -->
                                <div class="col-lg-4 mt-3">
                                    <strong><i class="fas fa-wallet"></i> Monto Ingresado:</strong>
                                    <input type="number" id="montoIngresado" class="form-control" oninput="calcularVuelto()">
                                </div>

                                <!-- Vuelto -->
                                <div class="col-lg-4 mt-3">
                                    <strong><i class="fas fa-coins"></i> Vuelto:</strong>
                                    <input type="text" id="vuelto" class="form-control" disabled>
                                </div>
                            </div>

                            <!-- Tabla de Productos -->
                            <div style="overflow-x: scroll; margin-top: 20px;">
                                <table class="table table-bordered">
                                    <thead style="background: #007bff; color: white;">
                                        <tr>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unitario</th>
                                            <th>Monto Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productosCobroContainer" style="text-align: center;"></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="realizarCobro()"><i class="fas fa-check"></i> Confirmar Cobro</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>



            <?php require_once("../html/footer.php"); ?>
        </div>

        <?php require_once("../html/mainjs.php"); ?>

        <script>
            function listarPedidos() {
                const estado = $('#estadoFiltro').val();
                $.ajax({
                    url: `../../controller/pedido.php?op=listar_pedidos&estado=${estado}`,
                    type: "GET",
                    success: function(response) {
                        const pedidos = JSON.parse(response);
                        let html = '';
                        pedidos.forEach(pedido => {
                            // Elegir clase de color según el estado
                            const cardClass = pedido.pedido_est == 1 ? 'card-warning' : 'card-success';
                            const fechaCrea = pedido.fechacrea.split(".")[0]; // Remover segundos extras

                            html += `<div class="col-md-2">
                            <div class="card ${cardClass}">
                                <div class="card-header" style="padding-right: 10px; display: flex; justify-content: space-between;">
                                    <div>
                                        <h5 style="font-weight: bold;">Mesa: ${pedido.mesa_nmr}</h5>
                                        <p>${fechaCrea}</p>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">`;

                            // Condiciones para mostrar opciones según el estado del pedido
                            if (pedido.pedido_est == 2) {
                                // Si el estado es '2' (Pagado), mostrar solo "Ver" y "Imprimir Comprobante"
                                html += `
                        <a class="dropdown-item" href="#" style="color: black" onclick="verDetallePedido(${pedido.pedido_id})">
                            <i class="fas fa-eye"></i> Ver
                        </a>
                        <a class="dropdown-item" href="#" style="color: black" onclick="imprimirComprobante(${pedido.pedido_id})">
                            <i class="fas fa-print"></i> Imprimir Comprobante
                        </a>`;
                            } else {
                                // Si el estado es diferente de '2', mostrar "Ver", "Pagar", "Editar", y "Eliminar"
                                html += `
                        <a class="dropdown-item" href="#" style="color: black" onclick="verDetallePedido(${pedido.pedido_id})">
                            <i class="fas fa-eye"></i> Ver
                        </a>
                        <a class="dropdown-item" href="#" style="color: black" onclick="pagarPedido(${pedido.pedido_id})">
                            <i class="fas fa-dollar-sign"></i> Pagar
                        </a>
                        <a class="dropdown-item" href="#" style="color: black">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a class="dropdown-item text-danger" href="#" style="color: black" onclick="eliminarPedido(${pedido.pedido_id})">
                            <i class="fas fa-trash-alt"></i> Eliminar
                        </a>`;
                            }

                            html += `           </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
                        });
                        $('#pedidosContainer').html(html);
                    }
                });
            }

            function imprimirComprobante(cobroId) {
                window.open(`../../controller/cobro.php?op=generar_comprobante_pedido&pedido_id=${cobroId}`, '_blank');
            }

            // Ver detalle de pedido
            function verDetallePedido(pedido_id) {
                $.ajax({
                    url: `../../controller/pedido.php?op=ver_detalle_pedido&pedido_id=${pedido_id}`,
                    type: "GET",
                    success: function(response) {
                        const data = JSON.parse(response);
                        const detalle = data.detalle;
                        const totales = data.totales;

                        let html = '';
                        detalle.forEach(item => {
                            html += `<tr>
                                    <td>${item.producto_nom}</td>
                                    <td>${item.pedidod_cantidad}</td>
                                    <td>${item.pedidod_precio_unitario}</td>
                                    <td>${item.pedidod_monto_total}</td>
                                </tr>`;
                            $('#mesa_nmr').text(item.mesa_nmr);
                        });
                        $('#detallePedidoContainer').html(html);
                        $('#totalCantidad').text(totales.total_cantidad);
                        $('#pedido_id').text(String(pedido_id).padStart(6, '0'));
                        $('#totalMonto').text(totales.total_monto);
                        $('#modalDetallePedidoLabel').text('Detalle del Pedido: #' + String(pedido_id).padStart(6, '0'));
                        // Guardar el pedido_id en el botón de pago
                        $('#btnPagarPedido').data('pedido-id', pedido_id);

                        $('#modalDetallePedido').modal('show');
                    }
                });
            }

            // Eliminar pedido con confirmación de SweetAlert
            function eliminarPedido(pedido_id) {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción no se puede revertir",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `../../controller/pedido.php?op=eliminar_pedido`,
                            type: "POST",
                            data: {
                                pedido_id: pedido_id
                            }, // Pasar pedido_id como parámetro
                            success: function(response) {
                                Swal.fire('Eliminado!', 'El pedido ha sido actualizado a inactivo.', 'success');
                                listarPedidos(); // Recargar la lista de pedidos
                            },
                            error: function() {
                                toastr.error('Error al eliminar el pedido');
                            }
                        });
                    }
                });
            }

            function pagarPedido(pedido_id) {
                Swal.fire({
                    title: '¿Deseas realizar el pago?',
                    text: "Confirma si quieres marcar este pedido como pagado.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, Pagar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        if ($('.modal.show').length > 0) {
                            $('.modal').modal('hide');
                        }

                        limpiarFormularioCobro(); // Limpiar el formulario antes de cargar el pedido
                        cargarDetalleCobro(pedido_id); // Cargar información del pedido en el modal
                        $('#modalCobro').modal('show'); // Abrir el modal de cobro
                    }
                });
            }


            // Función para obtener los productos en la tabla y armar un JSON
            function obtenerListaProductos() {
                const productos = [];
                $('#productosCobroContainer tr').each(function() {
                    const producto = {
                        nombre: $(this).find('td:eq(0)').text(),
                        cantidad: $(this).find('td:eq(1)').text(),
                        precio_unitario: $(this).find('td:eq(2)').text(),
                        total: $(this).find('td:eq(3)').text()
                    };
                    productos.push(producto);
                });
                return JSON.stringify(productos);
            }


            $(document).ready(function() {
                listarPedidos();

            });



            function toggleFields() {
                const tipoComprobante = $('input[name="tipoComprobante"]:checked').val();
                $('#campoDNI').hide();
                $('#campoRUC').hide();
                $('#campoNombre').hide();
                $('#campoRazon').hide();

                if (tipoComprobante === '1') { // Boleta seleccionada
                    $('#campoDNI').show();
                    $('#campoNombre').show();
                } else if (tipoComprobante === '2') { // Factura seleccionada
                    $('#campoRUC').show();
                    $('#campoRazon').show();
                }
            }


            // Límite de caracteres y solo números para los campos de DNI y RUC
            $('#dni').on('input', function() {
                this.value = this.value.replace(/\D/g, ''); // Elimina caracteres no numéricos
                if (this.value.length > 8) {
                    this.value = this.value.slice(0, 8); // Máximo 8 caracteres
                }
            });

            $('#ruc').on('input', function() {
                this.value = this.value.replace(/\D/g, ''); // Elimina caracteres no numéricos
                if (this.value.length > 11) {
                    this.value = this.value.slice(0, 11); // Máximo 11 caracteres
                }
            });


            // Calcular el vuelto
            function calcularVuelto() {
                const total = parseFloat($('#totalMonto_cobro').val());
                const ingreso = parseFloat($('#montoIngresado').val());
                const vuelto = ingreso > total ? (ingreso - total).toFixed(2) : 0;
                $('#vuelto').val(vuelto);
            }

            // Obtener datos de DNI desde el servidor
            function obtenerDatosDNI() {
                const dni = $('#dni').val();
                if (!dni) return;

                $.ajax({
                    url: `../../controller/pedido.php?op=obtener_dni`,
                    type: 'POST',
                    data: {
                        dni: dni
                    },
                    success: function(response) {
                        const data = JSON.parse(response);
                        if (data.nombre) {
                            $('#nombreDNI').val(data.nombre);
                        } else {
                            toastr.error("No se pudo obtener el nombre del DNI");
                        }
                    },
                    error: function() {
                        toastr.error("Error al obtener los datos del DNI");
                    }
                });
            }

            // Obtener datos de RUC desde el servidor
            function obtenerDatosRUC() {
                const ruc = $('#ruc').val();
                if (!ruc) return;

                $.ajax({
                    url: `../../controller/pedido.php?op=obtener_ruc`,
                    type: 'POST',
                    data: {
                        ruc: ruc
                    },
                    success: function(response) {
                        const data = JSON.parse(response);
                        if (data.razon_social) {
                            $('#razonSocial').val(data.razon_social);
                        } else {
                            toastr.error("No se pudo obtener la razón social del RUC");
                        }
                    },
                    error: function() {
                        toastr.error("Error al obtener los datos del RUC");
                    }
                });
            }


            function cargarDetalleCobro(pedido_id) {
                // Realizar una solicitud AJAX para obtener los detalles del pedido
                $.ajax({
                    url: "../../controller/pedido.php?op=obtener_detalle_pedido",
                    type: "POST",
                    data: {
                        pedido_id: pedido_id
                    },
                    success: function(response) {
                        const data = JSON.parse(response);
                        if (data) {
                            // Llenar los campos del modal con los datos obtenidos
                            $('#pedido_id').text(pedido_id);
                            $('#totalMonto_cobro').val(data.total); // Total del pedido
                            $('#productosCobroContainer').empty(); // Limpiar productos anteriores

                            // Renderizar productos en el modal
                            data.productos.forEach(producto => {
                                $('#productosCobroContainer').append(`
                        <tr>
                            <td>${producto.producto_nom}</td>
                            <td>${producto.pedidod_cantidad}</td>
                            <td>${producto.pedidod_precio_unitario}</td>
                            <td>${producto.total}</td>
                        </tr>
                    `);
                            });
                        } else {
                            toastr.error("Error al obtener los detalles del pedido.");
                        }
                    },
                    error: function() {
                        toastr.error("Error al cargar los detalles del pedido.");
                    }
                });
            }


            function realizarCobro() {
                const pedido_id = $('#pedido_id').text();
                const tipoComprobante = $('input[name="tipoComprobante"]:checked').val(); // Cambiar selector para radio buttons
                const dni = $('#dni').val();
                const ruc = $('#ruc').val();
                const nombreDNI = $('#nombreDNI').val();
                const razonSocial = $('#razonSocial').val();
                const montoIngresado = $('#montoIngresado').val();
                const vuelto = $('#vuelto').val();
                const totalMonto = $('#totalMonto_cobro').val();
                const conceptos = obtenerListaProductos(); // Llama a la función que obtiene el JSON de productos

                $.ajax({
                    url: "../../controller/pedido.php?op=registrar_cobro",
                    type: "POST",
                    data: {
                        pedido_id: pedido_id,
                        total: totalMonto,
                        ingreso: montoIngresado,
                        vuelto: vuelto,
                        tipo_comprobante: tipoComprobante, // Tipo de comprobante seleccionado
                        dni: dni,
                        nombre: nombreDNI,
                        ruc: ruc,
                        razon_social: razonSocial,
                        conceptos: conceptos
                    },
                    success: function(response) {
                        const data = JSON.parse(response);
                        if (data.status === "success") {
                            toastr.success("Cobro registrado exitosamente");
                            listarPedidos(); // Refrescar la lista de pedidos
                            $('#modalCobro').modal('hide');
                        } else {
                            toastr.error("Error al registrar el cobro");
                        }
                    },
                    error: function() {
                        toastr.error("Error al procesar la solicitud");
                    }
                });
            }


            function limpiarFormularioCobro() {
                $('input[name="tipoComprobante"]').prop('checked', false); // Desmarcar los radio buttons
                $('#dni').val('');
                $('#ruc').val('');
                $('#nombreDNI').val('');
                $('#razonSocial').val('');
                $('#totalMonto_cobro').val('');
                $('#montoIngresado').val('');
                $('#vuelto').val('');
                $('#productosCobroContainer').empty(); // Limpiar la lista de productos en la tabla

                // Ocultar campos de DNI y RUC
                $('#campoDNI').hide();
                $('#campoRUC').hide();
            }
        </script>
    </body>

    </html>
<?php
} else {
    header("Location: ../../index.php");
}
?>