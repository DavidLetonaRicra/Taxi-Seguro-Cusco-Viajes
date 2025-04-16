<?php
include('../config/db.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: login_admin.php');
    exit();
}

if (isset($_GET['id'])) {
    $id_reserva = $_GET['id'];

    // Obtener detalles de la reserva
    $sql = "SELECT * FROM reservas WHERE id = $id_reserva";
    $result = $conn->query($sql);
    $reserva = $result->fetch_assoc();
}

if (isset($_POST['estado'])) {
    // Actualizar estado
    $estado = $_POST['estado'];
    $sql = "UPDATE reservas SET estado = '$estado' WHERE id = $id_reserva";
    if ($conn->query($sql) === TRUE) {
        header('Location: gestion_reservas.php?mensaje=Reserva actualizada');
    }
}
?>

<h2>Editar Reserva</h2>
<form method="POST">
    <div class="mb-3">
        <label for="estado" class="form-label">Estado</label>
        <select name="estado" id="estado" class="form-select">
            <option value="pendiente" <?= $reserva['estado'] == 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
            <option value="confirmada" <?= $reserva['estado'] == 'confirmada' ? 'selected' : '' ?>>Confirmada</option>
            <option value="cancelada" <?= $reserva['estado'] == 'cancelada' ? 'selected' : '' ?>>Cancelada</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>
