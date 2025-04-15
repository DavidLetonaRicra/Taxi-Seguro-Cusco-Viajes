<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login_admin.php');
    exit();
}

$mysqli = new mysqli("localhost", "root", "", "taxi_seguro_cusco");
if ($mysqli->connect_error) {
    die("Error en la conexión: " . $mysqli->connect_error);
}

$query = "SELECT 
            reservas.id,
            usuarios.nombre AS nombre_cliente,
            destinos.nombre AS destino_nombre,
            reservas.fecha_viaje,
            reservas.estado
          FROM reservas
          LEFT JOIN usuarios ON reservas.id_cliente = usuarios.id
          LEFT JOIN destinos ON reservas.id_destino = destinos.id
          ORDER BY reservas.fecha_viaje DESC";

$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Reservas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <h2 class="text-center mb-4">📋 Gestión de Reservas</h2>
    <table class="table table-bordered table-hover table-dark">
        <thead class="table-light text-dark text-center">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Destino</th>
                <th>Fecha de Viaje</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($reserva = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $reserva['id'] ?></td>
                    <td><?= htmlspecialchars($reserva['nombre_cliente']) ?></td>
                    <td><?= htmlspecialchars($reserva['destino_nombre']) ?></td>
                    <td><?= $reserva['fecha_viaje'] ?></td>
                    <td><?= ucfirst($reserva['estado']) ?></td>
                    <td class="text-center">
                        <?php if ($reserva['estado'] === 'pendiente'): ?>
                            <a href="confirmar_reserva.php?id=<?= $reserva['id'] ?>" class="btn btn-success btn-sm">Confirmar</a>
                            <a href="cancelar_reserva.php?id=<?= $reserva['id'] ?>" class="btn btn-danger btn-sm">Cancelar</a>
                        <?php else: ?>
                            <span class="badge bg-secondary">Ya procesada</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="panel_admin.php" class="btn btn-outline-light">⬅ Volver al Panel</a>
</div>
</body>
</html>
