<?php
session_start();
require_once '../config/db.php';
require_once '../models/Usuario.php';
require_once '../models/Pedido.php';

if (!isset($_SESSION['cliente_id'])) {
    header('Location: login.php');
    exit;
}

$cliente_id = $_SESSION['cliente_id'];
$usuarioModel = new Usuario($pdo);
$pedidoModel = new Pedido($pdo);

$usuario = $usuarioModel->obtenerPorId($cliente_id);
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
  <h2 class="mb-4">👤 Bienvenido, <?= $usuario['nombre'] ?></h2>

  <div class="row">
    <div class="col-md-4">
      <div class="card mb-4">
        <div class="card-header bg-dark text-white">📋 Mi Perfil</div>
        <div class="card-body">
          <p><strong>Nombre:</strong> <?= $usuario['nombre'] . ' ' . $usuario['apellido_p'] . ' ' . $usuario['apellido_m'] ?></p>
          <p><strong>Correo:</strong> <?= $usuario['correo'] ?></p>
          <p><strong>Teléfono:</strong> <?= $usuario['telefono'] ?></p>
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
          <?php if (count($pedidos) === 0): ?>
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
                    <td><?= $pedido['producto'] ?></td>
                    <td><?= $pedido['cantidad'] ?></td>
                    <td><?= $pedido['fecha'] ?></td>
                    <td><?= $pedido['metodo'] ?></td>
                    <td><?= $pedido['empleado'] ?></td>
                    <td><?= $pedido['observaciones'] ?></td>
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