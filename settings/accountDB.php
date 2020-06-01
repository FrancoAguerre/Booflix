<?php
    include "../field-validation.php";
    include "../session.php";
    $sesion = new session();
    try{
        $sesion->auth();
    } catch (Exception $e) {
        die;
    }
    $conn = conn();

    $id = $_SESSION['id'];
    $newEmail = $_POST["email"];
    $newPlan = $_POST["plan"];

    $res = true;

    if(validateEmail($newEmail)){
        $userRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'"));
        $currentEmail = $userRow['email'];

        if ($currentEmail != $newEmail)
            $res &= mysqli_query($conn,"UPDATE users SET email='$newEmail' WHERE id=$id");
    }
    else
        $res = false;

    if ($newPlan == 1) {
        $profilesCount =  mysqli_num_rows(mysqli_query($conn, "SELECT * FROM profiles WHERE user_id = '$id'"));

        if ($profilesCount<=2) 
            $res &= mysqli_query($conn,"UPDATE users SET type='$newPlan' WHERE id=$id"); 
        else 
            $res = false;
    } else if ($newPlan == 2)
        $res &= mysqli_query($conn,"UPDATE users SET type='$newPlan' WHERE id=$id"); 
    else 
        $res = false;

    if ($res)
        header('Location: account.php#ok');
    else
        header('Location: account.php#error');
?>