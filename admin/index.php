<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="UTF-8">
  <title>PÁGINA ADMINISTRADOR</title>
    <link rel="stylesheet" href="../css/general.css">
</head>
<body style = "background-color: white; color: black" >
<center><h1>ADMINISTRADOR</h1></center>
<br>
<center>
	<div align = "center" style = "border:1px solid gray; padding: 16px; border-radius: 100px; width: 630px" ><h1>GESTIÓN</h1>
    	<input type="button" value="Agregar Administrador" onclick="window.location='new-admin.php'"/>
	    <input type="button" disabled="true" value="Enviar Notificacion" onclick="window.location='#'"/>
	    <input type="button" disabled="true" value="Ver estadísticas" onclick="window.location='#'"/>
    	<input type="button" disabled="true" value="Ver reseñas en moderacion" onclick="window.location='#'"/>
    </div>
</center>
<br>
<center>
	<div align = "center" style = "border:1px solid gray; padding: 16px; border-radius: 100px; width: 630px" ><h1> CARGA </h1>
    	<input type="button" value="Libro" onclick="window.location='new-book.php'"/>
    	<input type="button" value="Noticia" onclick="window.location='news.php'"/>
    	<input type="button" value="Género" onclick="window.location='form_load_genre.php'"/>
    	<input type="button" value="Editorial" onclick="window.location='form_load_publisher.php'"/>
    	<input type="button" value="Autor" onclick="window.location='form_load_author.php'"/>
	</div>
</center>
<br>
<center>
	<div align = "center" style = "border:1px solid gray; padding: 16px; border-radius: 100px; width: 630px" >
		<h1>EDICIÓN</h1>
		<input type="button" value="Editar Libro" onclick="window.location='select-isbn.php'"/>
		<input type="button" disabled="true" value="Editar Noticia" onclick="window.location='#'"/>
		<input type="button" disabled="true" value="Editar Genero" onclick="window.location='#'"/>
		<input type="button" disabled="true" value="Editar Editorial" onclick="window.location='#'"/>
		<input type="button" disabled="true" value="Editar Autor" onclick="window.location='#'"/>
		
    </div>
</center>
<br>
<center>
	<div align = "center" style = "border:1px solid gray; padding: 16px; border-radius: 100px; width: 630px" >
		<h1>ELIMINACIÓN</h1>
		<input type="button" disabled="true" value="Eliminar Libro" onclick="window.location='#'"/>
		<input type="button" disabled="true" value="Eliminar Noticia" onclick="window.location='#'"/>
		<input type="button" disabled="true" value="Eliminar Genero" onclick="window.location='#'"/>
		<input type="button" disabled="true" value="Eliminar Editorial" onclick="window.location='#'"/>
		<input type="button" disabled="true" value="Eliminar Autor" onclick="window.location='#'"/>
		
    </div>
</center>
<br>

<center>
	<div align = "center"  style = "border:1px solid gray; padding: 16px; border-radius: 100px; width: 630px" >
		<h1> PAGO </h1>
		<input type="button" value="Realizar Pago" onclick="window.location='payment.php'"/>
	</div>
</center>
<br><br><br>
<center><input type="button" value="Salir" onclick="window.location='../logout.php'"/>
     
</body>
</html>





