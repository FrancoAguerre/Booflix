<?php
	include "../db.php";
	$conn = conn();
	$noti = trim($_POST["notification"]);
	$uri = trim($_POST["uri"]);
	$usersRorws = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM users WHERE type != 0" ));
    $date=date("Y-m-d");

    while($usersRorws){
    	$id = $usersRorws['id'];

		if( $userQuery = mysqli_query($conn,"INSERT INTO notification (id_user,cotent,uri,seen,date) VALUES ('$id','$noti','$uri',0,'$date')"))
			header("Location:form_notification.php#addNotification");
		else
	    	header("Location:form_notification.php#addNotificationFail");
    }
	
?>