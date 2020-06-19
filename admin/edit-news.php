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
    $date=date("Y-m-d");
    $id= trim($_POST["Noticia"]);
    if(mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM news WHERE id='$id'"))){
        $registro=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM news WHERE id='$id'"));

    } else {
        header("Location: select-news.php#invalid_news");
    }
?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/general.css">
</head>
<body style = "background-color: white; color: black" >
<div align='center' class= "absolute-center" style = "border:1px solid gray; padding: 16px; border-radius: 6px;" ><h1> EDITAR NOTICIA </h1>

<form action="edit-newsDB.php?id=<?php echo $id ?>" method="POST" enctype="multipart/form-data">
<br>
<p>Título: <input type="text" name="titulo" size='40' required value = '<?php echo $registro["title"] ?>' ></p>
<p>Descripción: <input type="text" name="descripcion" size='34' required value = '<?php echo $registro["description"] ?>'></p>
<p>Fecha de baja: <input type="date" min="<?php echo $date ?>" name="fecha" size='50' required value = '<?php echo $registro["down_date"] ?>'></p>
<p>Url: <input type="text" name="url" size='40' placeholder="Opcional" value="<?php echo $registro["uri"]?>"></p>
<p>* Imagen: <input type="file" name="img" size='35' placeholder="Opcional"></p>
* Modifique este campo sólo si es necesario.
<p>
   <input type="submit" value="Guardar"/>
</p>
<br>
</form>
<input type="button" value="Volver" onclick="window.location='index.php'"/></div>

<div id="toast" class="toast" onmouseover="hideToast()">
<div id="toast-text" class="full-width no-pointer-actions"></div>

<script src="../js/toast.js"></script>
<script src="../js/admin.js"></script>
</body>