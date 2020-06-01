<?php
	include "session.php";
    $sesion = new session();
    try{
        $sesion->auth();
        if ($_SESSION['admin']) 
            header("location: admin.php");
    } catch (Exception $e) {
		header("Location: login.php#must-login");
    }
	$conn = conn();

    $id = $_SESSION['id'];
    
	$res = mysqli_query($conn, "SELECT * FROM profiles WHERE user_id = '$id' ORDER BY name ASC");
?>
<html>
<head>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/profiles.css">
    <title> Bookflix </title>
    <link rel="icon" href="res/ico.png">
    <meta charset="UTF-8">
</head>
<body style="overflow:hidden">
    <div id="for-footer" class="for-footer">
        <div class="top-bar-simple">
            <img class="margin-16"  src="res/header.png"  />
        </div>
        <div class="profiles-title super-smooth" id="title">
            Elegí un perfil
        </div>
        <div class="profiles-container absolute-center super-smooth" id="profiles-container">
            <?php
                while($profileRow=mysqli_fetch_assoc($res)){
                    $avatar;
                    if ($profileRow["img"] == null) 
                        $avatar = "src='res/profile.png' ";
                    else
                        $avatar = "src='data:jpg;base64,".base64_encode($profileRow['img'])."'";
            ?>      
                    <a class="profile" href="set-profile.php?profile=<?php echo $profileRow['id'];?>">
                        <img class=" profile-pic" <?php echo $avatar ?>></img>
                        <div >
                            <?php echo $profileRow['name'];?>
                        </div>
                    </a>
            <?php
                }
            ?>
            <a class="profile" href="set-profile.php?profile=0">
                <img class=" profile-pic" src="res/kids.png"></img>
                <div>
                    Kids
                </div>
            </a>
        </div>
        <a id="edit-profiles" class="go-to-profile-editing-container super-smooth" href="settings/profiles.php">
            <div class="go-to-profile-editing ">
                <img src="res/settings.png"></img>
                    <div style="padding:4px"></div>
                <div style="padding:8px">
                    Editar perfiles
                </div>
            </div>
        </a>
    </div>
    <div class="footer">
        <span>
            <a class="gray-link" href='help.php'>Ayuda</a>
            -
            <a class="gray-link" href='legal.php'>Legales</a>
            -
            <a class="gray-link" href='../vm.php'>Viking Moon</a>
        </span>
    </div>
	<script src="js/profiles.js"></script>
</body>
</html>