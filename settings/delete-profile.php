<?php
    include "../session.php";
	$sesion = new session();
	try{
		$sesion->auth();
	} catch (Exception $e) {
		die;
	}
	$conn = conn();
    
	$userId = $_SESSION['id'];
	$profileId = $_REQUEST["id"];
	
	$profilesCount =  mysqli_num_rows(mysqli_query($conn, "SELECT * FROM profiles WHERE user_id = '$userId'"));
	
	if($profilesCount>1 && mysqli_query($conn, "DELETE FROM profiles WHERE id = '$profileId' AND user_id = '$userId'")){
		if($_SESSION['profile-id']==$profileId)
			$_SESSION['profile-id']=null;
        header('Location: profiles.php#ok');
	} else
        header('Location: profiles.php#error');

?>