<?php
session_start();

// Redirigir si no hay sesión activa
if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit();
}

$user = $_SESSION['user'];
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
      <p><strong>Nombres:</strong> <?php echo htmlspecialchars($user['nombres']); ?></p>
      <p><strong>Apellidos:</strong> <?php echo htmlspecialchars($user['apellidos']); ?></p>
      <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($user['telefono']); ?></p>
      <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>

      <!-- Puedes agregar una opción para editar en el futuro -->
      <a href="../index.php" class="btn btn-secondary">← Volver</a>
    </div>
  </div>
</div>

</body>
</html>
