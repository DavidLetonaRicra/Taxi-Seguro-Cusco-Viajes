  <!-- Modal de Login -->
            <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="loginModalLabel">Iniciar sesión</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="includes/login.php" method="POST">
                                <div class="mb-3">
                                    <label for="loginEmail" class="form-label">Correo electrónico</label>
                                    <input type="email" class="form-control" id="loginEmail" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="loginPassword" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="loginPassword" name="password" required>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-amarillo">Iniciar sesión</button>
                                </div>
                            </form>
                            <hr>
                                <p class="text-center">¿No tienes cuenta? <a href="#" id="goToRegister">Regístrate aquí</a></p>
                        </div>
                    </div>
                </div>
            </div>