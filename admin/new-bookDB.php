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
    $autor = trim($_POST["Autor"]);
    $descripcion = trim($_POST["descripcion"]);
    $isbn = trim($_POST["isbn"]);
    $kids = ($_POST["kids"]);
    $fecha_publi = $_POST["fecha_publi"];
    $fecha_baja = $_POST["fecha_baja"];
	$portada = null;
    if(is_uploaded_file($_FILES['img']['tmp_name'])){
       $portada = addslashes(file_get_contents($_FILES ['img']['tmp_name']));
    }
    $genero=$_POST["Generos"];
    $editorial=$_POST["Editorial"];
    $pdf; //version futura
    $intro; //version futura
    if($kids=='on'){
        $kids=false; //por funcionamiento de 
    } else{
        $kids=true;
    }
    if($res=mysqli_query($conn, "INSERT INTO books (name, author_id, description, genre_id, isbn, cover, up_date, down_date, publish_id, is_for_kid) VALUES ('$titulo', '$autor','$descripcion', '$genero', '$isbn', '$portada', '$fecha_publi', '$fecha_baja','$editorial','$kids')")){
        
        header('Location: new-book.php?last-id='.mysqli_insert_id($conn).'#ok');
    } else 
        header('Location: new-book.php#error');
?>