window.onload = function () {
    switch (window.location.hash) {
        case "#ok":
            showToast("Operación exitosa");
            break;
        case "#error":
            showToast("Algo salió mal. Volvé a intentarlo.");
            break;
        case "#invalid_date":
            showToast("Las fechas son inválidas. Volvé a intentarlo");
            break;
        case "#invalid_isbn":
            showToast("No se encontró un libro asociado a ese ISBN");
            break;
        case "#invalid_news":
            showToast("No se encontró una noticia asociada a ese título");
            break;
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
        case "#invalid_chapter":
            showToast("Ese número de capitulo ya fue utilizado");
            break;
        case "#deletebook":
            showToast("Se eliminó el libro con exito");
            break;
        case "#deletebookFail":
            showToast("No se encontró un libro con ese ISBN");
            break;
    }
}

function validateDates(date1, date2){
    if( document.getElementById(date1).value < document.getElementById(date2).value){
        return true;
    } else if(document.getElementById(date2).value=='') {
        return true;
    } else {
        alert ("Fechas inválidas");
        return false;
    }
}