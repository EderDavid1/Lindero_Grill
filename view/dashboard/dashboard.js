$(document).ready(function() {
    // Hacer tarjetas movibles
    $(".draggable").sortable({
        connectWith: ".draggable",
        handle: ".card-header",
        placeholder: "sort-highlight",
        forcePlaceholderSize: true,
        zIndex: 999999
    });

    // Cambiar filtros de tiempo dinámicamente
    $('#filtroTiempo').on('change', function() {
        const filtro = $(this).val();
        let filtroHtml = '';

        if (filtro === 'mensual') {
            // Selector de Mes en columnas
            filtroHtml = '<div class="row">' +
                         '<div class="col-md-6">' +
                         '<label for="mesSelect">Seleccionar Mes</label>' +
                         '<select class="form-control" id="mesSelect">' +
                         '<option value="01">Enero</option>' +
                         '<option value="02">Febrero</option>' +
                         '<option value="03">Marzo</option>' +
                         '<!-- Otros meses aquí -->' +
                         '</select>' +
                         '</div>' +
                         '</div>';
        } else if (filtro === 'anual') {
            // Selector de Año en columnas
            filtroHtml = '<div class="row">' +
                         '<div class="col-md-6">' +
                         '<label for="anioSelect">Seleccionar Año</label>' +
                         '<select class="form-control" id="anioSelect">' +
                         '<option value="2023">2023</option>' +
                         '<option value="2024">2024</option>' +
                         '<!-- Otros años aquí -->' +
                         '</select>' +
                         '</div>' +
                         '</div>';
        } else if (filtro === 'personalizado') {
            // Campos de Fecha Personalizada en columnas
            filtroHtml = '<div class="row">' +
                         '<div class="col-md-6">' +
                         '<label for="fechaInicio">Fecha de Inicio</label>' +
                         '<input type="date" id="fechaInicio" class="form-control" />' +
                         '</div>' +
                         '<div class="col-md-6">' +
                         '<label for="fechaFin">Fecha de Fin</label>' +
                         '<input type="date" id="fechaFin" class="form-control" />' +
                         '</div>' +
                         '</div>';
        }

        // Insertar el HTML en el contenedor dinámico
        $('#filtroDinamico').html(filtroHtml);
    });

    // Llamar a la función de gráficos (ejemplo: Ganancia por Plato)
    cargarGananciaPorPlato();
    cargarPedidosPorMes();  
});

// Función para cargar datos del gráfico de Ganancia por Plato
function cargarGananciaPorPlato() {
    $.ajax({
        url: '../../controller/dashboard.php?op=ganancia_por_plato',
        type: 'GET',
        success: function(response) {
            const datos = JSON.parse(response);
            const labels = datos.map(item => item.producto_nom);
            const valores = datos.map(item => item.ganancia_total);

            new Chart(document.getElementById("gananciaPorPlatoChart"), {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Ganancia por Plato (S/)",
                        data: valores,
                        backgroundColor: "rgba(75, 192, 192, 0.5)",
                        borderColor: "rgba(75, 192, 192, 1)",
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    });
}
// Función para cargar los pedidos por mes
function cargarPedidosPorMes() {
    $.ajax({
        url: '../../controller/dashboard.php?op=pedidos_por_mes',
        type: 'GET',
        success: function(response) {
            const datos = JSON.parse(response);
            
            // Preparar las etiquetas y valores para el gráfico
            const meses = datos.map(item => {
                const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
                return monthNames[item.mes - 1] + ' ' + item.año;
            });
            const pedidos = datos.map(item => item.total_pedidos);

            // Crear el gráfico de pedidos por mes
            new Chart(document.getElementById("pedidos_mesnuales"), {
                type: "bar",
                data: {
                    labels: meses,
                    datasets: [{
                        label: "Pedidos por Mes",
                        data: pedidos,
                        backgroundColor: "rgba(75, 192, 192, 0.5)",
                        borderColor: "rgba(75, 192, 192, 1)",
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    });
}

$(document).ready(function() {
    // Obtener y mostrar la cantidad de pedidos
    $.ajax({
        url: '../../controller/dashboard.php?op=getCantidadPedidos',
        type: 'GET',
        success: function(response) {
            const data = JSON.parse(response);
            $('#cantidad_pedidos').text(data.cantidad_pedidos);  // Actualiza la cantidad de pedidos
        }
    });

    // Obtener y mostrar los ingresos totales
    $.ajax({
        url: '../../controller/dashboard.php?op=getIngresosTotales',
        type: 'GET',
        success: function(response) {
            const data = JSON.parse(response);
            $('#ingresos_totales').text(data.ingresos_totales);  // Actualiza los ingresos totales
        }
    });
});
