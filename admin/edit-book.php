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
    $res_genre=mysqli_query($conn, "SELECT * FROM genres");
    $res_publish=mysqli_query($conn, "SELECT * FROM publishers");
    $res_autor=mysqli_query($conn, "SELECT * FROM authors");
    $isbn= trim($_REQUEST["isbn"]);
    if(mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM books WHERE isbn='$isbn'"))){
        $registro=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM books WHERE isbn='$isbn'"));

    } else {
        header("Location: select-isbn.php#invalid_isbn");
    }
?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/general.css">
</head>
<body style = "background-color: white; color: black" >
<div align='center' class= "absolute-center" style = "border:1px solid gray; padding: 16px; border-radius: 6px;" ><h1> EDITAR LIBRO </h1>

<form action="edit-bookDB.php?isbn=<?php echo $isbn ?>" method="POST" enctype="multipart/form-data" onsubmit="return validateDates('date1', 'date2')">
<br>
<p>Título: <input type="text" name="titulo" size='40' required="required" value = '<?php echo $registro["name"] ?>'></p>
Autor: <select name="Autor">
    <?php
        while($autorRow=mysqli_fetch_assoc($res_autor)){
            $autor=$autorRow["name"];
            ?>
            <option <?php if($autorRow["id"]==$registro['author_id']) echo 'selected' ?> value=<?php echo $autorRow["id"]?>> <?php echo $autor?> </option>
            <?php
        }
    ?>
</select>
<p>Descripción: <input type="text" name="descripcion" size='34' required="required" value = '<?php echo $registro["description"] ?>'></p>
<p>PDF*: <input type="file" name="pdf" size='35' ></p>
<p>Introducción*: <input type="file" name="intro" size='35' ></p>
<p>ISBN: <input type="text" name="nisbn" size='30' maxlength="13" required="required"  minlength="13" value = '<?php echo $registro["isbn"] ?>'></p>
<p>+18: <input type="checkbox" <?php if($registro["is_for_kid"] == "0") echo "checked" ?> name="kids" size='35' ></p>
<p>Fecha de Publicación: <input id="date1" type="date" min="<?php echo $date ?>" name="fecha_publi" size='50' required="required"  value = '<?php echo $registro["up_date"] ?>'></p>
<p>Fecha de baja: <input id="date2" type="date" min="<?php echo $date ?>" name="fecha_baja" size='50' required="required" value = '<?php echo $registro["down_date"] ?>'></p>
<p>Portada*: <input type="file" name="img" size='35' ></p>
Genero: <select name="Generos">
    <?php
        while($genreRow=mysqli_fetch_assoc($res_genre)){
            $genre=$genreRow["desc_spa"];
            ?>
            <option <?php if($genreRow["id"]==$registro['genre_id']) echo 'selected' ?> value=<?php echo $genreRow["id"]?>> <?php echo $genre?> </option>
            <?php
        }
    ?>
</select>
Editorial: <select name="Editorial">
    <?php
        while($publishRow=mysqli_fetch_assoc($res_publish)){
            $publish=$publishRow["name"];
            ?>
            <option <?php if($publishRow["id"]==$registro['publish_id']) echo 'selected' ?> value=<?php echo $publishRow["id"]?>> <?php echo $publish?> </option>
            <?php
        }
    ?>
</select>
<p>
* Modifique estos campos sólo si es necesario.
</p>
<p>
   <input type="submit" value="Guardar">
</p>
<br>
</form>
<input type="button" value="Volver" onclick="window.location='index.php'"/>

<div id="toast" class="toast" onmouseover="hideToast()"></div>
<div id="toast-text" class="full-width no-pointer-actions"></div>

<script src="../js/toast.js"></script>
<script src="../js/admin.js"></script>
<script src="../js/field-validation.js"></script>
</body>