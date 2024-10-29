<?php
class Producto extends Conectar
{
    // Método para obtener todos los productos
     // Función para obtener todas las categorías
     public function get_categorias() {
        $sql = "SELECT cate_prod_id, cate_nom, fechacrea, cate_est
	        FROM public.tb_categoria_producto where cate_est = 1;"; // Asegúrate de que la tabla y los campos existen
        return Conectar::conexion()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Modificar get_productos para que acepte una categoría opcional
    public function get_productos($categoria_id = null) {
        $sql = "SELECT p.producto_id, p.producto_nom, p.producto_desc, p.producto_precio, p.plato_est FROM tb_producto p";
        
        // Agregar WHERE si se proporciona una categoría
        if ($categoria_id) {
            $sql .= " WHERE p.cate_producto_id = :categoria_id"; // Asegúrate de que cate_producto_id es la columna correcta
        }
        
        $stmt = Conectar::conexion()->prepare($sql);
        
        // Bindear el parámetro de categoría si está definido
        if ($categoria_id) {
            $stmt->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para insertar un nuevo producto
    public function insert_producto($nombre, $descripcion, $precio, $categoria_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO public.tb_producto (producto_nom, producto_desc, producto_precio, cate_producto_id, fechacrea, plato_est) 
                VALUES (?, ?, ?, ?, NOW(), 1)";
        $stmt = $conectar->prepare($sql);
        $stmt->execute([$nombre, $descripcion, $precio, $categoria_id]);
        return $stmt->rowCount();
    }

    // Método para actualizar un producto existente
    public function update_producto($id, $nombre, $descripcion, $precio, $categoria_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE public.tb_producto 
                SET producto_nom = ?, producto_desc = ?, producto_precio = ?, cate_producto_id = ? 
                WHERE producto_id = ?";
        $stmt = $conectar->prepare($sql);
        $stmt->execute([$nombre, $descripcion, $precio, $categoria_id, $id]);
        return $stmt->rowCount();
    }

    // Método para eliminar un producto (cambiar estado)
    public function delete_producto($id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE public.tb_producto SET plato_est = 0 WHERE producto_id = ?";
        $stmt = $conectar->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }
}
?>
