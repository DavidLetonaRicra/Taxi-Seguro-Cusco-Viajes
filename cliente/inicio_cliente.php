<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php'); // Redirige si no están logueados
    exit();
}
$email = $_SESSION['usuario'];
echo "¡Bienvenido, $email!";
// Aquí puedes agregar más información del usuario
?>
