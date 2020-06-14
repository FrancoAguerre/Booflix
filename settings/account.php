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
	
	$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'"));

	$email = $row['email'];
	$plan = $row['type'];

	$st = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM plans WHERE id ='1'"));
	$pl = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM plans WHERE id ='2'"));

	$stName = $st["name_spa"];
	$plName = $pl["name_spa"];

	$profilesCount =  mysqli_num_rows(mysqli_query($conn, "SELECT * FROM profiles WHERE user_id = '$id'"));
?>
<html>
<head>
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/alternative.css">
    <title>Ajustes - Bookflix </title>
    <link rel="icon" href="../res/ico.png">
    <meta charset="UTF-8">
</head>
<body class="books">
	<div class="for-footer">
		<div class=" top-bar-simple">
            <a href="../index.php">
                <img class="margin-16" src="../res/header.png" />
            </a>
		</div>
		<div id="toast" class="toast" onmouseover="hideToast()">
			<div id="toast-text" class="full-width no-pointer-actions"></div>
		</div>
		<div style="display:flex" class="settings absolute-center box-shadow">
			<div>
				<div style="padding:0.5px;"></div>
				<div class="tab-active">Cuenta</div>
				<div class="splitter"></div>
				<div class="tab" onclick="window.location='profiles.php';">Perfiles</div>
				<div class="splitter"></div>
				<div class="tab" onclick="window.location='payment.php';">Pago</div>
				<div class="splitter"></div>
				<div class="tab" onclick="window.location='security.php';">Seguridad</div>
			</div>
			<form class="settings-container"method="POST" id="account-form" onsubmit="return validateAccountEditing('<?php echo $email ?>')" action="accountDB.php">
				<div class="settings-item">
					<div class="desc">Correo electrónico</div>
					<div class="flex-grow">
						<input class="textbox width-100" type="email" id="email" name="email" placeholder="Correo electrónico" oninput="verifyAccountEditing()" value="<?php echo $email ?>"/>
						<div id="email-redtext" class="redtext"></div>
					</div>
				</div>
				<div class="settings-item">
					<div class="desc">Plan: </div>
					<input <?php if ($profilesCount>2) echo "disabled" ?> class="desc" type="radio" name="plan" id="st" onclick="selectPlan(1)" <?php  if ($plan==1) echo 'checked="true"' ?>>
					<label class="desc" for="st"><?php echo $stName ?></label>
					<input type="radio" name="plan"  id="pl" onclick="selectPlan(2)" <?php  if ($plan==2) echo 'checked="true"' ?>>
					<label class="desc" style="color:red; font-weight:bold;" for="pl"><?php echo $plName ?></label>
				</div>
				<div style="padding:8px;"></div>
				<div> El cambio de plan se verá reflejado en el próximo período.</div>
				<p class="<?php if ($profilesCount<=2) echo "hidden" ?>" style="color:red;">Para cambiarte al plan <?php echo $stName ?> debes tener <?php echo $st["max_profiles"] ?> perfiles o menos.</p>
				<input type="hidden" name="plan" id="selected-plan" value="<?php echo $plan ?>"/>
				<input class="button accent-alt save" id="account-next" style="font-size: 16px" type="submit" value="Guardar">
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
	<script src="../js/toast.js"></script>
	<script src="../js/field-validation.js"></script>
</body>
</html>