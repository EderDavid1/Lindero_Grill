<?php
/* Llamamos al archivo de conexion.php */
require_once("../../config/conexion.php");
if (isset($_SESSION["usua_id_sidc"])) {
  ?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <?php require_once("../html/mainHead.php"); ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>MPCH::Registrar OTROS ORIGENES</title>

  </head>

  <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
      <?php require_once("../html/menu.php"); ?>
      <?php require_once("../html/mainProfile.php"); ?>

      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content" style="margin-top:10px">
          <div class="container-fluid">
            <div class="row" style="padding-top: 20px;">
              <div class="col-md-3" style="    margin-bottom: 10px;">
                <label for="selectPersonas">Seleccionar Persona:</label>
                <select id="selectPersonas" class="form-control select2 select2-danger"
                  data-dropdown-css-class="select2-danger" style="width: 100%;">
                  <option value="">Seleccione una persona</option>
                  <option value="1">Juan Pérez - 12345678</option>
                  <option value="2">Ana Gómez - 23456789</option>
                  <option value="3">Luis Rodríguez - 34567890</option>
                  <option value="4">Marta Fernández - 45678901</option>
                </select>
              </div>
              <div class="col-md-9" style="display: flex;justify-content: flex-end; align-items: center;">
                <button id="btnAgregarPersona" class="btn btn-success" data-toggle="modal"
                  data-target="#modalAgregarPersona">
                  <i class="fa fa-plus"></i> Agregar Persona
                </button>
              </div>
              <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                  <div class="card-body box-profile">
                    <div class="text-center">
                      <img class="profile-user-img img-fluid img-circle" src="../../public/dist/img/user4-128x128.jpg"
                        alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">Nina Mcintire</h3>

                    <p class="text-muted text-center">Inspector</p>

                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Pendientes</b> <a class="float-right">25</a>
                      </li>
                      <li class="list-group-item">
                        <b>Completados</b> <a class="float-right">120</a>
                      </li>
                      <li class="list-group-item">
                        <b>Retrasados</b> <a class="float-right">5</a>
                      </li>
                    </ul>

                    <a href="#" class="btn btn-danger btn-block">
                      <i class="fas fa-trash"></i> <b>Eliminar</b>
                    </a>
                  </div>
                  <!-- /.card-body -->
                </div>

                <!-- /.card -->


                <!-- /.card -->
              </div>
              <!-- /.col -->
              <div class="col-md-9">
                <div class="card">
                  <div class="card-header p-2">
                    <ul class="nav nav-pills">
                      <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Dashboard</a>
                      </li>
                      <li class="nav-item"><a class="nav-link" href="#calendar" data-toggle="tab">Calendario</a></li>
                      <li class="nav-item"><a class="nav-link" href="#perfil" data-toggle="tab">Perfil</a></li>
                    </ul>
                  </div><!-- /.card-header -->
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="active tab-pane" id="activity">
                        <!-- Post -->
                        <div class="row">

                          <!-- Info Box de Desempeño -->
                          <div class="col-md-6">
                            <div class="info-box bg-success">
                              <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>

                              <div class="info-box-content">
                                <span class="info-box-text">Progreso</span>
                                <span class="info-box-number" id="progressPercentage">0%</span>

                                <div class="progress">
                                  <div class="progress-bar" id="progressBar" style="width: 0%"></div>
                                </div>
                                <span class="progress-description">
                                  <span id="progressDescription">0% Completo</span>
                                </span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.col -->

                          </div>
                          <div class="col-md-6">
                            
                              <div class="info-box bg-gradient-warning">
                                <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

                                <div class="info-box-content">
                                  <span class="info-box-text">Events</span>
                                  <span class="info-box-number">41,410</span>

                                  <div class="progress">
                                    <div class="progress-bar" style="width: 70%"></div>
                                  </div>
                                  <span class="progress-description">
                                    70% Increase in 30 Days
                                  </span>
                                </div>
                                <!-- /.info-box-content -->
                              </div>
                            
                          </div>
                          <!-- /.row -->

                          <!-- Tablas de Retrasados y Pendientes -->
                          <div class="row">
                            <!-- Tabla de Retrasados -->
                            <div class="col-md-12">
                              <div class="card">
                                <div class="card-header">
                                  <h3 class="card-title">Retrasados</h3>
                                </div>
                                <div class="card-body">
                                  <table class="table table-bordered">
                                    <thead>
                                      <tr>
                                        <th>Inspector</th>
                                        <th>Rol</th>
                                        <th>RUC</th>
                                        <th>Razón Social</th>
                                        <th>Expediente</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <!-- Ejemplo de datos -->
                                      <tr>
                                        <td>Juan Pérez</td>
                                        <td>Inspector</td>
                                        <td>12345678901</td>
                                        <td>Empresa XYZ S.A.</td>
                                        <td>EXP001</td>
                                      </tr>
                                      <tr>
                                        <td>Ana Gómez</td>
                                        <td>Inspector</td>
                                        <td>23456789012</td>
                                        <td>Comercial ABC S.R.L.</td>
                                        <td>EXP002</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                            <!-- /.col -->

                            <!-- Tabla de Pendientes -->
                            <div class="col-md-12">
                              <div class="card">
                                <div class="card-header">
                                  <h3 class="card-title">Pendientes</h3>
                                </div>
                                <div class="card-body">
                                  <table class="table table-bordered">
                                    <thead>
                                      <tr>
                                        <th>Inspector</th>
                                        <th>Rol</th>
                                        <th>RUC</th>
                                        <th>Razón Social</th>
                                        <th>Expediente</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <!-- Ejemplo de datos -->
                                      <tr>
                                        <td>Luis Rodríguez</td>
                                        <td>Inspector</td>
                                        <td>34567890123</td>
                                        <td>Servicios LM S.A.C.</td>
                                        <td>EXP003</td>
                                      </tr>
                                      <tr>
                                        <td>Marta Fernández</td>
                                        <td>Inspector</td>
                                        <td>45678901234</td>
                                        <td>Industrias PQR</td>
                                        <td>EXP004</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->
                        </div>
                        <!-- /.post -->
                      </div>
                      <style>
                        .tab-pane {
                          position: relative;
                          height: 100%;
                          /* O ajusta según lo necesites */
                          overflow-y: auto;
                          /* Añade barra de desplazamiento si es necesario */
                        }

                        #calendar {
                          max-width: 100%;
                          height: auto;
                          /* Ajustar el tamaño para que no se desborde */
                        }

                        .tab-content {
                          display: flex;
                          flex-direction: column;
                          height: 100%;
                          /* Hace que el contenido del tab ocupe todo el espacio disponible */
                        }

                        .fc .fc-scrollgrid-liquid {
                          height: 400px;
                        }
                      </style>
                      <!-- /.tab-pane -->
                      <div class="tab-pane" style="min-height: 600px;" id="calendar">
                        <!-- THE CALENDAR -->
                        <div id="calendar" style="height: 400px"></div>
                      </div>
                      <!-- /.tab-pane -->

                      <div class="tab-pane" id="perfil">
                        <form class="form-horizontal">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label for="inputName" class="col-sm-4 col-form-label">Nombre</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="inputName" placeholder="Nombre">
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group row">
                                <label for="inputPaterno" class="col-sm-4 col-form-label">Apellido Paterno</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="inputPaterno"
                                    placeholder="Apellido Paterno">
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group row">
                                <label for="inputMaterno" class="col-sm-4 col-form-label">Apellido Materno</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="inputMaterno"
                                    placeholder="Apellido Materno">
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group row">
                                <label for="inputDNI" class="col-sm-4 col-form-label">DNI</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="inputDNI" placeholder="DNI">
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group row">
                                <label for="inputTelefono" class="col-sm-4 col-form-label">Número de Teléfono</label>
                                <div class="col-sm-8">
                                  <input type="tel" class="form-control" id="inputTelefono"
                                    placeholder="Número de Teléfono">
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group row">
                                <label for="inputEmail" class="col-sm-4 col-form-label">Correo Electrónico</label>
                                <div class="col-sm-8">
                                  <input type="email" class="form-control" id="inputEmail"
                                    placeholder="Correo Electrónico">
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group row">
                                <label for="inputDireccion" class="col-sm-4 col-form-label">Dirección</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="inputDireccion" placeholder="Dirección">
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group row">
                                <label for="inputUbigeo" class="col-sm-4 col-form-label">Ubigeo</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="inputUbigeo" placeholder="Ubigeo">
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group row">
                                <label for="selectDepartamento" class="col-sm-4 col-form-label">Departamento</label>
                                <div class="col-sm-8">
                                  <select id="selectDepartamento" class="form-control">
                                    <option value="">Seleccione un departamento</option>
                                    <option value="01">Lima</option>
                                    <option value="02">Arequipa</option>
                                    <!-- Más opciones -->
                                  </select>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group row">
                                <label for="selectProvincia" class="col-sm-4 col-form-label">Provincia</label>
                                <div class="col-sm-8">
                                  <select id="selectProvincia" class="form-control">
                                    <option value="">Seleccione una provincia</option>
                                    <option value="01">Lima</option>
                                    <option value="02">Arequipa</option>
                                    <!-- Más opciones -->
                                  </select>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group row">
                                <label for="selectDistrito" class="col-sm-4 col-form-label">Distrito</label>
                                <div class="col-sm-8">
                                  <select id="selectDistrito" class="form-control">
                                    <option value="">Seleccione un distrito</option>
                                    <option value="01">Miraflores</option>
                                    <option value="02">Cercado de Arequipa</option>
                                    <!-- Más opciones -->
                                  </select>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group row">
                                <label for="inputFechaNacimiento" class="col-sm-4 col-form-label">Fecha de
                                  Nacimiento</label>
                                <div class="col-sm-8">
                                  <input type="date" class="form-control" id="inputFechaNacimiento">
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group row">
                                <label for="selectSexo" class="col-sm-4 col-form-label">Sexo</label>
                                <div class="col-sm-8">
                                  <select id="selectSexo" class="form-control">
                                    <option value="">Seleccione el sexo</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                  </select>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group row">
                                <div class="offset-sm-4 col-sm-8">
                                  <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i> Guardar
                                  </button>
                                  <button type="button" class="btn btn-secondary"
                                    onclick="window.location.href='URL_A_CANCELAR'">
                                    <i class="fa fa-times"></i> Cancelar
                                  </button>
                                </div>
                              </div>
                            </div>

                          </div>
                        </form>

                      </div>
                      <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                  </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>
      </div>
      <?php require_once("../html/footer.php"); ?>
      <?php require_once("modal_form.php"); ?>

      <?php require_once("../html/mainjs.php"); ?>


      <script type="text/javascript" src="otros_registros.js"></script>
      <script type="text/javascript" src="calendar_controller.js"></script>

    </div>
  </body>

  </html>
  <?php
} else {
  header("Location: " . Conectar::ruta() . "index.php");
}
?>