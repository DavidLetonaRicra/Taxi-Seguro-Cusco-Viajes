<?php
session_start();

if (file_exists('includes/db_connection.php')) {
    require_once 'includes/db_connection.php';
} else {
    die("El archivo db_connection.php no se encuentra.");
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los datos del formulario
    $origen = $_POST['origin'] ?? '';
    $destino = $_POST['destination'] ?? '';
    $fecha = $_POST['pickupDate'] ?? '';
    $hora = $_POST['pickupTime'] ?? '';
    $personas = $_POST['numPeople'] ?? 1;
    $comentarios = $_POST['additionalComments'] ?? '';

    // Verificar campos requeridos
    if (!empty($origen) && !empty($destino) && !empty($fecha) && !empty($hora)) {
        // Insertar SOLO los campos que el usuario llena
        $sql = "INSERT INTO reservas (origen, destino, fecha_reserva, hora_reserva, numero_personas, comentarios)
                VALUES (?, ?, ?, ?, ?, ?)";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$origen, $destino, $fecha, $hora, $personas, $comentarios]);

            if ($stmt->rowCount() > 0) {
                header("Location: index.php?reserva=ok");
                exit;
            } else {
                echo "No se pudo registrar la reserva.";
            }
        } catch (PDOException $e) {
            echo "Error en la base de datos: " . $e->getMessage();
        }
    } else {
        echo "Faltan campos requeridos.";
    }
} else {
    header("Location: index.php");
    exit;
}
?>
