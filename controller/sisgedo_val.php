<?php
// Construye la URL con los parámetros de la cadena de consulta
$url = 'http://192.168.12.21/Pide/Sisgedo/?expe=' .  $_POST['expe'] . '&reg='.$_POST['reg'];

// Realiza la solicitud HTTP y obtén la respuesta
$response = file_get_contents($url);

// Envía la respuesta al cliente
echo $response;
?>
