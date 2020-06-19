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
    $comment = $_POST["comment"];
    $calif = $_POST["calification"];
    $bookId = $_POST["book-id"];
    $today = date('Y-m-d h:i:s');

    if (!mysqli_num_rows(mysqli_query($conn,"SELECT * FROM reviews WHERE profile_id = $profileId AND book_id = $bookId")) && mysqli_query($conn,"INSERT INTO reviews (profile_id, calif, comment, book_id, date) VALUES ('$profileId', '$calif', '$comment', '$bookId', '$today')")){
        calc($bookId);
        header("Location: ../book.php?id=".$bookId."#critics");
    } else
        header("Location: ../book.php?id=".$bookId."#error");

?>