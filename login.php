<?php
	include "session.php";
    $sesion = new session();
    try{
        $sesion->auth();
        header("Location: index.php");
    } catch (Exception $e) { }
?>
<html>
<head>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/alternative.css">
    <title>Iniciar sesión - Bookflix </title>
    <link rel="icon" href="../res/ico.png">
    <meta charset="UTF-8">
</head>
<body class="books">
    <div id="for-footer" class="for-footer">
        <div class="top-bar-simple">
                <img class="margin-16"  src="res/header.png"  />
        </div>
        <div id="toast" class="toast" onmouseover="hideToast()">
            <div id="toast-text" class="full-width no-pointer-actions"></div>
        </div>
        <form class="form absolute-center box-shadow"method="POST" enctype="multipart/form-data" action="loginDB.php" onsubmit="return validateLogin()">
                <div class="title">Bienvenido</div>
                <div style="padding:16px;"></div>
                <input class="textbox width-100 " type="email" name="email" id="email" placeholder="Correo electrónico" oninput="verifyLogin()"/>
                <div id="email-redtext" class="redtext"></div>
                <input class="textbox width-100 " type="password" name="pass" id="pass" placeholder="Contraseña" oninput="verifyLogin()"/>
                <div style="padding:16px;"></div>
                <div class="form-foot ">
                    <div style="flex-grow: 1">
                        <div style="color:gray">¿Todavía no estás suscrito?</div>
                        <div style="padding:4px;"></div>
                            <a class="red-link" href='signup.php'>Suscribite gratis</a>
                    </div >
                    <input class="button accent-alt submit disabled" type="submit" id="login-next" value="Iniciar sesión"/>
                </div>
        </form>
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
    <script src="js/scripts-alt.js"></script>
    <script src="js/field-validation.js"></script>
	<script src="js/toast.js"></script>
    <script src="js/login.js"></script>
</body>
</html>