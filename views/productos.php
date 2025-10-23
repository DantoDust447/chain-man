<?php
session_start();
require_once '../config/db.php';
require_once '../controllers/ProductController.php';

$productos = obtenerProductos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Productos | Prime Supplements</title>
  <link rel="stylesheet" href="../public/assets/styles/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
  <h2 class="mb-4 text-center">💪 Suplementos Disponibles</h2>

  <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php foreach ($productos as $producto): ?>
      <div class="col">
        <div class="card product-card h-100">
          <img src="../public/assets/imgs/default-product.jpg" class="card-img-top product-img" alt="<?= $producto['nombre'] ?>">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?= $producto['nombre'] ?></h5>
            <p class="card-text">Marca: <?= $producto['marca'] ?></p>
            <p class="card-text">Categoría: <?= $producto['categoria'] ?></p>
            <p class="card-text">Estado: <?= $producto['estado'] ?></p>
            <p class="card-text fw-bold">Precio: Q<?= number_format($producto['precio'], 2) ?></p>

            <?php if (isset($_SESSION['cliente_id'])): ?>
              <form action="../controllers/CartController.php" method="POST" class="mt-auto">
                <input type="hidden" name="producto_id" value="<?= $producto['codigo'] ?>">
                <input type="number" name="cantidad" value="1" min="1" class="form-control mb-2">
                <button type="submit" class="btn btn-add-to-cart w-100">Agregar al carrito</button>
              </form>
            <?php else: ?>
              <div class="alert alert-secondary mt-auto">🔒 Inicia sesión para comprar</div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</body>
</html>
