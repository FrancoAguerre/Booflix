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
<div align='center' class= "absolute-center" style = "border:1px solid gray; padding: 16px; border-radius: 6px;" ><h1> AGREGAR ADMINISTRADOR </h1>

<form action="new-adminDB.php" method="POST" enctype="multipart/form-data">
<br>
<p>Mail: <input type="text" name="mail" size='40' required></p>
<p>Contraseña: <input type="password" name="pass" size='40' required placeholder="6 caracteres, una mayúscula, un número o signo"></p>
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