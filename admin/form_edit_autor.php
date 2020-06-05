<head>
     <meta charset="UTF-8">
     <link rel="stylesheet" href="../css/general.css">
</head>
<body style = "background-color: white; color: black" >
<div align = "center" class= "absolute-center" style = "border:1px solid gray; padding: 16px; border-radius: 6px;" ><h1> EDITAR AUTOR </h1>

<form align = "center" action="edit_authorDB.php" method="POST">
 <br>
 <p>Nombre actual:<input type="text" name="author1" required="required" size='40'></p>
 <p>Nuevo nombre:<input type="text" name="author2" required="required" size='40'></p>
 <p>
    <input type="submit" value="Modificar">
    <input type="reset" value="Borrar">
 </p>
<br>
</form>
<input type="button" value="Volver" onclick="window.location='index.php'"/></div>

<div id="toast" class="toast" onmouseover="hideToast()">
<div id="toast-text" class="full-width no-pointer-actions"></div>

<script src="../js/toast.js"></script>
<script src="../js/removal.js"></script>
</body>