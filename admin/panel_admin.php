<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login_admin.php');
    exit();
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
    <link rel="stylesheet" href="../style/estilos.css">
    <style>
        .admin-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .admin-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .card-icon {
            font-size: 3rem;
            color: #FFD700;
        }

        body {
            background-color: #111;
        }
    </style>
</head>

<body class="text-white">

    <div class="container mt-5">
        <h2 class="text-center mb-4">🎛️ Panel de Administración</h2>

        <!-- Botón de logout -->
        <div class="text-end mb-4">
            <a href="logout.php" class="btn btn-outline-danger">
                <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
            </a>
        </div>

        <div class="row g-4">

            <!-- Gestión de Administradores -->
            <div class="col-md-4">
                <div class="card bg-dark text-white admin-card">
                    <div class="card-body text-center">
                        <i class="bi bi-person-gear card-icon"></i>
                        <h5 class="card-title mt-3">Administradores</h5>
                        <a href="insertar_admin.php" class="btn btn-success btn-sm mt-2">Agregar</a>
                        <a href="gestion_admins.php" class="btn btn-info btn-sm mt-2">Ver</a>
                    </div>
                </div>
            </div>

            <!-- Gestión de Reservas -->
            <div class="col-md-4">
                <div class="card bg-dark text-white admin-card">
                    <div class="card-body text-center">
                        <i class="bi bi-journal-bookmark-fill card-icon"></i>
                        <h5 class="card-title mt-3">Reservas</h5>
                        <a href="agregar_reserva.php" class="btn btn-warning btn-sm mt-2">Agregar</a>
                        <a href="gestion_reservas.php" class="btn btn-primary btn-sm mt-2">Ver</a>
                    </div>
                </div>
            </div>

            <!-- Gestión de Clientes -->
            <div class="col-md-4">
                <div class="card bg-dark text-white admin-card">
                    <div class="card-body text-center">
                        <i class="bi bi-people-fill card-icon"></i>
                        <h5 class="card-title mt-3">Clientes</h5>
                        <a href="gestion_clientes.php" class="btn btn-success btn-sm mt-2">Ver</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
