<?php
require_once("../config/conexion.php");
require_once("../models/Pedido.php");

$pedido = new Pedido();

switch ($_GET["op"]) {
    case "listar_pedidos":
        $estado = $_GET["estado"]; // Obtener el filtro de estado de la URL
        $pedidos = $pedido->obtener_pedidos_por_estado($estado);
        echo json_encode($pedidos);
        break;


    case "ver_detalle_pedido":
        $pedido_id = $_GET["pedido_id"];
        $detalle = $pedido->obtener_detalle_pedido($pedido_id);
        $totales = $pedido->calcular_totales_pedido($pedido_id);
        echo json_encode(["detalle" => $detalle, "totales" => $totales]);
        break;
    case "obtener_dni":
        $dni = $_POST["dni"];
        $datos = $pedido->buscar_dni($dni);

        if ($datos) {
            echo json_encode($datos); // Si se encuentra en la base de datos, enviar el dato
        } else {
            // Si no está en la base de datos, consulta la API
            $apiUrl = "https://api.apis.net.pe/v1/dni?numero=" . $dni;
            $apiResponse = file_get_contents($apiUrl);
            $apiData = json_decode($apiResponse, true);

            if (isset($apiData["nombre"])) {
                echo json_encode(["nombre" => $apiData["nombre"]]);
            } else {
                echo json_encode(["nombre" => null]);
            }
        }
        break;

    case "obtener_ruc":
        $ruc = $_POST["ruc"];
        $datos = $pedido->buscar_ruc($ruc);

        if ($datos) {
            echo json_encode($datos); // Si se encuentra en la base de datos, enviar el dato
        } else {
            // Si no está en la base de datos, consulta la API
            $apiUrl = "https://api.apis.net.pe/v1/ruc?numero=" . $ruc;
            $apiResponse = file_get_contents($apiUrl);
            $apiData = json_decode($apiResponse, true);

            if (isset($apiData["nombre"])) {
                echo json_encode(["razon_social" => $apiData["nombre"]]);
            } else {
                echo json_encode(["razon_social" => null]);
            }
        }
        break;


    case "obtener_detalle_pedido":
        $pedido_id = $_POST["pedido_id"];
        $detalles = $pedido->obtener_detalle_pedido_cobro($pedido_id);
        echo json_encode($detalles);
        break;

    case "registrar_cobro":
        $pedido_id = $_POST["pedido_id"];
        $total = $_POST["total"];
        $ingreso = $_POST["ingreso"];
        $vuelto = $_POST["vuelto"];
        $tipo_comprobante = $_POST["tipo_comprobante"];
        $dni = $_POST["dni"];
        $nombre = $_POST["nombre"];
        $ruc = $_POST["ruc"];
        $razon_social = $_POST["razon_social"];
        $conceptos = $_POST["conceptos"];

        $pedido->registrar_cobro($pedido_id, $total, $ingreso, $vuelto, $tipo_comprobante, $dni, $nombre, $ruc, $razon_social, $conceptos);
        echo json_encode(["status" => "success"]);
        break;

    case "eliminar_pedido":
        $pedido_id = $_POST["pedido_id"];
        $pedido->eliminar_pedido($pedido_id);
        echo json_encode(["status" => "success", "message" => "Pedido actualizado a inactivo correctamente"]);
        break;
        // Registrar pedido
    case "registrar_pedido":
        $pedidoData = json_decode(file_get_contents("php://input"), true);

        // Verificar los datos recibidos
        if (!empty($pedidoData['pedido']) && !empty($pedidoData['productos'])) {
            // Registrar pedido principal
            $pedidoId = $pedido->registrar_pedido(
                $pedidoData['pedido']['mesa_id'],
                $_SESSION["usua_id_pdvlg"]
            );

            // Registrar detalles del pedido
            foreach ($pedidoData['productos'] as $producto) {
                $pedido->registrar_detalle_pedido(
                    $pedidoId,
                    $producto['producto_id'],
                    $producto['cantidad'],
                    $producto['precio_unitario'],
                    $producto['monto_total']
                );
            }
            echo json_encode(["status" => "success", "message" => "Pedido registrado correctamente"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Datos de pedido incompletos"]);
        }
        break;
}
