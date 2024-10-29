<?php 
    require_once("../config/conexion.php");
    require_once("../models/Usuario.php");

    $usuario =  new Usuario();
    switch($_GET["op"]){
        
        case "listar_usuarios":
            $datos = $usuario->get_usuarios();
            echo json_encode(["data" => $datos]);
            break;
    
        // Obtener un usuario por ID
        case "obtener_usuario":
            $pers_id = $_POST["pers_id"];
            $datos = $usuario->get_usuario_por_id($pers_id);
            echo json_encode($datos);
            break;
    
        // Registrar o actualizar usuario
        case "registrar_usuario":
            $pers_id = isset($_POST["pers_id"]) ? $_POST["pers_id"] : null;
            $pers_nombre = $_POST["pers_nombre"];
            $pers_apelpat = $_POST["pers_apelpat"];
            $pers_apelmat = $_POST["pers_apelmat"];
            $pers_foto = $_POST["pers_foto"];
            $pers_doc = $_POST["pers_doc"];
    
            $usuario->registrar_usuario($pers_id, $pers_nombre, $pers_apelpat, $pers_apelmat, $pers_foto, $pers_doc);
            echo json_encode(["status" => "success"]);
            break;
            
    }

?>