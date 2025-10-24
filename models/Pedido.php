<?php
require_once '../config/db.php';

class Pedido {
    private $pdo;

    public function __construct($conexion) {
        $this->pdo = $conexion;
    }

    // Registrar un pedido
    public function registrarPedido($cliente_id, $dni_empleado, $direccion_entrega, $telefono, $estado_id, $total_pedido, $observaciones) {
        $stmt = $this->pdo->prepare("INSERT INTO pedido (cliente_id, dni_empleado, direccion_entrega, telefono, estado_id, total_pedido, observaciones)
                                     VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $cliente_id,
            $dni_empleado,
            $direccion_entrega,
            $telefono,
            $estado_id,
            $total_pedido,
            $observaciones
        ]);
    }

    // Obtener todos los pedidos de un cliente
    public function obtenerPedidosPorCliente($cliente_id) {
        $stmt = $this->pdo->prepare("SELECT pedido_id, direccion_entrega, telefono, estado_id, total_pedido, observaciones
                                     FROM pedido
                                     WHERE cliente_id = ?
                                     ORDER BY pedido_id DESC");
        $stmt->execute([$cliente_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener todos los pedidos (para panel administrativo)
    public function obtenerTodosLosPedidos() {
        $stmt = $this->pdo->query("SELECT p.pedido_id, c.nombre AS cliente, p.direccion_entrega, p.telefono, p.estado_id, p.total_pedido, p.observaciones
                                   FROM pedido p
                                   JOIN clientes c ON p.cliente_id = c.cliente_id
                                   ORDER BY p.pedido_id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
