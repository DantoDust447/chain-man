<?php
require_once '../config/db.php';

class Pedido {
    private $pdo;

    public function __construct($conexion) {
        $this->pdo = $conexion;
    }

    /**
     * Registrar un nuevo pedido
     */
    public function registrarPedido($cliente_id, $dni_empleado, $direccion_entrega, $telefono, $estado_id, $total_pedido, $observaciones) {
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO pedido (cliente_id, dni_empleado, direccion_entrega, telefono, estado_id, total_pedido, observaciones)
                VALUES (:cliente_id, :dni_empleado, :direccion_entrega, :telefono, :estado_id, :total_pedido, :observaciones)
            ");
            return $stmt->execute([
                ':cliente_id' => $cliente_id,
                ':dni_empleado' => $dni_empleado,
                ':direccion_entrega' => $direccion_entrega,
                ':telefono' => $telefono,
                ':estado_id' => $estado_id,
                ':total_pedido' => $total_pedido,
                ':observaciones' => $observaciones
            ]);
        } catch (PDOException $e) {
            error_log("Error al registrar pedido: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Obtener todos los pedidos de un cliente específico
     */
    public function obtenerPedidosPorCliente($cliente_id) {
    $stmt = $this->pdo->prepare("
        SELECT pr.nombre AS producto,
               dp.cantidad,
               p.fecha,
               mp.metodo AS metodo,
               p.observaciones
        FROM pedido p
        JOIN detalle_pedido dp ON p.pedido_id = dp.pedido_id
        JOIN productos pr ON dp.producto_id = pr.producto_id
        JOIN metodo_pago mp ON p.metodo_pago_id = mp.id
        WHERE p.cliente_id = ?
        ORDER BY p.fecha DESC
    ");
    $stmt->execute([$cliente_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function obtenerPedidosConDetalles($cliente_id) {
    $stmt = $this->pdo->prepare("
        SELECT p.pedido_id,
               p.total_pedido,
               p.direccion_entrega,
               p.telefono,
               p.estado_id,
               p.observaciones,
               p.fecha,
               mp.metodo AS metodo,
               pr.nombre AS producto,
               dp.cantidad
        FROM pedido p
        JOIN detalle_pedido dp ON p.pedido_id = dp.pedido_id
        JOIN productos pr ON dp.producto_id = pr.producto_id
        JOIN metodo_pago mp ON p.metodo = mp.metodo_pago_id
        WHERE p.cliente_id = ?
        ORDER BY p.fecha DESC
    ");
    $stmt->execute([$cliente_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}





    /**
     * Obtener todos los pedidos (para panel administrativo)
     */
    public function obtenerTodosLosPedidos() {
        try {
            $stmt = $this->pdo->query("
                SELECT p.pedido_id, c.nombre AS cliente, p.direccion_entrega, p.telefono, p.estado_id, p.total_pedido, p.observaciones
                FROM pedido p
                JOIN clientes c ON p.cliente_id = c.cliente_id
                ORDER BY p.pedido_id DESC
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener todos los pedidos: " . $e->getMessage());
            return [];
        }
    }
}
?>
