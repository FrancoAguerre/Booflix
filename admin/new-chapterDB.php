<?php
    include "../session.php";
    include "upload-chapter.php";
    $session = new session();
    $conn = conn(); 
    try{
        $session->auth();
        if (!$_SESSION['admin']) 
            die;
    } catch (Exception $e) {
    }

    $titulo = trim($_POST["titulo"]);
    $nro = trim($_POST["nro"]);
    $fecha_publi = $_POST["fecha_publi"];
    $fecha_baja = $_POST["fecha_baja"];
    $id=$_REQUEST["id"];
    $pdf= $_FILES ['pdf']['tmp_name'];
    if(!(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM chapters WHERE book_id='$id' AND number='$nro'")))){
        move_uploaded_file($pdf, "../books/book-".$id."-".$nro.".pdf");
        mysqli_query($conn,"INSERT INTO chapters (title, book_id, up_date, down_date, number) VALUES ('$titulo', '$id', '$fecha_publi', '$fecha_baja', '$nro')");
        header('Location: select-isbn-chapter.php#ok');
    } else {
        header('Location: select-isbn-chapter.php#invalid_chapter');
    }

?>