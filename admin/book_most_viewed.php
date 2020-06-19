<?php
$date = date("Y-m")
?>


<head>
     <meta charset="UTF-8">
     <link rel="stylesheet" href="../css/general.css">
</head>
<body style = "background-color: white; color: black" >
<div align='center' class= "absolute-center" style = "border:1px solid gray; padding: 16px; border-radius: 6px; "><h1>LIBROS MAS LEIDOS</h1>
<form align = "center" action="book_most_viewedDB.php" method="POST">
<p>Desde: <input id="date1" type="month" max = "<?php echo $date ?>" name="fecha_desde" size='50' required="required" value =""/></p>
<p>Hasta: <input id="date1" type="month" max ="<?php echo $date ?>" name="fecha_hasta" size='50' required="required" value =""/></p>
<input type="submit" value="Ver"/>
</form>
<br><br>
<input type="button" value="Volver" onclick="window.location='view_statistics.php'"/></div>

<div id="toast" class="toast" onmouseover="hideToast()"></div>
<div id="toast-text" class="full-width no-pointer-actions"></div>

</body>
<script src="../js/toast.js"></script>
<script src="../js/admin.js"></script>
<script src="../js/statistics.js"></script>
