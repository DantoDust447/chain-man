<?php
require_once '../config/db.php';

class Carrito {
    private $pdo;

    public function __construct($conexion) {
        $this->pdo = $conexion;
    }

    // Agregar producto al carrito con fecha actual
    public function agregarProducto($cliente_id, $producto_id, $cantidad) {
        $stmt = $this->pdo->prepare("INSERT INTO carrito (cliente_id, producto_id, cantidad, fecha)
                                     VALUES (?, ?, ?, NOW())");
        return $stmt->execute([$cliente_id, $producto_id, $cantidad]);
    }

    // Obtener todos los registros del carrito de un cliente con nombre y precio del producto
    public function obtenerCarrito($cliente_id) {
        $stmt = $this->pdo->prepare("SELECT c.id, c.cliente_id, c.producto_id, c.cantidad, c.fecha,
                                            p.nombre, p.precio
                                     FROM carrito c
                                     JOIN productos p ON c.producto_id = p.producto_id
                                     WHERE c.cliente_id = ?");
        $stmt->execute([$cliente_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Eliminar un producto del carrito por ID
    public function eliminarProducto($id) {
        $stmt = $this->pdo->prepare("DELETE FROM carrito WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Vaciar todo el carrito de un cliente
    public function vaciarCarrito($cliente_id) {
        $stmt = $this->pdo->prepare("DELETE FROM carrito WHERE cliente_id = ?");
        return $stmt->execute([$cliente_id]);
    }
}
?>
