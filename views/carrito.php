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
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mi Carrito</title>
  <link rel="stylesheet" href="../public/assets/styles/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
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
