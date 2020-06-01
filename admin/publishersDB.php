<?php
	include "../db.php";
	$conn = conn();
	
	$publisher= trim($_POST["publisher"]);

	if( $userQuery = mysqli_query($conn,"INSERT INTO publishers (name) VALUES ('$publisher')") )
    header("Location:form_load_publisher.php#addpublisher");
    else
    header("Location:form_load_publisher.php#addpublisherfail");
	
?>