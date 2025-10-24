<?php
session_start();
require_once '../config/db.php';
require_once '../models/Carrito.php';

if (!isset($_SESSION['cliente_id'])) {
    header('Location: login.php');
    exit;
}

$cliente_id = $_SESSION['cliente_id'];
$carritoModel = new Carrito($pdo);
$items = $carritoModel->obtenerCarrito($cliente_id);
?>

<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <title>Mi Carrito</title>
  <link rel="stylesheet" href="../public/assets/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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
  <h2 class="mb-4">🛒 Mi Carrito</h2>

  <?php if (count($items) === 0): ?>
    <div class="alert alert-info">Tu carrito está vacío. ¡Agrega productos desde la tienda!</div>
  <?php else: ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Precio Unitario</th>
          <th>Total</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php $total = 0; ?>
        <?php foreach ($items as $item): ?>
          <tr>
            <td><?= $item['nombre'] ?></td>
            <td><?= $item['cantidad'] ?></td>
            <td>Q<?= number_format($item['precio'], 2) ?></td>
            <td>Q<?= number_format($item['precio'] * $item['cantidad'], 2) ?></td>
            <td>
              <form action="../controllers/CartController.php" method="POST" style="display:inline;">
                <input type="hidden" name="accion" value="eliminar">
                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
              </form>
            </td>
            <?php $total += $item['precio'] * $item['cantidad']; ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <th colspan="3" class="text-end">Total:</th>
          <th>Q<?= number_format($total, 2) ?></th>
          <th></th>
        </tr>
      </tfoot>
    </table>

    <div class="text-end">
      <a href="pedido.php" class="btn btn-success">✅ Confirmar Pedido</a>
    </div>
  <?php endif; ?>
</body>
</html>
