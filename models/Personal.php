<?php
class Personal extends Conectar
{
    // Obtener todos los registros de personas
    public function get_personas()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT pers_id, pers_nombre, pers_apelpat, pers_apelmat, pers_foto, fechacrea, pers_est, pers_doc 
                FROM sc_seguridad.tb_persona where pers_est=1  ORDER BY 1 ASC";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        return $result = $stmt->fetchAll();
    }

    // Obtener un registro específico
    public function ver_persona($pers_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT pers_id, pers_nombre, pers_apelpat, pers_apelmat, pers_foto, pers_est, pers_doc 
                FROM sc_seguridad.tb_persona WHERE pers_id = ?";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $pers_id);
        $stmt->execute();
        return $result = $stmt->fetch();
    }

    // Insertar un nuevo registro
    public function insert_persona($pers_nombre, $pers_apelpat, $pers_apelmat, $pers_foto, $pers_est, $pers_doc)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO sc_seguridad.tb_persona (pers_nombre, pers_apelpat, pers_apelmat, pers_foto, pers_est, pers_doc, fechacrea) 
                VALUES (?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $pers_nombre);
        $stmt->bindValue(2, $pers_apelpat);
        $stmt->bindValue(3, $pers_apelmat);
        $stmt->bindValue(4, $pers_foto);
        $stmt->bindValue(5, $pers_est);
        $stmt->bindValue(6, $pers_doc);
        $stmt->execute();
    }

    // Actualizar un registro existente
    public function update_persona($pers_id, $pers_nombre, $pers_apelpat, $pers_apelmat, $pers_foto, $pers_est, $pers_doc)
{
    $conectar = parent::conexion();
    parent::set_names();

    // Si la imagen está vacía, no actualizarla
    $sql = empty($pers_foto) ?
        "UPDATE sc_seguridad.tb_persona SET pers_nombre = ?, pers_apelpat = ?, pers_apelmat = ?, pers_est = ?, pers_doc = ? WHERE pers_id = ?" :
        "UPDATE sc_seguridad.tb_persona SET pers_nombre = ?, pers_apelpat = ?, pers_apelmat = ?, pers_foto = ?, pers_est = ?, pers_doc = ? WHERE pers_id = ?";

    $stmt = $conectar->prepare($sql);

    // Bind de valores dependiendo de si hay imagen o no
    $stmt->bindValue(1, $pers_nombre);
    $stmt->bindValue(2, $pers_apelpat);
    $stmt->bindValue(3, $pers_apelmat);
    if (!empty($pers_foto)) {
        $stmt->bindValue(4, $pers_foto);
        $stmt->bindValue(5, $pers_est);
        $stmt->bindValue(6, $pers_doc);
        $stmt->bindValue(7, $pers_id);
    } else {
        $stmt->bindValue(4, $pers_est);
        $stmt->bindValue(5, $pers_doc);
        $stmt->bindValue(6, $pers_id);
    }
    $stmt->execute();
}


    // Cambiar el estado de un registro
    public function update_persona_estado($pers_id, $estado)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE sc_seguridad.tb_persona SET pers_est = ? WHERE pers_id = ?";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $estado);
        $stmt->bindValue(2, $pers_id);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
?>
