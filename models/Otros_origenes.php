<?php
class otros_origenes extends conectar
{

    public function get_otros_origenes_x_search($otros_origenes_input)
    {
        $conectar = parent::conexion();
        parent::set_names();

        // Escapa el valor de búsqueda para evitar inyecciones SQL
        $search_value = '%' . $otros_origenes_input . '%';

        // Nueva consulta a la tabla `idosgd.tdtr_otro_origen`
        $sql = "
        SELECT co_otr_ori, nu_doc_otr_ori, co_tip_otr_ori, de_ape_pat_otr, de_ape_mat_otr, 
               de_nom_otr, de_raz_soc_otr, de_dir_otro_ori, ti_origen, ref_co_otr_ori, 
               ub_dep, ub_pro, ub_dis, es_activo, in_busca_texto, de_email, de_telefo
        FROM idosgd.tdtr_otro_origen
        WHERE co_otr_ori LIKE :search_value
           OR nu_doc_otr_ori ILIKE :search_value
           OR co_tip_otr_ori ILIKE :search_value
           OR de_ape_pat_otr ILIKE :search_value
           OR de_ape_mat_otr ILIKE :search_value
           OR de_nom_otr ILIKE :search_value
           OR de_raz_soc_otr ILIKE :search_value
           OR de_dir_otro_ori ILIKE :search_value
           OR ti_origen ILIKE :search_value
           OR ref_co_otr_ori ILIKE :search_value
           OR ub_dep ILIKE :search_value
           OR ub_pro ILIKE :search_value
           OR ub_dis ILIKE :search_value
           OR es_activo ILIKE :search_value
           OR in_busca_texto ILIKE :search_value
           OR de_email ILIKE :search_value
           OR de_telefo ILIKE :search_value
           order by co_otr_ori asc
    ";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(':search_value', $search_value);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }
    public function get_otros_origenes_top_10()
    {
        $conectar = parent::conexion();
        parent::set_names();

        // Nueva consulta a la tabla `idosgd.tdtr_otro_origen`
        $sql = "
        SELECT co_otr_ori, nu_doc_otr_ori, co_tip_otr_ori, de_ape_pat_otr, de_ape_mat_otr, 
               de_nom_otr, de_raz_soc_otr, de_dir_otro_ori, ti_origen, ref_co_otr_ori, 
               ub_dep, ub_pro, ub_dis, es_activo, in_busca_texto, de_email, de_telefo
        FROM idosgd.tdtr_otro_origen ORDER BY ctid  desc
                    LIMIT 10
        
    ";

        $sql = $conectar->prepare($sql);

        $sql->execute();

        return $resultado = $sql->fetchAll();
    }
    public function get_otros_origenes_x_co($co_otr_ori)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "
        SELECT co_otr_ori, nu_doc_otr_ori, co_tip_otr_ori, de_ape_pat_otr, de_ape_mat_otr, 
               de_nom_otr, de_raz_soc_otr, de_dir_otro_ori, ti_origen, ref_co_otr_ori, 
               ub_dep, ub_pro, ub_dis, es_activo, in_busca_texto, de_email, de_telefo
        FROM idosgd.tdtr_otro_origen
        WHERE co_otr_ori = ?
    ";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $co_otr_ori);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }
    public function obtener_ultimo_valor()
    {
        $conectar = parent::conexion();
        parent::set_names();

        // Consulta SQL para obtener el último valor de co_otr_ori
        $sql = "
            SELECT co_otr_ori
            FROM idosgd.tdtr_otro_origen
            ORDER BY co_otr_ori DESC
            LIMIT 1
        ";

        $sql = $conectar->prepare($sql);
        $sql->execute();

        $resultado = $sql->fetch(PDO::FETCH_ASSOC);

        // Verifica si se encontró un valor
        if ($resultado) {
            return $resultado['co_otr_ori'];
        } else {
            return 0; // Retorna 0 si no hay registros, para empezar desde 1
        }
    }

    public function get_data_direccion()
    {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "SELECT ubdep, ubprv, ubdis, ubloc, coreg, nodep, noprv, nodis, cpdis, stubi, stsob, feres, inubi, ub_inei, ccod_tipo_ubi
	FROM idosgd.idtubias;";

        $sql = $conectar->prepare($sql);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }
    public function registrar_nuevo($data)
    {
        $conectar = parent::conexion();
        parent::set_names();

        // Obtener el último valor de co_otr_ori
        $ultimo_valor = $this->obtener_ultimo_valor();
        $nuevo_valor = $ultimo_valor + 1; // Incrementar el último valor
// Formatear el nuevo valor a un string con ceros a la izquierda hasta alcanzar 10 dígitos
        $nuevo_valor_formateado = str_pad($nuevo_valor, 10, '0', STR_PAD_LEFT);
        // Consulta SQL para insertar un nuevo registro
        $sql = "
        INSERT INTO idosgd.tdtr_otro_origen 
            (co_otr_ori, nu_doc_otr_ori, co_tip_otr_ori, de_ape_pat_otr, de_ape_mat_otr, 
             de_nom_otr, de_raz_soc_otr, de_dir_otro_ori, 
             ub_dep, ub_pro, ub_dis, 
             de_email, de_telefo)
        VALUES 
            (:co_otr_ori, :nu_doc_otr_ori, :co_tip_otr_ori, :de_ape_pat_otr, :de_ape_mat_otr, 
             :de_nom_otr, :de_raz_soc_otr, :de_dir_otro_ori,
             :ub_dep, :ub_pro, :ub_dis, :de_email, :de_telefo)
    ";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(':co_otr_ori', $nuevo_valor_formateado);
        $sql->bindValue(':nu_doc_otr_ori', $data['nu_doc_otr_ori']);
        $sql->bindValue(':co_tip_otr_ori', $data['co_tip_otr_ori']);
        $sql->bindValue(':de_ape_pat_otr', $data['de_ape_pat_otr']);
        $sql->bindValue(':de_ape_mat_otr', $data['de_ape_mat_otr']);
        $sql->bindValue(':de_nom_otr', $data['de_nom_otr']);
        $sql->bindValue(':de_raz_soc_otr', $data['de_raz_soc_otr']);
        $sql->bindValue(':de_dir_otro_ori', $data['de_dir_otro_ori']);

        $sql->bindValue(':ub_dep', $data['ub_dep']);
        $sql->bindValue(':ub_pro', $data['ub_pro']);
        $sql->bindValue(':ub_dis', $data['ub_dis']);
        $sql->bindValue(':de_email', $data['de_email']);
        $sql->bindValue(':de_telefo', $data['de_telefo']);

        $sql->execute();

        // Verifica si la inserción fue exitosa
        return $resultado = $sql->fetchAll();
    }


    public function editar_registro($co_otr_ori, $data)
    {
        $conectar = parent::conexion();
        parent::set_names();

        // Consulta SQL para actualizar un registro existente
        $sql = "
        UPDATE idosgd.tdtr_otro_origen 
        SET 
            nu_doc_otr_ori = :nu_doc_otr_ori,
            co_tip_otr_ori = :co_tip_otr_ori,
            de_ape_pat_otr = :de_ape_pat_otr,
            de_ape_mat_otr = :de_ape_mat_otr,
            de_nom_otr = :de_nom_otr,
            de_raz_soc_otr = :de_raz_soc_otr,
            de_dir_otro_ori = :de_dir_otro_ori,
            ub_dep = :ub_dep,
            ub_pro = :ub_pro,
            ub_dis = :ub_dis,         
            de_email = :de_email,
            de_telefo = :de_telefo
        WHERE co_otr_ori = :co_otr_ori
    ";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(':nu_doc_otr_ori', $data['nu_doc_otr_ori']);
        $sql->bindValue(':co_tip_otr_ori', $data['co_tip_otr_ori']);
        $sql->bindValue(':de_ape_pat_otr', $data['de_ape_pat_otr']);
        $sql->bindValue(':de_ape_mat_otr', $data['de_ape_mat_otr']);
        $sql->bindValue(':de_nom_otr', $data['de_nom_otr']);
        $sql->bindValue(':de_raz_soc_otr', $data['de_raz_soc_otr']);
        $sql->bindValue(':de_dir_otro_ori', $data['de_dir_otro_ori']);

        $sql->bindValue(':ub_dep', $data['ub_dep']);
        $sql->bindValue(':ub_pro', $data['ub_pro']);
        $sql->bindValue(':ub_dis', $data['ub_dis']);

        $sql->bindValue(':de_email', $data['de_email']);
        $sql->bindValue(':de_telefo', $data['de_telefo']);
        $sql->bindValue(':co_otr_ori', $co_otr_ori);

        $sql->execute();

        // Verifica si la actualización fue exitosa
        return $resultado = $sql->fetchAll();
    }



}
