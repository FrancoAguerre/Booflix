<?php
    include "../field-validation.php";
    include "../session.php";
    $sesion = new session();
    try{
        $sesion->auth();
    } catch (Exception $e) {
        die;
    }
    $conn = conn();

    $id = $_SESSION['id'];
	$cardNumber = trim($_POST["card-number"]);
	$cardName = trim($_POST["card-name"]);
	$expDate = trim($_POST["exp-date"]);
	$securityCode = trim($_POST["security-code"]);
	$dni = trim($_POST["dni"]);
    
    if (mysqli_query($conn,"UPDATE payment SET name='$cardName', card_number='$cardNumber', security_code='$securityCode', expiration_date='$expDate', dni='$dni' WHERE user_id = $id"))
        header('Location: payment.php#ok');
    else
        header('Location: card.php#error');

?>