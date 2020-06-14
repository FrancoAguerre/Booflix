<?php
	include "../session.php";
	$sesion = new session();
	try{
		$sesion->auth();
	} catch (Exception $e) {
		header("Location: ../login.php#must-login");
	}
	$conn = conn();

	$id = $_SESSION['id'];
	
	$res = mysqli_query($conn, "SELECT * FROM profiles WHERE user_id = '$id' ORDER BY name ASC");
	
	$userRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'"));
	$plan = $userRow['type'];

	$profileCount=0;

	$planRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM plans WHERE id = '$plan'"));
	$maxProfiles = $planRow['max_profiles'];
	
?>
<html>
<head>
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/alternative.css">
    <title>Ajustes - Bookflix </title>
    <link rel="icon" href="../res/ico.png">
</head>
<body class="books">
	<div class="for-footer">
		<div class="top-bar-simple">
			<a href="../index.php">
                <img class="margin-16" src="../res/header.png" />
            </a>
		</div>
		<div id="toast" class="toast" onmouseover="hideToast()">
			<div id="toast-text" class="full-width no-pointer-actions"></div>
		</div>
		<div style="display:flex" class="settings absolute-center box-shadow">
			<div >
			<div>
				<div style="padding:0.5px;"></div>
				<div class="tab" onclick="window.location='account.php';">Cuenta</div>
				<div class="splitter"></div>
				<div class="tab-active">Perfiles</div>
				<div class="splitter"></div>
				<div class="tab" onclick="window.location='payment.php';">Pago</div>
				<div class="splitter"></div>
				<div class="tab" onclick="window.location='security.php';">Seguridad</div>
			</div>
			</div>
			<div class="settings-container" style="padding:16px">
					<form class="settings-profiles" method="POST" id="profile-selector-form" action="profile.php">
						<?php
							$kidCounter = 0;
							while($profileRow=mysqli_fetch_assoc($res)){
								$avatar;
								if ($profileRow["img"] == null) 
									$avatar = "src='../res/profile.png' ";
								else
									$avatar = "src='data:jpg;base64,".base64_encode($profileRow['img'])."'";
						?>
								<a class="settings-profile" href="profile.php?id=<?php echo $profileRow['id'] ?>">
									<img class="margin-16 settings-profile-pic-small" style="margin-top:8px;<?php if ($profileRow["kid"]) { echo "border-color:green"; $kidCounter++;} ?>" <?php echo $avatar?>/>
									<div style="text-align:center;margin-bottom:8px;"><?php echo $profileRow["name"] ?></div>
								</a>
						<?php
								$profileCount++;
							}

							if ($maxProfiles>$profileCount) {
						?>
						
						<a class="settings-profile" href="profile.php">
							<img class="settings-profile-add" src="../res/add.png"/>
							<div style="text-align:center;margin-bottom:8px;">Añadir</div>
						</a>
						<?php
							}
						?>
						<input style="position:absolute;" id="profile-id" name="profile-id" class="hidden">
					</form>
					<?php 
						if ($kidCounter>0) {
					?>
							<div class="settings-parental-message">
									<div style="border-radius:50%; border: 1px solid green; height:16px; width:16px; margin-right:8px; "></div>
									<div style="margin-top:1px">Perfil con control parental</div>
							</div>
					<?php 
						}
					?>
			</div>
		</div>
	</div>
	<script src="../js/toast.js"></script>
    <div class="footer">
        <span>
            <a class="gray-link" href='help.php'>Ayuda</a>
            -
            <a class="gray-link" href='legal.php'>Legales</a>
            -
            <a class="gray-link" href='../vm.php'>Viking Moon</a>
        </span>
    </div>
    <script src="../js/settings.js"></script>
</body>
</html>