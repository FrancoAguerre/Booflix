<head>
     <meta charset="UTF-8">
     <link rel="stylesheet" href="../css/general.css">
</head>
<body style = "background-color: white; color: black" >
<div align='center' class= "absolute-center" style = "border:1px solid gray; padding: 16px; border-radius: 6px; "><h1> ENVIO DE NOTIFICACIÓN</h1>
<form action="notificationDB.php" method="POST">
 <br>
 <p>URI: <input type="text" name="uri" size='40'></p>
 <p>Notificación</p>
 <textarea id="" name="notification" rows="4" cols="50"></textarea>
 <p>
    <input type="submit" value="Enviar">
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











