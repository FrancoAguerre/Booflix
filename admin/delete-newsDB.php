<?php

include "../db.php";
	$conn = conn();
	
	$news = trim($_POST["Noticia"]);
    
	if ( 0 < mysqli_num_rows(mysqli_query($conn,"SELECT * FROM news WHERE id = '$news'"))){
		mysqli_query($conn,"DELETE FROM news WHERE id = '$news'");
		header("Location:delete-news.php#ok");
	}
    else
        header("Location:delete-news.php#deleteNewsfail");
?>