<?php
session_start();

// Si ya está logueado, redirige al dashboard
if (isset($_SESSION['cliente_id'])) {
    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #1a1a1a;
      color: white;
    }
    .login-container {
      max-width: 400px;
      margin: 100px auto;
      padding: 30px;
      background-color: #2c2c2c;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
    }
    .btn-login {
      background-color: #ad0000;
      border-color: #ad0000;
    }
    .btn-login:hover {
      background-color: #9a0000;
      border-color: #9a0000;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2 class="text-center mb-4">🔐 Iniciar Sesión</h2>
    <form action="../controllers/AuthController.php" method="POST">
      <div class="mb-3">
        <label for="correo" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" id="correo" name="correo" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-login w-100">Ingresar</button>
    </form>
    <div class="mt-3 text-center">
      <a href="registro.php" class="text-light">¿No tienes cuenta? Regístrate</a>
    </div>
  </div>
</body>
</html>
