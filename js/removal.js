window.onload = function () {
    switch (window.location.hash) {
        case "#deletePublisher":
            showToast("Se eliminó la editorial con Exito");
            break;
            case "#deletePublisherFail":
            showToast("No se puede eliminar una editorial que posee libros asignados");
            break;
            case "#deleteGenre":
            showToast("Se eliminó el genero con Exito");
            break;
            case "#deleteGenreFail":
            showToast("No se puede eliminar un genero que posee libros asignados");
            break;
            case "#deleteAuthor":
            showToast("Se eliminó el autor con exito");
            break;
            case "#deleteAuthorFail":
            showToast("No se puede eliminar un autor que posee libros asignados");
            break;
            case "#editGenre":
            showToast("Se editó el genero con exito");
            break;
            case "#editGenreFail1":
            showToast("Ya existe un genero con ese nombre");
            break;
            case "#editGenreFail2":
            showToast("El genero no se encuentra cargado");
            break;
            case "#editPublisher":
            showToast("Se editó la editorial con exito");
            break;
            case "#editPublisherFail1":
            showToast("Ya existe una editorial con ese nombre");
            break;
            case "#editPublisherFail2":
            showToast("La editorial no se encuentra cargada");
            break;
            case "#editAuthor":
            showToast("Se editó el autor con exito");
            break;
            case "#editAuthorFail1":
            showToast("Ya existe un autor con ese nombre");
            break;
            case "#editAuthorFail2":
            showToast("El autor no se encuentra cargado");
            break;
            case "#deleteComment":
            showToast("El comentario se elimino con exito");
            break;

           
    }
}