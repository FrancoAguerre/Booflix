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
    $isbn= trim($_REQUEST["isbn"]);
    if(mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM books WHERE isbn='$isbn'"))){
        $registro=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM books WHERE isbn='$isbn'"));

    } else {
        header("Location: select-isbn-chapter.php#invalid_isbn");
    }
    $date=date("Y-m-d");
?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/general.css">
</head>
<body style = "background-color: white; color: black" >
<div align='center' class= "absolute-center" style = "border:1px solid gray; padding: 16px; border-radius: 6px;" ><h1> Agregar Capítulo </h1>

<form action="new-chapterDB.php?id=<?php echo $registro["id"]?>" method="POST" enctype="multipart/form-data" onsubmit="return validateDates('date1', 'date2')">
<br>
</p>
</p>
<p>Título: <input type="text" name="titulo" size='40' required></p>
<p>PDF: <input type="file" name="pdf" size='35' required></p>
<p>Fecha de Publicación: <input id="date1" type="date" min="<?php echo $date ?>" name="fecha_publi" size='50' required></p>
<p>Fecha de baja: <input id="date2" type="date" min="<?php echo $date ?>" name="fecha_baja" size='50'></p>
<p>Nro: <input type="number" name="nro" required></p>
<p>
   <input type="submit" value="Agregar">
   <input type="reset" value="Borrar">
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