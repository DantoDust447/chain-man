<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['cliente_id'])) {
    header('Location: ../login.php');
    exit;
}

$cliente_id = $_SESSION['cliente_id'];
$producto_id = $_POST['producto_id'] ?? null;
$cantidad = $_POST['cantidad'] ?? 1;

if ($producto_id && $cantidad > 0) {
    $stmt = $pdo->prepare("INSERT INTO carrito (cliente_id, producto_id, cantidad, fecha)
                           VALUES (?, ?, ?, NOW())");
    $stmt->execute([$cliente_id, $producto_id, $cantidad]);

    header('Location: ../index.php?agregado=1');
    exit;
} else {
    header('Location: ../index.php?error=1');
    exit;
}
?>
