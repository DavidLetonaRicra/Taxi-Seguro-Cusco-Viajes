<?php
session_start();
require_once '../includes/db_connection.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: login_admin.php');
    exit();
}

// Obtener todos los clientes
try {
    $sql = "SELECT * FROM clientes";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener los clientes: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Gestión de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <a href="panel_admin.php" class="btn btn-outline-primary mb-3">← Volver al Panel</a>
    <h2 class="mb-4 text-primary text-center">📋 Clientes Registrados</h2>

    <div class="card p-3 shadow-sm">
        <table class="table table-bordered table-hover text-center">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Fecha de Registro</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($clientes) > 0): ?>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?= $cliente['id_cliente'] ?></td>
                            <td><?= htmlspecialchars($cliente['nombres']) ?></td>
                            <td><?= htmlspecialchars($cliente['apellidos']) ?></td>
                            <td><?= $cliente['telefono'] ?? '—' ?></td>
                            <td><?= htmlspecialchars($cliente['email']) ?></td>
                            <td><?= $cliente['fecha_registro'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" class="text-center">No hay clientes registrados.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
