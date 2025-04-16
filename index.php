<?php
session_start();
$clienteLogueado = isset($_SESSION['id_cliente']);
?>





<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Taxi Seguro Cusco Viajes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/estilos.css">
    
</head>

<script src="js/scripts.js"></script>

<body>

            <nav class="navbar navbar-expand-lg azul-oscuro">
                <div class="container">
                    <a class="navbar-brand d-flex align-items-center" href="index.php">
                        <img src="img/logo.svg" alt="Logo Taxi Seguro Cusco" style="width: 40px; height: 40px;" class="me-2">
                        <span class="text-white fw-bold">Taxi Seguro Cusco Viajes</span>
                    </a>

                    <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav ms-auto align-items-center">
                            <li class="nav-item"><a class="nav-link text-white" href="index.php">Inicio</a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="destinos.html">Destinos</a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="servicios.html">Servicios</a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="nosotros.html">Nosotros</a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="contacto.html">Contacto</a></li>

                            <?php if (isset($_SESSION['user'])): ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-white d-flex align-items-center gap-2" href="#" id="perfilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 5px 10px;">
                                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Perfil" width="30" height="30" class="rounded-circle">
                                        <span class="d-none d-md-inline"><?php echo htmlspecialchars($_SESSION['user']['nombres']); ?></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="perfilDropdown">
                                        <li><a class="dropdown-item" href="includes/perfil.php">👤 Mi Perfil</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-danger" href="includes/logout.php">🔓 Cerrar Sesión</a></li>
                                    </ul>
                                </li>
                                <?php else: ?>
                                <li class="nav-item">
                                    <button class="btn btn-amarillo btn-sm ms-2" data-bs-toggle="modal" data-bs-target="#loginModal">Iniciar Sesión</button>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>







    <?php
                include 'modales/modal_login.php';
                include 'modales/modal_registro.php';
    ?>

    <!-- HEADER CON FONDO -->
    <header class="bg-image text-center py-5">
        <div class="container">
            <h1 class="display-4 fw-bold">Explora Cusco con Seguridad</h1>
            <p class="lead">Viajes turísticos privados con asignación manual de conductores</p>
            <!-- Cambiar el enlace a un botón que abrirá el modal -->
            <button class="btn btn-amarillo btn-lg mt-3 text-black" data-bs-toggle="modal"
                data-bs-target="#reservationModal">Reservar Ahora</button>
        </div>
    </header>


    <!-- Modal de Reserva Completa -->
    <div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reservationModalLabel">Reserva tu Viaje</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="reservationForm" action="procesar_reserva.php" method="POST">
                        <!-- Origen y Destino -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="origin" class="form-label">Origen</label>
                                <input type="text" class="form-control" id="origin" name="origin" required
                                    placeholder="Ej. Plaza de Armas">
                            </div>
                            <div class="col-md-6">
                                <label for="destination" class="form-label">Destino</label>
                                <input type="text" class="form-control" id="destination" name="destination" required
                                    placeholder="Ej. Machu Picchu">
                            </div>
                        </div>

                        <!-- Fecha y Hora -->
                        <div class="row g-3 mt-3">
                            <div class="col-md-6">
                                <label for="pickupDate" class="form-label">Fecha</label>
                                <input type="date" class="form-control" id="pickupDate" name="pickupDate" required>
                            </div>
                            <div class="col-md-6">
                                <label for="pickupTime" class="form-label">Hora</label>
                                <input type="time" class="form-control" id="pickupTime" name="pickupTime" required>
                            </div>
                        </div>

                        <!-- Número de Personas -->
                        <div class="mt-3">
                            <label for="numPeople" class="form-label">Número de Personas</label>
                            <input type="number" class="form-control" id="numPeople" name="numPeople" min="1" required
                                placeholder="1 Persona">
                        </div>

                        <!-- Comentarios Adicionales -->
                        <div class="mt-3">
                            <label for="additionalComments" class="form-label">Comentarios Adicionales</label>
                            <textarea class="form-control" id="additionalComments" name="additionalComments" rows="3"
                                placeholder="Ej. Necesito un asiento para niño, o viaje con mascotas..."></textarea>
                        </div>

                        <!-- Botón de Confirmación -->
                        <div class="d-grid gap-2 mt-4">
                            <?php if (isset($_SESSION['id_cliente'])): ?>
                                <button type="submit" class="btn btn-amarillo">Reservar viaje</button>
                            <?php else: ?>
                                <button type="button" class="btn btn-amarillo" data-bs-toggle="modal" data-bs-target="#loginModal">Inicia sesión para reservar</button>
                            <?php endif; ?>



                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





    <section class="servicios-destacados py-5">
        <div class="container text-center">
            <h2 class="text-brand mb-5">Nuestros Servicios</h2>
            <div class="row g-4">
                <!-- Taxi Turístico -->
                <div class="col-md-6">
                    <div class="card shadow rounded-4">
                        <div class="card-body">
                            <h4 class="card-title text-azul-oscuro">Taxi Turístico</h4>
                            <p class="card-text">Disfruta de un viaje exclusivo por los principales destinos turísticos
                                de
                                Cusco. Con un servicio personalizado, cómodo y seguro, podrás conocer los lugares más
                                emblemáticos con un conductor experto.</p>
                            <a href="destinos.html" class="btn btn-amarillo">Más información</a>
                        </div>
                    </div>
                </div>

                <!-- Taxi Exclusivo -->
                <div class="col-md-6">
                    <div class="card shadow rounded-4">
                        <div class="card-body">
                            <h4 class="card-title text-azul-oscuro">Taxi Exclusivo</h4>
                            <p class="card-text">Viaja de forma privada y exclusiva. Nuestro servicio de taxi es ideal
                                para
                                quienes desean comodidad y privacidad. Ya sea para un viaje en la ciudad o un tour
                                personalizado, ofrecemos la mejor atención.</p>
                            <a href="destinos.html" class="btn btn-amarillo">Más información</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>





    <!-- SECCIÓN INFORMATIVA -->
    <section class="py-2 text-center">
        <div class="container">
            <h2 class="text-brand">¿Por qué elegirnos?</h2>
            <p class="lead">Ofrecemos traslados privados, seguros y personalizados a los principales destinos turísticos
                de Cusco.</p>
            <div class="row mt-4">
                <div class="col-md-4">
                    <h5><i class="bi bi-calendar-check-fill text-verde"></i> Reservas Online</h5>
                    <p>Reserva desde cualquier parte del mundo de forma rápida.</p>
                </div>
                <div class="col-md-4">
                    <h5><i class="bi bi-person-badge-fill text-amarillo"></i> Conductores asignados</h5>
                    <p>Asignación manual que garantiza puntualidad y confianza.</p>
                </div>
                <div class="col-md-4">
                    <h5><i class="bi bi-shield-lock-fill text-rojo"></i> Seguridad Garantizada</h5>
                    <p>Protocolos de seguridad para que tu viaje sea seguro.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="azul-oscuro text-white text-center py-2">
        <p class="mb-0">&copy; 2025 Taxi Seguro Cusco Viajes | Todos los derechos reservados</p>
        <p class="mt-1">
            <a href="admin/login_admin.php" class="text-warning text-decoration-none small">Panel de Administración</a>
        </p>
    </footer>

    <!-- BOTON WHATTSAAP -->
    <a href="https://wa.me/51910406090?text=Hola%2C%20quisiera%20más%20información%20sobre%20sus%20tours"
        class="whatsapp-float" target="_blank" title="Contáctanos por WhatsApp">
        <img src="https://cdn-icons-png.flaticon.com/512/124/124034.png" alt="WhatsApp">
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>