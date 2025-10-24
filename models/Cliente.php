<?php
require_once '../config/db.php';

class Cliente {
    private $pdo;

    public function __construct($conexion) {
        $this->pdo = $conexion;
    }

    // Autenticar cliente por email y contraseña
    public function autenticar($email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE email = ?");
        $stmt->execute([$email]);
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cliente && password_verify($password, $cliente['contrasenia'])) {
            return $cliente;
        }

        return false;
    }

    // Obtener datos del cliente por ID
    public function obtenerPorId($cliente_id) {
        $stmt = $this->pdo->prepare("SELECT cliente_id, nombre, apellido, email, fecha_nac
                                     FROM clientes
                                     WHERE cliente_id = ?");
        $stmt->execute([$cliente_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar datos del perfil
    public function actualizarPerfil($cliente_id, $nombre, $apellido, $email, $fecha_nac) {
        $stmt = $this->pdo->prepare("UPDATE clientes
                                     SET nombre = ?, apellido = ?, email = ?, fecha_nac = ?
                                     WHERE cliente_id = ?");
        return $stmt->execute([$nombre, $apellido, $email, $fecha_nac, $cliente_id]);
    }

    // Registrar nuevo cliente
    public function registrar($nombre, $apellido, $email, $fecha_nac, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO clientes (nombre, apellido, email, fecha_nac, contrasenia)
                                     VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$nombre, $apellido, $email, $fecha_nac, $hash]);
    }
}
?>
