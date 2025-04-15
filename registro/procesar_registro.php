<?php
// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "taxi_seguro_cusco");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Verificar que las contraseñas coincidan
if ($password !== $confirm_password) {
    echo "⚠️ Las contraseñas no coinciden. <a href='registro.php'>Volver</a>";
    exit();
}

// Verificar si el correo ya existe
$sql_check = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conexion->prepare($sql_check);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    echo "⚠️ Este correo ya está registrado. <a href='registro.php'>Volver</a>";
    exit();
}

// Encriptar contraseña
$hash_password = password_hash($password, PASSWORD_BCRYPT);

// Insertar nuevo cliente (rol = cliente)
$sql_insert = "INSERT INTO usuarios (nombre, email, password, rol, estado) VALUES (?, ?, ?, 'cliente', 'activo')";
$stmt = $conexion->prepare($sql_insert);
$stmt->bind_param("sss", $nombre, $email, $hash_password);

if ($stmt->execute()) {
    echo "✅ Registro exitoso. <a href='../index.html'>Iniciar sesión</a>";
} else {
    echo "❌ Error al registrar: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
