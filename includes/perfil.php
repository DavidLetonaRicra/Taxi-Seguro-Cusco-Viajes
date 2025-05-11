<?php 
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Perfil - Taxi Seguro Cusco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card-profile {
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      overflow: hidden;
    }
    .profile-header {
      background-color: #1E88E5;
      color: white;
      padding: 1.5rem;
      text-align: center;
    }
    .profile-img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 50%;
      border: 3px solid white;
      margin-bottom: 1rem;
    }
    .profile-section {
      padding: 1rem 2rem;
    }
    .info-row {
      display: flex;
      justify-content: space-between;
      border-bottom: 1px solid #eaeaea;
      padding: 0.5rem 0;
    }
    .info-row:last-child {
      border-bottom: none;
    }
    .stats {
      display: flex;
      justify-content: space-between;
      margin-top: 1rem;
    }
    .stat-card {
      flex: 1;
      background: #f8f9fa;
      margin: 0 5px;
      border-radius: 10px;
      padding: 1rem;
      text-align: center;
      box-shadow: 0 1px 4px rgba(0,0,0,0.05);
    }
    .stat-card h6 {
      margin: 0.5rem 0 0;
      font-size: 14px;
    }
    .btn-sm-custom {
      font-size: 14px;
      margin-top: 10px;
    }
  </style>
</head>
<body class="bg-light">

<div class="container mt-4 mb-4">
  <div class="card card-profile">
    <!-- Encabezado -->
    <div class="profile-header">
    <img src="../img/david.png" class="profile-img" alt="Foto de Perfil">
    <h4><?php echo htmlspecialchars($user['nombres']) . ' ' . htmlspecialchars($user['apellidos']); ?></h4>
      <p class="mb-0"><?php echo htmlspecialchars($user['email']); ?></p>
      <small>Usuario registrado</small>
    </div>

    <!-- Información -->
    <div class="profile-section">
      <div class="info-row">
        <strong>📞 Teléfono:</strong>
        <span><?php echo !empty($user['telefono']) ? htmlspecialchars($user['telefono']) : 'No disponible'; ?></span>
        </div>
      <div class="info-row">
        <strong>✉️ Correo:</strong>
        <span><?php echo htmlspecialchars($user['email']); ?></span>
      </div>
      <div class="info-row">
        <strong>🛡️ Verificación:</strong>
        <span class="text-success">Verificado</span>
      </div>

      <div class="stats">
        <div class="stat-card">
          <strong>12</strong>
          <h6>Viajes Realizados</h6>
        </div>
        <div class="stat-card">
          <strong>3</strong>
          <h6>Reportes Abiertos</h6>
        </div>
        <div class="stat-card">
          <strong>⭐ 4.8</strong>
          <h6>Reputación</h6>
        </div>
      </div>

      <div class="mt-3 d-flex flex-wrap gap-2 justify-content-between">
        <a href="javascript:history.back()" class="btn btn-secondary btn-sm btn-sm-custom">⬅ Volver Atrás</a>
        <a href="../index.php" class="btn btn-primary btn-sm btn-sm-custom">🏠 Página Principal</a>
        <a href="editar_perfil.php" class="btn btn-outline-primary btn-sm btn-sm-custom">Editar Perfil</a>
        <a href="historial_viajes.php" class="btn btn-outline-secondary btn-sm btn-sm-custom">Historial de Viajes</a>
        <a href="logout.php" class="btn btn-danger btn-sm btn-sm-custom">Cerrar Sesión</a>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
