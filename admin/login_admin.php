<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login Administrador | Taxi Seguro Cusco Viajes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <!-- Icono de salida con Tooltip -->
    <a href="../index.php" class="position-absolute top-0 end-0 p-3 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Regresar al inicio">
        <i class="bi bi-x-circle fs-1"></i>
    </a>

    <!-- Tarjeta de Login -->
    <div class="card shadow-lg p-4 w-100" style="max-width: 400px;">
        <h4 class="text-center text-primary mb-4">Panel de Administración</h4>

        <!-- Formulario de inicio de sesión -->
        <form action="verificar_admin.php" method="POST">
            <div class="mb-3">
                <label for="usuario" class="form-label text-white">Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label text-white">Contraseña</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </div>
        </form>
    </div>

    <!-- Mensajes de error -->
    <div class="mt-3">
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger text-center">
                <?php if ($_GET['error'] == 'user-not-found'): ?>
                    El usuario no fue encontrado.
                <?php elseif ($_GET['error'] == 'incorrect-password'): ?>
                    La contraseña es incorrecta.
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <script>
        // Activar los tooltips de Bootstrap
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>

</body>

</html>
