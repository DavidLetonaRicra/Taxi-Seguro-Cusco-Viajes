<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login Administrador | Taxi Seguro Cusco Viajes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilo_admin.css"> <!-- Referencia a la hoja de estilos común -->
</head>

<body class="bg-dark-custom d-flex align-items-center justify-content-center" style="height: 100vh;">

    <div class="card shadow-lg p-4 card-shadow" style="width: 100%; max-width: 400px;">
        <h4 class="text-center text-amarillo mb-4">Panel de Administración</h4>

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
                <button type="submit" class="btn btn-amarillo">Ingresar</button>
            </div>
            
        </form>



    </div>
    
    <div class="mt-3">
        <?php if (isset($_GET['error'])): ?>
            <div class="mt-3">
                <?php if ($_GET['error'] == 'user-not-found'): ?>
                    <div class="alert alert-danger text-center">El usuario no fue encontrado.</div>
                <?php elseif ($_GET['error'] == 'incorrect-password'): ?>
                    <div class="alert alert-danger text-center">La contraseña es incorrecta.</div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>