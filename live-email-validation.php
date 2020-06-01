<?php
    include "field-validation.php";
    include "db.php";
	$conn = conn();

	$email=trim($_REQUEST["email"]);

    if (validateEmail($email))
        echo (mysqli_num_rows(mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'"))>0);
?>