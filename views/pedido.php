<?php
session_start();
require_once '../config/db.php';

// Verificar si el cliente está autenticado
if (!isset($_SESSION['cliente_id'])) {
    header('Location: login.php');
    exit;
}

$cliente_id = $_SESSION['cliente_id'];

// Obtener productos del carrito
$stmt = $pdo->prepare("SELECT c.id, p.nombre, p.precio, c.cantidad
                       FROM carrito c
                       JOIN productos p ON c.producto_id = p.producto_id
                       WHERE c.cliente_id = ?");
$stmt->execute([$cliente_id]);
$carrito = $stmt->fetchAll();

// Obtener métodos de pago
$metodos = $pdo->query("SELECT metodo_pago_id, metodo FROM metodo_pago")->fetchAll();

// Obtener empleados (puedes filtrar por rol si lo deseas)
$empleados = $pdo->query("SELECT dpi_empleado, nombre FROM empleado")->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Confirmar Pedido</title>
  <link rel="stylesheet" href="../public/assets/styles/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
  <h2 class="mb-4">🧾 Confirmar Pedido</h2>

  <?php if (count($carrito) === 0): ?>
    <div class="alert alert-warning">Tu carrito está vacío.</div>
  <?php else: ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Precio Unitario</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php $total = 0; ?>
        <?php foreach ($carrito as $item): ?>
          <tr>
            <td><?= $item['nombre'] ?></td>
            <td><?= $item['cantidad'] ?></td>
            <td>Q<?= number_format($item['precio'], 2) ?></td>
            <td>Q<?= number_format($item['precio'] * $item['cantidad'], 2) ?></td>
            <?php $total += $item['precio'] * $item['cantidad']; ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <th colspan="3" class="text-end">Total a pagar:</th>
          <th>Q<?= number_format($total, 2) ?></th>
        </tr>
      </tfoot>
    </table>

    <form action="../controllers/OrderController.php" method="POST" class="mt-4">
      <div class="mb-3">
        <label for="metodo_pago_id" class="form-label">Método de pago</label>
        <select name="metodo_pago_id" id="metodo_pago_id" class="form-select" required>
          <?php foreach ($metodos as $metodo): ?>
            <option value="<?= $metodo['metodo_pago_id'] ?>"><?= $metodo['metodo'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="empleado_id" class="form-label">Empleado que toma el pedido</label>
        <select name="empleado_id" id="empleado_id" class="form-select" required>
          <?php foreach ($empleados as $empleado): ?>
            <option value="<?= $empleado['dpi_empleado'] ?>"><?= $empleado['nombre'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="observaciones" class="form-label">Observaciones</label>
        <textarea name="observaciones" id="observaciones" class="form-control" rows="3" placeholder="Notas adicionales..."></textarea>
      </div>

      <button type="submit" class="btn btn-success w-100">✅ Confirmar Pedido</button>
    </form>
  <?php endif; ?>
</body>
</html>
