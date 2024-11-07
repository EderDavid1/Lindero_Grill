$(document).ready(function () {
    cargarCobros();
    cargarResumenDia();
    cargarMesas();
    
    $('#tablaCobros').DataTable({
        "paging": true,
        "searching": false,
        "ordering": false,
        "info": false
    });
});

function cargarMesas() {
    $.ajax({
        url: "../../controller/cobro.php?op=listar_mesas",
        type: "POST",
        dataType: "json",
        success: function (data) {
            let mesaDropdown = $("#mesa");
            data.forEach(mesa => {
                mesaDropdown.append(`<option value="${mesa.mesa_id}">${mesa.mesa_nmr}</option>`);
            });
        }
    });
}

function cargarCobros(filtros = {}) {
    $.ajax({
        url: "../../controller/cobro.php?op=listar_cobros",
        type: "POST",
        data: filtros,
        dataType: "json",
        success: function (data) {
            const tbody = $("#cobrosContainer");
            tbody.empty();
            let totalMonto = 0;

            data.forEach(cobro => {
                let pedidoIdFormatted = cobro.pedido_id.toString().padStart(6, '0');
                let fechaFormatted = new Date(cobro.fechacrea).toLocaleString('es-ES', { hour12: false, hour: "2-digit", minute: "2-digit", year: "numeric", month: "2-digit", day: "2-digit" });

                // Asegurarse de que `cob_total` sea un número antes de usar `.toFixed()`
                let cobTotal = parseFloat(cobro.cob_total) || 0;
                let cobIngreso = parseFloat(cobro.cob_ingreso) || 0;
                let cobVuelto = parseFloat(cobro.cob_vuelto) || 0;

                totalMonto += cobTotal;

                tbody.append(`
                    <tr>
                        <td>${cobro.cob_id}</td>
                        <td>#${pedidoIdFormatted}</td>
                        <td>${cobTotal.toFixed(2)}</td>
                        <td>${cobIngreso.toFixed(2)}</td>
                        <td>${cobVuelto.toFixed(2)}</td>
                        <td>${cobro.tipo_comprobante == '1' ? 'Boleta' : 'Factura'}</td>
                        <td>${cobro.cob_nombre || cobro.cob_razon_social}</td>
                        <td>${fechaFormatted}</td>
                        <td><button class="btn btn-secondary btn-sm" onclick="imprimirComprobante(${cobro.cob_id})">Imprimir</button></td>
                    </tr>
                `);
            });

            // Mostrar el total acumulado en el pie de tabla
            $("#totalMonto").text(totalMonto.toFixed(2));
        }
    });
}

function cargarResumenDia() {
    $.ajax({
        url: "../../controller/cobro.php?op=resumen_dia",
        type: "POST",
        dataType: "json",
        success: function (data) {
            $("#resumenCobros").text(`Total de cobros: ${data.cantidad_cobros}, Ingreso total: S/${data.total_ingresado}, Vuelto total: S/${data.total_vuelto}`);
        }
    });
}
function imprimirComprobante(cobroId) {
    $.ajax({
        url: "../../controller/cobro.php?op=generar_pdf",
        type: "POST",
        data: { cobro_id: cobroId },
        xhrFields: {
            responseType: 'blob' // Necesario para manejar el PDF como un archivo
        },
        success: function (response) {
            const blob = new Blob([response], { type: 'application/pdf' });
            const link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = `comprobante_${cobroId}.pdf`;
            link.click();
        },
        error: function () {
            alert("Error al generar el comprobante.");
        }
    });
}

function filtrarCobros() {
    const fechaInicio = $("#fechaInicio").val();
    const fechaFin = $("#fechaFin").val();
    const mesa = $("#mesa").val();
    const tipoComprobante = $("#tipoComprobante").val();

    const filtros = { fechaInicio, fechaFin, mesa, tipoComprobante };
    
    cargarCobros(filtros);
}

function imprimirComprobante(cobroId) {
    window.open(`../../controller/cobro.php?op=generar_comprobante&cobro_id=${cobroId}`, '_blank');
}
