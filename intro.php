<?php
    include "list.php";
	include "session.php";
    $sesion = new session();
    $conn = conn();
    $bookId=$_REQUEST['book'];

    try{
        $sesion->auth();
        header("Location: prevbookiew.php?id=".$bookId);
    } catch (Exception $e) { }

    $validationRes = mysqli_query($conn, "SELECT * FROM books ORDER BY calification DESC LIMIT 6");
    $isIdValid=false;
    while(!$isIdValid && $bookRow=mysqli_fetch_assoc($validationRes)){
        $isIdValid = $bookRow['id'] == $bookId;
    }

    if (!$isIdValid)
        header("Location: welcome.php");

    $res = mysqli_query($conn, "SELECT * FROM books WHERE id = '$bookId'");

    if (mysqli_num_rows($res)==0)
        header("Location: welcome.php");

    $bookRow=mysqli_fetch_assoc($res);
?>
<html>
<head>
    <link rel="stylesheet" href="css/general.css">
    <title> Bookflix </title>
    <link rel="icon" href="res/ico.png">
    <meta charset="UTF-8">
</head>
<body>
    <div class="top-bar " style="background-color: black; width: calc(100% - 17px)">
        <div class=" top-bar-area  ">
            <div style="padding:8px"> </div>
            <a href="welcome.php">
                <img src="res/header.png"/>
            </a>
        </div>
        <div class="top-bar-area" style="justify-content: center">
            <a class="top-bar-link" href="preview.php?book=<?php echo $bookId ?>">
                    <?php echo $bookRow['name'] ?>
            </a>
        </div>
        <div class="user-options top-bar-area ">
            <div style="padding:16px"> </div>
            <a class=" top-bar-link" href="login.php">
                Iniciar sesión
            </a>
            <div style="padding:16px"> </div>
            <a class=" top-bar-link" href="signup.php">
                Registrate
            </a>
        </div>
    </div>
        
    <object data="books/book-<?php echo $bookId ?>-0.pdf" type="application/pdf" class="pdf-viewer">
        </object> 
	<script src="js/general.js"></script>
</body>
</html>