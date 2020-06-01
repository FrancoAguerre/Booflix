<?php
    include "session.php";
    $sesion = new session();
    try{
        $sesion->auth();
    } catch (Exception $e) {
		header("Location: login.php#must-login");
    }
    $conn = conn();
    
    $key = $_REQUEST['key'];

    $type = 1;
    if (isset($_REQUEST['type']))$type = $_REQUEST['type'];

    if ($type>3 || $type <1)
        die;

    $res;

    switch($type){
        case 1: 
            $res = mysqli_query($conn, "SELECT * FROM books WHERE name LIKE '%$key%'");
            break;
        case 2:
            $authorRes = mysqli_query($conn, "SELECT * FROM authors WHERE name LIKE '%$key%'");
            $res = mysqli_query($conn, "SELECT * FROM books WHERE id = 99");
            break;
        case 3:
            $genreRes = mysqli_query($conn, "SELECT * FROM genres WHERE name LIKE '%$key%'");
            $res = mysqli_query($conn, "SELECT * FROM books WHERE id = 99");
            break;
        }
?>

<html>
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
                    <input name="key" id="search-box" class="search-textbox" placeholder="Buscar..." type="text" value="<?php echo $key ?>"></input>
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
        <div class="search-type-container">
            <div style="display:inline-block">
                <div class="search-type-selector">
                    <a class="search-type smooth <?php if ($type<2) echo "search-type-selected"?>" href="search.php?key=<?php echo $key ?>&type=1"> 
                        Libros
                    </a>
                    <a class="search-type smooth <?php if ($type==2) echo "search-type-selected"?>" href="search.php?key=<?php echo $key ?>&type=2"> 
                        Autores
                    </a>
                    <a class="search-type smooth <?php if ($type==3) echo "search-type-selected"?>" href="search.php?key=<?php echo $key ?>&type=3"> 
                        Géneros
                    </a>
                </div>
            </div>
        </div id="for-footer" class="for-footer" >
            <div class="search-results-container">
                <div id="search-results" class="search-results">
                    <div class="w-list-content" >
                    <?php
                        while($row=mysqli_fetch_assoc($res)){
                            $authorId=$row['author_id'];
                            $authorRow=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM authors WHERE id = '$authorId'"));
                            $authorName = $authorRow['name'];
                            $calification=$row['calification'];
                            $cover = "src='data:jpg;base64,".base64_encode($row['cover'])."'";
                    ?>
                        <a class="list-item" href="<?php echo 'book.php?id='.$row['id'] ?>">
                            <img class=" list-item-pic" <?php echo $cover ?>/>
                            <div class="list-item-desc">
                                <div ><?php echo $row['name'] ?></div>
                                <div style="padding:8px;"></div>
                                <div class="list-item-author"><?php echo $authorName ?></div>
                                <div style="padding:16px;"></div>
                                <div class="stars">
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
                                </div>
                            </div>
                        </a>
                    <?php  
                        }

                        if (mysqli_num_rows($res) < 1){
                    ?>
                            <div class="absolute-center empty-list-container">
                                <div class="empty-list-title">
                                    Sin resultados.
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                </div>
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
	<script src="js/general.js"></script>
</body>
</html>