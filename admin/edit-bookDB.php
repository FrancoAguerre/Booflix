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
    $new_isbn = trim($_POST["nisbn"]);
    $old_isbn= $_REQUEST["isbn"];
    $kids = ($_POST["kids"]);
    $fecha_publi = $_POST["fecha_publi"];
    $fecha_baja = $_POST["fecha_baja"];
	$portada = null;
    if(is_uploaded_file($_FILES['img']['tmp_name'])){
        $pic = addslashes(file_get_contents($_FILES ['img']['tmp_name']));
        $portada = ", cover='$pic'";
    }
    $genero=$_POST["Generos"];
    $editorial=$_POST["Editorial"];
    $pdf;//=addslashes(file_get_contents($_FILES ['pdf']['tmp_name'])); //probar
    $pdf_type;//=explode ('/',$_FILES ['pdf']['type']); //probar
    $intro; //version futura
    
    if($kids=='on'){
        $kids=false; //por funcionamiento de 
    } else{
        $kids=true;
    }

    if($res=mysqli_query($conn, "UPDATE `books` SET name='$titulo',author_id='$autor',description='$descripcion',is_for_kid='$kids',isbn='$new_isbn',
    up_date='$fecha_publi',down_date='$fecha_baja',genre_id='$genero',publish_id='$editorial'".$portada." WHERE isbn='$old_isbn'")){
         header('Location: select-isbn.php#ok');
    } else 
       header('Location: edit-book.php?isbn='.$old_isbn.'#error');
?>