<?php
require_once '../config/db.php';

class Usuario {
    private $pdo;

    public function __construct($conexion) {
        $this->pdo = $conexion;
    }

    // Autenticar usuario por correo y contraseña
    public function autenticar($correo, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios_clientes WHERE correo = ?");
        $stmt->execute([$correo]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($password, $usuario['password'])) {
            return $usuario;
        }

        return false;
    }

    // Obtener datos del usuario por ID
    public function obtenerPorId($cliente_id) {
        $stmt = $this->pdo->prepare("SELECT cliente_id, nombre, apellido_p, apellido_m, correo, telefono
                                     FROM usuarios_clientes
                                     WHERE cliente_id = ?");
        $stmt->execute([$cliente_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar datos del perfil
    public function actualizarPerfil($cliente_id, $nombre, $apellido_p, $apellido_m, $correo, $telefono) {
        $stmt = $this->pdo->prepare("UPDATE usuarios_clientes
                                     SET nombre = ?, apellido_p = ?, apellido_m = ?, correo = ?, telefono = ?
                                     WHERE cliente_id = ?");
        return $stmt->execute([$nombre, $apellido_p, $apellido_m, $correo, $telefono, $cliente_id]);
    }

    // Registrar nuevo usuario (opcional)
    public function registrar($nombre, $apellido_p, $apellido_m, $correo, $telefono, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO usuarios_clientes (nombre, apellido_p, apellido_m, correo, telefono, password)
                                     VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$nombre, $apellido_p, $apellido_m, $correo, $telefono, $hash]);
    }
}
?>
