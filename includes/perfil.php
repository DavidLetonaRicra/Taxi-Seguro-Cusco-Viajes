<?php
session_start();

// Redirigir si no hay sesión activa
if (!isset($_SESSION['user'])) {
    header("Location: login.php"); // Redirigir al login si no está logueado
    exit();
}

$user = $_SESSION['user']; // Asignamos los datos de la sesión a la variable $user
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mi Perfil - Taxi Seguro Cusco</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow-lg">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">👤 Mi Perfil</h4>
    </div>
    <div class="card-body">
      <p><strong>Nombres:</strong> <?php echo isset($user['nombres']) ? htmlspecialchars($user['nombres']) : 'No disponible'; ?></p>
      <p><strong>Apellidos:</strong> <?php echo isset($user['apellidos']) ? htmlspecialchars($user['apellidos']) : 'No disponible'; ?></p>
      <p><strong>Teléfono:</strong> <?php echo isset($user['telefono']) && !empty($user['telefono']) ? htmlspecialchars($user['telefono']) : 'No disponible'; ?></p>
      <p><strong>Email:</strong> <?php echo isset($user['email']) ? htmlspecialchars($user['email']) : 'No disponible'; ?></p>

      <a href="../index.php" class="btn btn-secondary">← Volver</a>
    </div>
  </div>
</div>

</body>
</html>
