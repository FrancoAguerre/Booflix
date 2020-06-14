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
	
	$userRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'"));
	$plan = $userRow['type'];

	$planRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM plans WHERE id = '$plan'"));
	$planName = $planRow['name_spa'];

	$paymentRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM payment WHERE user_id = '$id'"));
	$cardNumber = $paymentRow['card_number'];

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
				<div class="tab" onclick="window.location='account.php';">Cuenta</div>
				<div class="splitter"></div>
				<div class="tab" onclick="window.location='profiles.php';">Perfiles</div>
				<div class="splitter"></div>
				<div class="tab-active">Pago</div>
				<div class="splitter"></div>
				<div class="tab" onclick="window.location='security.php';">Seguridad</div>
			</div>
			<div class="settings-container" id="info">
				<div> Actualmente estás suscrito al plan <strong><?php echo $planName ?></strong>, usando tu tarjeta terminada en <strong> <?php echo substr($cardNumber,-4) ?></strong>.</div>
				<p>Si cambias la información de pago cuando ya se facturó el período actual, el cambio se verá reflejado en el próximo período.</p>
			
			
				<a class="button accent-alt save" href='card.php'>Cambiar información de pago</a>
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
	<script src="../js/toast.js"></script>
	<script src="../js/settings.js"></script>
</body>
</html>