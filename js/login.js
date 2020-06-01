window.onload = function () {
    switch (window.location.hash) {
        case "#login-wrong":
            setRedtext('email', "Usuario o contraseña incorrectos");
            break;
        case "#signedup":
            showToast("¡Ya te registraste! Ahora ingresa usando tus datos.");
            break;
        case "#must-login":
            showToast("Debes iniciar sesión para ver este contenido.");
            break;
    }
}