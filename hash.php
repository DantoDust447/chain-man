<?php
require_once 'config/db.php';

$stmt = $pdo->query("SELECT cliente_id, contrasenia FROM clientes");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuarios as $usuario) {
    $id = $usuario['cliente_id'];
    $plain = $usuario['contrasenia'];

    // Verifica si ya está hasheada (simple heurística: empieza con $2y$)
    if (strpos($plain, '$2y$') !== 0) {
        $hash = password_hash($plain, PASSWORD_DEFAULT);

        $update = $pdo->prepare("UPDATE clientes SET contrasenia = ? WHERE cliente_id = ?");
        $update->execute([$hash, $id]);

        echo "✅ Contraseña actualizada para cliente_id $id<br>";
    } else {
        echo "🔒 Contraseña ya cifrada para cliente_id $id<br>";
    }
}
?>
