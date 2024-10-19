var ciudadano_id = $("#ciudadano_idx").val();


$(document).ready(function () {
  $("#ciudadanosdetalles_form").submit(function (e) {
    e.preventDefault(); // Previene el envío normal del formulario

    var data = {
      ciud_numero_documento: $("#ciudadano_doc").val(),
      nuevo_email: $("#deemail").val(),
      ciud_nombre: $("#ciudadano_nombre").val(),
      ciud_primer_apellido: $("#ciudadano_apep").val(),
      ciud_segundo_apellido: $("#ciudadano_apem").val(),
      ciud_direccion: $("#ciudadano_direccion").val(),
      nuevo_telefono: $("#detelefo").val(),
      ubdep: $("#ciudadano_departamento").val(),
      ubprv: $("#ciudadano_provincia").val(),
      ubdis: $("#ciudadano_distrito").val(),
      action: "update_ciudadano_data" // Acción para identificar el tipo de solicitud
    };

    $.ajax({
      type: "POST",
      url: "../../controller/ciudadano.php?op=update_ciudadano_data", // Cambia esto a la ruta correcta del script PHP que maneja la solicitud
      data: data,
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          Swal.fire({
            icon: 'success',
            title: 'Actualización Exitosa',
            text: response.message,
            confirmButtonText: 'Aceptar'
          })
          $("#ciudadanoModal").modal("hide");
          if ($('#search').val() === '') {
            loadTableData()
          } else {
            search_int();
          }



        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: response.message,
            confirmButtonText: 'Aceptar'
          });
        }
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'No se pudo realizar la actualización.',
          confirmButtonText: 'Aceptar'
        });
      }
    });
  });
});

function editar(doc) {
  $("#ciudadanoModal").modal("show");
  
  // Formatea el valor de 'doc' a 8 caracteres con ceros a la izquierda
  let formattedDoc = doc.toString().padStart(8, '0');

  // Llama a la función 'buscarDNI' con el valor formateado
 
  $("#ciudadano_doc").val(formattedDoc);
  buscarDNI(formattedDoc);
}



var area_id = 0;
var proced_id = 0;

$(document).ready(function () {
  $(".select2").select2();
  validarCheckCiud();
});


function validarCheckCiud() {
  var ciudadano_nombre = $("#ciudadano_nombre").val();
  var ciud_id = $("#ciud_id").val();

  var $iconoCheck = $(".estado-icono .fa-check");
  var $iconoClose = $(".estado-icono .fa-close");
  if (ciudadano_nombre !== "" && ciud_id !== "") {
    // Todos los campos tienen valores, mostrar el ícono de check y ocultar el de close
    $iconoCheck.show();
    $iconoClose.hide();
  } else {
    // Al menos uno de los campos está vacío, mostrar el ícono de close y ocultar el de check
    $iconoCheck.hide();
    $iconoClose.show();
  }
}
function buscarDNI(ciudadano_doc) {
  // Obtener el valor del checkbox seleccionado


  // Verificar qué tipo de documento está seleccionado

  var ciudadano_doc = $("#ciudadano_doc").val();
  $.post(
    "../../controller/ciudadano.php?op=consultar_dni",
    { ciudadano_doc: ciudadano_doc },
    function (data) {
      // Verifica si data no está vacía
      if (data.trim() !== "") {
        // Parsea la respuesta JSON del servidor
        var response = JSON.parse(data);

        // Verifica si se encontró la persona
        if (response.ciudadano_nombre) {
          $("#ciudadano_nombre").val(response.ciudadano_nombre);
          $("#ciudadano_apep").val(response.ciudadano_apep);
          $("#ciudadano_apem").val(response.ciudadano_apem);
          $("#ciud_id").val(response.ciudadano_id);
          $("#ciudadano_direccion").val(response.ciudadano_direccion);
          $("#deemail").val(response.deemail);
          $("#detelefo").val(response.detelefo);
          validarCheckCiud();
          if ($('#search').val() === '') {
            loadTableData();
          } else {
            search_int();
          }
          $("#ciud_mensaje")
            .text("Ciudadano encontrado")
            .css("color", "green")
            .show();
          // Verifica si se recibió la foto del ciudadano
          // Extrae el departamento, provincia y distrito (asume que estos campos están en la respuesta)
          let departamento = response.departamento || "";
          let provincia = response.provincia || "";
          let distrito = response.distrito || "";

          // Carga los datos de dirección en los selectores correspondientes
          if (departamento) {

            setSelectValue('#ciudadano_departamento', departamento, 100); // Intento cada 100 ms

          }

          if (provincia) {
            setTimeout(function () {
              setSelectValue('#ciudadano_provincia', provincia, 100); // Intento cada 100 ms

            }, 200); // Espera 400 ms antes de ejecutar el trigger para la provincia
          }

          if (distrito) {
            setTimeout(function () {
              setSelectValue('#ciudadano_distrito', distrito, 100); // Intento cada 100 ms

            }, 300); // Espera 600 ms antes de ejecutar el trigger para el distrito
          }

        } else {
          // Si no se encuentra a la persona, muestra el mensaje "No encontrado" en rojo
          $("#ciud_mensaje").text(response.error).css("color", "red").show();
          validarCheckCiud();
        }
      } else {
        // Si no se encuentra a la persona, muestra el mensaje "No encontrado" en rojo
        $("#ciud_mensaje")
          .text("Ciudadano no encontrado")
          .css("color", "red")
          .show();
      }
    }
  );


}


function combo_areas() {
  $.post("../../controller/procedimiento.php?op=getAreas_usu", function (data) {
    $("#area_id").html(data);
    $("#area_id").prop("selectedIndex", 1);
    combo_proced($("#area_id").val());
  });
}





function mostrarError() {
  swal.fire({
    title: "Error!",
    text: "Ciudadano no encontrado",
    icon: "error",
    confirmButtonText: "Aceptar"
  });
}

$(document).ready(function () {
  // Función para cargar los departamentos
  function cargarDepartamentos() {
    $.ajax({
      url: "../../controller/ciudadano.php?op=get_direccion_data",
      method: "POST",
      dataType: "json",
      success: function (data) {
        let departamentos = {};
        data.forEach(function (item) {
          if (!departamentos[item.ubdep]) {
            departamentos[item.ubdep] = item.nodep;
          }
        });

        $('#ciudadano_departamento').empty().append('<option value="">Selecciona un departamento</option>');
        $.each(departamentos, function (key, value) {
          $('#ciudadano_departamento').append('<option value="' + key + '">' + value + '</option>');
        });
        $('#ciudadano_departamento').select2({
          dropdownParent: $('#ciudadanoModal .modal-body')
        });

      }
    });
  }

  // Función para cargar las provincias basadas en el departamento seleccionado
  function cargarProvincias(departamento) {
    $.ajax({
      url: "../../controller/ciudadano.php?op=get_direccion_data",
      method: "POST",
      dataType: "json",
      success: function (data) {
        let provincias = {};
        data.forEach(function (item) {
          if (item.ubdep === departamento && !provincias[item.ubprv]) {
            provincias[item.ubprv] = item.noprv;
          }
        });

        $('#ciudadano_provincia').empty().append('<option value="">Selecciona una provincia</option>');
        $('#ciudadano_provincia').select2({
          dropdownParent: $('#ciudadanoModal .modal-body')
        });
        $.each(provincias, function (key, value) {
          $('#ciudadano_provincia').append('<option value="' + key + '">' + value + '</option>');
        });
      }
    });
  }

  // Función para cargar los distritos basados en la provincia seleccionada
  function cargarDistritos(departamento, provincia) {
    $.ajax({
      url: "../../controller/ciudadano.php?op=get_direccion_data",
      method: "POST",
      dataType: "json",
      success: function (data) {
        let distritos = {};
        data.forEach(function (item) {
          if (item.ubdep === departamento && item.ubprv === provincia) {
            distritos[item.ubdis] = item.nodis;
          }
        });

        $('#ciudadano_distrito').empty().append('<option value="">Selecciona un distrito</option>');
        $.each(distritos, function (key, value) {
          $('#ciudadano_distrito').append('<option value="' + key + '">' + value + '</option>');
        });
        $('#ciudadano_distrito').select2({
          dropdownParent: $('#ciudadanoModal .modal-body')
        });
      }
    });
  }

  // Cargar departamentos al inicio
  cargarDepartamentos();

  // Cargar provincias cuando se selecciona un departamento
  $('#ciudadano_departamento').change(function () {
    let departamento = $(this).val();
    cargarProvincias(departamento);
    $('#ciudadano_distrito').empty().append('<option value="">Selecciona un distrito</option>'); // Reset distritos
  });

  // Cargar distritos cuando se selecciona una provincia
  $('#ciudadano_provincia').change(function () {
    let departamento = $('#ciudadano_departamento').val();
    let provincia = $(this).val();
    cargarDistritos(departamento, provincia);
  });
});
function limitarDigitos(input, cant) {
  let valor = input.value.toString().replace(/\D/g, ''); // Remover caracteres no numéricos

  const max_length = cant; // Por defecto, límite de 11 dígitos para RUC

  if (valor.length > max_length) {
    valor = valor.slice(0, max_length); // Truncar el valor si excede el límite
  }
  input.value = valor;
}

function setSelectValue(selector, value, timeout) {
  var interval = setInterval(function () {
    var currentValue = $(selector).val();
    if (currentValue === value) {
      clearInterval(interval); // Detiene el bucle cuando el valor es el esperado
    } else {
      $(selector).val(value).trigger('change'); // Intenta establecer el valor
    }
  }, timeout); // Intervalo de tiempo entre cada intento
}



