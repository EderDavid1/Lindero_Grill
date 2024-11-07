<?php

class Cobro extends Conectar {
    
    public function listar_cobros($fechaInicio = null, $fechaFin = null, $mesa = null, $tipo_comprobante = null) {
        $conexion = Conectar::conexion();
        $sql = "SELECT cob_id, pedido_id, cob_total, cob_ingreso, cob_vuelto, tipo_comprobante, 
                       cob_dni, cob_nombre, cob_ruc, cob_razon_social, fechacrea 
                FROM sc_restaurante.tb_cobro WHERE 1=1";
        
        if ($fechaInicio) $sql .= " AND DATE(fechacrea) >= :fechaInicio";
        if ($fechaFin) $sql .= " AND DATE(fechacrea) <= :fechaFin";
        if ($mesa) $sql .= " AND pedido_id = :mesa";
        if ($tipo_comprobante) $sql .= " AND tipo_comprobante = :tipo_comprobante";
        
        $stmt = $conexion->prepare($sql);
        
        if ($fechaInicio) $stmt->bindParam(":fechaInicio", $fechaInicio);
        if ($fechaFin) $stmt->bindParam(":fechaFin", $fechaFin);
        if ($mesa) $stmt->bindParam(":mesa", $mesa);
        if ($tipo_comprobante) $stmt->bindParam(":tipo_comprobante", $tipo_comprobante);
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function resumen_cobros_dia() {
        $conexion = Conectar::conexion();
        $sql = "SELECT COUNT(*) as cantidad_cobros, SUM(cob_total) as total_ingresado, SUM(cob_vuelto) as total_vuelto
                FROM sc_restaurante.tb_cobro WHERE DATE(fechacrea) = CURDATE()";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function listar_mesas() {
        $conexion = Conectar::conexion();
        $sql = "SELECT mesa_id, mesa_nmr FROM public.tb_mesa WHERE mesa_est = 1";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtener_detalle_cobro($cobro_id) {
        $conexion = Conectar::conexion();
        $sql = "SELECT cob_id, pedido_id, cob_total, cob_ingreso, cob_vuelto, tipo_comprobante, 
                       cob_dni, cob_nombre, cob_ruc, cob_razon_social, fechacrea, cob_conceptos
                FROM sc_restaurante.tb_cobro 
                WHERE cob_id = :cobro_id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(":cobro_id", $cobro_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function obtener_detalle_cobro_pedido($pedido_id) {
        $conexion = Conectar::conexion();
        $sql = "SELECT cob_id, pedido_id, cob_total, cob_ingreso, cob_vuelto, tipo_comprobante, 
                       cob_dni, cob_nombre, cob_ruc, cob_razon_social, fechacrea, cob_conceptos
                FROM sc_restaurante.tb_cobro 
                WHERE pedido_id = :pedido_id and cob_estado =1";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(":pedido_id", $pedido_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}
?>
