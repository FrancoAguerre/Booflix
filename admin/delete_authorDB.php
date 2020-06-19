<?php

include "../db.php";
	$conn = conn();
	
	$id_author = trim($_POST["id_author"]);
	
	mysqli_query($conn,"DELETE FROM authors WHERE id = '$id_author'");	
	$dato = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM authors WHERE id = '$id_author'"));
	if($id_author == $dato['id']){
			
		header("Location:form_delete_author.php#deleteAuthorFail");
	}
	else{
           
		header("Location:form_delete_author.php#deleteAuthor");
	}

?>