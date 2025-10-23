<?php
require_once '../config/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente_id = $_SESSION['cliente_id'];
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];

    $stmt = $pdo->prepare("INSERT INTO carrito (cliente_id, producto_id, cantidad) VALUES (?, ?, ?)");
    $stmt->execute([$cliente_id, $producto_id, $cantidad]);

    header('Location: ../views/carrito.php');
}
if ($_POST['accion'] === 'eliminar') {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM carrito WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: ../views/carrito.php');
}

?>
