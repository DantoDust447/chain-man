<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Prime Supplements | Suplementos Deportivos</title>
</head>

<body>
    <header>
        <nav>
            <img src="assets/imgs/logo.png" alt="Logo de la empresa" class="logo">
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

            <div class="btn-group" role="group" aria-label="Default button group">
                <button type="button" class="btn btn-outline-primary" id="cart-btn">
                    <i class="bi bi-basket3-fill"></i>
                </button>
                <button type="button" class="btn btn-outline-primary" id="profile-btn">
                    <i class="bi bi-person-fill"></i>
                </button>
            </div>
        </nav>
        <div class="social-network-bar">
            Siguenos en nuestras redes sociales y forma parte de nuestra comunidad
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
                    <img src="assets/imgs/9aadd7150415553.62fa23d888ee5.webp" class="d-block w-100" alt="Promoción 1"
                        style="width: 200px; height: 600px; object-fit: cover; position: center;">
                </div>
                <div class="carousel-item">
                    <img src="assets/imgs/prdctcarr.png" class="d-block w-100" alt="Promoción 2"
                        style="width: 200px; height: 600px; object-fit: cover; position: center;">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        
        <hr>

        <h2 class="text-center my-4">🔥 Nuestros Productos Destacados 🔥</h2>
        
        <div class="row row-cols-1 row-cols-md-3 g-4" id="products-container">
            </div>

    </main>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous">
    </script>
    <script src="assets/js/app.js"></script> 
</body>

</html>