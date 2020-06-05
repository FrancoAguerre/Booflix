<?php

include "../db.php";
	$conn = conn();
	
	$author = trim($_POST["author"]);
	
	if ( 0 < mysqli_num_rows(mysqli_query($conn,"SELECT name FROM authors WHERE name = '$author'"))){
		mysqli_query($conn,"DELETE FROM authors WHERE name = '$author'");
		header("Location:form_delete_author.php#deleteAuthor");
	}
	else
		header("Location:form_delete_author.php#deleteAuthorFail");
?>