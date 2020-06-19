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
    $old_title=$_REQUEST["id"];
    $titulo = trim($_POST["titulo"]);
    $descripcion = trim($_POST["descripcion"]);
    $fecha_baja = $_POST["fecha"];
    $url= $_POST["url"];
	$imagen = null;
    if(is_uploaded_file($_FILES['img']['tmp_name'])){
        $pic = addslashes(file_get_contents($_FILES ['img']['tmp_name']));
        $imagen = ", img='$pic'";
    }   
    if($res=mysqli_query($conn, "UPDATE news SET title='$titulo',description='$descripcion',down_date='$fecha_baja', uri='$url'".$imagen." WHERE id='$old_title'")){
         header('Location: select-news.php#ok');
    } else{  
        header('Location: edit-news.php?title='.$old_title.'#error');
    }    
?>