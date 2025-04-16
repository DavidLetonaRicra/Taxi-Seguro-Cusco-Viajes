<?php
session_start();

// Verifica que el cliente esté logueado
if (!isset($_SESSION['id_cliente'])) {
    header("Location: index.php"); // o login.php
    exit();
}

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "taxi_seguro_cusco");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener datos del formulario
$origen = $_POST['origin'];
$destino = $_POST['destination'];
$fecha = $_POST['pickupDate'];
$hora = $_POST['pickupTime'];
$num_personas = $_POST['numPeople'];
$comentarios = $_POST['additionalComments'];

// ID del cliente desde sesión
$id_cliente = $_SESSION['id_cliente'];

echo "<pre>";
print_r($_POST);
echo "</pre>";
exit;





// Insertar en la tabla de reservas
$sql = "INSERT INTO reservas (id_cliente, origen, destino, fecha, hora, numero_personas, comentarios, estado)
        VALUES (?, ?, ?, ?, ?, ?, ?, 'pendiente')";


$stmt = $conexion->prepare($sql);
$stmt->bind_param("issssis", $id_cliente, $origen, $destino, $fecha, $hora, $numero_personas, $comentarios);

if ($stmt->execute()) {
    // Redirige con mensaje de éxito (puedes mostrar un modal en el index si quieres)
    header("Location: index.php?reserva=exitosa");
} else {
    echo "Error al guardar la reserva: " . $conexion->error;
}

$stmt->close();
$conexion->close();
?>
