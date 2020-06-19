<head>
     <meta charset="UTF-8">
     <link rel="stylesheet" href="../css/general.css">
</head>
<body style = "background-color: white; color: black" >
<div align='center' class= "absolute-center" style = "border:1px solid gray; padding: 16px; border-radius: 6px; "><h1>ESTADISTICAS</h1>
<input type="button" value="Usuarios registrados por mes" onclick="window.location='view_users_per_month.php'"/><br><br>
<input type="button" value="Libros mas leidos" onclick="window.location='book_most_viewed.php'"/>
<br><br><br>
<input type="button" value="Volver" onclick="window.location='index.php'"/></div>

<div id="toast" class="toast" onmouseover="hideToast()"></div>
<div id="toast-text" class="full-width no-pointer-actions"></div>

</body>
<script src="../js/toast.js"></script>
<script src="../js/admin.js"></script>
