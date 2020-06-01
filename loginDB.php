<?php
    include "session.php";

	$email = trim(strtolower($_POST["email"])); 
    $pass = md5(trim($_POST["pass"]));		// I KNOW!!!
    
    $session = new session();
    try{
        $session->login($email,$pass);
            header("location: profiles.php");
    } catch (Exception $e){
       header("location: login.php#login-wrong");
    }
?>
