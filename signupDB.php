<?php
    include "field-validation.php";
	include "db.php";
	$conn = conn();

	$plan = trim($_POST["plan"]);
	$name = trim($_POST["name"]);
	$email = trim($_POST["email"]);
	$passRaw = trim($_POST["pass"]);
	$pass = md5($passRaw);		// I KNOW!!!
	$cardNumber = trim($_POST["card-number"]);
	$cardName = trim($_POST["card-name"]);
	$expDate = trim($_POST["exp-date"]);
	$securityCode = trim($_POST["security-code"]);
	$dni = trim($_POST["dni"]);

    $today = new DateTime();
    $today->modify('+1 month');
    $date = $today->format('Y-m-d');

	//due the randomness of the mercadopago module, we're not checking the card data again, it's only validated on the client side
	//payment fields are not validated here for it's mercadopago's business to do it.

	$availablePlans = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM plans"));

	if (($plan >= 1 || $plan <= $availablePlans) && validateEmail($email) && validateName($name) && validatePass($passRaw)) {
		$userQuery = mysqli_query($conn,"INSERT INTO users (email,pass,type,date) VALUES ('$email','$pass','$plan','$date')");
		$userId = mysqli_insert_id($conn);	

		$profileQuery = mysqli_query($conn,"INSERT INTO profiles (name,user_id) VALUES ('$name','$userId')");
		$paymentQuery = mysqli_query($conn,"INSERT INTO payment (name,card_number,security_code,expiration_date,dni,user_id,last_payment_date,last_payment_state) VALUES ('$cardName','$cardNumber','$securityCode','$expDate','$dni','$userId','$date',1)");
		
		if ($userQuery && $profileQuery && $paymentQuery) header("Location: login.php#signedup");
		else
			header("Location: signup.php#error");
	}else
		header("Location: signup.php#error");

?>