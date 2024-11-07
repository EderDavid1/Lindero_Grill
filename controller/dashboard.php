<?php
require_once("../config/conexion.php");
require_once("../models/Dashboard.php");

$dashboard = new Dashboard();

switch ($_GET["op"]) {

    case "ganancia_por_plato":
        $datos = $dashboard->getGananciaPorPlato();
        echo json_encode($datos);
        break;
    case "pedidos_por_mes":
        $datos = $dashboard->getPedidosPorMes();  // Llamamos al método que trae los pedidos por mes
        echo json_encode($datos);  // Retornamos los datos como JSON
        break;
    case "ganancias_mensuales":
        $datos = $dashboard->getGananciasMensuales();
        echo json_encode($datos);
        break;

    case "categorias":
        $datos = $dashboard->getCategorias();
        echo json_encode($datos);
        break;
    case "getCantidadPedidos":
        $datos = $dashboard->getCantidadPedidos();
        echo json_encode($datos);
        break;
    case "getIngresosTotales":
        $datos = $dashboard->getIngresosTotales();
        echo json_encode($datos);
        break;

        // Otros casos para otras métricas...
}
