<?php
session_start();
require_once '../config/db.php';
require_once '../models/Cliente.php';
require_once '../models/Pedido.php';

if (!isset($_SESSION['cliente_id'])) {
    header('Location: login.php');
    exit;
}

$cliente_id = $_SESSION['cliente_id'];
$clienteModel = new Cliente($pdo);
$pedidoModel = new Pedido($pdo);

$cliente = $clienteModel->obtenerPorId($cliente_id);
$pedidos = $pedidoModel->obtenerPedidosPorCliente($cliente_id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mi Panel</title>
  <link rel="stylesheet" href="../public/assets/styles/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
  <h2 class="mb-4">👤 Bienvenido, <?= htmlspecialchars($cliente['nombre']) ?></h2>

  <div class="row">
    <div class="col-md-4">
      <div class="card mb-4">
        <div class="card-header bg-dark text-white">📋 Mi Perfil</div>
        <div class="card-body">
          <p><strong>Nombre:</strong> <?= htmlspecialchars($cliente['nombre'] . ' ' . $cliente['apellido']) ?></p>
          <p><strong>Correo:</strong> <?= htmlspecialchars($cliente['email']) ?></p>
          <p><strong>Fecha de nacimiento:</strong> <?= $cliente['fecha_nac'] ? htmlspecialchars($cliente['fecha_nac']) : 'No registrada' ?></p>
          <a href="editar_perfil.php" class="btn btn-outline-primary btn-sm">✏️ Editar perfil</a>
        </div>
      </div>

      <div class="d-grid gap-2">
        <a href="carrito.php" class="btn btn-success">🛒 Ver mi carrito</a>
        <a href="pedido.php" class="btn btn-primary">✅ Confirmar pedido</a>
        <a href="logout.php" class="btn btn-danger">🔒 Cerrar sesión</a>
      </div>
    </div>

    <div class="col-md-8">
      <div class="card">
        <div class="card-header bg-dark text-white">📦 Historial de Pedidos</div>
        <div class="card-body">
          <?php if (empty($pedidos)): ?>
            <div class="alert alert-info">Aún no has realizado ningún pedido.</div>
          <?php else: ?>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Cantidad</th>
                  <th>Fecha</th>
                  <th>Método de Pago</th>
                  <th>Empleado</th>
                  <th>Observaciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($pedidos as $pedido): ?>
                  <tr>
                    <td><?= htmlspecialchars($pedido['producto']) ?></td>
                    <td><?= htmlspecialchars($pedido['cantidad']) ?></td>
                    <td><?= htmlspecialchars($pedido['fecha']) ?></td>
                    <td><?= htmlspecialchars($pedido['metodo']) ?></td>
                    <td><?= htmlspecialchars($pedido['empleado']) ?></td>
                    <td><?= htmlspecialchars($pedido['observaciones']) ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
