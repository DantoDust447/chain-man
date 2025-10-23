<?php
require_once '../config/db.php';

class Carrito {
    private $pdo;

    public function __construct($conexion) {
        $this->pdo = $conexion;
    }

    // Agregar producto al carrito
    public function agregarProducto($cliente_id, $producto_id, $cantidad) {
        $stmt = $this->pdo->prepare("INSERT INTO carrito (cliente_id, producto_id, cantidad) VALUES (?, ?, ?)");
        return $stmt->execute([$cliente_id, $producto_id, $cantidad]);
    }

    // Obtener productos del carrito de un cliente
    public function obtenerCarrito($cliente_id) {
        $stmt = $this->pdo->prepare("SELECT c.id, p.nombre, p.precio, c.cantidad, p.codigo AS producto_id
                                     FROM carrito c
                                     JOIN productos p ON c.producto_id = p.codigo
                                     WHERE c.cliente_id = ?");
        $stmt->execute([$cliente_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Eliminar un producto del carrito
    public function eliminarProducto($id) {
        $stmt = $this->pdo->prepare("DELETE FROM carrito WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Vaciar el carrito del cliente
    public function vaciarCarrito($cliente_id) {
        $stmt = $this->pdo->prepare("DELETE FROM carrito WHERE cliente_id = ?");
        return $stmt->execute([$cliente_id]);
    }
}
?>
