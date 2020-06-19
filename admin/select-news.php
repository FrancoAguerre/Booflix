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
    $res_news=mysqli_query($conn, "SELECT * FROM news");
?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/general.css">
</head>
<body style = "background-color: white; color: black" >
<div align='center' class= "absolute-center" style = "border:1px solid gray; padding: 16px; border-radius: 6px;" ><h1> Editar Noticia </h1>

<form action="edit-news.php" method="POST" enctype="multipart/form-data">
<br>
Noticia: <select name="Noticia">
    <?php
        while($newsRow=mysqli_fetch_assoc($res_news)){
            $news=$newsRow["title"];
            ?>
            <option <?php if($newsRow["id"]==$newsRow['title']) echo 'selected' ?> value=<?php echo $newsRow["id"]?>> <?php echo $news?> </option>
            <?php
        }
    ?>
</select>
<p>
   <input type="submit" value="Siguiente">
</p>
<br>
</form>
<input type="button" value="Volver" onclick="window.location='index.php'"/></div>

<div id="toast" class="toast" onmouseover="hideToast()">
<div id="toast-text" class="full-width no-pointer-actions"></div>

<script src="../js/toast.js"></script>
<script src="../js/admin.js"></script>
</body>