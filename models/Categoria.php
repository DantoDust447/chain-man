<?php
class Categoria {
    private $pdo;

    public function __construct($conexion) {
        $this->pdo = $conexion;
    }

    public function obtenerTodas() {
        $stmt = $this->pdo->query("SELECT categoria_id, categoria FROM cat_productos ORDER BY categoria ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
