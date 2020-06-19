<?php

include "../db.php";
	$conn = conn();
	
	$id_publisher = trim($_POST["id_publisher"]);
	
	mysqli_query($conn,"DELETE FROM publishers WHERE id = '$id_publisher'");	
	$dato = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM publishers WHERE id = '$id_publisher'"));
	if($id_publisher == $dato['id']){
			
		header("Location:form_delete_publisher.php#deletePublisherFail");
	}
	else{
           
		header("Location:form_delete_publisher.php#deletePublisher");
	}

?>