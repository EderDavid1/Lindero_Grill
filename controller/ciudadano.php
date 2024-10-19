
<?php
require_once("../config/conexion.php");
require_once("../models/Ciudadano.php");
require_once("../models/Bitacora.php");
$bitacora = new Bitacora();
$ciudadano =  new Ciudadano();
switch ($_GET["op"]) {

    case "buscarDNI":
        $datos = $ciudadano->get_ciudadano_x_doc($_POST["ciudadano_doc"]);
        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {
                $output["ciud_id"] = $row["ciud_id"];
                $output["ciudadano_dni"] = $row["ciud_numero_documento"];
                $output["ciudadano_nombre"] = $row["ciud_nombre"];
                $output["ciudadano_apep"] = $row["ciud_primer_apellido"];
                $output["ciudadano_apem"] = $row["ciud_segundo_apellido"];
                $output["ciud_celular"] = $row["ciud_celular"];
                $output["ciud_foto"] = $row["ciud_foto"];
            }
            echo json_encode($output);
        }
        break;
}


?>