<?php
require_once '../config/db.php';
require_once '../models/Cliente.php';

$clienteModel = new Cliente($pdo);
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $email = trim($_POST['email']);
    $fecha_nac = $_POST['fecha_nac'] ?? null;
    $password = $_POST['contrasenia'];

    if ($nombre && $apellido && $email && $password) {
        $registrado = $clienteModel->registrar($nombre, $apellido, $email, $fecha_nac, $password);
        if ($registrado) {
            header('Location: login.php?registro=exitoso');
            exit;
        } else {
            $mensaje = '❌ Error al registrar. Intenta nuevamente.';
        }
    } else {
        $mensaje = '⚠️ Todos los campos obligatorios deben estar completos.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Cliente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
  <h2 class="mb-4">📝 Crear una cuenta</h2>

  <?php if ($mensaje): ?>
    <div class="alert alert-warning"><?= htmlspecialchars($mensaje) ?></div>
  <?php endif; ?>

  <form method="POST" class="row g-3">
    <div class="col-md-6">
      <label for="nombre" class="form-label">Nombre *</label>
      <input type="text" name="nombre" id="nombre" class="form-control" required>
    </div>

    <div class="col-md-6">
      <label for="apellido" class="form-label">Apellido *</label>
      <input type="text" name="apellido" id="apellido" class="form-control" required>
    </div>

    <div class="col-md-6">
      <label for="email" class="form-label">Correo electrónico *</label>
      <input type="email" name="email" id="email" class="form-control" required>
    </div>

    <div class="col-md-6">
      <label for="fecha_nac" class="form-label">Fecha de nacimiento</label>
      <input type="date" name="fecha_nac" id="fecha_nac" class="form-control">
    </div>

    <div class="col-md-6">
      <label for="contrasenia" class="form-label">Contraseña *</label>
      <input type="password" name="contrasenia" id="contrasenia" class="form-control" required>
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn-primary">✅ Registrarme</button>
      <a href="login.php" class="btn btn-outline-secondary">🔐 Ya tengo cuenta</a>
    </div>
  </form>
</body>
</html>
