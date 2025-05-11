<?php
session_start();
require_once '../includes/db_connection.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: login_admin.php');
    exit();
}

try {
    $sql = "SELECT * FROM clientes";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener los clientes: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Gestión de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="panel_admin.php" class="btn btn-outline-primary">← Volver al Panel</a>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="modoOscuro">
            <label class="form-check-label" for="modoOscuro">🌙 Modo Oscuro</label>
        </div>
    </div>

    <h2 class="mb-4 text-center text-primary">📋 Clientes Registrados</h2>

    <!-- Estadísticas rápidas -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Clientes</h5>
                    <p class="fs-4"><?= count($clientes) ?></p>
                </div>
            </div>
        </div>
        <!-- Puedes añadir más tarjetas para "activos", "verificados", etc. -->
    </div>

    <!-- Filtros simulados -->
    <div class="mb-3">
        <button class="btn btn-outline-secondary btn-sm me-2">Todos</button>
        <button class="btn btn-outline-success btn-sm me-2">Activos</button>
        <button class="btn btn-outline-danger btn-sm">Inactivos</button>
    </div>

    <!-- Tabla de clientes -->
    <div class="card shadow-sm p-3">
        <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-primary">
                <tr>
                    <th>Avatar</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Fecha Registro</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($clientes) > 0): ?>
                    <?php foreach ($clientes as $cliente): ?>
                        <?php
                            $iniciales = strtoupper(substr($cliente['nombres'], 0, 1) . substr($cliente['apellidos'], 0, 1));
                        ?>
                        <tr>
                            <td>
                                <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center mx-auto" style="width: 40px; height: 40px;">
                                    <?= $iniciales ?>
                                </div>
                            </td>
                            <td><?= htmlspecialchars($cliente['nombres']) ?></td>
                            <td><?= htmlspecialchars($cliente['apellidos']) ?></td>
                            <td><?= $cliente['telefono'] ?? '—' ?></td>
                            <td><?= htmlspecialchars($cliente['email']) ?></td>
                            <td><?= $cliente['fecha_registro'] ?></td>
                            <td><span class="badge bg-success">Activo</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalDetalle<?= $cliente['id_cliente'] ?>" title="Ver Detalle">👁️</button>
                                <button class="btn btn-sm btn-warning" title="Editar">✏️</button>
                                <button class="btn btn-sm btn-danger" title="Eliminar">🗑️</button>
                            </td>
                        </tr>

                        <!-- Modal Detalle -->
                        <div class="modal fade" id="modalDetalle<?= $cliente['id_cliente'] ?>" tabindex="-1">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Detalle del Cliente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                              <div class="modal-body text-start">
                                <p><strong>Nombre:</strong> <?= htmlspecialchars($cliente['nombres']) . ' ' . htmlspecialchars($cliente['apellidos']) ?></p>
                                <p><strong>Email:</strong> <?= htmlspecialchars($cliente['email']) ?></p>
                                <p><strong>Teléfono:</strong> <?= $cliente['telefono'] ?? '—' ?></p>
                                <p><strong>Fecha Registro:</strong> <?= $cliente['fecha_registro'] ?></p>
                                <p><strong>Estado:</strong> Activo</p>
                              </div>
                            </div>
                          </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="8" class="text-center">No hay clientes registrados.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('modoOscuro').addEventListener('change', function () {
        document.body.classList.toggle('bg-dark');
        document.body.classList.toggle('text-light');
        document.querySelectorAll('.card').forEach(el => el.classList.toggle('bg-dark'));
    });
</script>

</body>
</html>
