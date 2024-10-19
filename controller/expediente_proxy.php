<?php
// expediente_proxy.php

    $dependencia = '00018';
    $tipo_documento = '104';
    $estado = '1';

    // URL del API con los parámetros
    $url = "https://www.munichiclayo.gob.pe/SGD_API/controller/expediente.php?op=filtrar_por_dependencia_receptora";
    
    // Datos a enviar en la solicitud POST
    $data = [
        'dependencia_id' => $dependencia,
        'tipo_documento' => $tipo_documento,
        'estado' => $estado
    ];

    // Inicializa cURL
    $ch = curl_init($url);
    
    // Configuración de cURL para enviar los datos como POST
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Ejecuta la solicitud
    $response = curl_exec($ch);
    curl_close($ch);

    // Devuelve la respuesta al frontend
    echo $response;
    
?>
