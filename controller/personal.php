<?php
require_once("../config/conexion.php");
require_once("../models/Personal.php");

$personal = new Personal();

switch ($_GET["op"]) {

    case "listar_personas":
        // Obtener solo las personas activas y eliminadas
        $datos = $personal->get_personas(); // Asegúrate de que esta función obtenga todos los estados (1 y 0)
        $html = '';
        foreach ($datos as $row) {
            // Mostrar solo si el estado es 1 (activo) o 0 (eliminado)
            if ($row['pers_est'] == 1 || $row['pers_est'] == 0) {
                // Crear HTML para cada persona
                $html .= "<div class='col-md-3 col-sm-6 col-12'>
                            <div class='info-box shadow'>
                              <img src='" . $row['pers_foto'] . "' class='info-box-icon' alt='Foto'>
                              <div class='info-box-content'>
                                <span class='info-box-text'>{$row['pers_nombre']} {$row['pers_apelpat']}</span>
                                <span class='info-box-number'>Estado: " . ($row['pers_est'] == 1 ? 'Activo' : 'Eliminado') . "</span>
                                <div class='row'>
                                    <div class='col-lg-6'>   
                                        <button class='btn btn-warning btn-sm mt-2' onclick='editarPersona(" . $row['pers_id'] . ")'>Editar</button>
                                    </div>
                                    <div class='col-lg-6'>
                                        <button class='btn btn-danger btn-sm mt-2' onclick='eliminarPersona(" . $row['pers_id'] . ", " . $row['pers_est'] . ")'>Eliminar</button>
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>";
            }
        }
        echo $html;
        break;


    case "insertar_persona":
        $foto_base64 = $_POST["pers_foto"];
        $personal->insert_persona($_POST["pers_nombre"], $_POST["pers_apelpat"], $_POST["pers_apelmat"], $foto_base64, $_POST["pers_est"], $_POST["pers_doc"]);
        echo "Persona registrada correctamente";
        break;
    case "actualizar_persona":
        $foto_base64 = $_POST["pers_foto"];
        $personal->update_persona($_POST["pers_id"], $_POST["pers_nombre"], $_POST["pers_apelpat"], $_POST["pers_apelmat"], $foto_base64, $_POST["pers_est"], $_POST["pers_doc"]);
        echo "Persona actualizada correctamente";
        break;

    case "ver_persona":
        $datos = $personal->ver_persona($_POST["pers_id"]);
        echo json_encode($datos);
        break;

    case "eliminar_persona":
        // Obtener el contenido JSON de la solicitud
        $data = json_decode(file_get_contents('php://input'), true);

        // Acceder a los datos decodificados
        $pers_id = $data['pers_id']; // Cambia esto para acceder al ID de la persona
        $estado = $data['estado']; // Cambia esto para acceder al nuevo estado

        // Llama a la función para actualizar el estado
        $personal->update_persona_estado($pers_id, $estado); // Cambia el estado según el ID de la persona
        echo $estado === 0 ? "Persona eliminada correctamente" : "Persona reactivada correctamente";
        break;
}
