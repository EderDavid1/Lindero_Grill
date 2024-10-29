<?php

require_once("../config/conexion.php");
require_once("../models/Otros_origenes.php");



$otros_origenes = new Otros_origenes();

switch ($_GET["op"]) {
    case "get_top_10":
        $data = $otros_origenes->get_otros_origenes_top_10();
        echo json_encode($data);
        break;
    case "buscar":
        $datos = $otros_origenes->get_otros_origenes_x_search($_POST["otros_origenes_input"]);

        // Inicializa un array para almacenar los resultados
        $output = array();

        // Verifica si los datos están disponibles y son un array
        if (is_array($datos) && count($datos) > 0) {
            foreach ($datos as $row) {
                // Añade cada fila de datos al array de salida
                $output[] = array(
                    "co_otr_ori" => $row["co_otr_ori"],
                    "nu_doc_otr_ori" => $row["nu_doc_otr_ori"],
                    "co_tip_otr_ori" => $row["co_tip_otr_ori"],
                    "de_ape_pat_otr" => $row["de_ape_pat_otr"],
                    "de_ape_mat_otr" => $row["de_ape_mat_otr"],
                    "de_nom_otr" => $row["de_nom_otr"],
                    "de_raz_soc_otr" => $row["de_raz_soc_otr"],
                    "de_dir_otro_ori" => $row["de_dir_otro_ori"],
                    "ti_origen" => $row["ti_origen"],
                    "ref_co_otr_ori" => $row["ref_co_otr_ori"],
                    "ub_dep" => $row["ub_dep"],
                    "ub_pro" => $row["ub_pro"],
                    "ub_dis" => $row["ub_dis"],
                    "es_activo" => $row["es_activo"],
                    "in_busca_texto" => $row["in_busca_texto"],
                    "de_email" => $row["de_email"],
                    "de_telefo" => $row["de_telefo"]
                );
            }

            // Codifica el array de salida en formato JSON y lo envía como respuesta
            echo json_encode($output);
        } else {
            // Si no hay datos, se devuelve un array vacío
            echo json_encode(array());
        }
        break;
    case "mostrar_co_otr_ori":
        $datos = $otros_origenes->get_otros_origenes_x_co($_POST["co_otr_ori"]);

        // Inicializa un array para almacenar los resultados
        $output = array();

        // Verifica si los datos están disponibles y son un array
        if (is_array($datos) && count($datos) > 0) {
            foreach ($datos as $row) {
                // Añade cada fila de datos al array de salida
                $output[] = array(
                    "co_otr_ori" => $row["co_otr_ori"],
                    "nu_doc_otr_ori" => $row["nu_doc_otr_ori"],
                    "co_tip_otr_ori" => $row["co_tip_otr_ori"],
                    "de_ape_pat_otr" => $row["de_ape_pat_otr"],
                    "de_ape_mat_otr" => $row["de_ape_mat_otr"],
                    "de_nom_otr" => $row["de_nom_otr"],
                    "de_raz_soc_otr" => $row["de_raz_soc_otr"],
                    "de_dir_otro_ori" => $row["de_dir_otro_ori"],
                    "ti_origen" => $row["ti_origen"],
                    "ref_co_otr_ori" => $row["ref_co_otr_ori"],
                    "ub_dep" => $row["ub_dep"],
                    "ub_pro" => $row["ub_pro"],
                    "ub_dis" => $row["ub_dis"],
                    "es_activo" => $row["es_activo"],
                    "in_busca_texto" => $row["in_busca_texto"],
                    "de_email" => $row["de_email"],
                    "de_telefo" => $row["de_telefo"]
                );
            }

            // Codifica el array de salida en formato JSON y lo envía como respuesta
            echo json_encode($output);
        } else {
            // Si no hay datos, se devuelve un array vacío
            echo json_encode(array());
        }
        break;


    case "get_direccion_data":
        $data = $otros_origenes->get_data_direccion();
        echo json_encode($data);
        break;
    case 'update_otros_origenes_data':
        // Obtén los datos del POST
        $co_otr_ori = isset($_POST['co_otr_ori']) ? $_POST['co_otr_ori'] : null;
        $nu_doc_otr_ori = $_POST['nu_doc_otr_ori'];
        $co_tip_otr_ori = $_POST['co_tip_otr_ori'];
        $de_ape_pat_otr = $_POST['de_ape_pat_otr'];
        $de_ape_mat_otr = $_POST['de_ape_mat_otr'];
        $de_nom_otr = $_POST['de_nom_otr'];
        $de_raz_soc_otr = $_POST['de_raz_soc_otr'];
        $de_dir_otro_ori = $_POST['de_dir_otro_ori'];
        $ub_dep = $_POST['ub_dep'];
        $ub_pro = $_POST['ub_pro'];
        $ub_dis = $_POST['ub_dis'];

        $de_email = $_POST['de_email'];
        $de_telefo = $_POST['de_telefo'];

        // Crear una instancia del modelo
        $otros_origenes = new otros_origenes();

        if ($co_otr_ori) {
            // Actualizar un registro existente
            $result = $otros_origenes->editar_registro($co_otr_ori, [
                'nu_doc_otr_ori' => $nu_doc_otr_ori,
                'co_tip_otr_ori' => $co_tip_otr_ori,
                'de_ape_pat_otr' => $de_ape_pat_otr,
                'de_ape_mat_otr' => $de_ape_mat_otr,
                'de_nom_otr' => $de_nom_otr,
                'de_raz_soc_otr' => $de_raz_soc_otr,
                'de_dir_otro_ori' => $de_dir_otro_ori,


                'ub_dep' => $ub_dep,
                'ub_pro' => $ub_pro,
                'ub_dis' => $ub_dis,

                'de_email' => $de_email,
                'de_telefo' => $de_telefo
            ]);
        } else {
            // Insertar un nuevo registro
            $result = $otros_origenes->registrar_nuevo([
                'nu_doc_otr_ori' => $nu_doc_otr_ori,
                'co_tip_otr_ori' => $co_tip_otr_ori,
                'de_ape_pat_otr' => $de_ape_pat_otr,
                'de_ape_mat_otr' => $de_ape_mat_otr,
                'de_nom_otr' => $de_nom_otr,
                'de_raz_soc_otr' => $de_raz_soc_otr,
                'de_dir_otro_ori' => $de_dir_otro_ori,
                'ub_dep' => $ub_dep,
                'ub_pro' => $ub_pro,
                'ub_dis' => $ub_dis,
                'de_email' => $de_email,
                'de_telefo' => $de_telefo
            ]);
        }

        // Verifica si se actualizó o insertó al menos una fila
        if ($result > 0) {
            echo json_encode(["status" => "success", "message" => "Datos procesados exitosamente."]);
        } else {
            echo json_encode(["status" => "error", "message" => "No se realizaron cambios en los datos."]);
        }
        break;


}


?>