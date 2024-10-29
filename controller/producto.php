<?php
require_once("../config/conexion.php");
require_once("../models/Producto.php");

$producto = new Producto();

switch ($_GET["op"]) {
    // Listar productos
    case "listar_productos":
        $categoria_id = isset($_POST["categoria_id"]) ? $_POST["categoria_id"] : null; // Obtener el ID de categoría
        $datos = $producto->get_productos($categoria_id); // Pasar la categoría a la función
    
        // Devolver los datos en el formato esperado por DataTables
        echo json_encode(["data" => $datos]); // Devolver como objeto con la clave 'data'
        break;

    // Obtener categorías
    case "get_categorias":
        $datos = $producto->get_categorias(); // Obtener las categorías
        echo json_encode($datos); // Devolver en formato JSON
        break;
    // Insertar o actualizar un producto
    case "guardar_producto":
        if (empty($_POST["producto_id"])) {
            $producto->insert_producto($_POST["producto_nom"], $_POST["producto_desc"], $_POST["producto_precio"], $_POST["cate_producto_id"]);
            echo json_encode(["status" => "success", "message" => "Producto registrado correctamente"]);
        } else {
            $producto->update_producto($_POST["producto_id"], $_POST["producto_nom"], $_POST["producto_desc"], $_POST["producto_precio"], $_POST["cate_producto_id"]);
            echo json_encode(["status" => "success", "message" => "Producto actualizado correctamente"]);
        }
        break;

    // Eliminar producto
    case "eliminar_producto":
        $producto->delete_producto($_POST["producto_id"]);
        echo json_encode(["status" => "success", "message" => "Producto eliminado correctamente"]);
        break;
}
?>
