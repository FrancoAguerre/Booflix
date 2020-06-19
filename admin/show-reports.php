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
    $res_review=mysqli_query($conn, "SELECT * FROM reviews");
?>
<head>
  
  <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/general.css">
</head>
<body style = "background-color: white; color: black" >
<div align='center' class= "absolute-center" style = "border:1px solid gray; padding: 50px; border-radius: 6px;" ><h1> MODERACIÓN </h1>
<div>
<br>
Reseñas en Moderación:
<br>
<br>
<br>
    <?php
        $counter=0;
        while($reviewRow=mysqli_fetch_assoc($res_review)){
            $review_id=$reviewRow["id"];
            if(4<mysqli_num_rows(mysqli_query($conn, "SELECT * FROM reports WHERE review_id='$review_id'"))){
                $counter++;
                ?>
                <div style="display:flex"> 
                <?php 
                echo '"'.$reviewRow['comment'].'"';
                ?>
                <div style="padding-left:32px"></div>
                <input value= 'Aprobar' type="button" onclick="location.href='approve-review.php?id=<?php echo $review_id ?>'"></input>
                <div style="padding-left:16"></div>
                <input value= 'Eliminar' type="button" onclick="location.href='delete-review.php?id=<?php echo $review_id ?>'"></input>
                </div>
                <br>
                <?php
            }
        }
        if(!$counter){
            ?> <p> * No hay reseñas en moderación </p>  <?php
        }
    ?>
<br>
</div>
<input type="button" value="Volver" onclick="window.location='index.php'"/></div>

<div id="toast" class="toast" onmouseover="hideToast()">
<div id="toast-text" class="full-width no-pointer-actions"></div>

<script src="../js/toast.js"></script>
<script src="../js/admin.js"></script>
</body>