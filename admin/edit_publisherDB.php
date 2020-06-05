<?php

include "../db.php";
	$conn = conn();
	
	$publisher = trim($_POST["publisher1"]);
	$newPublisher = trim($_POST["publisher2"]);
    $result = mysqli_query($conn,"SELECT id FROM publishers WHERE name = '$publisher'");
    
    switch(true){
		case 0 < mysqli_num_rows($result) :
			$row =  mysqli_fetch_assoc($result);
            $id = $row['id'];
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