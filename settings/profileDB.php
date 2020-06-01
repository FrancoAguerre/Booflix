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
    
	$userId = $_SESSION['id'];
	$profileId = $_POST["profile-id"];
    $name = $_POST["name"];
    $pic = null;
    $pic_type;
    $pic_size;
    if(is_uploaded_file($_FILES['profile-pic']['tmp_name'])){
       $pic = addslashes(file_get_contents($_FILES ['profile-pic']['tmp_name']));
       $pic_type=explode ('/',$_FILES ['profile-pic']['type']);
       $pic_size=$_FILES ['profile-pic']['size'];
    }   
    $res;

    if(validateName($name)){
        if ($profileId!=0)
            if ($pic!=null)
                if(validatePic($pic,$pic_type,$pic_size))
                    $res = mysqli_query($conn,"UPDATE profiles SET name='$name', img='$pic' WHERE id=$profileId");
                else
                    $res = false;
            else
                $res = mysqli_query($conn,"UPDATE profiles SET name='$name' WHERE id=$profileId");
        else{
            $userRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = '$userId'"));
            $plan = $userRow['type'];

            $planRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM plans WHERE id = '$plan'"));
            $maxProfiles = $planRow['max_profiles']; 

            $profilesCount =  mysqli_num_rows(mysqli_query($conn, "SELECT * FROM profiles WHERE user_id = '$userId'"));

            if ($profilesCount<$maxProfiles){
                if ($pic!=null)
                    if(validatePic($pic,$pic_type,$pic_size))
                        $res = mysqli_query($conn,"INSERT INTO profiles (name,img,user_id) VALUES ('$name','$pic','$userId')");
                    else
                        $res = false;
                else
                    $res = mysqli_query($conn,"INSERT INTO profiles (name,user_id) VALUES ('$name','$userId')");
            } else
                $res = false;
        }
    } else
        $res=false;

     if ($res)
         header('Location: profiles.php#ok');
     else
         header('Location: profiles.php#error');
?>