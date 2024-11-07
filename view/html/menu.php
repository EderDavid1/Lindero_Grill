<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <?php if ($_SESSION["rol_id_pdvlg"] == 1) { ?>
    <a href="../caja/" class="brand-link text-center"
      style="display: flex; justify-content: center; align-items: center;">
      <span style="font-size: 24px; font-weight: bold;">
        <span class="logo-mpch" style="color: white;">LinderoGrill</span>
        <span class="logo-separator" style="color: white;"> | </span>
        <span class="logo-sgd" style="color: #ff7500;">PDVLG</span>
      </span>
    </a>
  <?php } ?>
  
  <!-- Sidebar -->
  <div class="sidebar" style="padding-top: 20px;">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
        <!-- Opciones para el Administrador (rol 1) -->
        <?php if ($_SESSION["rol_id_pdvlg"] == 1) { ?>
          <li class="nav-header">MANTENIMIENTOS</li>
          
          <li class="nav-item">
            <a href="../mnt_mesa/" class="nav-link">
              <i class="nav-icon fas fa-concierge-bell"></i>
              <p>Registrar Mesas</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../mnt_productos/" class="nav-link">
              <i class="nav-icon fas fa-utensils"></i>
              <p>Productos</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../mnt_personal/" class="nav-link">
              <i class="nav-icon fas fa-user-shield"></i>
              <p>Personal</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../mnt_usuarios/" class="nav-link">
              <i class="nav-icon fas fa-user-shield"></i>
              <p>Usuarios</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../caja/" class="nav-link">
              <i class="nav-icon fas fa-cash-register"></i>
              <p>Caja</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../dashboard/" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../mnt_pedidos/" class="nav-link">
              <i class="nav-icon fas fa-receipt"></i>
              <p>Pedidos</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../nuevo_pedido/" class="nav-link">
              <i class="nav-icon fas fa-receipt"></i>
              <p>Nuevo pedido</p>
            </a>
          </li>
        
        <!-- Opciones para el Mozo (rol 2) -->
        <?php } elseif ($_SESSION["rol_id_pdvlg"] == 2) { ?>
          <li class="nav-item">
            <a href="../nuevo_pedido/" class="nav-link">
              <i class="nav-icon fas fa-receipt"></i>
              <p>Nuevo pedido</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../mnt_pedidos/" class="nav-link">
              <i class="nav-icon fas fa-receipt"></i>
              <p>Pedidos</p>
            </a>
          </li>
        
        <!-- Opciones para el Cajero (rol 3) -->
        <?php } elseif ($_SESSION["rol_id_pdvlg"] == 3) { ?>
          <li class="nav-item">
            <a href="../caja/" class="nav-link">
              <i class="nav-icon fas fa-cash-register"></i>
              <p>Caja</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../dashboard/" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../mnt_pedidos/" class="nav-link">
              <i class="nav-icon fas fa-receipt"></i>
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
