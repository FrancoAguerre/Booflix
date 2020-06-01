<?php
    include "session.php";
    $sesion = new session();
    try{
        $sesion->auth();
    } catch (Exception $e) {
		header("Location: login.php#must-login");
    }
	$conn = conn();

    $id = $_SESSION['id'];

    if(isset($_REQUEST["profile"])){
        $profile = $_REQUEST["profile"];
        if($profileRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM profiles WHERE id = '$profile'"))){
            $_SESSION['profile-id'] = $profile;
            $_SESSION['profile-name'] = $profileRow['name'];
            $avatar;
                if ($profileRow["img"] == null) 
                    $avatar = "'res/profile.png' ";
                else
                    $avatar = "'data:jpg;base64,".base64_encode($profileRow['img'])."'";
            $_SESSION['profile-pic'] = $avatar;
            header("Location: index.php");    
        } else if ($profile==0){
            //kids
        }else
            header("Location: profiles.php");
    } else
        header("Location: profiles.php");
?>