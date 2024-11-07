<?php
require_once("../config/conexion.php");
require_once("../models/Permiso.php");

$permiso = new Permiso();

switch ($_GET["op"]) {
    case "listar_roles":
        $roles = $permiso->listar_roles();
        echo json_encode($roles);
        break;

    case "listar_sistemas":
        $sistemas = $permiso->listar_sistemas();
        echo json_encode($sistemas);
        break;
        case "listar_personal":
            $personal = $permiso->listar_personal();
            echo json_encode($personal);
            break;
    case "crear_usuario":
        $pers_id = $_POST['pers_id'];
        $rol_id = $_POST['rol_id'];
        $sist_id = $_POST['sist_id'];
        $perm_usu = $_POST['perm_usu'];
        $perm_pass = $_POST['perm_pass'];
        
        $permiso->crear_usuario($pers_id, $rol_id, $sist_id, $perm_usu, $perm_pass);
        echo "Usuario creado correctamente.";
        break;

        case "registrar_permiso":
            $pers_perm_id = $_POST['pers_perm_id'];
            $rol_perm_id = $_POST['rol_perm_id'];
            $sist_perm_id = $_POST['sist_perm_id'];
            $usuario_perm = $_POST['usuario_perm'];
            $password_perm = md5($_POST['password_perm']); // Aplicar MD5 a la contraseña
            
            // Ahora se llama al método para crear el usuario, pasando la contraseña ya procesada
            $permiso->crear_usuario($pers_perm_id, $rol_perm_id, $sist_perm_id, $usuario_perm, $password_perm);
            echo "Permiso registrado correctamente.";
            break;
        

        case "listar_usuarios":
            $usuarios = $permiso->listar_usuarios();
            foreach ($usuarios as $usuario) {
                echo "<tr>
                        <td>{$usuario['perm_usu']}</td>
                        <td>{$usuario['pers_id']}</td>
                        <td>{$usuario['rol_id']}</td>
                        <td>{$usuario['sist_id']}</td>
                        <td>
                            <button class='btn btn-danger btn-sm' onclick='eliminarUsuario({$usuario['perm_id']})'>Eliminar</button>
                        </td>
                      </tr>";
            }
            break;
}
?>
