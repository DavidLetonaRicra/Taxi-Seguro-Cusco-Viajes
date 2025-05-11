<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login_admin.php');
    exit();
}

require_once '../includes/db_connection.php';

if (isset($_GET['id']) && isset($_GET['estado'])) {
    $id_reserva = $_GET['id'];
    $nuevo_estado = $_GET['estado'];

    try {
        $sql = "UPDATE reservas SET estado = :estado WHERE id_reserva = :id_reserva";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':estado', $nuevo_estado);
        $stmt->bindParam(':id_reserva', $id_reserva);
        $stmt->execute();

        header("Location: gestion_reservas.php"); // Regresa a la página de gestión de reservas
    } catch (PDOException $e) {
        die("Error al cambiar el estado: " . $e->getMessage());
    }
} else {
    header("Location: gestion_reservas.php"); // Si no se pasa id o estado, redirige a la gestión de reservas
}
?>