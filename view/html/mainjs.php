<!-- jQuery -->
<script src="../../public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery UI -->
<script src="../../public/plugins/jquery-ui/jquery-ui.min.js"></script>

<script src="../../public/plugins/select2/js/select2.full.min.js"></script>
<script src="../../public/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../../public/plugins/toastr/toastr.min.js"></script>
<!-- Bootstrap Switch -->
<script src="../../public/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="../../public/plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- Toastr -->
<script src="../../public/dist/js/adminlte.min.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="../../public/plugins/moment/moment.min.js"></script>
<script src="../../public/plugins/fullcalendar/main.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../public/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

<script src="../../public/plugins/jszip/jszip.min.js"></script>
<script src="../../public/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../public/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../public/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../public/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../public/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
  // Función para activar el menú según la URL actual
  function activateMenu() {
    // Obtiene la URL actual
    const currentUrl = window.location.href;

    // Selecciona todos los elementos del menú que tienen enlaces
    const menuItems = document.querySelectorAll('.nav-item a');

    // Itera sobre cada elemento del menú
    menuItems.forEach((item) => {
      // Obtiene el href del enlace actual
      const itemHref = item.href;

      // Verifica si la URL actual contiene el href del menú
      if (currentUrl.includes(itemHref)) {
        // Activa el enlace del menú principal
        item.classList.add('active');

        // Activa la sección padre si existe
        const parentNavItem = item.closest('.nav-item.has-treeview');
        if (parentNavItem) {
          parentNavItem.querySelector('a.nav-link').classList.add('active');
          // Muestra el submenú si no está visible
          const subMenu = parentNavItem.querySelector('.nav-treeview');
          if (subMenu) {
            subMenu.style.display = 'block';
          }
        }
      }
    });
  }

  // Llama a la función cuando la página se carga
  document.addEventListener('DOMContentLoaded', function () {
    activateMenu();

    // Inicializa Select2
    $('.select2').select2({
      theme: 'bootstrap4'
    });
    $('.select2').on('select2:open', function () {
      // Usa un pequeño delay para asegurar que el campo de búsqueda está visible
      setTimeout(function () {
        $('.select2-container .select2-search__field').focus();
      }, 0);
    });
  });
</script>