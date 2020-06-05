<?php

include "../db.php";
	$conn = conn();
	
	$genre = trim($_POST["genre"]);
	
	if ( 0 < mysqli_num_rows(mysqli_query($conn,"SELECT desc_spa FROM genres WHERE desc_spa = '$genre'"))){
		mysqli_query($conn,"DELETE FROM genres WHERE desc_spa = '$genre'");
		header("Location:form_delete_genre.php#deleteGenre");
	}
	else
		header("Location:form_delete_genre.php#deleteGenreFail");
?>