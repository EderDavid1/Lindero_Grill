
<?php
require_once("../config/conexion.php");
require_once("../models/Empresa.php");
require_once("../models/Bitacora.php");
$bitacora = new Bitacora();
$empresa =  new Empresa();
switch ($_GET["op"]) {

    case "buscaRUC":
        $datos = $empresa->get_empresa_x_RUC($_POST["empr_ruc"]);
        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {
                $output["empr_id"] = $row["empr_id"];
                $output["empr_categoria"] = $row["empr_categoria"];
                $output["empr_ruc"] = $row["empr_ruc"];
                $output["empr_razon_social"] = $row["empr_razon_social"];
                $output["empr_nombre_comercial"] = $row["empr_nombre_comercial"];
                $output["empr_tipo_actividad"] = $row["empr_tipo_actividad"];
                $output["empr_direccion"] = $row["empr_direccion"];
                $output["empr_telefono"] = $row["empr_telefono"];
                $output["empr_estado"] = $row["empr_estado"];
                // Ejecuta la función para obtener los nombres de los giros
                if ($row["gico_id"] !== null) {
                    // Ejecuta la función para obtener los nombres de los giros
                    $nombres_giros = $empresa->getGirosByString($row["gico_id"]);
                    $output["empr_nombres_giros"] = implode(', ', $nombres_giros);
                } else {
                    $output["empr_nombres_giros"] = '';
                }
            }
            echo json_encode($output);
        }
        break;

    case "combo_empresa":
        $datos = $empresa->get_direcciones($_POST['empr_ruc']);
        if (is_array($datos) == true and count($datos) > 0) {
            $html = " <option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['empr_id'] . "'>" . $row['empr_direccion'] . "</option>";
            }
            echo $html;
        }
        break;
    case "combo_prov":
        $datos = $empresa->get_provincia();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = " <option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['cod_prov_sunat'] . "'>" . $row['desc_prov_sunat'] . "</option>";
            }
            echo $html;
        }
        break;
    case "combo_dist":
        $datos = $empresa->get_distrito($_POST['cod_prov_sunat']);
        if (is_array($datos) == true and count($datos) > 0) {
            $html = " <option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['cod_ubigeo_sunat'] . "'>" . $row['desc_ubigeo_sunat'] . "</option>";
            }
            echo $html;
        }
        break;
}

?>