<?php
class Pedido extends Conectar
{
    

    // Registrar pedido principal
    public function registrar_pedido($mesa_id, $pers_id) {
        $sql = "INSERT INTO sc_restaurante.tb_pedido ( mesa_id, pers_id)
                VALUES ( :mesa_id, :pers_id) RETURNING pedido_id";
        $stmt = Conectar::conexion()->prepare($sql);
        $stmt->bindParam(':mesa_id', $mesa_id);
        $stmt->bindParam(':pers_id', $pers_id);
        
        $stmt->execute();
        
        return $stmt->fetchColumn();  // Retornar el ID del pedido insertado
    }
    public function buscar_dni($dni) {
        $sql = "SELECT cob_nombre AS nombre FROM sc_restaurante.tb_cobro WHERE cob_dni = :dni LIMIT 1";
        $stmt = Conectar::conexion()->prepare($sql);
        $stmt->bindParam(":dni", $dni);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function buscar_ruc($ruc) {
        $sql = "SELECT cob_razon_social AS razon_social FROM sc_restaurante.tb_cobro WHERE cob_ruc = :ruc LIMIT 1";
        $stmt = Conectar::conexion()->prepare($sql);
        $stmt->bindParam(":ruc", $ruc);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    
    public function registrar_cobro($pedido_id, $total, $ingreso, $vuelto, $tipo_comprobante, $dni, $nombre, $ruc, $razon_social, $conceptos) {
        try {
            // Iniciar transacción
            $conexion = Conectar::conexion();
            $conexion->beginTransaction();
            
            // Inserción en la tabla tb_cobro
            $sql = "INSERT INTO sc_restaurante.tb_cobro (pedido_id, cob_total, cob_ingreso, cob_vuelto, tipo_comprobante, cob_dni, cob_nombre, cob_ruc, cob_razon_social, cob_conceptos)
                    VALUES (:pedido_id, :total, :ingreso, :vuelto, :tipo_comprobante, :dni, :nombre, :ruc, :razon_social, :conceptos)";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(":pedido_id", $pedido_id);
            $stmt->bindParam(":total", $total);
            $stmt->bindParam(":ingreso", $ingreso);
            $stmt->bindParam(":vuelto", $vuelto);
            $stmt->bindParam(":tipo_comprobante", $tipo_comprobante);
            $stmt->bindParam(":dni", $dni);
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":ruc", $ruc);
            $stmt->bindParam(":razon_social", $razon_social);
            $stmt->bindParam(":conceptos", $conceptos);
            $stmt->execute();
    
            // Actualización del estado del pedido en la tabla tb_pedido
            $sql = "UPDATE sc_restaurante.tb_pedido SET pedido_est = 2 WHERE pedido_id = :pedido_id";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(":pedido_id", $pedido_id);
            $stmt->execute();
    
            // Confirmar transacción
            $conexion->commit();
    
        } catch (Exception $e) {
            // Revertir transacción en caso de error
            $conexion->rollBack();
            throw $e;
        }
    }
    
    public function obtener_detalle_pedido_cobro($pedido_id) {
        $sql = "SELECT producto.producto_nom, detalle.pedidod_cantidad, detalle.pedidod_precio_unitario, 
                       (detalle.pedidod_cantidad * detalle.pedidod_precio_unitario) AS total
                FROM sc_restaurante.tb_pedido_detalle detalle
                JOIN tb_producto producto ON detalle.producto_id = producto.producto_id
                WHERE detalle.pedido_id =  :pedido_id";
        $stmt = Conectar::conexion()->prepare($sql);
        $stmt->bindParam(':pedido_id', $pedido_id);
        $stmt->execute();
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $total_sql = "SELECT SUM(detalle.pedidod_cantidad * detalle.pedidod_precio_unitario) AS total
                      FROM sc_restaurante.tb_pedido_detalle detalle
                      WHERE detalle.pedido_id = :pedido_id";
        $stmt_total = Conectar::conexion()->prepare($total_sql);
        $stmt_total->bindParam(':pedido_id', $pedido_id);
        $stmt_total->execute();
        $total = $stmt_total->fetchColumn();
    
        return [
            "productos" => $productos,
            "total" => $total
        ];
    }
    
    // Registrar detalle del pedido
    public function registrar_detalle_pedido($pedido_id, $producto_id, $cantidad, $precio_unitario, $monto_total) {
        $sql = "INSERT INTO sc_restaurante.tb_pedido_detalle( producto_id, pedido_id, pedidod_cantidad, pedidod_precio_unitario, pedidod_monto_total)
                VALUES (:producto_id, :pedido_id, :cantidad, :precio_unitario, :monto_total)";

        $stmt = Conectar::conexion()->prepare($sql);
        $stmt->bindParam(':producto_id', $producto_id);
        $stmt->bindParam(':pedido_id', $pedido_id);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':precio_unitario', $precio_unitario);
        $stmt->bindParam(':monto_total', $monto_total);
        $stmt->execute();
    }
    
    public function pagar_pedido($pedido_id) {
        $sql = "UPDATE sc_restaurante.tb_pedido SET pedido_est = 2 WHERE pedido_id = :pedido_id";
        $stmt = Conectar::conexion()->prepare($sql);
        $stmt->bindParam(':pedido_id', $pedido_id);
        $stmt->execute();
    }
    public function eliminar_pedido($pedido_id) {
        $sql = "UPDATE sc_restaurante.tb_pedido SET pedido_est = 0 WHERE pedido_id = :pedido_id";
        $stmt = Conectar::conexion()->prepare($sql);
        $stmt->bindParam(':pedido_id', $pedido_id);
        $stmt->execute();
    }
    // Método para obtener todos los pedidos
    public function obtener_pedidos_por_estado($estado) {
        $sql = "SELECT tp.pedido_id, tp.fechacrea, tm.mesa_nmr, tp.pedido_est 
        FROM sc_restaurante.tb_pedido tp
        inner join tb_mesa tm on tm.mesa_id = tp.mesa_id 
        WHERE pedido_est = :estado";
        $stmt = Conectar::conexion()->prepare($sql);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    // Método para obtener el detalle de un pedido específico
    public function obtener_detalle_pedido($pedido_id) {
        $sql = "SELECT tpd.pedidod_id, tpd.fechacrea, tpd.producto_id, tpro.producto_nom, tpd.pedido_id,
            tpd.pedidod_cantidad, tpd.pedidod_precio_unitario, tpd.pedidod_monto_total, 
            tpd.pedidod_est, tm.mesa_nmr
                FROM sc_restaurante.tb_pedido_detalle tpd
                left join sc_restaurante.tb_pedido tp on tp.pedido_id = tpd.pedido_id
                left join tb_mesa tm on tp.mesa_id = tm.mesa_id
				left join tb_producto tpro on tpro.producto_id = tpd.producto_id
                WHERE tp.pedido_id= :pedido_id";
        $stmt = Conectar::conexion()->prepare($sql);
        $stmt->bindParam(':pedido_id', $pedido_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para calcular el monto total y cantidad de productos de un pedido
    public function calcular_totales_pedido($pedido_id) {
        $sql = "SELECT SUM(pedidod_monto_total) AS total_monto, SUM(pedidod_cantidad) AS total_cantidad 
                FROM sc_restaurante.tb_pedido_detalle 
                WHERE pedido_id = :pedido_id";
        $stmt = Conectar::conexion()->prepare($sql);
        $stmt->bindParam(':pedido_id', $pedido_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
