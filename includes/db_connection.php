<?php
try {
    $host = 'localhost';
    $dbname = 'taxi_seguro_cusco';
    $username = 'root'; // Cambia a tu usuario si es necesario
    $password = '';     // Cambia a tu contraseña si es necesario

    // Establecer la conexión con PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
