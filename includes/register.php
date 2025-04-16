<?php
// Iniciar sesión si es necesario para manejar redirecciones.
session_start();

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar a la base de datos
    require_once('db_connection.php'); // Asegúrate de que este archivo esté configurado correctamente.

    // Obtener los datos del formulario
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validar que las contraseñas coincidan
    if ($password != $confirmPassword) {
        $_SESSION['error'] = "Las contraseñas no coinciden.";
        header("Location: register.php");
        exit();
    }

    // Hashear la contraseña para mayor seguridad
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Verificar si el correo electrónico ya existe en la base de datos
    $stmt = $pdo->prepare("SELECT * FROM clientes WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        $_SESSION['error'] = "El correo electrónico ya está registrado.";
        header("Location: register.php");
        exit();
    }

    // Insertar el nuevo cliente en la base de datos
    $stmt = $pdo->prepare("INSERT INTO clientes (nombres, apellidos, telefono, email, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nombres, $apellidos, $telefono, $email, $hashedPassword]);

    // Redirigir al login después de registrar
    $_SESSION['success'] = "Registro exitoso. Inicia sesión.";
    header("Location: login.php");
    exit();
}
?>
