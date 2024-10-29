<?php
class Orden_giro extends conectar
{
    public function abrir_procedimiento($ciud_id, $empr_id, $proced_id)
    {
        try {
            $conectar = parent::conexion();
            parent::set_names();

            // Llamada al procedimiento almacenado `abrir_procedimiento`
            $sql = "SELECT * FROM sc_giros.abrir_procedimiento(?, ?, ?);";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $ciud_id);
            $sql->bindValue(2, $empr_id);
            $sql->bindValue(3, $proced_id);
            $sql->execute();

            return $sql->fetchAll();
        } catch (Exception $e) {
            // Manejo de errores
            return ["error" => $e->getMessage()];
        }
    }

    public function girar_tasas($tasatciudadano, $usuario_id, $comentario)
    {
        try {
            $conectar = parent::conexion();
            parent::set_names();

            // Llamada al procedimiento almacenado `pagar_tasa_ciud`
            $sql = "CALL sc_giros.pagar_tasa_ciud(?, ?, ?);";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $tasatciudadano);
            $sql->bindValue(2, $usuario_id);
            $sql->bindValue(3, $comentario);
            $sql->execute();

            return $sql->fetchAll();
        } catch (Exception $e) {
            // Manejo de errores
            return ["error" => $e->getMessage()];
        }
    }
}
