<?php
require_once('../config/db.php');

// Obtener todos los clientes
$sql = "SELECT * FROM clientes";  // Suponiendo que tienes una tabla "clientes"
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Clientes</title>
    <link rel="stylesheet" href="../style/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white p-4">

    <div class="container">
        <h2 class="text-center mb-4">Clientes Registrados</h2>
        <table class="table table-bordered table-hover table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $fila['id']; ?></td>
                        <td><?php echo $fila['nombre']; ?></td>
                        <td><?php echo $fila['email']; ?></td>
                        <td>
                            <a href="editar_cliente.php?id=<?php echo $fila['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="eliminar_cliente.php?id=<?php echo $fila['id']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
