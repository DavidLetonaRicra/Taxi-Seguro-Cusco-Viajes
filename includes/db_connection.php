<?php
// Parámetros de conexión
$host = 'localhost';  // o tu IP si estás usando un servidor remoto
$dbname = 'taxi_seguro_cusco';  // Nombre de la base de datos
$username = 'root';  // Tu nombre de usuario de MySQL
$password = '';  // Tu contraseña de MySQL (por defecto es vacío en muchos servidores locales)

// Creación de la conexión
try {
    // Usando PDO para conectarse a la base de datos
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Establecer el modo de error a excepción para poder manejar los errores adecuadamente
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Si llegamos hasta aquí, la conexión fue exitosa
    // echo "Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    // En caso de error, mostramos el mensaje
    die("Error al conectar a la base de datos: " . $e->getMessage());
}
?>
