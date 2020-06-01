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
	$profileId = "";
	if (isset($_REQUEST["id"]))
		$profileId = $_REQUEST["id"];
	else
		$profileId = 0;
	$name ="";
	$profilePic = "src='../res/profile.png' ";

	$profilesCount =  mysqli_num_rows(mysqli_query($conn, "SELECT * FROM profiles WHERE user_id = '$id'"));

	if ($profileId>0){
		$profileRow=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM profiles WHERE id = '$profileId' AND user_id = '$id'"));
		$name=$profileRow['name'];
		if (!$profileRow["img"] == null) $profilePic = "src='data:jpg;base64,".base64_encode($profileRow['img'])."'";
	}
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
		<div style="display:flex" class="settings absolute-center box-shadow">
			<div >
			<div style="padding:0.5px;"></div>
				<div class="tab" onclick="window.location='account.php';">Cuenta</div>
				<div class="splitter"></div>
				<div class="tab-active">Perfiles</div>
				<div class="splitter"></div>
				<div class="tab" onclick="window.location='payment.php';">Pago</div>
				<div class="splitter"></div>
				<div class="tab" onclick="window.location='security.php';">Seguridad</div>
			</div>
			<div class="settings-container">
				<div class="delete-confirmation-container <?php if ($profileId==0 || $profilesCount==1) echo "hidden" ?>" id="delete-profile-form" onmouseleave="hideDeleteConfirmation()" method="POST" enctype="multipart/form-data"  action="delete-profile.php">
					<a class="button-alt"id="del-button" onclick="askDeleteConfirmation(<?php echo $profileId ?>)">Eliminar</a>
					<div class="delete-confirmation hidden smooth "id="delete-confirmation">
						¿Estás seguro que querés eliminar este perfil?
						&nbspVolvé a cliquear para confirmar.
					</div>
				</div>
				<form method="POST" enctype="multipart/form-data" id="profile-form" action="profileDB.php">
					<div class="center-content center-text" >
							<div class="settings-profile-pic-container ">
								<div class="settings-profile-pic-advice-container hidden smooth" class="test" id="profile-pic-advice">
									<div class="settings-profile-pic-advice">
									Guardar para ver los cambios
									</div>
								</div>
								<div class="settings-profile-pic-editor hidden smooth " class="test" id="profile-pic-editor">
									<img class="absolute-center" src="../res/edit.png"/>
								</div>
								<img class="settings-profile-pic" id="profile-pic" style="height:128px; width:128px;" <?php echo $profilePic; ?> onclick="document.getElementById('profile-pic-file-input').click()"
									onmouseover="document.getElementById('profile-pic-editor').classList.remove('hidden');" onmouseleave="document.getElementById('profile-pic-editor').classList.add('hidden');"
								/>
							</div>
							<div id="profile-pic-redtext" class="redtext"></div>
							<input class="textbox center-text" type="text" id="name" name="name" placeholder="Tu nombre" oninput="verifyProfileEditing()" value="<?php echo $name; ?>"/>
							<div id="name-redtext" class="redtext"></div>
					</div>
					<input style="position:absolute;" id="profile-id" name="profile-id" class="hidden" value="<?php echo $profileId ?>">
					<div class="settings-foot smooth" id="form-foot">
						<a class="button accent-alt <?php if($name=="") echo "disabled" ?>" id="profile-next" onclick="validateProfileEditing('<?php echo $name ?>')">Guardar</a>
						<div style="padding:8px;"></div>
						<a class="button-alt" href='profiles.php'>Cancelar</a>
					</div>
					<input class="hidden" id="profile-pic-file-input" name="profile-pic" type="file" accept=".jpg" onchange="validateProfilePic('profile-pic-file-input','profile-pic')" />
				</form>
			</div>
		</div>
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
    <script src="../js/scripts-alt.js"></script>
    <script src="../js/settings.js"></script>
    <script src="../js/field-validation.js"></script>
</body>
</html>