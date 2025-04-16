
<?php
session_start(); 
?>
    <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                require_once('db_connection.php');

                $email = $_POST['email'];
                $password = $_POST['password'];

                $stmt = $pdo->prepare("SELECT * FROM clientes WHERE email = ?");
                $stmt->execute([$email]);
                $user = $stmt->fetch();

                if ($user) {
                    if (password_verify($password, $user['password'])) {
                    $_SESSION['user'] = [
                            'id' => $user['id_cliente'],
                            'nombres' => $user['nombres'],
                            'apellidos' => $user['apellidos'],
                            'email' => $user['email']
                        ];


                        header("Location: ../index.php");
                        exit();
                    } else {
                        $_SESSION['error'] = "Contraseña incorrecta.";
                    }
                } else {
                    $_SESSION['error'] = "El correo electrónico no está registrado.";
                }
            }
    ?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Iniciar sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <!-- Mostrar mensaje de error si es necesario -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Formulario de Login -->
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar sesión</button>
        </form>
    </div>
</body>
</html>
