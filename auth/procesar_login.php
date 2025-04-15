<?php
session_start();

// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "taxi_seguro_cusco");

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener datos del formulario
$email = $_POST['email'];
$password = $_POST['password'];

// Verificar si existe el usuario
$sql = "SELECT * FROM usuarios WHERE email = ? AND rol = 'cliente'";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();

    // Verificar contraseña
    if (password_verify($password, $usuario['password'])) {
        // Guardar datos en sesión
        $_SESSION['id_usuario'] = $usuario['id'];
        $_SESSION['nombre_usuario'] = $usuario['nombre'];
        $_SESSION['rol'] = $usuario['rol'];

        // Redirigir a una página de bienvenida o a reservas
        header("Location: ../cliente/inicio_cliente.php");
        exit();
    } else {
        echo "❌ Contraseña incorrecta. <a href='index.html'>Volver</a>";
    }
} else {
    echo "❌ Usuario no encontrado. <a href='index.html'>Volver</a>";
}

$stmt->close();
$conexion->close();
?>
