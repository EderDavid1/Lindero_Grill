<?php
class Usuario extends Conectar
{

    public function login()
    {
        $conectar = parent::conexion();
        parent::set_names();

        if (isset($_POST["enviar"])) {
            $usu = $_POST["usu_usu"];  // Aquí usas 'usu_usu' como el campo para el usuario
            $pass = $_POST["usu_pass"];

            // Validación de campos vacíos
            if (empty($usu) || empty($pass)) {  // Cambié 'dni' por 'usu' para la validación
                header("Location:" . Conectar::ruta() . "index.php?m=2");  // Campos vacíos
                exit();
            }

            // Consulta SQL para obtener los datos del usuario
            $sql = "SELECT p.pers_id, p.pers_nombre, p.pers_apelpat, p.pers_apelmat, p.pers_doc, p.pers_foto, 
                            r.rol_id, r.rol_nombre, r.rol_est, 
                            s.sist_id, s.sist_nom
                    FROM sc_seguridad.tb_permiso perm
                    INNER JOIN sc_seguridad.tb_persona p ON perm.pers_id = p.pers_id
                    INNER JOIN sc_seguridad.tb_rol r ON perm.rol_id = r.rol_id
                    INNER JOIN sc_seguridad.tb_sistema s ON perm.sist_id = s.sist_id
                    WHERE perm.perm_usu = ? AND perm.perm_pass = ? AND p.pers_est = 1 AND perm.perm_est = 1";

            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $usu);
            $stmt->bindValue(2, md5($pass));  // Supongo que el password está encriptado con MD5
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificar si el usuario existe
            if (!$resultado) {
                header("Location:" . Conectar::ruta() . "index.php?m=8");  // Datos incorrectos
                exit();
            }

            // Si el usuario es válido, guardar los datos en sesión
            $_SESSION["usua_id_pdvlg"] = $resultado["pers_id"];
            $_SESSION["usua_dni_pdvlg"] = $resultado["pers_doc"];
            $_SESSION["rol_id_pdvlg"] = $resultado["rol_id"];
            $_SESSION["pers_apellidos_pdvlg"] = $resultado["pers_apelpat"] . " " . $resultado["pers_apelmat"];
            $_SESSION["pers_nombre_pdvlg"] = $resultado["pers_nombre"];
            $_SESSION["nombre_completo_pdvlg"] = $resultado["pers_nombre"] . " " . $resultado["pers_apelpat"] . " " . $resultado["pers_apelmat"];
            $_SESSION["rol_nombre_pdvlg"] = $resultado["rol_nombre"];
            $_SESSION["sistema_id_pdvlg"] = $resultado["sist_id"];
            $_SESSION["sistema_nombre_pdvlg"] = $resultado["sist_nom"];


            switch ($_SESSION["rol_id_pdvlg"]) {
                case 1:  // Rol orientador
                    header("Location: " . Conectar::ruta() . "view/mnt_pedidos/");
                    exit();
                // Añadir más casos según los roles
                default:
                    header("Location:" . Conectar::ruta() . "view/mnt_pedidos/");
                    exit();
            }
        }
    }


    public function logout()
    {
        session_start();  // Asegurarse de iniciar la sesión antes de destruirla
        session_unset();
        session_destroy();

        header("Location:" . Conectar::ruta() . "index.php");
        exit();
    }

    // Método para obtener todos los usuarios
    public function get_usuarios()
    {
        $sql = "SELECT pers_id, pers_nombre, pers_apelpat, pers_apelmat, pers_foto, fechacrea, pers_est, pers_doc 
                 FROM sc_seguridad.tb_persona";
        return Conectar::conexion()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para obtener un usuario por ID
    public function get_usuario_por_id($pers_id)
    {
        $sql = "SELECT pers_id, pers_nombre, pers_apelpat, pers_apelmat, pers_foto, fechacrea, pers_est, pers_doc
                 FROM sc_seguridad.tb_persona 
                 WHERE pers_id = ?";
        $stmt = Conectar::conexion()->prepare($sql);
        $stmt->execute([$pers_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function eliminar_usuario($perm_id) {
        $sql = "UPDATE sc_seguridad.tb_permiso SET perm_est = 0 WHERE perm_id = ?";
        $stmt = Conectar::conexion()->prepare($sql);
        $stmt->execute([$perm_id]);
      }
      
    // Método para registrar o actualizar un usuario
    public function registrar_usuario($pers_id, $pers_nombre, $pers_apelpat, $pers_apelmat, $pers_foto, $pers_doc)
    {
        if ($pers_id) {
            // Actualizar
            $sql = "UPDATE sc_seguridad.tb_persona 
                     SET pers_nombre = ?, pers_apelpat = ?, pers_apelmat = ?, pers_foto = ?, pers_doc = ? 
                     WHERE pers_id = ?";
            $stmt = Conectar::conexion()->prepare($sql);
            $stmt->execute([$pers_nombre, $pers_apelpat, $pers_apelmat, $pers_foto, $pers_doc, $pers_id]);
        } else {
            // Registrar
            $sql = "INSERT INTO sc_seguridad.tb_persona (pers_nombre, pers_apelpat, pers_apelmat, pers_foto, pers_doc, pers_est, fechacrea) 
                     VALUES (?, ?, ?, ?, ?, 1, NOW())";
            $stmt = Conectar::conexion()->prepare($sql);
            $stmt->execute([$pers_nombre, $pers_apelpat, $pers_apelmat, $pers_foto, $pers_doc]);
        }
    }


}
