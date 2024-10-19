$(document).ready(function () {
  // Función para simular la búsqueda de datos por DNI
  function buscarDatosPorDNI(dni) {
      // Aquí puedes hacer una llamada AJAX a tu API para obtener los datos de la persona
      // Este es un ejemplo simulado con datos dummy:
      var personas = {
          "12345678": { nombre: "Juan Pérez", foto: "https://via.placeholder.com/150" },
          "23456789": { nombre: "Ana Gómez", foto: "https://via.placeholder.com/150" },
          "34567890": { nombre: "Luis Rodríguez", foto: "https://via.placeholder.com/150" },
          "45678901": { nombre: "Marta Fernández", foto: "https://via.placeholder.com/150" }
      };
      return personas[dni];
  }

  // Configuración de SweetAlert2 para toasts
  var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
  });

  // Evento para buscar los datos al ingresar el DNI
  $('#dniInput').on('change', function () {
      var dni = $(this).val();
      var datosPersona = buscarDatosPorDNI(dni);

      if (datosPersona) {
          $('#nombreCompleto').val(datosPersona.nombre);
          $('#fotoPersona').attr('src', datosPersona.foto);
          $('#personData').show();

          // Mostrar toast de éxito al encontrar la persona
          Toast.fire({
              icon: 'success',
              title: 'Los datos de la persona fueron encontrados correctamente.'
          });
      } else {
          $('#personData').hide();

          // Mostrar toast de error al no encontrar la persona
          Toast.fire({
              icon: 'error',
              title: 'No se encontraron datos para el DNI ingresado.'
          });
      }
  });

  // Evento para guardar la persona (simulado)
  $('#btnGuardarPersona').on('click', function () {
      // Aquí puedes manejar la lógica de guardar la persona
      Toast.fire({
          icon: 'success',
          title: 'La persona ha sido guardada correctamente.'
      });
      $('#modalAgregarPersona').modal('hide');
  });
});
