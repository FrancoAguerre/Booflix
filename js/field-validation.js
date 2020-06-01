function setRedtext(ctrl,text,unique=false){
    var _ctrl = document.getElementById(ctrl);
    var redtext;
    if (!unique)
        redtext = document.getElementById(ctrl + '-redtext');
    else 
        redtext = document.getElementById('redtext');
    _ctrl.style.borderColor = "red";
    _ctrl.focus();
    redtext.innerText = text;
}

function clearRedtext(ctrl,unique=false){
    var _ctrl = document.getElementById(ctrl);
    var redtext;
    if (!unique)
        redtext = document.getElementById(ctrl + '-redtext');
    else 
        redtext = document.getElementById('redtext');

    _ctrl.style.borderColor = "lightgray";
    redtext.innerText = "";   
}

function validateName(ctrl){
    if (!document.getElementById(ctrl).value.trim().match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/)) 
    {
        setRedtext(ctrl, "Sólo se permiten caracteres alfabéticos");
        return false;
    } else {
        clearRedtext(ctrl);
        return true;
    }
}
function validateEmail(ctrl) {
    if (document.getElementById(ctrl).value.match(/^[^@]+@[^@]([^@]*\.)+[^@]+$/)) 
        return true;
    else {
        setRedtext(ctrl, "El correo electrónico no tiene el formato correcto");
        return false;
    }
}

function getCurrentPath(){
    path = window.location.pathname.split("/");
    return path[path.length - 1].split('.')[0];
}

function profileLiveValidation(ctrl){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200){
            if (this.response == 1) 
                setRedtext('name', "Este perfil ya existe");
             else {
                clearRedtext('name');
                profileLiveValidationOk();
            }
        }
    };
    uri = "live-profile-validation.php?name=";
    xmlhttp.open("GET", uri + document.getElementById(ctrl).value.trim(), true);
    xmlhttp.send();
}

function emailLiveValidation(ctrl){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200){
            if (this.response == 1) 
                setRedtext(ctrl, "Este usuario ya está registrado");
             else {
                clearRedtext(ctrl);
                emailLiveValidationOk();
            }
        }
    };
    uri = "live-email-validation.php?email=";
    if (getCurrentPath() != "signup" ) uri = "../" + uri;
    xmlhttp.open("GET", uri + document.getElementById(ctrl).value.trim(), true);
    xmlhttp.send();
}

function cardLiveValidation(number,name,exp,sec,dni){
    var frm = new FormData();
    frm.append("card-number", number);
    frm.append("card-name", name);
    frm.append("expiration-date", exp);
    frm.append("security-code", sec);
    frm.append("dni", dni);
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200){
            if (this.response == 0) 
                cardLiveValidationOk();
             else 
                showToast('Hubo un problema con la tarjeta. Verificá los datos y volvé a intentarlo.');
        } 
    };

    uri = "live-card-validation.php";
    if (getCurrentPath() != "signup" ) uri = "../" + uri;
    xmlhttp.open("POST", uri, true);
    xmlhttp.send(frm);
}

function validatePass(ctrl,unique=false){
    if (document.getElementById(ctrl).value.match(/(?=.*[0-9¡!"#$%&'()*+,-./:;<=>¿?@[\]^_`{|}~])(?=.*[A-Z]).{6,}/)){
        clearRedtext(ctrl,unique);
        return true;
    } else{
        setRedtext(ctrl, "La contraseña debe tener al menos 6 caracteres, una mayúscula y un número o signo",unique);
        return false;
    }
}

function validatePassConf(ctrl1, ctrl2,unique=false) {
    var p1 = document.getElementById(ctrl1);
    var p2 = document.getElementById(ctrl2);

    if (p1.value == p2.value) {
        clearRedtext(ctrl1,unique);
        clearRedtext(ctrl2,unique);
        return true;
    }
    else {
        setRedtext(ctrl1, "",unique);
        setRedtext(ctrl2, "Las contraseñas no coinciden",unique);
        return false;
    }
}

function validateExpDate(ctrl){
    var date = document.getElementById(ctrl).value;
    var month = date.split('/')[0];
    if (date.match(/^\d{2}\/\d{2}$/) && month <=12){
        var year = date.split('/')[1];
        var today = new Date();
        if(today.getYear()+1900<20+year){
            clearRedtext(ctrl);
            return true;
        } else if(today.getYear()+1900>20+year) {
            setRedtext(ctrl, "La tarjeta está vencida");
            return false;
        } else {
            if(today.getMonth()+1<=month){
                clearRedtext(ctrl);
                return true;
            } else {
                setRedtext(ctrl, "La tarjeta está vencida");
                return false;
            }
        }
    } else {
        setRedtext(ctrl, "La fecha debe tener el formato mm/aa");
        return false;
    }
}

function validateNumber(ctrl){
    if (document.getElementById(ctrl).value.trim().match(/^[0-9]+$/)) {
        clearRedtext(ctrl);
        return true;
    }
    else {
        setRedtext(ctrl, "Sólo se permiten caracteres numéricos");
        return false;
    }
}

function validateProfilePic(src, ctrl) {
    var file = document.getElementById(src);
    var ext = file.value.substr(file.value.lastIndexOf(".") + 1, file.value.length).toLowerCase();

    if ((ext == "jpg") && (file.files[0].size < 2 * 1024 * 1024)) {
        clearRedtext(ctrl);
        editProfilePic();
        return true;
    } else {
        setRedtext(ctrl, "La imagen debe ser JPG y pesar menos de 2 MB");
        return false;
    }
}