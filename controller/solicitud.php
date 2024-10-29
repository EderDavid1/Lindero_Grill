<?php
require_once("../config/conexion.php");
require_once("../models/Solicitud.php");
require_once("../models/Bitacora.php");
$bitacora = new Bitacora();
$solicitud = new Solicitud();
switch ($_GET["op"]) {
    case "combo_tipo_solicitante":
        $datos = $solicitud->get_tipo_solicitante();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "  <option value=''>Selecciona un Tipo Solicitante</option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['tiposoli_id'] . "'>" . $row['tiposoli_nom'] . "</option>";
            }
            echo $html;
        }
        break;
    case "tipo_certificado":
        $datos = $solicitud->get_tipo_certificado($_POST['nivel_id']);
        if (is_array($datos) && count($datos) > 0) {
            echo json_encode($datos);
        }
        break;
    case "requisitos":
        $datos = $solicitud->get_tipo_requisitos($_POST['tipocert_id']);
        if (is_array($datos) && count($datos) > 0) {
            echo json_encode($datos);
        }
        break;
    case "combo_funcion":
        $datos = $solicitud->get_funcion();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = " <option value=''>Selecciona una Función</option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['func_id'] . "'>" . $row['func_nom'] . "</option>";
            }
            echo $html;
        }
        break;
    case "subfunciones":
        $datos = $solicitud->get_subfuncion($_POST['func_id']);
        if (is_array($datos) && count($datos) > 0) {
            echo json_encode($datos);
        }
        break;
    case "getnivelriesgo":
        // Verifica que 'subfun_id' esté presente en la solicitud POST
        if (isset($_POST['subfun_id']) && !empty($_POST['subfun_id'])) {
            $subfun_id = intval($_POST['subfun_id']); // Sanitiza la entrada

            // Asumiendo que tienes una instancia de tu modelo $solicitud
            $datos = $solicitud->get_nivelRiesgo($subfun_id);

            if (is_array($datos) && count($datos) > 0) {
                // Respuesta exitosa con datos
                echo json_encode([
                    'status' => 'success',
                    'data' => $datos
                ]);
            } else {
                // Respuesta cuando no se encuentran datos
                echo json_encode([
                    'status' => 'error',
                    'message' => 'No se encontraron niveles de riesgo para la subfunción proporcionada.'
                ]);
            }
        } else {
            // Respuesta cuando 'subfun_id' no está presente o es inválido
            echo json_encode([
                'status' => 'error',
                'message' => 'Parámetro "subfun_id" faltante o inválido.'
            ]);
        }
        break;
    case "condiciones":
        $datos = $solicitud->get_condiciones();
        if (is_array($datos) && count($datos) > 0) {
            echo json_encode($datos);
        }
        break;
    case "condicion_seguridad":
        $datos = $solicitud->get_condicion_seguridad($_POST['func_id']);
        if (is_array($datos) && count($datos) > 0) {
            echo json_encode($datos);
        }
        break;
}


?>