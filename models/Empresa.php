<?php
class Empresa extends conectar
{

    public function get_empresa_x_RUC($empr_ruc)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT empr_id, empr_categoria, ubig_id, gico_id, empr_ruc, empr_razon_social, empr_nombre_comercial, gico_id, empr_tipo_actividad, empr_direccion, empr_telefono, empr_correo, empr_area_establecimiento, empr_estado, empr_created_at, empr_updated_at
                    FROM public.tb_empresa 
                    WHERE empr_ruc = ? and empr_estado='A'";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $empr_ruc);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function getGirosByString($giros_string)
    {
        // Remueve los caracteres "{" y "}"
        $giros_string = str_replace(array('{', '}'), '', $giros_string);

        // Divide la cadena en un array utilizando la coma como delimitador
        $giros_array = explode(',', $giros_string);

        // Inicializa un array para almacenar los nombres de los giros
        $nombres_giros = array();

        // Itera sobre cada ID de giro
        foreach ($giros_array as $gico_id) {
            // Obtiene el nombre del giro utilizando la función getGiros
            $nombre_giro = $this->getGiros($gico_id);

            // Si se encuentra el nombre del giro, agrégalo al array de nombres
            if ($nombre_giro) {
                $nombres_giros[] = $nombre_giro;
            }
        }

        return $nombres_giros;
    }
    public function getGiros($gico_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT gico_nombre 
            FROM public.tb_giro_comercial  
            WHERE gico_id = ?";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $gico_id, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result['gico_nombre'];
        } else {
            return null; // Si no hay resultados, retorna null
        }
    }
    public function get_direcciones($empr_ruc)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT empr_id, empr_direccion
            FROM public.tb_empresa  
            WHERE empr_ruc = ?";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $empr_ruc, PDO::PARAM_STR);
        $stmt->execute();
        return $result = $stmt->fetchAll();
    }
    public function get_string_prov($ubigeo)
    {
        // Extrae los primeros 4 caracteres del código de ubigeo para obtener el código de provincia
        $cod_prov = substr($ubigeo, 0, 4);
    
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT cod_prov_sunat, desc_prov_sunat
            FROM sc_escalafon.tb_ubigeo  
            WHERE cod_prov_sunat = ?";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $cod_prov, PDO::PARAM_STR);
        $stmt->execute();
        return $result = $stmt->fetchAll();
    }
    
    public function get_provincia()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT DISTINCT cod_dep_sunat, desc_dep_sunat, cod_prov_sunat, desc_prov_sunat
        FROM sc_escalafon.tb_ubigeo where cod_dep_sunat = '14'";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        return $result = $stmt->fetchAll();
    }
    public function get_distrito($cod_prov)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT cod_ubigeo_sunat, desc_ubigeo_sunat
        FROM sc_escalafon.tb_ubigeo where cod_prov_sunat = ? ";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $cod_prov, PDO::PARAM_STR);
        $stmt->execute();
        return $result = $stmt->fetchAll();
    }
}
