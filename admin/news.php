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
?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/general.css">
</head>
<body style = "background-color: white; color: black" >
<div align='center' class= "absolute-center" style = "border:1px solid gray; padding: 16px; border-radius: 6px;" ><h1> CARGAR NOTICIA </h1>

<form action="newsDB.php" method="POST" enctype="multipart/form-data">
<br>
<p>Título: <input type="text" name="titulo" size='40' required></p>
<p>Descripción: <input type="text" name="descripcion" size='34' required></p>
<p>Fecha de baja: <input type="date" min="<?php echo $date ?>" name="fecha" size='50' required></p>
<p>Url: <input type="text" name="url" size='40' placeholder="Opcional"></p>
<p>Imagen: <input type="file" name="img" size='35' placeholder="Opcional"></p>
<p>
   <input type="submit" value="Agregar">
   <input type="reset" value="Borrar">
</p>
<br>
</form>
<input type="button" value="Volver" onclick="window.location='index.php'"/></div>

<div id="toast" class="toast" onmouseover="hideToast()">
<div id="toast-text" class="full-width no-pointer-actions"></div>

<script src="../js/toast.js"></script>
<script src="../js/admin.js"></script>
</body>