<?php
require_once '../config/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['cliente_id'])) {
        die("⚠️ Sesión no iniciada.");
    }

    $cliente_id = $_SESSION['cliente_id'];
    $metodo_pago_id = $_POST['metodo_pago_id'] ?? null;
    $empleado_id = $_POST['empleado_id'] ?? null;
    $observaciones = $_POST['observaciones'] ?? '';
    $direccion_entrega = $_POST['direccion_entrega'] ?? 'Sin dirección';
    $telefono = $_POST['telefono'] ?? 'Sin teléfono';
    $estado_id = 1; // Estado inicial: pendiente

    try {
        // Obtener productos del carrito
        $stmt = $pdo->prepare("
            SELECT c.producto_id, c.cantidad, p.precio
            FROM carrito c
            JOIN productos p ON c.producto_id = p.producto_id
            WHERE c.cliente_id = ?
        ");
        $stmt->execute([$cliente_id]);
        $carrito = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($carrito)) {
            echo "❌ El carrito está vacío.";
            exit;
        }

        // Calcular total del pedido
        $total_pedido = array_reduce($carrito, function ($total, $item) {
            return $total + ($item['precio'] * $item['cantidad']);
        }, 0);

        // Iniciar transacción
        $pdo->beginTransaction();

        // Insertar pedido
        $stmt = $pdo->prepare("
            INSERT INTO pedido (cliente_id, dni_empleado, direccion_entrega, telefono, estado_id, total_pedido, observaciones)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $cliente_id,
            $empleado_id,
            $direccion_entrega,
            $telefono,
            $estado_id,
            $total_pedido,
            $observaciones
        ]);

        $pedido_id = $pdo->lastInsertId();

        // Insertar detalles del pedido
        $stmt = $pdo->prepare("
            INSERT INTO detalle_pedido (pedido_id, producto_id, cantidad, precio_unitario)
            VALUES (?, ?, ?, ?)
        ");
        foreach ($carrito as $item) {
            $stmt->execute([
                $pedido_id,
                $item['producto_id'],
                $item['cantidad'],
                $item['precio']
            ]);
        }

        // Vaciar carrito
        $pdo->prepare("DELETE FROM carrito WHERE cliente_id = ?")->execute([$cliente_id]);

        // Confirmar transacción
        $pdo->commit();

        // Redirigir con éxito
        header('Location: ../views/dashboard.php?pedido=exitoso');
        exit;
    } catch (PDOException $e) {
        $pdo->rollBack();
        error_log("Error al procesar pedido: " . $e->getMessage());
        echo "❌ Ocurrió un error al procesar tu pedido.";
    }
}
?>
