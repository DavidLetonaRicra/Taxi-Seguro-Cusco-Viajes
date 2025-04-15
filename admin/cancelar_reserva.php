<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login_admin.php');
    exit();
}

if (!isset($_GET['id'])) {
    die("ID de reserva no proporcionado.");
}

$mysqli = new mysqli("localhost", "root", "", "taxi_seguro_cusco");
if ($mysqli->connect_error) {
    die("Error en la conexión: " . $mysqli->connect_error);
}

$id_reserva = intval($_GET['id']);

$sql = "UPDATE reservas SET estado = 'cancelada' WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $id_reserva);
$stmt->execute();

$stmt->close();
$mysqli->close();

header("Location: gestion_reservas.php");
exit();
?>
