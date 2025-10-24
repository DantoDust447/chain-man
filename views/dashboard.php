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
<html lang="es" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <title>Mi Panel</title>
  <link rel="stylesheet" href="../public/assets/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<header>
    <nav>
      <a href="../public/index.php">
        <img src="../public/assets/imgs/logo.png" alt="Logo de la empresa" class="logo">
      </a>
      <span class="navbar-brand mb-0 h1 text-light me-4">Prime Supplements</span>
      <div class="link-container" id="main-nav-links">
        <a href="views/categorias.php" class="header-links">Categorías</a>
        <a href="views/marcas.php" class="header-links">Marcas</a>
        <a href="views/productos.php" class="header-links">Productos</a>
        <a href="views/nosotros.php" class="header-links">Nosotros</a>
      </div>

      <div class="btn-group" role="group" aria-label="Default button group">
        <a href="../views/carrito.php" class="btn btn-outline-primary" id="cart-btn">
          <i class="bi bi-basket3-fill"></i>
        </a>
        <a href="../views/dashboard.php" class="btn btn-outline-primary" id="profile-btn">
          <i class="bi bi-person-fill"></i>
        </a>
      </div>
    </nav>

    <div class="social-network-bar">
      Síguenos en nuestras redes sociales y forma parte de nuestra comunidad
      <div class="social-icon-container">
        <i class="bi bi-facebook"></i>
        <i class="bi bi-instagram"></i>
        <i class="bi bi-twitter-x"></i>
      </div>
    </div>
  </header>
<body >
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
