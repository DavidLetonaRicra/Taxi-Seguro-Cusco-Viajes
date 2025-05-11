<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login_admin.php');
    exit();
}

include '../config/db.php'; // tu archivo de conexión a la BD

// Si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_reserva = $_POST['reserva'];
    $id_conductor = $_POST['conductor'];

    // Asignar el conductor y actualizar el estado de la reserva
    $sql = "UPDATE reservas SET id_conductor=?, estado='Asignado' WHERE id_reserva=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id_conductor, $id_reserva);
    $stmt->execute();

    // Actualizar disponibilidad del conductor (opcional)
    $conn->query("UPDATE conductores SET disponible=0 WHERE id_conductor=$id_conductor");

    $mensaje = "Conductor asignado correctamente.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignar Conductor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilo_admin.css">
</head>
<body class="bg-dark text-white p-4">

    <div class="container card-shadow p-4">
        <h3 class="text-center text-amarillo mb-4">🚖 Asignación Manual de Conductores</h3>

        <?php if (isset($mensaje)) echo "<div class='alert alert-success'>$mensaje</div>"; ?>

        <form method="POST" class="row g-3">

            <div class="col-md-6">
                <label class="form-label">Selecciona una Reserva</label>
                <select name="reserva" class="form-select" required>
                    <option value="">-- Reservas Pendientes --</option>
                    <?php
                    $res = $conn->query("SELECT id_reserva FROM reservas WHERE estado='Pendiente'");
                    while ($row = $res->fetch_assoc()) {
                        echo "<option value='{$row['id_reserva']}'>Reserva #{$row['id_reserva']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Selecciona un Conductor</label>
                <select name="conductor" class="form-select" required>
                    <option value="">-- Conductores Disponibles --</option>
                    <?php
                    $res = $conn->query("SELECT id_conductor, nombre FROM conductores WHERE disponible=1");
                    while ($row = $res->fetch_assoc()) {
                        echo "<option value='{$row['id_conductor']}'>{$row['nombre']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-12 text-center mt-3">
                <button type="submit" class="btn btn-amarillo px-4">Asignar Conductor</button>
            </div>

        </form>
    </div>

</body>
</html>
