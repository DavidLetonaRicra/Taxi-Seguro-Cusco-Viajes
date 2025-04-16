<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: login_admin.php');
    exit();
}

$reservas = [];
$sql = "SELECT * FROM reservas WHERE estado = 'pendiente'";
$resultado = $conexion->query($sql);

if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $reservas[] = $fila;
    }
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
    <link rel="stylesheet" href="estilo_admin.css">
   
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center text-amarillo mb-4">🔐 Admin Panel</h4>
        <a href="insertar_admin.php"><i class="bi bi-person-plus me-2"></i>Agregar Admin</a>
        <a href="gestion_admins.php"><i class="bi bi-person-gear me-2"></i>Ver Admins</a>
        <a href="agregar_reserva.php"><i class="bi bi-journal-plus me-2"></i>Agregar Reserva</a>
        <a href="gestion_reservas.php"><i class="bi bi-journal-bookmark-fill me-2"></i>Ver Reservas</a>
        <a href="gestion_clientes.php"><i class="bi bi-people-fill me-2"></i>Clientes</a>
        <a href="asignar_conductor.php"><i class="bi bi-truck-front me-2"></i>Asignar Conductor</a>


            <div class="logout-btn">
                <a href="logout.php" class="btn btn-outline-danger btn-custom w-75 mx-auto">
                    <i class="bi bi-box-arrow-right"></i> Salir
                </a>
            </div>
    </div>

        <!-- Contenido Principal -->
        <div class="main-content">
            <h2 class="mb-4">🎛️ Panel de Administración</h2>

            <div class="col-md-12 mt-4">
                <div class="card p-4">
                    <h5 class="text-amarillo">Reservas Pendientes</h5>
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
                                        <td><?php echo htmlspecialchars($reserva['fecha']); ?></td>
                                        <td><?php echo htmlspecialchars($reserva['hora']); ?></td>
                                        <td><?php echo htmlspecialchars($reserva['num_personas']); ?></td>
                                        <td>
                                            <a href="confirmar_reserva.php?id=<?php echo $reserva['id']; ?>" class="btn btn-success btn-sm">Confirmar</a>
                                            <a href="cancelar_reserva.php?id=<?php echo $reserva['id']; ?>" class="btn btn-danger btn-sm">Cancelar</a>
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

            
        


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
