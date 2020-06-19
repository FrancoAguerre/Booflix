<?php
    include "session.php";
    include "list.php";
    $sesion = new session();
    try{
        $sesion->auth();
        if (!isset($_SESSION['profile-id'])){
            header("Location: profiles.php");
        }
    } catch (Exception $e) {
		header("Location: login.php#must-login");
    }
    $conn = conn();

    $profileId = $_SESSION['profile-id'];
    $today = date('Y-m-d h:i:s');
    
    $bookId = $_REQUEST['book'];
    $chapterNum = 1;
    if (isset($_REQUEST['chapter']))
        $chapterNum = $_REQUEST['chapter'];
    $nextChapterNum = $chapterNum + 1;
    $prevChapterNum = $chapterNum - 1;

    if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM history WHERE book_id = '$bookId' AND profile_id = '$profileId'"))) {
            mysqli_query($conn,"UPDATE history SET last_chapter = '$chapterNum', date = '$today' WHERE book_id = '$bookId' AND profile_id = '$profileId'");
            mysqli_query($conn,"INSERT INTO views_stats (book_id, date) VALUES ('$bookId', '$today')");
    } else 
        mysqli_query($conn,"INSERT INTO history (book_id, profile_id, last_chapter, date) VALUES ('$bookId', '$profileId', '$chapterNum', '$today')");

    $book = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM books WHERE id = '$bookId'"));
    $chapter = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM chapters WHERE book_id = '$bookId' AND number = '$chapterNum'"));
    $nextChapter = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM chapters WHERE book_id = '$bookId' AND number = '$nextChapterNum'"));
    $prevChapter = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM chapters WHERE book_id = '$bookId' AND number = '$prevChapterNum'"));;
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
        <div class="top-bar " style="background-color: black; width: calc(100% - 17px)">
            <div class=" top-bar-area" >
                <div style="padding:8px"> </div>
                <a href="index.php">
                    <img src="res/header.png"/>
                </a>
                <?php if ($prevChapter['title']!="" || $nextChapter['title']!=""){ ?>
                <div style="padding:16px"> </div>
                <a class=" top-bar-link" href="book.php?id=<?php echo $bookId ?>">
                    <?php echo $book['name'] ?>
                </a>
                <?php } ?>
            </div>
            <div class="top-bar-area" style="justify-content: center">
                <?php if ($prevChapter['title']!="" || $nextChapter['title']!=""){ ?>
                    <?php if ($prevChapter['title']!=""){ ?>
                    <a class="top-bar-link" style="text-align:niddle" href="read.php?book=<?php echo $bookId."&chapter=".$prevChapterNum ?>">
                        <img  class="chapter-button" src="res/left.png"/>
                        <div style="padding:4px"> </div>
                        <div style="padding-top:4px">
                            <?php echo $prevChapter['title'] ?>
                        </div>
                    </a>
                    <div style="padding:32px"> </div>
                    <?php } ?>
                    <div class="top-bar-link-selected">
                        <?php echo $chapter['title'] ?>
                    </div>
                    <?php if ($nextChapter['title']!=""){ ?>
                    <div style="padding:32px"> </div>
                    <a class="top-bar-link" href="read.php?book=<?php echo $bookId."&chapter=".$nextChapterNum ?>">
                        <div style="padding-top:4px">
                            <?php echo $nextChapter['title'] ?>
                        </div>
                        <div style="padding:4px"> </div>
                        <img  class="chapter-button" src="res/left.png" style="transform:rotate(180deg)"/>
                    </a>
                    <?php } ?>
                <?php } else { ?>
                <a class=" top-bar-link" href="book.php?id=<?php echo $bookId ?>">
                    <?php echo $book['name'] ?>
                </a>
                <?php } ?>
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
        <object data="books/book-<?php echo $bookId ?>-<?php echo $chapterNum ?>.pdf" type="application/pdf" class="pdf-viewer">
        </object>   
        </div>
	<script src="js/general.js"></script>
</body>
</html>