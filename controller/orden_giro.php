<?php

require_once("../config/conexion.php");
require_once("../models/Orden_giro.php");

session_start(); // Asegúrate de que la sesión esté iniciada antes de acceder a $_SESSION

$orden_giro = new Orden_giro();

switch ($_GET["op"]) {
    case "crear_orden_giro":
        // Validar entradas
        $ciud_id = isset($_POST['ciud_id']) ? intval($_POST['ciud_id']) : null;
        $proced_id = isset($_POST['proced_id']) ? intval($_POST['proced_id']) : null;
        $empr_id = isset($_POST['empr_id']) ? intval($_POST['empr_id']) : null;
        $comentario = isset($_POST['comentario']) ? htmlspecialchars($_POST['comentario'], ENT_QUOTES, 'UTF-8') : '';

        if ($ciud_id && $proced_id && $empr_id) {
            // Obtener datos de abrir_procedimiento
            $data = $orden_giro->abrir_procedimiento($ciud_id, $empr_id, $proced_id);

            if (!empty($data)) {
                foreach ($data as $row) {
                    if (isset($row['inserted_tasatciud'])) {
                        $orden_giro->girar_tasas($row['inserted_tasatciud'], $_SESSION['usua_id_sidc'], $comentario);
                    }
                }
            } else {
                echo json_encode(["error" => "No se encontraron datos."]);
                exit;
            }
        } else {
            echo json_encode(["error" => "Datos de entrada inválidos."]);
            exit;
        }

        echo json_encode($data);
        break;
    
    default:
        echo json_encode(["error" => "Operación no válida."]);
        break;
}
?>
