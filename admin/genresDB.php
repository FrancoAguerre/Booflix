<?php
	include "../db.php";
	$conn = conn();
	
	$genre = trim($_POST["genre"]);

	if ( $userQuery = mysqli_query($conn,"INSERT INTO genres (desc_spa) VALUES ('$genre')") )
		header("Location:form_load_genre.php#addgen");
	else
		header("Location:form_load_genre.php#addgenfail");
	
?>