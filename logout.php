<?php
	session_start(); 
	session_unset(); 
	session_destroy(); 
	if (isset($_REQUEST['forever']) && $_REQUEST['forever'])
		header("Location: welcome.php#goodbye");
	else
		header("Location: index.php");
?>