<html>
<head>
    <link rel="stylesheet" href="css/general.css">
    <title> Bookflix </title>
    <link rel="icon" href="res/ico.png">
    <meta charset="UTF-8">
</head>
<body>
    <div id="for-footer" class="for-footer">
    <?php
	include "session.php";
    $sesion = new session();
    try{
        $sesion->auth();
        if (!isset($_SESSION['profile-id'])){
            header("Location: profiles.php");
        }

    } catch (Exception $e) {}
?>
              
        <div class=" error-container">
            <img class="pointer" onclick="window.location='index.php'" src="res/logo-large.png"/>
            <div style="padding:32px"> </div>
            <div class="empty-list-title">
 <?php               
                $errorMessage = array ("UwU","Mal ahí.");
                echo $errorMessage[rand(0,count($errorMessage)-1)];
?>
            </div>
            <div style="padding:8px"> </div>
            <div class="empty-list-desc">
                Error 404: La página solicitada no existe. En un momento se te redireccionará a la página principal.
            </div>
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
	<script src="js/auto-redirect.js"></script>
</body>
</html>