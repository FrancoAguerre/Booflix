<?php
    include "../session.php";
    $session = new session();
    $conn = conn(); 
    try{
        $session->auth();
        if (!$_SESSION['admin']) 
            die;
    } catch (Exception $e) {
    }
    $titulo = trim($_POST["titulo"]);
	$descripcion = trim($_POST["descripcion"]);
	$fecha = trim($_POST["fecha"]);
	$url = trim($_POST["url"]);
	$imagen = null;
    if(is_uploaded_file($_FILES['img']['tmp_name'])){
       $imagen = addslashes(file_get_contents($_FILES ['img']['tmp_name']));
    }
    
    if($res=mysqli_query($conn, "INSERT INTO news (title, description, img, uri, down_date) VALUES ('$titulo','$descripcion', '$imagen', '$url', '$fecha')")){
        header('Location: news.php#ok');
    } else 
        header('Location: news.php#error');
?>