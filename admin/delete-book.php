<head>
     <meta charset="UTF-8">
     <link rel="stylesheet" href="../css/general.css">
</head>
<body style = "background-color: white; color: black" >
<div align = "center" class= "absolute-center" style = "border:1px solid gray; padding: 16px; border-radius: 6px;" ><h1> ELIMINAR LIBRO </h1>

<form align = "center" action="delete-bookDB.php" method="POST">
 <br>
 <p>ISBN: <input type="text" name="book" maxlength="13" minlength="13" required placeholder="Sólo caracteres numéricos" size='40'></p>
 <p>
    <input type="submit" value="Eliminar">
 </p>
<br>
</form>
<input type="button" value="Volver" onclick="window.location='index.php'"/></div>

<div id="toast" class="toast" onmouseover="hideToast()">
<div id="toast-text" class="full-width no-pointer-actions"></div>

<script src="../js/toast.js"></script>
<script src="../js/admin.js"></script>
</body>