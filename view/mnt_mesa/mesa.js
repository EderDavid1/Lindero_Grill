$(document).ready(function() {
    listarMesas();
  
    // Enviar formulario para registrar o actualizar mesa
    $("#formMesa").on("submit", function(e) {
      e.preventDefault();
      var mesa_id = $("#mesa_id").val();
      var action = mesa_id === "" ? "insertar_mesa" : "insertar_mesa";
  
      $.ajax({
        url: "../../controller/mesa.php?op=" + action,
        type: "POST",
        data: $(this).serialize(),
        success: function(response) {
          if (response.includes("correctamente")) {
            toastr.success(response, "¡Éxito!");
          } else {
            toastr.error("Hubo un error al procesar la solicitud.", "Error");
          }
          $("#modal_mesa").modal("hide");
          listarMesas();
        },
        error: function() {
          toastr.error("Error en el servidor o la red. Inténtalo de nuevo.", "Error");
        }
      });
    });
  });
  
  // Función para listar las mesas
  function listarMesas() {
    $.ajax({
      url: "../../controller/mesa.php?op=listar_mesas",
      type: "GET",
      success: function(response) {
        $("#MesaContainer").html(response); // Asegúrate de tener un contenedor adecuado en tu HTML
      },
      error: function() {
        toastr.error("Error al cargar las mesas. Inténtalo de nuevo.", "Error");
      }
    });
  }
  
  // Función para cargar los datos de una mesa en el formulario y editar
  function editarMesa(mesa_id) {
    $.ajax({
      url: "../../controller/mesa.php?op=ver_mesa",
      type: "POST",
      data: { mesa_id: mesa_id },
      success: function(data) {
        try {
          var mesa = JSON.parse(data);
          $("#mesa_id").val(mesa.mesa_id); // Coloca el mesa_id en el campo oculto
          $("#mesa_nmr").val(mesa.mesa_nmr);
          $("#mesa_sillas_num").val(mesa.mesa_sillas_num);
          $("#mesa_est").val(mesa.mesa_est);
          $("#modal_mesa").modal("show");
        } catch (e) {
          toastr.error("Error al cargar los datos de la mesa.", "Error");
        }
      },
      error: function() {
        toastr.error("Error al cargar la mesa seleccionada.", "Error");
      }
    });
  }
  
 // Función para eliminar una mesa (cambiar su estado a 0)
function eliminarMesa(mesa_id) {
    // Usando Swal.fire para confirmar la eliminación
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás recuperar esta mesa después de eliminarla!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "../../controller/mesa.php?op=eliminar_mesa",
                type: "POST",
                data: { mesa_id: mesa_id },
                success: function(response) {
                    toastr.success(response, "¡Éxito!");
                    listarMesas(); // Actualiza la lista de mesas
                },
                error: function() {
                    toastr.error("Error al eliminar la mesa.", "Error");
                }
            });
        }
    });
}

  