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
    $isbn=$_POST['isbn'];
    $res=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM books WHERE isbn='$isbn'"));
    if($res){
        $id=$res['id'];
        $res_cap=mysqli_query($conn, "SELECT * FROM chapters WHERE book_id='$id' ORDER BY number ASC"); 
    } else {
        header("Location: select-edit-chapter.php#invalid_isbn");
    }

?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/general.css">
</head>
<body style = "background-color: white; color: black" >
<div align='center' class= "absolute-center" style = "border:1px solid gray; padding: 16px; border-radius: 6px;" ><h1> Eliminar Capítulo </h1>

<form action="del-chapter.php?id=<?php echo $id?>" method="POST" enctype="multipart/form-data">
<br>
Capítulo: <select name="Capitulo">
    <?php
        while($capRow=mysqli_fetch_assoc($res_cap)){
            $cap=$capRow["title"];
            ?>
            <option <?php if($capRow["id"]==$capRow['title']) echo 'selected' ?> value=<?php echo $capRow["id"]?>> <?php echo $cap?> </option>
            <?php
        }
    ?>
</select>
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