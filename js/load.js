window.onload = function () {
    switch (window.location.hash) {
        case "#addgen":
            showToast("Se agregó el nuevo genero con Exito");
            break;
            case "#addgenfail":
            showToast("El genero ya se ecuentra cargado");
            break;
            case "#addauthor":
            showToast("Se agregó el nuevo autor con Exito");
            break;
            case "#addauthorfail":
            showToast("El autor ya se encuentra cargado");
            break;
            case "#addpublisher":
            showToast("Se agregó la nueva editorial con Exito");
            break;
            case "#addpublisherfail":
            showToast("La editorial ya se encuentra cargada");
            break;
    }
}