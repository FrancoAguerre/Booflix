<?php
    include "../session.php";
    include "calc.php";
    $sesion = new session();
    $conn = conn();

    try{
        $sesion->auth();
        if (!isset($_SESSION['profile-id'])){
            die(0);
        }
    } catch (Exception $e) {
        die(0);
    }

    $profileId = $_SESSION['profile-id'];
    $criticId = $_REQUEST["id"];
    
    $bookId = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM reviews WHERE profile_id = $profileId AND id = $criticId"))['book_id'];

    if (mysqli_query($conn,"DELETE FROM reviews WHERE profile_id = $profileId AND id = $criticId")){
        calc($bookId);
        header("Location: ../book.php?id=".$bookId."#critics");
    } else
        header("Location: ../book.php?id=".$bookId."#error");

?>