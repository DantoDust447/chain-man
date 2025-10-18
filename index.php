<?php require_once 'db_crud/config/conexion.php'; ?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Prime Supplements | Suplementos Deportivos</title>
</head>
<body>
<header>
    <nav>
        <img src="assets/imgs/logo.png" alt="Logo" class="logo">
        <span class="navbar-brand mb-0 h1 text-light me-4">Prime Supplements</span>
        <div class="link-container" id="main-nav-links">
            <a href="#" class="header-links">Categorías</a>
            <a href="#" class="header-links">Marcas</a>
            <a href="#" class="header-links">Productos</a>
            <a href="#" class="header-links">Nosotros</a>
        </div>
        <form class="search-bar" id="search-form">
            <input type="text" id="search-input" class="form-control" placeholder="Buscar producto...">
            <button type="submit" class="btn btn-outline-light d-flex align-items-center">
                <i class="bi bi-search"></i>
            </button>
        </form>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-outline-primary" id="cart-btn">
                <i class="bi bi-basket3-fill"></i>
            </button>
            <button type="button" class="btn btn-outline-primary" id="profile-btn">
                <i class="bi bi-person-fill"></i>
            </button>
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

<main class="container-fluid">
    <div id="carouselExampleRide" class="carousel slide" data-bs-ride="true">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/imgs/9aadd7150415553.62fa23d888ee5.webp" class="d-block w-100" alt="Promoción 1" style="height: 600px; object-fit: cover;">
            </div>
            <div class="carousel-item">
                <img src="assets/imgs/prdctcarr.png" class="d-block w-100" alt="Promoción 2" style="height: 600px; object-fit: cover;">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>

    <hr>

    <h2 class="text-center my-4">🔥 Nuestros Productos Destacados 🔥</h2>

    <div class="row row-cols-1 row-cols-md-3 g-4" id="products-container">
        <?php
        $sql = "SELECT 
                    p.producto_id, 
                    p.nombre, 
                    p.descripcion, 
                    p.precio, 
                    p.cantidad_peso, 
                    p.imagen_producto,
                    c.categoria, 
                    m.marca_nombre
                FROM productos p
                LEFT JOIN cat_productos c ON p.categoria_id = c.categoria_id
                LEFT JOIN marcas m ON p.marca_id = m.marca_id
                LIMIT 9";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($productos) {
            foreach ($productos as $producto): ?>
                <div class="col">
                    <div class="card product-card">
                        <img src="assets/imgs/<?= htmlspecialchars($producto['imagen_producto'] ?: 'default.jpg') ?>"
                             class="card-img-top product-img"
                             alt="<?= htmlspecialchars($producto['nombre']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($producto['nombre']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($producto['descripcion']) ?></p>
                            <p class="fw-bold text-danger">$<?= number_format($producto['precio'], 2) ?></p>
                            <p class="text-secondary small">
                                <?= htmlspecialchars($producto['marca_nombre'] ?? 'Sin marca') ?> |
                                <?= htmlspecialchars($producto['categoria'] ?? 'Sin categoría') ?>
                            </p>
                            <button class="btn btn-add-to-cart">Agregar al carrito</button>
                        </div>
                    </div>
                </div>
            <?php endforeach;
        } else {
            echo "<p class='text-center text-muted'>No hay productos disponibles.</p>";
        }
        ?>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/app.js"></script>
</body>
</html>
