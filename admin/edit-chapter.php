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
    $id=$_REQUEST["id"];
    $chapter_id=$_POST["Capitulo"];
    if(mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM chapters WHERE book_id='$id' AND id = '$chapter_id'")))
    {
        $res=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM chapters WHERE book_id='$id' AND id = '$chapter_id'"));
    
    } else {
        header("Location: select-edit-chapter.php#error");
    }
    $date=date("Y-m-d");
?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/general.css">
</head>
<body style = "background-color: white; color: black" >
<div align='center' class= "absolute-center" style = "border:1px solid gray; padding: 16px; border-radius: 6px;" ><h1> Editar Capítulo </h1>

<form action="edit-chapterDB.php?id=<?php echo $res["id"]."&book_id=".$id?>" method="POST" enctype="multipart/form-data" onsubmit="return validateDates('date1', 'date2')">
<br>
</p>
</p>
<input type="hidden" value= "<?php echo $res["number"] ?>" name="oldnro"> </input>
<p>Título: <input type="text" name="titulo" size='40' required value = '<?php echo $res["title"] ?>'></p>
<p>*PDF: <input type="file" name="pdf" size='35' ></p>
<p>*Fecha de Publicación: <input id="date1" type="date" min="<?php echo $date ?>" name="fecha_publi" size='50'  value = '<?php echo $registro["up_date"] ?>'></p>
<p>*Fecha de baja: <input id="date2" type="date" min="<?php echo $date ?>" name="fecha_baja" size='50'  value = '<?php echo $registro["down_date"] ?>'></p>
<p>Nro: <input type="number" name="nro"  value = '<?php echo $res["number"] ?>'></p>
* Solo modifique los campos de ser necesario
<p>
   <input type="submit" value="Guardar">
</p>
<br>
</form>
<input type="button" value="Volver" onclick="window.location='index.php'"/>

<div id="toast" class="toast" onmouseover="hideToast()"></div>
<div id="toast-text" class="full-width no-pointer-actions"></div>

<script src="../js/toast.js"></script>
<script src="../js/admin.js"></script>
<script src="../js/field-validation.js"></script>
</body>