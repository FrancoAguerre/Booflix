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
?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/general.css">
</head>
<body style = "background-color: white; color: black" >
<div align='center' class= "absolute-center" style = "border:1px solid gray; padding: 16px; border-radius: 6px;" ><h1> Editar libro </h1>

<form action="edit-book.php" enctype="multipart/form-data">
<br>
<p>ISBN :  <input type="text" name="isbn" size='30' maxlength="13" minlength="13" placeholder = "Ingrese el ISBN del libro a editar" ></p>
<p>
   <input type="submit" value="Siguiente">
</p>
<br>
</form>
<input type="button" value="Volver" onclick="window.location='index.php'"/></div>

<div id="toast" class="toast" onmouseover="hideToast()">
<div id="toast-text" class="full-width no-pointer-actions"></div>

<script src="../js/toast.js"></script>
<script src="../js/admin.js"></script>
</body>