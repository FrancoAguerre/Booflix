<?php

include "../db.php";
	$conn = conn();
	
	$id_genre = trim($_POST["id_genre"]);
	
	mysqli_query($conn,"DELETE FROM genres WHERE id = '$id_genre'");	
	$dato = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM genres WHERE id = '$id_genre'"));
	if($id_genre == $dato['id']){
			
		header("Location:form_delete_genre.php#deleteGenreFail");
	}
	else{
           
		header("Location:form_delete_genre.php#deleteGenre");
	}

?>