$(document).ready(function () {
  // Inicializar datatable
  var table = $('#SolicitudTable').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url": "../../controller/expediente_proxy.php",  // Ruta actualizada al archivo PHP
      "type": "POST",
      "dataSrc": function (json) {
        if (json.success) {
          return json.data; // Usar el campo "data" de la respuesta si es exitoso
        } else {
          // Si hay un error, mostrar notificación con Toastr
          toastr.error("Error al cargar los expedientes: " + json.message, "Error");
          return [];
        }
      },
      "error": function (xhr, error, code) {
        // Si la solicitud falla (problema con el servidor, CORS, etc.)
        toastr.error("Error al comunicarse con el servidor. Inténtalo de nuevo.", "Error");
      }
    },
    "columns": [
      { "data": "expediente", "title": "Expediente" },
      { "data": "documento", "title": "Documento" },
      { "data": "fecha_emision", "title": "Fecha de Emisión" },
      { "data": "dependencia_origen", "title": "Dependencia Origen" },
      { "data": "dependencia_destino", "title": "Dependencia Destino" },
      {
        "data": null,
        "render": function (data, type, row) {
          return `<button class="btn btn-sm btn-info" onclick="editar('${row.expediente}')">Editar</button>`;
        },
        "title": "Acciones"
      }
    ]
  });

  // Acción para el botón de buscar
  $('#btnBuscar').on('click', function () {
    table.search($('#search').val()).draw();
  });
});


function listarFunciones() {
  $.ajax({
    url: "../../controller/solicitud.php?op=combo_funcion",
    type: "POST",
    dataType: "html",
    success: function (data) {
      $("#soli_funcion").select2();
      $("#soli_funcion").html(data);

      // Agregar evento change
      $("#soli_funcion").on("change", function () {
        let funcId = $(this).val();
        listarSubfunciones(funcId);
        const card = document.getElementById("card_stick");
      });
    },
    error: function (xhr, status, error) {
      console.error("Error en la solicitud AJAX:", status, error);
    }
  });
}
function listarSubfunciones(funcId) {
  document.getElementById('riesgo_incendio').innerText = '';
  document.getElementById('riesgo_colapso').innerText = '';
  $.ajax({
    url: "../../controller/solicitud.php?op=subfunciones",
    type: "POST",
    data: { func_id: funcId },
    dataType: "json",
    success: function (data) {
      if (Array.isArray(data) && data.length > 0) {
        let html = "";
        data.forEach(function (item) {
          html += `
            <tr>
              <td>${item.subfun_nom}</td>
              <td style="text-align: center;">
                <input type="radio" id="subfunc_${item.subfun_id}" name="subfuncion" value="${item.subfun_id}" style="cursor:pointer;width: 20px; height: 20px;" onchange="mostrarNivelRiesgo(${item.subfun_id})">
              </td>
            </tr>
          `;
        });
        document.querySelector("#subfunciones-table tbody").innerHTML = html;
      }
    },
    error: function (xhr, status, error) {
      console.error("Error en la solicitud AJAX:", status, error);
    }
  });
}
function mostrarNivelRiesgo(subfuncId) {
  $.ajax({
    url: "../../controller/solicitud.php?op=getnivelriesgo",
    type: "POST",
    data: { subfun_id: subfuncId },
    dataType: "json",
    success: function (response) {
      if (response.status === 'success' && response.data.length > 0) {
        const data = response.data[0];  // Accede al primer objeto en el array 'data'

        // Actualizar los niveles de riesgo en los elementos correspondientes
        document.getElementById('riesgo_incendio').innerText = data.niv_ries_inc || 'No disponible';
        document.getElementById('riesgo_colapso').innerText = data.niv_ries_colap || 'No disponible';


      } else {
        // Mostrar mensaje de error si no hay datos
        alert('No se encontraron niveles de riesgo.');
        document.getElementById('riesgo_incendio').innerText = 'No disponible';
        document.getElementById('riesgo_colapso').innerText = 'No disponible';
      }
    },
    error: function (xhr, status, error) {
      console.error("Error al obtener nivel de riesgo:", status, error);
      alert("Ocurrió un error al obtener el nivel de riesgo. Por favor, intenta nuevamente.");
    }
  });
}
