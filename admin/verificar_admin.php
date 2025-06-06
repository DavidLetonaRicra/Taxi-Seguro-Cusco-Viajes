<?php
// Iniciar sesión para manejar la sesión del usuario
session_start();

// Conectar a la base de datos
$mysqli = new mysqli("localhost", "root", "", "taxi_seguro_cusco");

// Verificar conexión a la base de datos
if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}

// Verificar si se enviaron los datos por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir los datos del formulario
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Validar que los campos no estén vacíos
    if (empty($usuario) || empty($contrasena)) {
        header("Location: login_admin.php?error=empty-fields");
        exit();
    }

    // Preparar la consulta para buscar al usuario en la base de datos
    $stmt = $mysqli->prepare("SELECT * FROM administradores WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró el usuario
    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($contrasena, $admin['clave'])) {
            // La contraseña es correcta, iniciar sesión
            $_SESSION['admin_id'] = $admin['id_admin'];  // Asegúrate que el campo sea 'id_admin'
            $_SESSION['usuario'] = $admin['usuario'];

            // Redirigir al panel de administración
            header("Location: panel_admin.php");
            exit();
        } else {
            // Contraseña incorrecta
            header("Location: login_admin.php?error=incorrect-password");
            exit();
        }
    } else {
        // Usuario no encontrado
        header("Location: login_admin.php?error=user-not-found");
        exit();
    }
}
?>
