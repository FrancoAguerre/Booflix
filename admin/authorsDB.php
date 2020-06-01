<?php
	include "../db.php";
	$conn = conn();
	
	$author = trim($_POST["author"]);

	if( $userQuery = mysqli_query($conn,"INSERT INTO authors (name) VALUES ('$author')"))
		header("Location:form_load_author.php#addauthor");
	else
	    header("Location:form_load_author.php#addauthorfail");
	
?>