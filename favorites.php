<?php
    include "session.php";
    include "wrap-list.php";
    $sesion = new session();
    try{
        $sesion->auth();
    } catch (Exception $e) {
		header("Location: login.php#must-login");
    }
	$conn = conn();

    $id = $_SESSION['profile-id'];
    
    $res = mysqli_query($conn, "SELECT * FROM favs WHERE profile_id = '$id'");


?>
<head>
    <link rel="stylesheet" href="css/general.css">
    <title> Bookflix </title>
    <link rel="icon" href="res/ico.png">
    <meta charset="UTF-8">
</head>
<body>
    <div>
        <div class="top-bar ">
            <div class=" top-bar-area  ">
                <div style="padding:8px"> </div>
                <a href="index.php">
                    <img src="res/header.png"/>
                </a>
                <div style="padding:16px"> </div>
                <a class=" top-bar-link" href="authors.php">
                    Autores
                </a>
                <div style="padding:8px"> </div>
                <a class=" top-bar-link" href="genres.php">
                    Géneros
                </a>
                <div style="padding:8px"> </div>
                <a class=" top-bar-link-selected">
                    Favoritos
                </a>
                <div style="padding:8px"> </div>
                <a class=" top-bar-link" href="history.php">
                    Historial
                </a>
            </div>
            <div class="top-bar-area ">
                <form id="search-form" method="GET" class="search-box " action="search.php" onsubmit="return validateSearchBox()">
                    <input name="key" id="search-box" class="search-textbox" placeholder="Buscar..." type="text"></input>
                    <img class="top-bar-button margin-auto" src="res/search.png" onclick="if (validateSearchBox()) document.getElementById('search-form').submit()"/>
                </form>
            </div>
            <div class="user-options top-bar-area ">
                <div style="display:flex" class="profile-menu-box" onclick="document.getElementById('profile-menu').classList.remove('hidden')">
                    <div class="margin-auto"><?php echo $_SESSION['profile-name']; ?></div>
                    <div  style="padding:8px"> </div>
                    <img class="profile-menu-pic" src=<?php echo $_SESSION['profile-pic'] ?>/>
                </div>
                <div style="padding:16px"> </div>
                <img class="top-bar-button" src="res/bell.png"/>
            </div>
        </div>
        <div id="profile-menu" class="profile-menu-container hidden smooth" onmouseleave="document.getElementById('profile-menu').classList.add('hidden')">
            <div class="profile-menu">
                <a class="profile-menu-item" href="profiles.php">
                    Cambiar de perfíl
                </a>
                <a class="profile-menu-item" href="settings/account.php">
                    Ajustes
                </a>
                <a class="profile-menu-item" href="logout.php">
                    Cerrar sesión
                </a>
            </div>  
        </div>
        <div id="for-footer" class="for-footer">
            <div id="lists">
                <div style="padding:24px"></div>
                <?php 
                    if (mysqli_num_rows($res)>0)
                        showList(1, $res, "Favoritos");
                    else{
                ?>
                    <div class="absolute-center empty-list-container">
                        <div class="empty-list-title">
                            Nada por acá.
                        </div>
                        <div style="padding:8px"> </div>
                        <div class="empty-list-desc">
                            Aquí aparecerán los libros que agregues a tu lista de favoritos.
                        </div>
                    </div>
                <?php 
                }
                ?>
            </div>
        </div>
    </div>
    <div class="footer" id="footer">
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