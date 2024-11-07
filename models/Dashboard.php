
<?php


class Dashboard extends Conectar
{
    // Obtener el total de ganancias por plato
    public function getGananciaPorPlato()
    {
        $conectar = parent::conexion();
        $sql = "SELECT p.producto_nom, SUM(d.pedidod_cantidad * d.pedidod_precio_unitario) as ganancia_total
                FROM sc_restaurante.tb_pedido_detalle d
                INNER JOIN tb_producto p ON d.producto_id = p.producto_id
                WHERE d.pedidod_est = 1
                GROUP BY p.producto_nom";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getPedidosPorMes() {
        $conectar = parent::conexion();
        $sql = "SELECT 
                    EXTRACT(YEAR FROM fechacrea) AS año, 
                    EXTRACT(MONTH FROM fechacrea) AS mes, 
                    COUNT(pedido_id) AS total_pedidos
                FROM sc_restaurante.tb_pedido
                WHERE pedido_est in(1,2)
                GROUP BY EXTRACT(YEAR FROM fechacrea), EXTRACT(MONTH FROM fechacrea)
                ORDER BY año DESC, mes DESC";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getCantidadPedidos() {
        $conectar = parent::conexion();
        $sql = "SELECT COUNT(pedido_id) AS cantidad_pedidos
                FROM sc_restaurante.tb_pedido
                WHERE pedido_est in (1,2)";  // Suponiendo que 1 es el estado "activo"
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);  // Devolvemos la cantidad de pedidos
    }
    public function getIngresosTotales() {
        $conectar = parent::conexion();
        $sql = "SELECT SUM(cob_total) AS ingresos_totales
                FROM sc_restaurante.tb_cobro
                WHERE cob_estado = 1";  // Suponiendo que 1 es el estado "activo" del cobro
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);  // Devolvemos la suma de los ingresos totales
    }
        
    // Obtener las ganancias mensuales
    public function getGananciasMensuales()
    {
        $conectar = parent::conexion();
        $sql = "SELECT DATE_FORMAT(fechacrea, '%Y-%m') as mes, SUM(cob_total) as ganancia_mensual
                FROM tb_cobro
                WHERE cob_estado = 1
                GROUP BY DATE_FORMAT(fechacrea, '%Y-%m')";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener las categorías de productos
    public function getCategorias()
    {
        $conectar = parent::conexion();
        $sql = "SELECT cate_prod_id, cate_nom FROM tb_categoria_producto WHERE cate_est = 1";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener las métricas adicionales según necesidades
}
?>
