<?php
/* Llamamos al archivo de conexion.php */
require_once("../../config/conexion.php");
if (isset($_SESSION["usua_id_pdvlg"])) {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php require_once("../html/mainHead.php"); ?>
        <title>Crear Usuario</title>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <?php require_once("../html/menu.php"); ?>
            <?php require_once("../html/mainProfile.php"); ?>
            <div class="content-wrapper">
                <section class="content">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Crear Usuario</h3>
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalPermiso">Registrar Permiso</button>
                            </div>
                            <div class="card-body">


                                <h3 class="card-title mt-4">Usuarios Activos</h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="usuariosTable">
                                        <thead>
                                            <tr>
                                                <th>Nombre de Usuario</th>
                                                <th>Personal ID</th>
                                                <th>Rol ID</th>
                                                <th>Sistema ID</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="usuariosContainer"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Modal para registrar permisos -->
            <div class="modal fade" id="modalPermiso" tabindex="-1" aria-labelledby="modalPermisoLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalPermisoLabel">Registrar Permiso</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formRegistrarPermiso">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="pers_perm_id">Personal</label>
                                    <select id="pers_perm_id" class="form-control" name="pers_perm_id" required>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="rol_perm_id">Rol</label>
                                    <select id="rol_perm_id" class="form-control" name="rol_perm_id" required>
                                        <!-- Aquí se llenarán las opciones de roles -->
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="sist_perm_id">Sistema</label>
                                    <select id="sist_perm_id" class="form-control" name="sist_perm_id" required>
                                        <!-- Aquí se llenarán las opciones de sistemas -->
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="usuario_perm">Nombre de Usuario</label>
                                    <input type="text" class="form-control" id="usuario_perm" name="usuario_perm" required>
                                </div>

                                <div class="form-group">
                                    <label for="password_perm">Contraseña</label>
                                    <input type="password" class="form-control" id="password_perm" name="password_perm" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php require_once("../html/footer.php"); ?>
        </div>
        <?php require_once("../html/mainjs.php"); ?>
        <script>
            // Función para listar roles y sistemas
            function listarRolesYSistemas() {
                $.ajax({
                    url: "../../controller/permiso.php?op=listar_roles",
                    type: "GET",
                    success: function(data) {
                        let roles = JSON.parse(data);
                        roles.forEach(role => {
                            $("#rol_id, #rol_perm_id").append(`<option value="${role.rol_id}">${role.rol_nombre}</option>`);
                        });
                    }
                });

                $.ajax({
                    url: "../../controller/permiso.php?op=listar_sistemas",
                    type: "GET",
                    success: function(data) {
                        let sistemas = JSON.parse(data);
                        sistemas.forEach(sistema => {
                            $("#sist_id, #sist_perm_id").append(`<option value="${sistema.sist_id}">${sistema.sist_nom}</option>`);
                        });
                    }
                });
            }

            // Función para crear un nuevo usuario
            $("#formCrearUsuario").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    url: "../../controller/permiso.php?op=crear_usuario",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        toastr.success(response); // Mensaje de éxito
                        $("#formCrearUsuario")[0].reset(); // Resetear el formulario
                        listarUsuarios(); // Recargar la lista de usuarios
                    },
                    error: function() {
                        toastr.error("Error al crear el usuario.");
                    }
                });
            });

            // Función para registrar permisos
            $("#formRegistrarPermiso").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    url: "../../controller/permiso.php?op=registrar_permiso",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        toastr.success(response); // Mensaje de éxito
                        $("#formRegistrarPermiso")[0].reset(); // Resetear el formulario
                        listarUsuarios(); // Recargar la lista de usuarios
                        $('#modalPermiso').modal('hide'); // Cerrar el modal
                    },
                    error: function() {
                        toastr.error("Error al registrar el permiso.");
                    }
                });
            });

            // Función para listar usuarios activos
            function listarUsuarios() {
                $.ajax({
                    url: "../../controller/permiso.php?op=listar_usuarios",
                    type: "GET",
                    success: function(response) {
                        $("#usuariosContainer").html(response); // Cargar los usuarios en la tabla
                    },
                    error: function() {
                        toastr.error("Error al cargar los usuarios.");
                    }
                });
            }

            function eliminarUsuario(perm_id) {
                Swal.fire({
                    title: "¿Está seguro de que desea eliminar este usuario?",
                    text: "Esta acción no se puede deshacer",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Sí, eliminar",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "../../controller/usuario.php?op=eliminar_usuario",
                            type: "POST",
                            data: {
                                perm_id: perm_id
                            },
                            success: function(response) {
                                toastr.success("Usuario eliminado correctamente.");
                                listarUsuarios(); // Recargar la lista de usuarios
                            },
                            error: function() {
                                toastr.error("Error al eliminar el usuario.");
                            }
                        });
                    }
                });
            }


            $.ajax({
                url: "../../controller/permiso.php?op=listar_personal",
                type: "GET",
                success: function(data) {
                    let personal = JSON.parse(data);
                    personal.forEach(persona => {
                        $("#pers_perm_id").append(`<option value="${persona.pers_id}">${persona.pers_nombre}</option>`);
                    });
                }
            });
            $(document).ready(function() {
                listarRolesYSistemas(); // Cargar roles y sistemas al inicio
                listarUsuarios(); // Cargar usuarios al inicio
            });
        </script>
    </body>

    </html>
<?php
} else {
    header("Location: " . Conectar::ruta() . "index.php");
}
?>