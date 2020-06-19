<?php
    include "../session.php";
    $session = new session();
    $conn = conn(); 
    try{
        $session->auth();
        if (!$_SESSION['admin']) 
            die;
    } catch (Exception $e) {
    }
    $id=$_REQUEST["id"];
    $chapter_id=$_POST["Capitulo"];
    
    mysqli_query($conn,"DELETE FROM chapters WHERE id = '$chapter_id' AND book_id = '$id'");
    
    header("Location: select-del-isbn.php#ok");
?>