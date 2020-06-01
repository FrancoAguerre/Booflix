window.onload = function () {
    switch (window.location.hash) {
        case "#error":
            showToast("Algo salió mal. Volvé a intentarlo.");
            break;
    }
}

function emailLiveValidationOk(){
    if(validatePass('pass') && validatePassConf('pass', 'pass-conf'))
        showPaymentForm();
 }

 function cardLiveValidationOk(){
    document.getElementById("signup-form").submit();
 }

 function selectPlan(id) {
     var standard = document.getElementById('plan-standard');
     var plus = document.getElementById('plan-plus');
     switch (id) {
         case 1:
             standard.classList.add("plan-selected");
             plus.classList.remove("plan-selected");
             document.getElementById("selected-plan").value=1;
         break;
         case 2:
            plus.classList.add("plan-selected");
            standard.classList.remove("plan-selected");
             document.getElementById("selected-plan").value=2;
         break;
     }
     enableNext("plan-next");
 }