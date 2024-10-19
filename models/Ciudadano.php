<?php
class ciudadano extends conectar
{

    public function get_ciudadano_x_doc($ciudadano_dni)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT ciud_id,ciud_domicilio_real, ciud_numero_documento, ciud_primer_apellido, ciud_segundo_apellido, ciud_nombre, ciud_fecha_nac,ciud_celular, ciud_sexo, ciud_foto
            FROM public.tb_ciudadano
            where ciud_numero_documento =? and ciud_estado  = 'A'";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $ciudadano_dni);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
}
