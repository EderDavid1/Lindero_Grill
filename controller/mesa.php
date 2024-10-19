<?php
require_once("../config/conexion.php");
require_once("../models/Mesa.php");

$mesa = new Mesa();

switch ($_GET["op"]) {

    // Obtener todas las mesas
    case "listar_mesas":
        $datos = $mesa->get_mesas();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = '';
            foreach ($datos as $row) {
                // Asignar la clase de estado según el estado de la mesa
                $estado_clase = '';
                $estado_texto = '';

                switch ($row['mesa_est']) {
                    case 1: // Libre
                        $estado_clase = 'bg-info'; // Color azul para libre
                        $estado_texto = 'Disponible';
                        break;
                    case 2: // En uso
                        $estado_clase = 'bg-warning'; // Color amarillo para en uso
                        $estado_texto = 'En Uso';
                        break;
                    case 0: // Eliminada o inactiva
                        $estado_clase = 'bg-danger'; // Color rojo para eliminada
                        $estado_texto = 'Eliminada';
                        break;
                }

                // Crear el HTML para cada mesa
                $html .= "<div class='col-md-3 col-sm-6 col-12'>
                        <div class='info-box shadow'>
                          <span class='info-box-icon $estado_clase'>{$row['mesa_nmr']}</span>
                          <div class='info-box-content'>
                            <span class='info-box-text'>Sillas: {$row['mesa_sillas_num']}</span>
                            <span class='info-box-number'>Estado: $estado_texto</span>
                            <div class='row'>
                                <div class='col-lg-6'>   <button class='btn btn-warning btn-sm mt-2' style='width: 100%' onclick='editarMesa(" . $row['mesa_id'] . ")'>Editar</button></div>
                                 <div class='col-lg-6'><button class='btn btn-danger btn-sm mt-2' style='width: 100%' onclick='eliminarMesa(" . $row['mesa_id'] . ")'>Eliminar</button> </div>
                            </div>
                          
                            
                          </div>
                        </div>
                      </div>";
            }
            echo $html;
        }
        break;

    // Registrar una nueva mesa
    case "insertar_mesa":
        if (empty($_POST["mesa_id"])) {
            $mesa->insert_mesa($_POST["mesa_nmr"], $_POST["mesa_est"], $_POST["mesa_sillas_num"]);
            echo "Mesa registrada correctamente";
        } else {
            $mesa->update_mesa($_POST["mesa_id"], $_POST["mesa_nmr"], $_POST["mesa_est"], $_POST["mesa_sillas_num"]);
            echo "Mesa actualizada correctamente";
        }
        break;

    // Obtener los datos de una mesa específica
    case "ver_mesa":
        $datos = $mesa->ver_mesa($_POST["mesa_id"]);
        echo json_encode($datos);
        break;

    // Eliminar (cambiar estado a 0) una mesa
    case "eliminar_mesa":
        $mesa->update_mesa_estado($_POST["mesa_id"], 0);  // Cambiar el estado a 0 (inactivo)
        echo "Mesa eliminada correctamente";
        break;
}
