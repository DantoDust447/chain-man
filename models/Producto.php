<?php
require_once '../controllers/ProductController.php';
$productos = obtenerProductos();
?>

<div class="row row-cols-1 row-cols-md-3 g-4">
  <?php foreach ($productos as $producto): ?>
    <div class="col">
      <div class="card product-card">
        <img src="../public/assets/imgs/default-product.jpg" class="card-img-top product-img" alt="<?= $producto['nombre'] ?>">
        <div class="card-body">
          <h5 class="card-title"><?= $producto['nombre'] ?></h5>
          <p class="card-text">Marca: <?= $producto['marca'] ?></p>
          <p class="card-text">Precio: Q<?= number_format($producto['precio'], 2) ?></p>
          <p class="card-text">Estado: <?= $producto['estado'] ?></p>
          <p class="card-text">Categoría: <?= $producto['categoria'] ?></p>
          <form action="../controllers/CartController.php" method="POST">
            <input type="hidden" name="producto_id" value="<?= $producto['codigo'] ?>">
            <input type="number" name="cantidad" value="1" min="1" class="form-control mb-2">
            <button type="submit" class="btn btn-add-to-cart w-100">Agregar al carrito</button>
          </form>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
