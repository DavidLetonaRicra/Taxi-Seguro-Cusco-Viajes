<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login_admin.php');
    exit();
}

require_once('../config/db.php');

// Procesar el formulario al enviarlo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $fecha = $_POST['fecha'];
    $destino = $_POST['destino'];
    $comentario = $_POST['comentario'];

    $sql = "INSERT INTO reservas (nombre, telefono, fecha, destino, comentario, estado)
        VALUES (?, ?, ?, ?, ?, 'pendiente')";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssss", $nombre, $telefono, $fecha, $destino, $comentario);
    $stmt->execute();

    header("Location: gestion_reservas.php?msg=insertado");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Reserva | Panel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilo_admin.css">
</head>
<body class="bg-dark text-white">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Agregar Nueva Reserva</h2>

        <form method="POST" action="">
            <div class="mb-3">
                <label class="form-label">Nombre del Cliente</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha del Viaje</label>
                <input type="date" name="fecha" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Destino</label>
                <input type="text" name="destino" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Comentario</label>
                <textarea name="comentario" class="form-control" rows="3"></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Registrar Reserva</button>
                <a href="panel_admin.php" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </div>
</body>
</html>
