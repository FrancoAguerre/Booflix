<head>
     <meta charset="UTF-8">
     <link rel="stylesheet" href="../css/general.css">
</head>
<body style = "background-color: white; color: black" >
<div align='center' class= "absolute-center" style = "border:1px solid gray; padding: 16px; border-radius: 6px; "><h1> CARGA GENERO </h1>

<form action="genresDB.php" method="POST">
 <br>
 <p>Genero:  <input type="text" name="genre" required="required" size='40'></p>
 <p>
    <input type="submit" value="Agregar">
    <input type="reset" value="Borrar">
 </p>
<br>
</form>
<input type="button" value="Volver" onclick="window.location='index.php'"/></div>

<div id="toast" class="toast" onmouseover="hideToast()"></div>
<div id="toast-text" class="full-width no-pointer-actions"></div>

</body>
<script src="../js/toast.js"></script>
<script src="../js/admin.js"></script>