<!DOCTYPE html>
<html lang="es">
<head>
  
  <meta charset="UTF-8">
  <title>PÁGINA ADMINISTRADOR</title>
    <link rel="stylesheet" href="../css/general.css">
</head>
<body style = "background-color: white; color: black" >
<center><h1>ADMINISTRADOR</h1></center>
<br>
<center>
<div style="width:784px">
<center>
	<div align = "center" style = "border:1px solid gray; padding: 16px; border-radius: 100px" ><h1>GESTIÓN</h1>
    	<input type="button" value="Agregar Administrador" onclick="window.location='new-admin.php'"/>
	    <!<input type="button" value="Enviar Notificacion" onclick="window.location='form_notification.php'"/>
	    <input type="button" value="Ver Estadísticas" onclick="window.location='view_statistics.php'"/>
    	<input type="button" value="Ver reseñas en moderacion" onclick="window.location='show-reports.php'"/>
    </div>
</center>
<br>
<center>
	<div align = "center" style = "border:1px solid gray; padding: 16px; border-radius: 100px" ><h1> CARGA </h1>
    	<input type="button" value="Libro" onclick="window.location='new-book.php'"/>
    	<input type="button" value="Noticia" onclick="window.location='news.php'"/>
    	<input type="button" value="Género" onclick="window.location='form_load_genre.php'"/>
    	<input type="button" value="Editorial" onclick="window.location='form_load_publisher.php'"/>
    	<input type="button" value="Autor" onclick="window.location='form_load_author.php'"/>
    	<input type="button" value="Capítulo" onclick="window.location='select-isbn-chapter.php'"/>
	</div>
</center>
<br>
<center>
	<div align = "center" style = "border:1px solid gray; padding: 16px; border-radius: 100px" >
		<h1>EDICIÓN</h1>
		<input type="button" value="Editar Libro" onclick="window.location='select-isbn.php'"/>
		<input type="button" value="Editar Noticia" onclick="window.location='select-news.php'"/>
		<input type="button" value="Editar Género" onclick="window.location='form_edit_genre.php'"/>
		<input type="button" value="Editar Editorial" onclick="window.location='form_edit_publisher.php'"/>
		<input type="button" value="Editar Autor" onclick="window.location='form_edit_author.php'"/>
		<input type="button" value="Editar Capítulo" onclick="window.location='select-edit-chapter.php'"/>
		
    </div>
</center>
<br>
<center>
	<div align = "center" style = "border:1px solid gray; padding: 16px; border-radius: 100px" >
		<h1>ELIMINACIÓN</h1>
		<input type="button" value="Eliminar Libro" onclick="window.location='delete-book.php'"/>
		<input type="button" value="Eliminar Noticia" onclick="window.location='delete-news.php'"/>
		<input type="button" value="Eliminar Genero" onclick="window.location='form_delete_genre.php'"/>
		<input type="button" value="Eliminar Editorial" onclick="window.location='form_delete_publisher.php'"/>
		<input type="button" value="Eliminar Autor" onclick="window.location='form_delete_author.php'"/>
		<input type="button" value="Eliminar Capítulo" onclick="window.location='select-del-isbn.php'"/>
		
    </div>
</center>
<br>

<center>
	<div align = "center"  style = "border:1px solid gray; padding: 16px; border-radius: 100px" >
		<h1> PAGO </h1>
		<input type="button" value="Realizar Pago" onclick="window.location='payment.php'"/>
	</div>
</center>
</div>
</center>
<br><br><br>
<center><input type="button" value="Salir" onclick="window.location='../logout.php'"/>
     
</body>
</html>





