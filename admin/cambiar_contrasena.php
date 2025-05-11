<?php
require_once('../config/db.php');

// Verificar si el administrador está logueado
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login_admin.php");
    exit();
}

// Procesar el cambio de contraseña
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_SESSION['usuario'];
    $contrasenaActual = $_POST['contrasena_actual'];
    $nuevaContrasena = $_POST['nueva_contrasena'];

    // Validar si la contraseña actual es correcta
    $query = "SELECT * FROM administradores WHERE usuario = '$usuario'";
    $resultado = $conexion->query($query);
    $admin = $resultado->fetch_assoc();

    if (password_verify($contrasenaActual, $admin['contrasena'])) {
        // Contraseña correcta, proceder a actualizarla
        $nuevaContrasenaHash = password_hash($nuevaContrasena, PASSWORD_DEFAULT);
        $conexion->query("UPDATE administradores SET contrasena = '$nuevaContrasenaHash' WHERE usuario = '$usuario'");

        // Mostrar mensaje de éxito
        echo "<div class='alert alert-success'>Contraseña cambiada exitosamente.</div>";
    } else {
        echo "<div class='alert alert-danger'>La contraseña actual es incorrecta.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cambiar Contraseña | Taxi Seguro Cusco Viajes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/estilos.css">
</head>
<body class="bg-dark text-white p-4">

    <div class="container">
        <h2 class="text-center mb-4">Cambiar Contraseña</h2>

        <form action="cambiar_contrasena.php" method="POST">
            <div class="mb-3">
                <label for="contrasena_actual" class="form-label">Contraseña Actual</label>
                <input type="password" id="contrasena_actual" name="contrasena_actual" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nueva_contrasena" class="form-label">Nueva Contraseña</label>
                <input type="password" id="nueva_contrasena" name="nueva_contrasena" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
        </form>

        <div class="mt-3">
            <a href="gestion_admins.php" class="btn btn-secondary">Volver al Panel de Administración</a>
        </div>
    </div>

</body>
</html>
