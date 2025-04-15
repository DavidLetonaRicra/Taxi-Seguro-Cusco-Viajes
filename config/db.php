<?php
$host = 'localhost';
$usuario = 'root';
$contrasena = ''; // Deja en blanco si no tienes contraseña en XAMPP
$basedatos = 'taxi_seguro_cusco';

$conexion = new mysqli($host, $usuario, $contrasena, $basedatos);

if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}
?>
