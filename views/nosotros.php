<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<!--Esta parte del proyecto fue creada por Dante Sánchez-->
<!--El motivo de esto es concientizar al resto del grupo a ser mas colaborativo-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/assets/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Prime Suplements</title>
</head>

<body>
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
    <br>
    <main>
        <div class="container">
            <ul class="list-group">
                <li class="list-group-item list-group-item-success">
                    <h1 class="text-center">Nosotros</h1>
                </li>
                <li class="list-group-item list-group-item-secondary">
                    <p>En Prime Supplements creemos que cada persona puede
                        alcanzar su mejor versión con disciplina, constancia
                        y el apoyo de los suplementos adecuados. </p>
                    <p>
                        Somos una tienda dedicada a ofrecer productos 100%
                        originales y de alta calidad, seleccionados especialmente
                        para ayudarte a mejorar tu rendimiento, lograr tus
                        objetivos deportivos y mantener un estilo de vida saludable.</p>
                </li>
                <li class="list-group-item list-group-item-success">
                    <h3 class="text-center">Misión</h3>
                </li>
                <li class="list-group-item list-group-item-secondary">
                    <p>
                        Brindar a nuestros clientes suplementos confiables, efectivos y seguros,
                        acompañados de un servicio cercano y personalizado.
                    </p>
                </li>
                <li class="list-group-item list-group-item-success">
                    <h3 class="text-center">Visión</h3>
                </li>
                <li class="list-group-item list-group-item-secondary">
                    <p>
                        Convertirnos en la tienda de suplementos deportivos líder en Guatemala,
                        reconocida por la confianza, la innovación y la pasión por el deporte.
                    </p>
                </li>
                <li class="list-group-item list-group-item-success">
                    <h3 class="text-center">Valores</h3>
                </li>
                <li class="list-group-item list-group-item-secondary">
                    <ul>
                        <li>Calidad garantizada en cada producto.</li>

                        <li>Transparencia y confianza con nuestros clientes.</li>

                        <li>Pasión por el deporte y la vida saludable.</li>

                        <li>Compromiso con tu bienestar y resultados.</li>
                    </ul>
                <li class="list-group-item list-group-item-success">
                    <h3 class="text-center">¿Por qué elegirnos?</h3>
                </li>
                <li class="list-group-item list-group-item-secondary">
                    <ul>
                        <li>Productos auténticos y certificados.</li>
                        <li>Asesoría personalizada según tus objetivos (ganar masa, definición o bienestar).</li>
                        <li>Envíos rápidos y seguros a todo el país.</li>
                        <li>Comunidad activa que comparte motivación y resultados.</li>
                    </ul>
                </li>
            </ul>
        </div>
    </main>
</body>