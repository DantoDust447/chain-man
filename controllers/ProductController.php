<?php
require_once '../config/db.php';

// Mostrar todos los productos
function obtenerProductos() {
    global $pdo;
    $stmt = $pdo->query("SELECT p.codigo, p.nombre, p.marca, p.precio, e.descripcion AS estado, c.categoria
                         FROM productos p
                         JOIN estado e ON p.estado_id = e.id
                         JOIN cat_productos c ON p.categoria_id = c.id");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Mostrar un producto por ID
function obtenerProductoPorId($codigo) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT p.codigo, p.nombre, p.marca, p.precio, e.descripcion AS estado, c.categoria
                           FROM productos p
                           JOIN estado e ON p.estado_id = e.id
                           JOIN cat_productos c ON p.categoria_id = c.id
                           WHERE p.codigo = ?");
    $stmt->execute([$codigo]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
