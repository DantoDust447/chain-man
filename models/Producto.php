<?php
class Producto {
    private $pdo;

    public function __construct($conexion) {
        $this->pdo = $conexion;
    }

    public function obtenerTodos() {
        $stmt = $this->pdo->query("SELECT * FROM productos ORDER BY nombre ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorCategoria($categoria_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM productos WHERE categoria_id = ?");
        $stmt->execute([$categoria_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
