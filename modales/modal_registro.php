<!-- Modal de Registro -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 500px; width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Crear cuenta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="includes/register.php" method="POST">
                    <!-- Nombres -->
                    <div class="mb-3">
                        <label for="registerNombres" class="form-label">Nombres</label>
                        <input type="text" class="form-control" id="registerNombres" name="nombres" required>
                    </div>
                    <!-- Apellidos -->
                    <div class="mb-3">
                        <label for="registerApellidos" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="registerApellidos" name="apellidos" required>
                    </div>
                    <!-- Teléfono -->
                    <div class="mb-3">
                        <label for="registerTelefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="registerTelefono" name="telefono">
                    </div>
                    <!-- Correo electrónico -->
                    <div class="mb-3">
                        <label for="registerEmail" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="registerEmail" name="email" required>
                    </div>
                    <!-- Contraseña -->
                    <div class="mb-3">
                        <label for="registerPassword" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="registerPassword" name="password" required>
                    </div>
                    <!-- Confirmar Contraseña -->
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                    </div>
                    <!-- Botón de Registro -->
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-amarillo">Registrar</button>
                    </div>
                </form>
                <hr>
                <p class="text-center">¿Ya tienes cuenta? <a href="#" id="goToLogin">Inicia sesión aquí</a></p>
            </div>
        </div>
    </div>
</div>
