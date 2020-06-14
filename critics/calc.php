<?php

function calc($bookId){
    include_once "../db.php";
    $conn = conn();

    $reviews = mysqli_query($conn,"SELECT * FROM reviews WHERE book_id = $bookId");
    $reviewsCount = 0;
    $reviewsValue = 0;
    while ($reviewRow = mysqli_fetch_assoc($reviews)){
        if ($reviewRow['calif']>0){
            $reviewsCount++;
            $reviewsValue = $reviewsValue + $reviewRow['calif'];
        }
    }
    $newCalif = round($reviewsValue / $reviewsCount);
    mysqli_query($conn,"UPDATE books SET calification = $newCalif WHERE id = '$bookId'");
}    
?>