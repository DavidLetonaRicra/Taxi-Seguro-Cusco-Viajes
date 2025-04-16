<?php
require_once '../config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "UPDATE reservas SET estado = 'confirmada' WHERE id = $id";
    $conexion->query($sql);
}

header('Location: panel_admin.php');
exit();
?>
