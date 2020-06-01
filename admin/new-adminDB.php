<?php
    include "../session.php";
    include "../field-validation.php";
    $session = new session();
    $conn = conn(); 
    try{
        $session->auth();
        if (!$_SESSION['admin']) 
            die;
    } catch (Exception $e) {
    }
	$mail = trim($_POST["mail"]);
	$contraRaw = trim($_POST["pass"]);
	$contra = md5($contraRaw);
        
    if(validateEmail($mail) && validatePass($contraRaw) && mysqli_query($conn, "INSERT INTO users (email, pass, type) VALUES ('$mail','$contra', '0')")){
        header('Location: new-admin.php#ok');
    } else 
        header('Location: new-admin.php#error');
?>