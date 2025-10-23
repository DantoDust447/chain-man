<?php
require_once '../config/db.php';

class Pedido {
    private $pdo;

    public function __construct($conexion) {
        $this->pdo = $conexion;
    }

    // Registrar un pedido
    public function registrarPedido($cliente_id, $producto_id, $cantidad, $metodo_pago_id, $empleado_id, $observaciones) {
        $stmt = $this->pdo->prepare("INSERT INTO pedido (cliente_id, producto_id, cantidad, fecha, metodo_pago_id, empleado_id, observaciones)
                                     VALUES (?, ?, ?, NOW(), ?, ?, ?)");
        return $stmt->execute([
            $cliente_id,
            $producto_id,
            $cantidad,
            $metodo_pago_id,
            $empleado_id,
            $observaciones
        ]);
    }

    // Obtener todos los pedidos de un cliente
    public function obtenerPedidosPorCliente($cliente_id) {
        $stmt = $this->pdo->prepare("SELECT p.pedido_id, pr.nombre AS producto, p.cantidad, p.fecha, mp.metodo, e.nombre AS empleado, p.observaciones
                                     FROM pedido p
                                     JOIN productos pr ON p.producto_id = pr.codigo
                                     JOIN metodo_pago mp ON p.metodo_pago_id = mp.id
                                     JOIN empleado e ON p.empleado_id = e.empleado_id
                                     WHERE p.cliente_id = ?
                                     ORDER BY p.fecha DESC");
        $stmt->execute([$cliente_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener todos los pedidos (para panel administrativo)
    public function obtenerTodosLosPedidos() {
        $stmt = $this->pdo->query("SELECT p.pedido_id, u.nombre AS cliente, pr.nombre AS producto, p.cantidad, p.fecha, mp.metodo, e.nombre AS empleado, p.observaciones
                                   FROM pedido p
                                   JOIN usuarios_clientes u ON p.cliente_id = u.cliente_id
                                   JOIN productos pr ON p.producto_id = pr.codigo
                                   JOIN metodo_pago mp ON p.metodo_pago_id = mp.id
                                   JOIN empleado e ON p.empleado_id = e.empleado_id
                                   ORDER BY p.fecha DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
