<?php
	include "../session.php";
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

    if (!mysqli_num_rows(mysqli_query($conn,"SELECT * FROM reports WHERE profile_id = $profileId AND review_id = $criticId")))
        echo mysqli_query($conn,"INSERT INTO reports (profile_id, review_id) VALUES ($profileId, $criticId)");
    else
        echo 0;

?>