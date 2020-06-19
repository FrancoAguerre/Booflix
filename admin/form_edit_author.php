<?php
    include "../db.php";
    include "../session.php";
    $session = new session();
    $conn = conn(); 
    try{
        $session->auth();
        if (!$_SESSION['admin']) 
            die;
    } catch (Exception $e) {
    }
    
   $res_autor=mysqli_query($conn, "SELECT * FROM authors");
?>

<head>
     <meta charset="UTF-8">
     <link rel="stylesheet" href="../css/general.css">
</head>
<body style = "background-color: white; color: black" >
<div align = "center" class= "absolute-center" style = "border:1px solid gray; padding: 16px; border-radius: 6px;" ><h1> EDITAR AUTOR </h1>

<form align = "center" action="edit_authorDB.php" method="POST">
 <br>
 <p>Autor: <select name="id_author1">
    <?php
        while($autorRow=mysqli_fetch_assoc($res_autor)){
            $autor=$autorRow["name"];
            ?>
            <option value= <?php echo $autorRow['id']?>> <?php echo $autor?> </option>
            <?php
        }
    ?>
 </select></p>
 <p>Nuevo nombre:<input type="text" name="author2" required="required" size='40'></p>
 <p>
    <input type="submit" value="Modificar">
 </p>
<br>
</form>
<input type="button" value="Volver" onclick="window.location='index.php'"/></div>

<div id="toast" class="toast" onmouseover="hideToast()">
<div id="toast-text" class="full-width no-pointer-actions"></div>

<script src="../js/toast.js"></script>
<script src="../js/removal.js"></script>
</body>