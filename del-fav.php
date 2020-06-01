<?php
    include_once "session.php";
    $conn = conn();
    $sesion = new session();
    try{
        $sesion->auth();
    } catch (Exception $e) {
        $die;
    }

    $profile_id = $_SESSION['profile-id'];
    $book_id = $_REQUEST['id'];

    mysqli_query($conn,"DELETE FROM favs WHERE profile_id = $profile_id AND book_id = $book_id ");
?>