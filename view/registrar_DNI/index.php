<?php
/* Llamamos al archivo de conexion.php */
require_once("../../config/conexion.php");
if (isset($_SESSION["usua_id_masgd"])) {
  ?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <?php require_once("../html/mainHead.php"); ?>
    <link rel="stylesheet" href="css/style.css">
    <title>MPCH::Registrar DNI</title>
  </head>

  <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">

      <?php require_once("../html/mainProfile.php"); ?>
      <?php require_once("../html/menu.php"); ?>

      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">

          <div class="container-fluid">
            <!-- Data Table -->
            <div class="card">

              <div class="card-header">
                <h3 class="card-title">Lista de Ciudadanos</h3>
                <!-- Button to Open Modal -->
                <button type="button" class="btn btn-primary float-right" onclick="nuevo()">
                  <i class="fa fa-plus"></i> Agregar Ciudadano
                </button>
              </div>
              <div class="card-body">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" id="search" name="de_raz_soc_otr" placeholder="Buscar..."
                    style="text-transform: uppercase;" />
                  <div class="input-group-append">
                    <button class="btn btn-primary" id="btnBuscar" type="button">
                      <i class="fa fa-search"></i>
                    </button>
                  </div>
                </div>
                <div style="overflow-x: scroll;">
                <table id="ciudadanosTable" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>DNI</th>
                      <th>Nombre</th>
                      <th>Domicilio</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Aquí se cargarán los datos de la base de datos dinámicamente -->
                  </tbody>
                </table>
                </div>
                

              </div>
            </div>
          </div>

        </section>
        <!-- /.content -->
      </div>

      <?php require_once("../html/footer.php"); ?>
      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
    </div>
    <?php require_once("modal_ciudadano.php"); ?>
    <?php require_once("../html/mainjs.php"); ?>
    <script type="text/javascript" src="usudetalleciudadano.js"></script>
    <script>
      function nuevo() {
        $("#ciudadanoModal").modal("show");
        clearModalInputs();
      }

      function clearModalInputs() {
        // Limpia los valores de los inputs

        // Limpia el valor del input oculto
        $('#ciud_id').val('');
        $('#ciudadano_doc').val('');
        $('#ciudadano_nombre').val('');
        $('#ciudadano_apep').val('');
        $('#ciudadano_apem').val('');
        $('#ciudadano_direccion').val('');
        $('#detelefo').val('');
        $('#deemail').val('');
        $('#ciudadano_departamento').val('').trigger('change');
        $('#ciudadano_provincia').val('').trigger('change');
        $('#ciudadano_distrito').val('').trigger('change');


        // Oculta los mensajes si los hay
        $('#ciud_mensaje').hide();
      }


      $(document).ready(function () {
        // Función para cargar los datos en la tabla
        // Función para manejar la búsqueda
        $("#btnBuscar").on('click', function (event) {
          event.preventDefault();
          if ($('#search').val() === '') {
            loadTableData()
          } else {
            search_int();
          }
        });
        loadTableData();
      });
      function loadTableData() {
        $.ajax({
          url: '../../controller/ciudadano.php?op=get_top_10',
          method: 'GET',
          dataType: 'json',
          success: function (response) {
            // Limpia el contenido actual de la tabla
            $('#ciudadanosTable tbody').empty();

            // Itera sobre los datos recibidos y añade filas a la tabla
            $.each(response, function (index, item) {
              $('#ciudadanosTable tbody').append(
                `<tr>
                              <td>${item.nulem}</td>
                              <td>${item.deapp} ${item.deapm} ${item.denom}</td>
                              <td>${item.dedomicil}</td>
                              <td>
                                <button type="button" class="btn btn-warning btn-sm" onclick="editar(${item.nulem})">Editar</button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="eliminar(${item.nulem})">Eliminar</button>
                              </td>
                            </tr>`
              );
            });
          },
          error: function () {
            console.error('Error al cargar los datos.');
          }
        });
      }

      // Carga los datos cuando la página está lista
      function eliminar(val) {

        Swal.fire({
          icon: 'warning',
          title: 'Acceso Denegado',
          text: 'No tiene el nivel necesario para realizar esta operación. Por favor, contactarse con la Gerencia de Tecnología de la Municipalidad Provincial de Chiclayo.',
          timer: 5000, // 5 segundos
          timerProgressBar: true,
          showConfirmButton: false,
          willClose: () => {
            // Opcional: alguna acción cuando el Swal se cierre
          }
        });

      }

      // Ejemplo de función para obtener el nivel del usuario
      function obtenerNivelUsuario() {
        // Aquí iría la lógica para determinar el nivel del usuario
        // Podría ser una llamada AJAX, lectura de una variable de sesión, etc.
        return 3; // Valor de ejemplo
      }

    </script>
    <script>
      function showText() {
        var button = document.querySelector('.btn-group button');;
        button.style.transform = 'scale(1.1)'; // Aumenta un poco el tamaño
        button.style.transition = 'transform 0.5s'; // Ajusta la duración de la transición
      }

      function hideText() {
        var button = document.querySelector('.btn-group button');
        button.innerHTML = '<i class="fa fa-refresh"></i>'; // Vuelve al icono solo
        button.style.transform = 'scale(1)'; // Restaura el tamaño original
      }
    </script>
    <script>




      function limitarADigitosDocumento(input) {
        let valor = input.value.toString().replace(/\D/g, ''); // Remover caracteres no numéricos

        const max_length = 11; // Por defecto, límite de 11 dígitos para RUC

        if (valor.length > max_length) {
          valor = valor.slice(0, max_length); // Truncar el valor si excede el límite
        }
        input.value = valor;
      }

    </script>
    <script>
      function limitabuscadni(input) {
        let valor = input.value.toString().replace(/\D/g, '');
        let max_length = 8; // Por defecto, límite de 8 dígitos para DNI


        // Limitar el valor al máximo permitido
        if (valor.length > max_length) {
          valor = valor.slice(0, max_length);
        }
        // Realizar acciones dependiendo de la longitud del valor
        if (valor.length === max_length) {
          resetearCampos();
          validarCheckCiud();
          buscarDNI(valor);
          $("#spinner-ciud").remove();
        } else if (valor.length < max_length) {

          resetearCampos();
          validarCheckCiud();

          // Mostrar el mensaje "Buscando..." y agregar el spinner si no existe
          if ($("#spinner-ciud").length === 0) {
            var spinner = $("<i>").addClass("fa fa-spinner fa-spin").attr("id", "spinner-ciud");
            $("#ciud_mensaje").text("Buscando... ").css("color", "grey").append(spinner).show();
          }

        }
        if (valor.length == 0) {

          resetearCampos();
          validarCheckCiud();
          // Remover el spinner
          $("#spinner-ciud").removeClass("fa fa-spinner fa-spin");
          $("#ciud_mensaje").text("Buscando...").css("color", "green").hide();
          // Remover el spinner
          $("#spinner-ciud").remove();

        }

        input.value = valor;
      }
      function search_int() {
        var searchValue = $("#search").val();

        // Hacer la llamada AJAX para buscar y actualizar la tabla
        $.ajax({
          url: '../../controller/ciudadano.php?op=buscar',
          type: 'POST',
          data: { val: searchValue }, // Cambia 'otros_origenes_input' a 'val' según el endpoint
          dataType: 'json',
          success: function (data) {
            var $tbody = $("#ciudadanosTable tbody");
            $tbody.empty(); // Limpiar el contenido de la tabla

            // Llenar la tabla con los datos recibidos
            $.each(data, function (index, item) {
              $tbody.append(
                `<tr>
                              <td>${item.nulem}</td>
                              <td>${item.deapp} ${item.deapm} ${item.denom}</td>
                              <td>${item.dedomicil}</td>
                              <td>
                                <button type="button" class="btn btn-warning btn-sm" onclick="editar(${item.nulem})">Editar</button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="eliminar(${item.nulem})">Eliminar</button>
                              </td>
                            </tr>`
              );
            });
          },
          error: function (xhr, status, error) {
            console.error("Error en la búsqueda:", error);
          }
        });
      }


      function resetearCampos() {
        // Limpiar los campos de texto
        $("#ciudadano_nombre").val('');
        $("#ciudadano_apep").val('');
        $("#ciudadano_apem").val('');
        $("#ciud_id").val('');
        $("#ciudadano_direccion").val('');
        $("#deemail").val('');
        $("#detelefo").val('');

        // Limpiar los selectores y restablecer a su estado inicial
        $("#ciudadano_departamento").val('').trigger('change');
        $("#ciudadano_provincia").val('').trigger('change');
        $("#ciudadano_distrito").val('').trigger('change');



        // Limpiar los mensajes y otros elementos si es necesario
        $("#ciud_mensaje").text('').hide();
      }



      function limitartel(input) {
        let valor = input.value.toString().replace(/\D/g, '');
        if (valor.length > 9) {
          valor = valor.slice(0, 9);
        }
        input.value = valor;
      }
    </script>
  </body>

  </html>
  <?php
} else {
  /* Si no a iniciado sesion se redireccionada a la ventana principal */
  header("Location:" . Conectar::ruta() . "views/404/");
}
?>