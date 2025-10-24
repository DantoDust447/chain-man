<?php
require_once '../config/db.php';
require_once '../models/Categoria.php';

$categoriaModel = new Categoria($pdo);
$categorias = $categoriaModel->obtenerTodas();
?>

<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <title>Categorías</title>
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
        <a href="../views/categorias.php" class="header-links">Categorías</a>
        <a href="../views/marcas.php" class="header-links">Marcas</a>
        <a href="../views/productos.php" class="header-links">Productos</a>
        <a href="../views/nosotros.php" class="header-links">Nosotros</a>
      </div>

      <form class="search-bar" id="search-form">
        <input type="text" id="search-input" class="form-control" placeholder="Buscar producto...">
        <button type="submit" class="btn btn-outline-light d-flex align-items-center">
          <i class="bi bi-search"></i>
        </button>
      </form>

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
<body>
  <h2 class="mb-4">📂 Categorías de Suplementos</h2>

  <?php if (empty($categorias)): ?>
    <div class="alert alert-warning">No hay categorías registradas.</div>
  <?php else: ?>
    <div class="row">
      <?php foreach ($categorias as $cat): ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($cat['categoria']) ?></h5>
              <a href="productos.php?categoria_id=<?= $cat['categoria_id'] ?>" class="btn btn-primary">🔍 Ver productos</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</body>
</html>
