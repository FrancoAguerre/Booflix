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
    $cap= $_POST["cap"];
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
    $pdf= $_FILES ['pdf']['tmp_name'];
    $intro = $_FILES['intro']['tmp_name'];
    if($kids=='on'){
        $kids=false; //por funcionamiento de 
    } else{
        $kids=true;
    }
    if($res=mysqli_query($conn, "INSERT INTO books (name, author_id, description, genre_id, isbn, cover, up_date, down_date, publish_id, is_for_kid) VALUES ('$titulo', '$autor','$descripcion', '$genero', '$isbn', '$portada', '$fecha_publi', '$fecha_baja','$editorial','$kids')")){
        $last_id= $conn->insert_id;
        mysqli_query($conn,"INSERT INTO chapters (title, book_id, up_date, down_date, number) VALUES ('$cap', '$conn->insert_id', '$fecha_publi', '$fecha_baja', '1')");
        move_uploaded_file($pdf, "../books/book-".$conn->insert_id."-1.pdf");
        move_uploaded_file($intro, "../books/book-".$conn->insert_id."-0.pdf");
        header('Location: new-book.php?last-id='.$last_id.'#ok');
    } else 
        header('Location: new-book.php#error');
?>