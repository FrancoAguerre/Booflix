<?php

include "../db.php";
	$conn = conn();
	
	$genre = trim($_POST["genre1"]);
	$newGenre = trim($_POST["genre2"]);
    $result = mysqli_query($conn,"SELECT id FROM genres WHERE desc_spa = '$genre'");
    
    switch(true){
		case 0 < mysqli_num_rows($result) :
			$row =  mysqli_fetch_assoc($result);
            $id = $row['id'];
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