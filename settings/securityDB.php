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
    $oldPassRaw = trim($_POST["old-pass"]);
    $oldPass = md5($oldPassRaw);		// I KNOW!!!
    $newPassRaw = trim($_POST["new-pass"]);
    $newPass = md5($newPassRaw);		// I KNOW!!!

    if(validatePass($newPassRaw)){
        if (mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = '$id' AND pass='$oldPass'"))){
            mysqli_query($conn,"UPDATE users SET pass='$newPass' WHERE id='$id' AND pass='$oldPass'");
            header('Location: security.php#ok');
        } else 
            header('Location: security.php#wrong-pass');
    }else 
        header('Location: security.php#error');
?>