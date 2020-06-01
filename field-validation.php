<?php

function validateEmail($ctrl) {     // OK
    return $ctrl!="" && preg_match('/^[^@]+@[^@]([^@]*\.)+[^@]+$/', $ctrl);
}

function validateName($ctrl) {      // OK
    return $ctrl!="" && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $ctrl);
}

function validatePass($ctrl) {      // OK
    return $ctrl!="" && preg_match('/(?=.*[0-9¡!"#$%&\'()*+,-.\/:;<=>¿?@[\]^_`{|}~])(?=.*[A-Z]).{6,}/', $ctrl);
}

function validatePic($pic,$pic_type,$pic_size) {        // OK
    return (isset($pic) && ($pic_type[1]=="jpg" || $pic_type[1]=="jpeg") && $pic_size<2 * 1024 * 1024);
}

?>