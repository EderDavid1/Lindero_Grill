<?php
class Mesa extends Conectar
{
    // Método para obtener todas las mesas
    public function get_mesas()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT mesa_id, mesa_nmr, fechacrea, mesa_est, mesa_sillas_num 
                FROM public.tb_mesa order by 1 asc";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        return $result = $stmt->fetchAll();
    }

    // Método para obtener los datos de una mesa específica
    public function ver_mesa($mesa_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT mesa_id, mesa_nmr, mesa_est, mesa_sillas_num 
                FROM public.tb_mesa WHERE mesa_id = ?";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $mesa_id);
        $stmt->execute();
        return $result = $stmt->fetch();
    }
    public function update_mesa_estado($mesa_id, $estado)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE public.tb_mesa SET mesa_est = ? WHERE mesa_id = ?";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $estado);
        $stmt->bindValue(2, $mesa_id);
        $stmt->execute();
        return $stmt->rowCount(); // Devuelve el número de filas afectadas
    }
    // Método para insertar una nueva mesa
    public function insert_mesa($mesa_nmr, $mesa_est, $mesa_sillas_num)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO public.tb_mesa (mesa_nmr, mesa_est, mesa_sillas_num, fechacrea) 
                VALUES (?, ?, ?, NOW())";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $mesa_nmr);
        $stmt->bindValue(2, $mesa_est);
        $stmt->bindValue(3, $mesa_sillas_num);
        $stmt->execute();
    }

    // Método para actualizar una mesa existente
    public function update_mesa($mesa_id, $mesa_nmr, $mesa_est, $mesa_sillas_num)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE public.tb_mesa 
                SET mesa_nmr = ?, mesa_est = ?, mesa_sillas_num = ? 
                WHERE mesa_id = ?";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $mesa_nmr);
        $stmt->bindValue(2, $mesa_est);
        $stmt->bindValue(3, $mesa_sillas_num);
        $stmt->bindValue(4, $mesa_id);
        $stmt->execute();
    }
}
