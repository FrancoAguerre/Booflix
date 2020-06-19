<?php
    include "../session.php";
    $sesion = new session();
    try{
        $sesion->auth();
    } catch (Exception $e) {
        die;
    }
    $conn = conn();

    $id = $_SESSION['id'];
    $pass = md5(trim($_POST["password"]));

    if (mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = '$id' AND pass='$pass'"))){
        mysqli_query($conn, "DELETE FROM users WHERE id = '$id'");
        header('Location: ../logout.php?forever=true');
    } else {
        header('Location: delete.php#wrong-pass');
    }
?>