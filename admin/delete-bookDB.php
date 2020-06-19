<?php

include "../db.php";
	$conn = conn();
	
	$book = trim($_POST["book"]);
    
	if ( 0 < mysqli_num_rows(mysqli_query($conn,"SELECT name FROM books WHERE isbn = '$book'"))){
		mysqli_query($conn,"DELETE FROM books WHERE isbn = '$book'");
		header("Location:delete-book.php#deletebook");
	}
	else
		header("Location:delete-book.php#deletebookFail");
?>