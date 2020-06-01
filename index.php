<?php
    include "list.php";
	include "session.php";
    $sesion = new session();
    try{
        $sesion->auth();
        if (!isset($_SESSION['profile-id'])){
            header("Location: profiles.php");
        }
    } catch (Exception $e) {
        header("Location: welcome.php");
    }
    $conn = conn();
    
    
    $news = mysqli_query($conn, "SELECT * FROM news");
    

    $res1 = mysqli_query($conn, "SELECT * FROM books WHERE author_id != 6 ORDER BY name ASC");
    $res2 = mysqli_query($conn, "SELECT * FROM books WHERE author_id = 6 ORDER BY name ASC ");
    $res3 = mysqli_query($conn, "SELECT * FROM books WHERE genre_id = 5 ORDER BY name ASC ");
    $res4 = mysqli_query($conn, "SELECT * FROM books WHERE author_id = 5 ORDER BY name ASC ");
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
                <a class=" top-bar-link" href="favorites.php">
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
        <div class="news-container">
            <?php
                $colors = array (array('rgba(255,48,0,.8)',.1),array('rgba(255,128,0,.9)',.15),array('rgba(255,216,0,.85)',.15),
                                array('rgba(192,255,0,.75)',.15),array('rgba(0,255,128,.75)',.15),array('rgba(0,176,255,.75)',.1),
                                array('rgba(255,0,144,.75)',.15));

                $newsCounter = 1;
                while($newsRow=mysqli_fetch_assoc($news)){
                    $uri = null;
                    if($newsRow['uri'] != null)
                        $uri = "href='". $newsRow['uri'] ."'";
                    $ran = rand(-5, 5);
                    if ($newsRow['img'] != null){
                    $cover = "'data:jpg;base64,".base64_encode($newsRow['img'])."'";
            ?>
                    <a class="news <?php if($newsCounter>1) echo 'hidden' ?>" <?php if($uri!=null) echo $uri ?> style="color:white" id="news-<?php echo $newsCounter ?>">
                        <img class="news-background " src=<?php echo $cover ?>/>
                        <div class="news-content">
                            <img class="news-image box-shadow" style="transform: rotate(<?php echo $ran ?>deg)" src=<?php echo $cover ?>/>
                            <div class="news-text">
                                <div class="news-title">
                                <?php echo $newsRow['title'] ?>
                                </div>
                                <div class="news-desc">
                                <?php echo $newsRow['description'] ?>
                                </div>

                            </div>
                        </div>
                    </a>
            <?php     
                    } else {
                        $color = rand(0,count($colors)-1)
            ?>
                        <a class="news <?php if($newsCounter>1) echo 'hidden' ?>" <?php if($uri!=null) echo $uri ?> style="color:white" id="news-<?php echo $newsCounter ?>">
                            <div class="null-news-background " style="
                                transform: rotate(<?php echo $ran ?>deg) scale(1.6);
                                background-color: <?php echo $colors[$color][0] ?>">
                                <div class="null-news-back-color-light"></div>
                            </div>
                            <div class="null-news-background-pattern" style="opacity:<?php echo $colors[$color][1]?>"></div>
                            <div class="news-content">
                                <div class="null-news-text">
                                    <div class="news-title">
                                    <?php echo $newsRow['title'] ?>
                                    </div>
                                    <div class="news-desc">
                                    <?php echo $newsRow['description'] ?>
                                    </div>
                                </div>
                            </div>
                        </a>
            <?php
                    }   
                    $newsCounter++;
                }
            ?>
            <div class="news-selector-container" id ="news-container">
            <?php
                for($i = 1;$i<$newsCounter;$i++){
            ?>
                    <div class="news-selector smooth <?php if($i==1) echo 'news-selector-active' ?>" id="news-selector-<?php echo $i ?>" onClick="selectNews(<?php echo $i ?>)">
                        <div class="circle ">
                        </div>
                    </div>
            <?php
                }
            ?>
            </div>
        </div>
        <div id="lists" >
            <?php showList(1, $res1, "Libros")?>
            <?php showList(2, $res2, "Stephen King", "Stephen King")?>
            <?php showList(3, $res3, "Terror")?>
            <?php showList(4, $res4, "Edgar Allan Poe", "Edgar Allan Poe")?>
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