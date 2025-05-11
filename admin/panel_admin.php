<?php
session_start();
require_once '../includes/db_connection.php';  // Verifica que la ruta sea correcta

if (!isset($_SESSION['admin_id'])) {
    header('Location: login_admin.php');
    exit();
}

$reservas = [];
try {
    // Realizar la consulta con PDO
    $sql = "SELECT * FROM reservas WHERE estado = 'pendiente'";
    $stmt = $pdo->query($sql);

    // Verificar si se obtuvieron resultados
    if ($stmt->rowCount() > 0) {
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $reservas[] = $fila;
        }
    }
} catch (PDOException $e) {
    // En caso de error, podemos manejarlo aquí si lo necesitas
    die("Error al realizar la consulta: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Panel de Administración | Taxi Seguro Cusco Viajes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- Contenedor del Menú y Contenido -->
    <div class="container-fluid d-flex">
        <!-- Sidebar -->
        <div class="d-flex flex-column" style="background-color:rgb(11, 109, 208); color: white; padding: 20px; width: 250px; height: 100vh;">
            <h4 class="text-center mb-4">🔐 Panel de Administración</h4>
            <a href="insertar_admin.php" class="text-white mb-2"><i class="bi bi-person-plus me-2"></i>Agregar Admin</a>
            <a href="gestion_admins.php" class="text-white mb-2"><i class="bi bi-person-gear me-2"></i>Ver Admins</a>
            <a href="agregar_reserva.php" class="text-white mb-2"><i class="bi bi-journal-plus me-2"></i>Agregar Reserva</a>
            <a href="gestion_reservas.php" class="text-white mb-2"><i class="bi bi-journal-bookmark-fill me-2"></i>Gestión Reservas</a>
            <a href="gestion_clientes.php" class="text-white mb-2"><i class="bi bi-people-fill me-2"></i>Clientes</a>
            <a href="asignar_conductor.php" class="text-white mb-2"><i class="bi bi-truck-front me-2"></i>Asignar Conductor</a>

            <div class="mt-auto">
                <a href="logout.php" class="btn btn-outline-light w-100"><i class="bi bi-box-arrow-right"></i> Salir</a>
            </div>
        </div>

        <!-- Contenido Principal -->
        <div class="container-fluid ms-3">
            <div class="row">
                <div class="col-12">
                    <h2 class="mt-4 mb-4 text-primary">🎛️ Panel de Administración</h2>
                    <div class="card p-4">
                        <h5 class="text-primary">Reservas Pendientes</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Origen</th>
                                    <th>Destino</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Personas</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($reservas) > 0): ?>
                                    <?php foreach ($reservas as $index => $reserva): ?>
                                        <tr>
                                            <td><?php echo $index + 1; ?></td>
                                            <td><?php echo htmlspecialchars($reserva['origen']); ?></td>
                                            <td><?php echo htmlspecialchars($reserva['destino']); ?></td>
                                            <td><?php echo htmlspecialchars($reserva['fecha_reserva']); ?></td>
                                            <td><?php echo htmlspecialchars($reserva['hora_reserva']); ?></td>
                                            <td><?php echo htmlspecialchars($reserva['numero_personas']); ?></td>
                                            <td>
                                                <a href="confirmar_reserva.php?id=<?php echo $reserva['id_reserva']; ?>" class="btn btn-success btn-sm">Confirmar</a>
                                                <a href="cancelar_reserva.php?id=<?php echo $reserva['id_reserva']; ?>" class="btn btn-danger btn-sm">Cancelar</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="7" class="text-center">No hay reservas pendientes.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
