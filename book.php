<?php
    include "list.php";
	include "session.php";
    $sesion = new session();
    $conn = conn();
    $bookId=$_REQUEST['id'];

    try{
        $sesion->auth();
        if (!isset($_SESSION['profile-id'])){
            header("Location: profiles.php");
        }
    } catch (Exception $e) {
        header("Location: index.php");
    }

    $res = mysqli_query($conn, "SELECT * FROM books WHERE id = '$bookId'");

    if (mysqli_num_rows($res)==0)
        header("Location: index.php");

    $bookRow=mysqli_fetch_assoc($res);
    $authorId=$bookRow['author_id'];
    $genreId=$bookRow['genre_id'];
    $name = $bookRow['name'];
    $calification=$bookRow['calification'];
    $cover = "'data:jpg;base64,".base64_encode($bookRow['cover'])."'";
    $description = $bookRow['description'];

    $id = $_SESSION['profile-id'];
    $isInFavs = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM favs WHERE book_id = '$bookId' AND profile_id = '$id'")) != 0;

    $authorRow=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM authors WHERE id = '$authorId'"));
    $author=$authorRow['name'];
    $genreRow=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM genres WHERE id = '$genreId'"));
    $genre=$genreRow['desc_spa'];

    $res1 = mysqli_query($conn, "SELECT * FROM books WHERE author_id = '$authorId' AND id != '$bookId' ORDER BY name ASC");
    $res2 = mysqli_query($conn, "SELECT * FROM books WHERE genre_id = '$genreId' AND id != '$bookId' ORDER BY name ASC ");
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
        <div class="preview-container ">
            <div class="preview">
                <img class="preview-background" src=<?php echo $cover ?>></img>
                <div class="preview-content">
                    <img class="preview-cover " src=<?php echo $cover ?>></img>
                    <div class="preview-text">
                        <div class="">
                            <div class="preview-title">
                                <?php echo $name ?>
                            </div>
                            <div class="preview-author">
                                <?php echo $author ?>
                            </div>
                            <a class="stars" href="critics.php?book=<?php echo $bookId ?>">
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
                            <a class="button-accent-white smooth " style="text-shadow:none" href='read.php?book=<?php echo $bookId ?>'>Leer ahora</a>
                            <a id="add-to-favs" class="button-white pointer smooth" style="width:152px" onclick="toggleFavs(<?php echo $bookId ?>)"><?php if ($isInFavs) echo "Quitar de Favoritos";
                                                                    else echo "Agregar a Favoritos"?>
                            </a>
                            <a class="button-white smooth" href="critics.php?book=<?php echo $bookId ?>">Reseñas</a>
                 </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="lists" >
            <?php showList(1, $res1, ("Más de " . $author), $author)?>
            <?php showList(2, $res2, ("Más de " . $genre))?>
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