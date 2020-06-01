<?php 
	include_once "db.php";

class session {  

    function login($email, $pass) { 
    	$conn = conn();

		if($row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' AND pass = '$pass'"))) {
			session_start();
			$_SESSION['id'] = $row['id'];
			$_SESSION['admin'] = $row['type'] == 0;
		} else throw new Exception();
    } 

    function auth() { 
		if (!isset($_SESSION)) session_start(); 
        if (!isset($_SESSION['id'])) throw new Exception();
        
        //it's ugly but it works, like me babe
	} 
} 
?> 