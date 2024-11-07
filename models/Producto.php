<?php
class Producto extends Conectar
{
    // Obtener todas las categorías
    public function get_categorias()
    {
        $sql = "SELECT cate_prod_id, cate_nom, fechacrea, cate_est FROM public.tb_categoria_producto WHERE cate_est = 1";
        return Conectar::conexion()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener productos con categoría opcional
    public function get_productos($categoria_id = null)
    {
        $sql = "SELECT producto_id, producto_nom, producto_desc, producto_precio, plato_est 
                FROM tb_producto 
                WHERE plato_est = 1";

        if ($categoria_id) {
            $sql .= " AND cate_producto_id = :categoria_id";
        }

        $stmt = Conectar::conexion()->prepare($sql);
        if ($categoria_id) {
            $stmt->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener producto por ID
    public function get_producto_id($producto_id)
    {
        $sql = "SELECT producto_id, producto_nom, producto_desc, producto_precio, plato_est, cate_producto_id 
                FROM tb_producto 
                WHERE producto_id = :producto_id";
        $stmt = Conectar::conexion()->prepare($sql);
        $stmt->bindParam(":producto_id", $producto_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Cambiado para obtener solo un producto
    }

    // Insertar producto
    public function insert_producto($nombre, $descripcion, $precio, $categoria_id)
    {
        $sql = "INSERT INTO tb_producto (producto_nom, producto_desc, producto_precio, cate_producto_id, fechacrea, plato_est) 
                VALUES (?, ?, ?, ?, NOW(), 1)";
        $stmt = Conectar::conexion()->prepare($sql);
        $stmt->execute([$nombre, $descripcion, $precio, $categoria_id]);
        return $stmt->rowCount();
    }

    // Actualizar producto
    public function update_producto($id, $nombre, $descripcion, $precio, $categoria_id)
    {
        $sql = "UPDATE tb_producto 
                SET producto_nom = ?, producto_desc = ?, producto_precio = ?, cate_producto_id = ? 
                WHERE producto_id = ?";
        $stmt = Conectar::conexion()->prepare($sql);
        $stmt->execute([$nombre, $descripcion, $precio, $categoria_id, $id]);
        return $stmt->rowCount();
    }

    // Eliminar (cambiar estado) producto
    public function delete_producto($id)
    {
        $sql = "UPDATE tb_producto SET plato_est = 0 WHERE producto_id = ?";
        $stmt = Conectar::conexion()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }
}
