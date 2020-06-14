function enableNext(ctrl){
    var next = document.getElementById(ctrl);
    next.class = next.classList.remove("disabled");
}

function disableNext(ctrl){
    var next = document.getElementById(ctrl);
    next.class = next.classList.add("disabled");
}
 
 function verifyData(){
     if (document.getElementById("name").value!="" && document.getElementById("email").value!=""
         && document.getElementById("pass").value!="" && document.getElementById("pass-conf").value!="")
         enableNext("data-next");
     else 
         disableNext("data-next"); 
 }
 
 function validateData(){
    if (validateName('name') && validateEmail('email'))
        emailLiveValidation('email');
 }

 function verifyCardNumber(ctrl){
    var length = document.getElementById(ctrl).value.replace(/(\r\n|\n|\r)/gm, "").length;
    return (length == 16);
 }
 
 function verifyPayment(){
     if (verifyCardNumber('card-number') && document.getElementById("card-name").value!=""
         && document.getElementById("exp-date").value!="" && document.getElementById("security-code").value!="" && document.getElementById("dni").value!="")
         enableNext("payment-next");
     else 
         disableNext("payment-next");  
 }
 
 function validatePayment(unique=false){
     if(validateNumber('card-number',unique) && validateName('card-name',unique) && validateExpDate('exp-date',unique) && validateNumber('security-code',unique) && validateNumber('dni',unique))
        cardLiveValidation('card-number','card-name','exp-date','security-code','dni');
    return false;
 }

 function verifyLogin(){
    if (document.getElementById("email").value!="" && document.getElementById("pass").value!="")
        enableNext("login-next");
    else 
        disableNext("login-next"); 
 }
 
 function validateLogin(){
     return validateEmail('email');
 }
 
 function showDataForm(){
     document.getElementById("plans-form").classList.add("hidden");
     document.getElementById("data-form").classList.remove("hidden");
 }
 
 function showPaymentForm(){
     document.getElementById("data-form").classList.add("hidden");
     document.getElementById("payment-form").classList.remove("hidden");
 }