<?php

include "../db.php";
	$conn = conn();
	
	$publisher = trim($_POST["publisher"]);
    
	if ( 0 < mysqli_num_rows(mysqli_query($conn,"SELECT name FROM publishers WHERE name = '$publisher'"))){
		mysqli_query($conn,"DELETE FROM publishers WHERE name = '$publisher'");
		header("Location:form_delete_publisher.php#deletePublisher");
	}
	else
		header("Location:form_delete_publisher.php#deletePublisherFail");
?>