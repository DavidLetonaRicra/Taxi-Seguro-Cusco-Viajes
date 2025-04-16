<?php
include('../config/db.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: login_admin.php');
    exit();
}

if (isset($_GET['id'])) {
    $id_reserva = $_GET['id'];
    $sql = "DELETE FROM reservas WHERE id = $id_reserva";
    if ($conn->query($sql) === TRUE) {
        header('Location: gestion_reservas.php?mensaje=Reserva eliminada con éxito');
    } else {
        echo "Error al eliminar la reserva: " . $conn->error;
    }
}
