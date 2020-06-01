<?php
    include "db.php";
    include "mercadopago.php";

    $conn = conn();
    
    $number = $_POST["card-number"];
    $name = $_POST["card-name"];
    $exp = $_POST["expiration-date"];
    $sec = $_POST["security-code"];
    $dni = $_POST["dni"];
    
    $mercadopago = new MercadoPago();

    if ($mercadopago->checkCard($number,$name,$exp,$sec,$dni))
        echo 0;
    else
        echo 1;
?>