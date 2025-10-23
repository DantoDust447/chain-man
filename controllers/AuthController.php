<?php
require_once '../config/db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM clientes WHERE email = ?");
    $stmt->execute([$correo]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($password, $usuario['contrasenia'])) {
        $_SESSION['cliente_id'] = $usuario['cliente_id'];
        header('Location: ../views/dashboard.php');
    } else {
        echo "Credenciales incorrectas";
    }
}
?>
