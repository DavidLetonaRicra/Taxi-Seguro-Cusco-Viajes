<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login_admin.php');
    exit();
}

require_once '../includes/db_connection.php';

// Filtro opcional por estado
$estado = $_GET['estado'] ?? '';

$sql = "SELECT * FROM reservas";
$params = [];

if ($estado !== '') {
    $sql .= " WHERE estado = :estado";
    $params[':estado'] = $estado;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Reservas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <a href="panel_admin.php" class="btn btn-outline-primary mb-4">← Volver al Panel</a>
    <h2 class="mb-4 text-center text-primary">Gestión de Reservas</h2>

    <form method="GET" class="d-flex mb-4">
        <select name="estado" class="form-select" aria-label="Filtrar por estado">
            <option value="">Filtrar por estado</option>
            <option value="Pendiente" <?= $estado == 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
            <option value="Confirmada" <?= $estado == 'Confirmada' ? 'selected' : '' ?>>Confirmada</option>
            <option value="Cancelada" <?= $estado == 'Cancelada' ? 'selected' : '' ?>>Cancelada</option>
        </select>
        <button type="submit" class="btn btn-outline-primary ms-2">Filtrar</button>
    </form>

    <table class="table table-bordered table-striped text-center">
        <thead class="bg-primary text-white">
            <tr>
                <th>ID</th>
                <th>Cliente</th> <!-- Nueva columna -->
                <th>Origen</th>
                <th>Destino</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th># Personas</th>
                <th>Comentarios</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($reservas as $reserva): ?>
            <tr>
                <td><?= $reserva['id_reserva'] ?></td>
                <td><?= 'Usuario #' . $reserva['id_reserva'] ?></td>
                <td><?= htmlspecialchars($reserva['origen']) ?></td>
                <td><?= htmlspecialchars($reserva['destino']) ?></td>
                <td><?= $reserva['fecha_reserva'] ?></td>
                <td><?= $reserva['hora_reserva'] ?></td>
                <td><?= $reserva['numero_personas'] ?></td>
                <td><?= htmlspecialchars($reserva['comentarios']) ?></td>
                <td>
                    <span class="badge bg-<?= 
                        $reserva['estado'] == 'Pendiente' ? 'warning' : 
                        ($reserva['estado'] == 'Confirmada' ? 'success' : 'danger')
                    ?>">
                        <?= $reserva['estado'] ?>
                    </span>
                </td>
                <td>
                    <!-- Botón para abrir el modal de edición -->
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editarModal" 
                            data-id="<?= $reserva['id_reserva'] ?>"
                            data-estado="<?= $reserva['estado'] ?>"
                            data-origen="<?= htmlspecialchars($reserva['origen']) ?>"
                            data-destino="<?= htmlspecialchars($reserva['destino']) ?>"
                            data-fecha="<?= $reserva['fecha_reserva'] ?>"
                            data-hora="<?= $reserva['hora_reserva'] ?>"
                            data-personas="<?= $reserva['numero_personas'] ?>"
                            data-comentarios="<?= htmlspecialchars($reserva['comentarios']) ?>">
                        Editar
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal para editar estado -->
<div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editarModalLabel">Editar Estado de Reserva</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <form id="formEditarEstado" action="cambiar_estado.php" method="GET">
            <input type="hidden" name="id" id="modalIdReserva">
            <div class="mb-3">
                <label for="modalEstado" class="form-label">Estado</label>
                <select class="form-select" id="modalEstado" name="estado">
                    <option value="Pendiente">Pendiente</option>
                    <option value="Confirmada">Confirmada</option>
                    <option value="Cancelada">Cancelada</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Manejo del modal
    const editarModal = document.getElementById('editarModal');
    editarModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const idReserva = button.getAttribute('data-id');
        const estado = button.getAttribute('data-estado');

        const modalIdReserva = document.getElementById('modalIdReserva');
        const modalEstado = document.getElementById('modalEstado');

        // Rellenar el formulario con la información de la reserva
        modalIdReserva.value = idReserva;
        modalEstado.value = estado;
    });
</script>

</body>
</html>