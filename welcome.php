<?php
    include_once "session.php";
    $conn = conn();
    $sesion = new session();
    try{
        $sesion->auth();
        header("Location: index.php");
    } catch (Exception $e) { }
    
    include "list.php";

?>
<html>
<head>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/welcome.css">
    <title> Bookflix </title>
    <link rel="icon" href="res/ico.png">
    <meta charset="UTF-8">
</head>
<body>
    <div id="toast" class="toast" onmouseover="hideToast()">
        <div id="toast-text" class="full-width no-pointer-actions"></div>
    </div>
    <div id="for-footer" class="for-footer">
        <div class="welcome-block books" src="res/logo-large.png">
            <a class="button accent margin-16 box-shadow" style="float:right; " href='login.php'>Iniciar sesión</a>
            <div class="welcome-presentation absolute-center"  >
                <img src="res/logo-large.png"/>
                <div style="padding:8px"></div>
                <div class="welcome-text text-shadow">Disfrutá de miles de libros en cualquier momento.</div> 
                <div style="padding:24px"></div>
                <input class="button big accent box-shadow" type="button" onclick="window.location='signup.php'" value="Suscribite gratis"/>
                <div style="padding:12px"></div>
                <div class="welcome-text text-shadow">Te regalamos el primer mes.</div>
                
            </div>
        </div>
        <div class="welcome-block">
            <div class="best-books-title">
                Los mejores libros
            </div>
            <div id="lists" class="absolute-center" style="width:100%">
                <?php showList(1, null, null)?>
            </div>
        </div>

    </div>
    <div class="footer">
        <span>
            <a class="gray-link" href='help.php'>Ayuda</a>
            -
            <a class="gray-link" href='legal.php'>Legales</a>
			-
            <a class="gray-link" href='vm.php'>Viking Moon</a>
        </span>
    </div>
	<script src="js/toast.js"></script>
    <script src="js/general.js"></script>
</body>
</html>