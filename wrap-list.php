<?php

function showList($id, $res, $title){

    include_once "session.php";
    $conn = conn();
    $sesion = new session();
    try{
        $sesion->auth();
        if(mysqli_num_rows($res)==0)
            return;
    } catch (Exception $e) {
        $die;
    }
?>
<div class="v-list-container ">
    <div class="v-list-title">
        <?php echo $title ?>
    </div>
    <div class="w-list-content">
        <?php
        
            while($listRow=mysqli_fetch_assoc($res)){
                $bookId = $listRow['book_id'];
                $bookRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM books WHERE id = '$bookId'"));
                $authorId=$bookRow['author_id'];
                $authorRow=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM authors WHERE id = '$authorId'"));
                $authorName = $authorRow['name'];
                $calification=$bookRow['calification'];
                $cover = "src='data:jpg;base64,".base64_encode($bookRow['cover'])."'";
        ?>
                <a class="list-item" href="<?php echo 'book.php?id='.$bookRow['id'] ?>">
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
        ?>
    </div>
</div>
<?php

}

?>