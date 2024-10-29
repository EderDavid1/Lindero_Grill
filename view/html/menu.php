<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <?php if ($_SESSION["rol_id_pdvlg"] == 1) { ?>
    <a href="../registrar_DNI/" class="brand-link text-center"
      style="display: flex; justify-content: center; align-items: center;">
      <span style="font-size: 24px; font-weight: bold;">
        <span class="logo-mpch" style="color: white;">LinderoGrill</span>
        <span class="logo-separator" style="color: white;"> | </span>
        <span class="logo-sgd" style="color: #007bff;">PDVLG</span>
      </span>
    </a>
  <?php } ?>
  <!-- Sidebar -->
  <div class="sidebar" style="padding-top: 20px;">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?php if ($_SESSION["rol_id_pdvlg"] == 1) { ?>
          <li class="nav-header">MANTENIMIENTOS</li>
          <li class="nav-item">
            <a href="../calendario_actividades/" class="nav-link">
              <i class="nav-icon fas fa-chart-line"></i> <!-- Ícono de gráfico para Ventas -->
              <p>Ventas</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../mnt_mesa/" class="nav-link">
              <i class="nav-icon fas fa-concierge-bell"></i> <!-- Ícono de campana para Registrar Mesas -->
              <p>Registrar Mesas</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../mnt_productos/" class="nav-link">
              <i class="nav-icon fas fa-utensils"></i> <!-- Ícono de utensilios para Platos -->
              <p>Productos</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../mnt_usuarios/" class="nav-link">
              <i class="nav-icon fas fa-user-shield"></i> <!-- Ícono de usuario con escudo para Usuarios -->
              <p>Usuarios</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../coordinador_bandeja/" class="nav-link">
              <i class="nav-icon fas fa-cash-register"></i> <!-- Ícono de caja registradora para Caja -->
              <p>Caja</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../registro_informes/" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i> <!-- Ícono de tablero para Dashboard -->
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../tecnico_bandeja/" class="nav-link">
              <i class="nav-icon fas fa-receipt"></i> <!-- Ícono de recibo para Pedidos -->
              <p>Pedidos</p>
            </a>
          </li>

        <?php } ?>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
<script>

</script>