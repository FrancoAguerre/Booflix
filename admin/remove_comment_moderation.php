<?php

include "../db.php";
	$session = new session();
    $conn = conn(); 
    try{
        $session->auth();
        if (!$_SESSION['admin']) 
            die;
    } catch (Exception $e) {
    }
    
	$id_com = trim($_POST["id"]);
	
	if (0 < mysqli_num_rows(mysqli_query($conn,"SELECT reviews FROM  WHERE id = 'id_com'"))){
		mysqli_query($conn,"DELETE FROM reviews WHERE name = '$id_com'");
		header("Location:-----#------");
	}
	else
		header("Location:-----#--------");