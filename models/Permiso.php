<?php
class Permiso extends Conectar {
    
    public function crear_usuario($pers_id, $rol_id, $sist_id, $perm_usu, $perm_pass) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO sc_seguridad.tb_permiso (pers_id, rol_id, sist_id, perm_usu, perm_pass, perm_est) 
                VALUES (?, ?, ?, ?, ?, 1)";
        $stmt = $conectar->prepare($sql);
        
        // Ejecutar la consulta con los parámetros
        $stmt->execute([$pers_id, $rol_id, $sist_id, $perm_usu, $perm_pass]); // Usando el array como parámetros
        return $stmt->rowCount() > 0; // Retorna verdadero si se insertó correctamente
    }
    
    
    public function listar_personal() {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT pers_id, pers_nombre FROM sc_seguridad.tb_persona WHERE pers_est = 1"; // Cambia el nombre de la tabla y los campos según tu esquema
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function listar_roles() {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT rol_id, rol_nombre FROM sc_seguridad.tb_rol WHERE rol_est = 1";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listar_sistemas() {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT sist_id, sist_nom FROM sc_seguridad.tb_sistema WHERE sist_est = 1";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listar_usuarios() {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT perm_id, perm_usu, pers_id, rol_id, sist_id FROM sc_seguridad.tb_permiso WHERE perm_est = 1";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


?>
