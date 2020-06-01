window.onload = function () {
    switch (window.location.hash) {
        case "#ok":
            showToast("Se guardaron los cambios.");
            break;
        case "#error":
            showToast("Algo salió mal. Volvé a intentarlo.");
            break;
        case "#wrong-pass":
            setRedtext('old-pass', "Contraseña incorrecta",true);
            break;
    }
}

function verifyProfileEditing(){
    if (document.getElementById('name').value!="") 
        enableNext('profile-next');
    else
        disableNext('profile-next');
}

function validateProfileEditing(name){
    if (document.getElementById('name').value.toLowerCase() != name.toLowerCase()){
        if (validateName('name'))
            profileLiveValidation('name');
    } else
        profileLiveValidationOk();
}

function profileLiveValidationOk(){
    document.getElementById('profile-form').submit();
}

var _isProfileDeleteConfirmed = false;

function askDeleteConfirmation(id){
    if (_isProfileDeleteConfirmed) {
        window.location.assign("delete-profile.php?id=" + id);
    } else {
        document.getElementById('delete-confirmation').classList.remove('hidden');
        document.getElementById('form-foot').classList.add('hidden');
        _isProfileDeleteConfirmed=true;
    }

}

function hideDeleteConfirmation(){
    document.getElementById('delete-confirmation').classList.add('hidden');
    document.getElementById('form-foot').classList.remove('hidden');
    _isProfileDeleteConfirmed=false;
}

function verifyAccountEditing(){
    if (document.getElementById('email').value!="") 
        enableNext('account-next');
    else
        disableNext('account-next');
}

function validateAccountEditing(email){
    if (document.getElementById('email').value != email){
        if (validateEmail('email'))
            emailLiveValidation('email');
    } else
        emailLiveValidationOk();
}

function emailLiveValidationOk(){
    document.getElementById('account-form').submit();
}

function selectPlan(id) {
    switch (id) {
        case 1:
            document.getElementById("selected-plan").value=1;
        break;
        case 2:
            document.getElementById("selected-plan").value=2;
        break;
    }
}

function verifyPassEditing(){
    if (document.getElementById('old-pass').value!="" && document.getElementById('new-pass').value!="" && document.getElementById('new-pass-conf').value!="")
        enableNext('security-next');
    else
        disableNext('security-next');
}

function validatePassEditing(){

    if(document.getElementById('old-pass').value != document.getElementById('new-pass').value){
        if (validatePass('new-pass',true) && validatePassConf('new-pass','new-pass-conf',true))
            document.getElementById('security-form').submit();
    } else 
        setRedtext('new-pass', "La contraseña actual y la contraseña nueva deben ser distintas",true);
    
}

function editProfilePic(){
    document.getElementById("profile-pic-advice").classList.remove('hidden');
}