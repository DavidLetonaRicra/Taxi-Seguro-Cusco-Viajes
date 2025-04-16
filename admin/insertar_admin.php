<?php
// Configurar la conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'taxi_seguro_cusco');  // Si usas XAMPP, por defecto el usuario es 'root' y la contraseña está vacía

// Comprobar si hay errores en la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Comprobar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Cifrar la contraseña
    $contrasena_cifrada = password_hash($contrasena, PASSWORD_DEFAULT);

    // Consulta para insertar el nuevo administrador en la base de datos
    $sql = "INSERT INTO administradores (usuario, contrasena) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $usuario, $contrasena_cifrada);

    if ($stmt->execute()) {
        echo "Administrador insertado exitosamente.";
        // Redirigir a la página de gestión de administradores
        header("Location: gestion_admins.php?mensaje=Administrador agregado exitosamente");
        exit();
    } else {
        echo "Error al insertar administrador: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Nuevo Administrador</title>
    <link rel="stylesheet" href="estilo_admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white p-4">

    <div class="container">
        <h2 class="text-center mb-4">Agregar Nuevo Administrador</h2>

        <!-- Formulario para agregar administrador -->
        <form action="insertar_admin.php" method="POST">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-success">Agregar Administrador</button>
            </div>
        </form>

        <div class="mt-3">
            <a href="gestion_admins.php" class="btn btn-primary">Volver a la gestión de administradores</a>
        </div>
    </div>

</body>
</html>
