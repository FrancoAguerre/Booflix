<?php

include "../db.php";
	$conn = conn();
	
	$id_genre = trim($_POST["id_genre1"]);
	$newGenre = trim($_POST["genre2"]);
    $result = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM genres WHERE id = '$id_genre'"));

    switch(true){
		case $id_genre == $result['id'] :
            $id = $result['id'];
			if (mysqli_query($conn,"UPDATE genres SET desc_spa = '$newGenre' WHERE id = '$id'")){
		    	header("Location:form_edit_genre.php#editGenre");} 
			else
		    	header("Location:form_edit_genre.php#editGenreFail1");
		break;
		default : 
			header("Location:form_edit_genre.php#editGenreFail2");
		break;
	}
	
?>