<?php
require_once '../includes/db_connection.php';

// Eliminar administrador si se pasó el parámetro por GET
if (isset($_GET['eliminar'])) {
    $idEliminar = intval($_GET['eliminar']);
    
    // Usamos PDO para eliminar el administrador
    $sql = "DELETE FROM administradores WHERE id_admin = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $idEliminar, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        header("Location: gestion_admins.php?mensaje=Administrador eliminado exitosamente");
        exit();
    } else {
        echo "Error al eliminar el administrador.";
    }
}

// Obtener lista de administradores
$sql = "SELECT * FROM administradores";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Administradores</title>
    <link rel="stylesheet" href="estilo_admins.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-4">

    <?php if (isset($_GET['mensaje'])): ?>
        <div class="alert alert-success text-center">
            <?php echo htmlspecialchars($_GET['mensaje']); ?>
        </div>
    <?php endif; ?>

    <div class="container">
        <h2 class="text-center text-primary mb-4">Administradores Registrados</h2>
        <div class="mb-3 text-end">
            
            <a href="insertar_admin.php" class="btn btn-primary">Agregar Nuevo Admin</a>
        </div>

        <table class="table table-bordered table-hover">
            <thead class="bg-primary text-white">
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultado as $fila): ?>
                    <tr>
                        <td><?php echo $fila['id_admin']; ?></td>
                        <td><?php echo $fila['usuario']; ?></td>
                        <td>
                            <a href="cambiar_contrasena.php?id=<?php echo $fila['id_admin']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="gestion_admins.php?eliminar=<?php echo $fila['id_admin']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este administrador?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

           <!-- Botón para regresar al panel de administración -->
    <a href="panel_admin.php" class="btn btn-outline-primary mb-4">
        <i class="bi bi-arrow-left-circle"></i> Regresar al Panel de Administración
    </a>
    </div>

 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
