<?php
require_once('../config/db.php');

// Eliminar administrador si se pasó el parámetro por GET
if (isset($_GET['eliminar'])) {
    $idEliminar = intval($_GET['eliminar']);
    $conexion->query("DELETE FROM administradores WHERE id = $idEliminar");
    header("Location: gestion_admins.php?mensaje=Administrador eliminado exitosamente");
    exit();
}

// Obtener lista de administradores
$sql = "SELECT * FROM administradores";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Administradores</title>
    <link rel="stylesheet" href="../style/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white p-4">

        <?php if (isset($_GET['mensaje'])): ?>
            <div class="alert alert-success text-center">
                <?php echo htmlspecialchars($_GET['mensaje']); ?>
            </div>
        <?php endif; ?>


    <div class="container">
        <h2 class="text-center mb-4">Administradores Registrados</h2>
        <div class="mb-3 text-end">
            <a href="insertar_admin.php" class="btn btn-success">Agregar Nuevo Admin</a>
        </div>

        <table class="table table-bordered table-hover table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $fila['id']; ?></td>
                        <td><?php echo $fila['usuario']; ?></td>
                        <td>
                            <a href="cambiar_contrasena.php?id=<?php echo $fila['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="gestion_admins.php?eliminar=<?php echo $fila['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este administrador?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
