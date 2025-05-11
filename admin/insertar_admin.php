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
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Verificar si el nombre de usuario ya existe en la base de datos
    $sql = "SELECT * FROM administradores WHERE usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Si ya existe un usuario con el mismo nombre
    if ($resultado->num_rows > 0) {
        echo "Error: El usuario '$usuario' ya existe. Por favor, elige otro nombre de usuario.";
    } else {
        // Cifrar la contraseña
        $contrasena_cifrada = password_hash($contrasena, PASSWORD_DEFAULT);

        // Consulta para insertar el nuevo administrador en la base de datos
        $sql = "INSERT INTO administradores (nombre, usuario, clave) VALUES (?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sss", $nombre, $usuario, $contrasena_cifrada);

        if ($stmt->execute()) {
            // Redirigir a la página de gestión de administradores
            header("Location: gestion_admins.php?mensaje=Administrador agregado exitosamente");
            exit();
        } else {
            echo "Error al insertar administrador: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Nuevo Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">
        <h2 class="text-center text-primary mb-4">Agregar Nuevo Administrador</h2>
    <div class="container" style="max-width: 450px;">
        

        <!-- Formulario para agregar administrador -->
        <form action="insertar_admin.php" method="POST" >
            <div class="mb-3">
                <label for="nombre" class="form-label text-primary">Nombre</label>
                <input type="text" class="form-control border-primary" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label text-primary">Usuario</label>
                <input type="text" class="form-control border-primary" id="usuario" name="usuario" required>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label text-primary">Contraseña</label>
                <input type="password" class="form-control border-primary" id="contrasena" name="contrasena" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Agregar Administrador</button>
            </div>
        </form>

        <div class="mt-3">
            <a href="gestion_admins.php" class="btn btn-outline-primary">Volver a la gestión de administradores</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
