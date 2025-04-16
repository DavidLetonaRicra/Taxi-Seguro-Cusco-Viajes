<?php
include('../config/db.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: login_admin.php');
    exit();
}

// Lógica para filtrar reservas por estado
$estado = '';
if (isset($_GET['estado'])) {
    $estado = $_GET['estado'];
}

$sql = "SELECT r.id, c.nombre AS nombre_cliente, d.nombre AS destino, 
               cond.nombre AS conductor, v.modelo AS vehiculo, r.estado
        FROM reservas r
        JOIN usuarios c ON r.id_cliente = c.id
        JOIN destinos d ON r.id_destino = d.id
        JOIN conductores cond ON r.id_conductor = cond.id
        JOIN vehiculos v ON r.id_vehiculo = v.id";

if ($estado != '') {
    $sql .= " WHERE r.estado = '$estado'";
}

// Ejecutar la consulta SQL y obtener los resultados
$result = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gestión de Reservas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="estilo_admin.css"> <!-- Agregar tu CSS -->
</head>
<body>
    <div class="container py-4">
    <!-- Botón para regresar al panel de administración -->
    <a href="panel_admin.php" class="btn btn-secondary mb-4 regresar-btn">
        <i class="bi bi-arrow-left-circle"></i> Regresar al Panel de Administración
    </a>


        <h2 class="text-center mb-4">Gestión de Reservas</h2>
        <form method="GET" class="d-flex mb-4">
            <select name="estado" class="form-select" aria-label="Filtrar por estado">
                <option value="">Filtrar por estado</option>
                <option value="pendiente" <?= $estado == 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                <option value="confirmada" <?= $estado == 'confirmada' ? 'selected' : '' ?>>Confirmada</option>
                <option value="cancelada" <?= $estado == 'cancelada' ? 'selected' : '' ?>>Cancelada</option>
            </select>
            <button type="submit" class="btn btn-primary ms-2">Filtrar</button>
        </form>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID Reserva</th>
                    <th>Cliente</th>
                    <th>Destino</th>
                    <th>Conductor</th>
                    <th>Vehículo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['nombre_cliente'] ?></td>
                        <td><?= $row['destino'] ?></td>
                        <td><?= $row['conductor'] ?></td>
                        <td><?= $row['vehiculo'] ?></td>
                        <td><?= $row['estado'] ?></td>
                        <td>
                            <a href="editar_reserva.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="eliminar_reserva.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
