<?php

function showList($id, $res, $title, $author = null){

    //I'm not sure if it's necessary, but for security sake if there is not user logged in, $res is bypassed and the function only returns the 6 best qualified books.

    include_once "session.php";
    $conn = conn();
    $sesion = new session();
    $logged=true;
    try{
        $sesion->auth();
        /*if(mysqli_num_rows($res)==0)
            return;*/
    } catch (Exception $e) {
        $logged=false;
        $res = mysqli_query($conn, "SELECT * FROM books ORDER BY calification DESC LIMIT 6");
    }
?>
<div class="v-list-container">
    <div class="v-list-title">
        <?php echo $title ?>
    </div>
    <div id="v-scroll-left-<?php echo $id ?>" class="v-list-scroll-container smooth hidden"  onclick="vScrollLeft('<?php echo $id ?>')">
        <div class="v-list-scroll smooth">
            <img class="v-list-scroll-ico " src="res/left.png"/>
        </div>
    </div>
    <div id="v-scroll-right-<?php echo $id ?>" class="v-list-scroll-container smooth hidden" style="right:0px; transform: rotate(180deg);" onclick="vScrollRight('<?php echo $id ?>')">
        <div class="v-list-scroll smooth ">
            <img class="v-list-scroll-ico " src="res/left.png"/>
        </div>
    </div>
    <div class="v-list-content" id="v-list-<?php echo $id ?>" onscroll="vListScrolled(<?php echo $id ?>)">
        <?php
            while($bookRow=mysqli_fetch_assoc($res)){
                if (!(($logged && $_SESSION['kid']) && $bookRow['is_for_kid'] == 0)){
                    $authorId=$bookRow['author_id'];
                    $authorName ="";
                    if ($author!=null) $authorName = $author;
                    else {
                        $authorRow=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM authors WHERE id = '$authorId'"));
                        $authorName = $authorRow['name'];
                    }
                    $calification=$bookRow['calification'];
                    $cover = "src='data:jpg;base64,".base64_encode($bookRow['cover'])."'";
        ?>
                    <a class="list-item" href="<?php
                                                    if ($logged) echo 'book.php?id='.$bookRow['id'];
                                                    else echo 'preview.php?book='.$bookRow['id'];
                                                ?>">
                        <img class=" list-item-pic" <?php echo $cover ?>/>
                        <div class="list-item-desc">
                            <div ><?php echo $bookRow['name'] ?></div>
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
            }
        ?>
    </div>
</div>
<?php
}
?>