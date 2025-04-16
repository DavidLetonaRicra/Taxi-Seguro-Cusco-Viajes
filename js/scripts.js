document.addEventListener("DOMContentLoaded", function () {
    const goToRegister = document.getElementById('goToRegister');
    const goToLogin = document.getElementById('goToLogin');

    if (goToRegister) {
        goToRegister.addEventListener('click', function (e) {
            e.preventDefault(); // Evita que el navegador salte a "#"
            const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.hide();
            const registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
            registerModal.show();
        });
    }

    if (goToLogin) {
        goToLogin.addEventListener('click', function (e) {
            e.preventDefault(); // Evita que el navegador salte a "#"
            const registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
            registerModal.hide();
            const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        });
    }
});
