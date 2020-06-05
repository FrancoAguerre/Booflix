<?php

include "../db.php";
	$conn = conn();
	
	$author = trim($_POST["author1"]);
	$newAuthor = trim($_POST["author2"]);
    $result = mysqli_query($conn,"SELECT id FROM authors WHERE name = '$author'");
    
    switch(true){
		case 0 < mysqli_num_rows($result) :
			$row =  mysqli_fetch_assoc($result);
            $id = $row['id'];
			if (mysqli_query($conn,"UPDATE authors SET name = '$newAuthor' WHERE id = '$id'")){
		    	header("Location:form_edit_author.php#editAuthor");}
		    else
		    	header("Location:form_edit_author.php#editAuthorFail1");
		break;
		default : 
			header("Location:form_edit_author.php#editAuthorFail2");
		break;
	}
	
?>