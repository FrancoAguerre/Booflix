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

	$name=trim($_REQUEST["name"]);

    
    if (validateName($name))
        echo (mysqli_num_rows(mysqli_query($conn, "SELECT id FROM profiles WHERE name = '$name' AND user_id = '$id'"))>0);
?>