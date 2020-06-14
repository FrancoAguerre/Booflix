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
    if ($_SESSION['kid'] && $bookRow['is_for_kid'] == 0)
        header("Location: index.php");

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

    $chapters=mysqli_query($conn, "SELECT * FROM chapters WHERE book_id = '$bookId' ORDER BY number");

    $critics=mysqli_query($conn, "SELECT * FROM reviews WHERE book_id = '$bookId' ORDER BY date DESC");

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
    <div id="toast" class="toast" onmouseover="hideToast()">
        <div id="toast-text" class="full-width no-pointer-actions"></div>
    </div>
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
        <?php
            if (mysqli_num_rows($chapters)>1) {
        ?>
                <div class="white-box-background hidden smooth" id="chapters" onclick="document.getElementById('chapters').classList.add('hidden')">
                    <div class="white-box absolute-center" onclick="event.stopPropagation()">
                            <?php
                                while($chapter = mysqli_fetch_assoc($chapters)){
                            ?>
                                    <a class="chapter" href="read.php?book=<?php echo $bookId?>&chapter=<?php echo $chapter['number']?>">
                                        Capítulo <?php echo $chapter['number']?>: <?php echo $chapter['title']?>
                                    </a>
                            <?php
                                }
                            ?>
                        </div>
                </div>
        <?php
            }
        ?>
        <div class="white-box-background hidden smooth" id="critics" onclick="document.getElementById('critics').classList.add('hidden')"> 
            <div class="white-box absolute-center" onclick="event.stopPropagation()">
                <div class="white-box-scroll" id="critics-container">
                <?php
                if (!mysqli_num_rows(mysqli_query($conn, "SELECT * FROM reviews WHERE profile_id = '$id' AND book_id = '$bookId'"))) {
                ?>
                    <form method="POST" action="critics/publish.php">
                        <div class="critic-user">Reseñar libro</div>
                        <div style="padding:8px"> </div>
                        <div class="stars">
                            <div style="padding:4px"> </div>
                            <img class="star new-review-star pointer smooth" id="new-review-star-1" onclick="fillReviewStars(1)" src="res/star.png"/>
                            <img class="star new-review-star pointer smooth" id="new-review-star-2" onclick="fillReviewStars(2)" src="res/star.png"/>
                            <img class="star new-review-star pointer smooth" id="new-review-star-3" onclick="fillReviewStars(3)" src="res/star.png"/>
                            <img class="star new-review-star pointer smooth" id="new-review-star-4" onclick="fillReviewStars(4)" src="res/star.png"/>
                            <img class="star new-review-star pointer smooth" id="new-review-star-5" onclick="fillReviewStars(5)" src="res/star.png"/>
                        </div>
                        <input type="hidden" name="calification" id="new-review-calif" value="0"/>
                        <input type="hidden" name="book-id" value="<?php echo $bookId ?>"/>
                        <div style="padding:8px"> </div>
                        <textarea id="new-review-comment" name="comment" id="new-review-comment" class="new-review-comment" placeholder="Comentario" maxlength="140" oninput="checkNewReviewComment()"></textarea>
                        <div style="padding:8px"> </div>
                        <div style="display:flex; flex-direction: row-reverse">
                            <div style="padding:2px"> </div>
                            <input type="submit" class="button accent-alt disabled" id="critic-submit" style="font-size: 16px" value="Reseñar"/>
                        </div>
                    </form>
                    <div class="critic-splitter" id ="critic-splitter-<?php echo $criticId ?>"></div>
                <?php
                }
                ?>
                <?php
                    if(mysqli_num_rows($critics)>0){
                        while($criticRow = mysqli_fetch_assoc($critics)){
                            $criticId = $criticRow['id'];
                            if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM reports WHERE review_id = '$criticId'"))<=5){
                                ?>
                                <div class="critic" id="critic-<?php echo $criticId ?>">
                                <?php
                                $profileId=$criticRow['profile_id'];
                                if ($profileId!=$id) {
                                    $userRow=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM profiles WHERE id = '$profileId'"));
                                    
                                    if(!mysqli_num_rows(mysqli_query($conn, "SELECT * FROM reports WHERE review_id = '$criticId' AND profile_id = '$id'"))) {
                                    ?>
                                    <img class="report pointer" id="report-<?php echo $criticId ?>" src="res/report.png" title="Reportar" onclick="report(<?php echo $criticId ?>)"/>                     
                                    <?php
                                }
                                    ?>                
                                    <div class="critic-user"><?php echo $userRow["name"] ?></div>
                                    <?php
                                } else {

                                    ?>
                                    <img class="report pointer" id="report-<?php echo $criticId ?>" src="res/delete.png" title="Eliminar" onclick="window.location='critics/delete.php?id=<?php echo $criticId ?>'"/>
                                    <div class="critic-user" style="color: rgb(255,187,0)"><?php echo $_SESSION['profile-name'] ?></div>
                                    <?php
                                }
                    ?>
                                <div  style="padding:8px"> 
                                    <div class="stars">
                                        <?php
                                        for($i=0;$i<$criticRow["calif"];$i++){
                                        ?>
                                            <img class="star" src="res/star.png"/>
                                        <?php
                                        }
                                        for($i=0;$i<5-$criticRow["calif"];$i++){
                                        ?>
                                            <img class="star disabled" src="res/star.png"/>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                        <?php
                                        if ($criticRow['comment']!="") {
                                        ?>
                                            <div class="critic-comment">
                                        <?php
                                                echo $criticRow['comment'];
                                        ?>
                                            </div>
                                        <?php
                                            };
                                        ?>
                                        
                                </div>
                            </div>
                            <div class="critic-splitter" id ="critic-splitter-<?php echo $criticId ?>"></div>
                            <?php
                            }
                            ?>
                        <?php
                        }
                    } else {
                        ?>
                            <div class="no-critics">
                                Este libro no tiene comentarios, Soyez le premier!
                            </div>
                        <?php
                    }
                ?>
                </div>
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
                            <div class="stars pointer" onclick="document.getElementById('critics').classList.remove('hidden')">
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
                            <div class="preview-description">
                                <?php echo $description?>
                            </div>
                        </div>
                        <div class="preview-controls ">
                            <a class="button-accent-white smooth pointer" style="text-shadow:none" 
                                <?php
                                    if (mysqli_num_rows($chapters)>1) 
                                        echo 'onclick="document.getElementById(\'chapters\').classList.remove(\'hidden\')"';  
                                    else
                                        echo 'href="read.php?book='.$bookId.'"';
                                ?>
                            >Leer ahora</a>
                            <a id="add-to-favs" class="button-white pointer smooth" style="width:152px" onclick="toggleFavs(<?php echo $bookId ?>)">
                                <?php if ($isInFavs) echo "Quitar de Favoritos";
                                        else echo "Agregar a Favoritos"?>
                            </a>
                            <div class="button-white smooth pointer" onclick="document.getElementById('critics').classList.remove('hidden')">Reseñas</div>
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
	<script src="js/toast.js"></script>
	<script src="js/general.js"></script>
</body>
</html>