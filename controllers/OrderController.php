<?php
require_once '../config/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente_id = $_SESSION['cliente_id'];
    $metodo_pago_id = $_POST['metodo_pago_id'];
    $empleado_id = $_POST['empleado_id'];
    $observaciones = $_POST['observaciones'];

    // Obtener productos del carrito
    $stmt = $pdo->prepare("SELECT * FROM carrito WHERE cliente_id = ?");
    $stmt->execute([$cliente_id]);
    $carrito = $stmt->fetchAll();

    foreach ($carrito as $item) {
        $stmt = $pdo->prepare("INSERT INTO pedido (cliente_id, producto_id, cantidad, fecha, metodo_pago_id, empleado_id, observaciones)
                               VALUES (?, ?, ?, NOW(), ?, ?, ?)");
        $stmt->execute([$cliente_id, $item['producto_id'], $item['cantidad'], $metodo_pago_id, $empleado_id, $observaciones]);
    }

    // Vaciar carrito
    $pdo->prepare("DELETE FROM carrito WHERE cliente_id = ?")->execute([$cliente_id]);

    echo "Pedido registrado correctamente";
}
?>
