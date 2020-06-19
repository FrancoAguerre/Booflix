<?php

include "../db.php";
	$conn = conn();
	
	$id_author = trim($_POST["id_author1"]);
	$newAuthor = trim($_POST["author2"]);
    $result = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM authors WHERE id = '$id_author'"));
    
    switch(true){
		case $id_author == $result['id'] :
            $id = $result['id'];
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
