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
    $fecha_publi = $_POST["fecha_publi"];
    $fecha_baja = $_POST["fecha_baja"];
    $pdf= $_FILES ['pdf']['tmp_name'];
    $nro=$_POST["nro"];
    $id=$_REQUEST["id"];
    $book_id=$_REQUEST['book_id'];
    $old_number=$_POST['oldnro'];
    if(!mysqli_num_rows(mysqli_query($conn, "SELECT * FROM chapters WHERE number='$nro' AND number!='$old_number' AND book_id='$book_id'" ))){
        mysqli_query($conn, "UPDATE `chapters` SET title='$titulo', up_date='$fecha_publi',down_date='$fecha_baja',number='$nro' WHERE id='$id'");
        move_uploaded_file($pdf, "../books/book-".$book_id."-".$nro.".pdf");
        header('Location: select-edit-chapter.php#ok');
    } else 
       header('Location: select-edit-chapter.php?id='.$id.'#invalid_chapter');
?>
