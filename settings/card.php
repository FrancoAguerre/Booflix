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
			<form class="settings-container" id="card-edit-form" method="POST" onsubmit="return validatePayment(true)" action="cardDB.php">
					<div> Nueva tarjeta de débito o crédito</div>
					<div style="padding:8px;"></div>
					<input class="textbox width-100 " type="text" pattern="[0-9]*" inputmode="numeric" name="card-number" id="card-number" placeholder="Número de tarjeta" maxlength="16" oninput="verifyPayment()"/>
					<div style="padding:8px;"></div>
					<input class="textbox width-100  " type="text" name="card-name" id="card-name" placeholder="Nombre y apellido" oninput="verifyPayment()"/>
					<div style="padding:8px;"></div>
					<div style="display:flex">
						<input class="textbox width-100 " type="text" name="exp-date" id="exp-date" placeholder="Vencimiento" oninput="verifyPayment()"/>
						<div style="padding:8px;"></div>
						<input class="textbox width-100 " type="text" name="security-code" id="security-code" placeholder="Código de seguridad" oninput="verifyPayment()"/>
					</div>
					<div style="padding:8px;"></div>
					<input class="textbox width-100 " type="text" name="dni" id="dni" placeholder="DNI del titular" oninput="verifyPayment()"/>
				<div class="settings-foot">
					<input class="button accent-alt disabled" id="payment-next" style="font-size: 16px" type="submit" value="Guardar">
					<div style="padding:8px;"></div>
					<a class="button-alt" href='payment.php'>Descartar</a>
					<div style="padding:8px;"></div>
					<div id="redtext" class="settings-redtext" style="max-width:208px"></div>
				</div>
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
	<script src="../js/settings.js"></script>
    <script src="../js/scripts-alt.js"></script>
	<script src="../js/field-validation.js"></script>
	<script src="../js/card-edit.js"></script>
	<script src="../js/toast.js"></script>
</body>
</html>