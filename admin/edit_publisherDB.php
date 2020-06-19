<?php

include "../db.php";
	$conn = conn();
	
	$id_publisher = trim($_POST["id_publisher1"]);
	$newPublisher = trim($_POST["publisher2"]);
    $result = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM publishers WHERE id = '$id_publisher'"));
    
    switch(true){
		case $id_publisher == $result['id'] :
            $id = $result['id'];
			if (mysqli_query($conn,"UPDATE publishers SET name = '$newPublisher' WHERE id = '$id'")){
		    	header("Location:form_edit_publisher.php#editPublisher");}
		    else
		    	header("Location:form_edit_publisher.php#editPublisherFail1");
		break;
		default : 
			header("Location:form_edit_publisher.php#editPublisherFail2");
		break;
	}
	
?>