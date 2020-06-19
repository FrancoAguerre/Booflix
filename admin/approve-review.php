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
    $id = $_REQUEST["id"];
	mysqli_query($conn,"DELETE FROM reports WHERE review_id = '$id'");
	header("Location:show-reports.php#ok");
?>