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
    $authorId=$bookRow['author_id'];
    $name = $bookRow['name'];
    $calification=$bookRow['calification'];
    $cover = "'data:jpg;base64,".base64_encode($bookRow['cover'])."'";
    $description = $bookRow['description'];

    $authorRow=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM authors WHERE id = '$authorId'"));
    $author=$authorRow['name'];
?>
<html>
<head>
    <link rel="stylesheet" href="css/general.css">
    <title> Bookflix </title>
    <link rel="icon" href="res/ico.png">
    <meta charset="UTF-8">
</head>
<body>
    <div id="for-footer" class="for-footer">
        <div class="top-bar ">
            <div class=" top-bar-area  ">
                <div style="padding:8px"> </div>
                <a href="welcome.php">
                    <img src="res/header.png"/>
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
        <div class="preview-demo">
            <img class="preview-background" src=<?php echo $cover ?>></img>
            <div class="preview-content" >
                <img class="preview-cover " src=<?php echo $cover ?>></img>
                <div class="preview-text">
                    <div class="">
                        <div class="preview-title">
                            <?php echo $name ?>
                        </div>
                        <div class="preview-author">
                            <?php echo $author ?>
                        </div>
                        <a class="stars" >
                            <?php
                                for($i=0;$i<$calification;$i++){
                            ?>
                                    <img class="star" src="res/star.png"/>
                            <?php
                                }
                                for($i=0;$i<5-$calification;$i++){
                            ?>
                                    <img class="star disabled" src="res/star.png"/>
                            <?php
                                }
                            ?>
                        </a>
                        <div class="preview-description">
                            <?php echo $description?>
                        </div>
                    </div>
                    <div class="preview-controls ">
                        <a class="button-accent-white smooth " style="text-shadow:none" href='intro.php?book=<?php echo $bookId ?>'>Leer introducción</a>
                    </div>
                </div>
            </div>
            <div class="preview-demo-gradient"> </div>
        </div>
    </div>
    <div class="footer">
        <span>
            <a class="gray-link" href='help.php'>Ayuda</a>
            -
            <a class="gray-link" href='legal.php'>Legales</a>
            -
            <a class="gray-link" href='../vikingmoon'>Viking Moon</a>
        </span>
    </div>
	<script src="js/general.js"></script>
</body>
</html>