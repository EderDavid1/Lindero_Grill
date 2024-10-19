<?php
class Solicitud extends conectar
{

    public function get_tipo_solicitante()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT tiposoli_id, tiposoli_nom, tiposoli_est
        FROM sc_gitse.tb_tipo_solicitante where tiposoli_est = 1";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        return $result = $stmt->fetchAll();
    }
    public function get_tipo_certificado($nivel_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        // Usamos una consulta SQL que filtra nivel_id que contiene el valor $nivel_id
        $sql = "SELECT tipocert_id, tipocert_nom, tipocert_form, tipocert_est, nivel_id
                FROM sc_gitse.tb_tipocertificado
                WHERE tipocert_est = 1
                  AND nivel_id::text LIKE ?";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, '%' . $nivel_id . '%');
        $stmt->execute();
        return $result = $stmt->fetchAll();
    }
    
    
    public function get_condiciones()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT cond_id, cond_nom, cond_est
        FROM sc_gitse.tb_condiciones where cond_est=1";
        $stmt = $conectar->prepare($sql);
        
        $stmt->execute();
        return $result = $stmt->fetchAll();
    }
    public function  get_condicion_seguridad( $func_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "select fc.funccondi_id, tbf.func_nom, fcs.condsegu_nom, tc.cate_nom, tr.tiporiesgo_nom    from sc_gitse.tb_funcioncondicion fc 
        inner join sc_gitse.tb_funcion tbf on fc.func_id = tbf.func_id
        inner join sc_gitse.tb_condicion_seguridad fcs on fc.condsegu_id = fcs.condsegu_id
        inner join sc_gitse.tb_categoria tc on tc.categ_id = fcs.cate_id
        inner join sc_gitse.tb_tiporiesgo tr on tr.tiporiesgo_id  = fcs.tiporiesgo_id
        where fc.est=1 and tbf.func_id = ?";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $func_id);
        $stmt->execute();
        return $result = $stmt->fetchAll();
    }
    public function get_tipo_requisitos($tipo_cert)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT ttr.tiporeq_id, ttr.req_id,tr.req_nom , ttr.tipocert_id, ttr.tiporeq_est
        FROM sc_gitse.tb_tipo_req  ttr
        inner join sc_gitse.tb_requisitos tr on ttr.req_id = tr.req_id
        where ttr.tipocert_id = ? and ttr.tiporeq_est = 1 ";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $tipo_cert);
        $stmt->execute();
        return $result = $stmt->fetchAll();
    }
    public function get_funcion()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT func_id, func_nom, func_est
        FROM sc_gitse.tb_funcion WHERE func_est= 1 order by func_nom;";
        $stmt = $conectar->prepare($sql);

        $stmt->execute();
        return $result = $stmt->fetchAll();
    }
    public function get_subfuncion($func_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "
        SELECT subfun_id, func_id, subfun_nom, subfun_orden, subfun_est
        FROM sc_gitse.tb_subfuncion WHERE subfun_est = 1 and func_id =? order by subfun_orden ";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $func_id);
        $stmt->execute();
        return $result = $stmt->fetchAll();
    }
    public function get_nivelRiesgo($subfunc_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT niv_ries_inc, niv_ries_colap
	    FROM sc_gitse.tb_subfuncion where subfun_id = ?
    ";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $subfunc_id);
        $stmt->execute();
        return $result = $stmt->fetchAll();
    }
    
}
