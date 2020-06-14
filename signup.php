<?php
	include "db.php";
	$conn = conn();

	$st = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM plans WHERE id ='1'"));
	$pl = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM plans WHERE id ='2'"));

	$stName = $st["name_spa"];
	$stPrice = $st["price"];
	$plName = $pl["name_spa"];
	$plPrice = $pl["price"];
?>
<html>
<head>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/alternative.css">
    <title>Registrarse - Bookflix </title>
    <link rel="icon" href="res/ico.png">
    <meta charset="UTF-8">
</head>
<body class="books">
    <div id="for-footer" class="for-footer">
		<div class="top-bar-simple">
				<img class="margin-16"  src="res/header.png"/>
		</div>
		<div id="toast" class="toast" onmouseover="hideToast()">
			<div id="toast-text" class="full-width no-pointer-actions"></div>
		</div>
		<form method="POST" action="signupDB.php" id="signup-form"> 
			<div class="form absolute-center box-shadow " id="plans-form">
				<div style="padding:0.5px;"></div>
				<div class="title">Elegí un plan</div>
				<div style="padding:16px;"></div>
				<div style="display:flex;">
					<div class="plan smooth" id="plan-standard" onclick="selectPlan(1)">
						<div class="plan-name"><?php echo $stName  ?></div>
						<div class="plan-text">· Más de 14.000 libros disponibles.</div>
						<div class="plan-text">· Podés cancelar cuando quieras.</div>
						<div class="plan-text">· Sólo dos lectores a la vez.</div>
						<div class="plan-text">· $<?php echo $stPrice  ?> mensuales.</div>
					</div>
					<div style="padding:16px;"></div>
					<div class="plan smooth" id="plan-plus" onclick="selectPlan(2)">
						<div class="plan-name"><?php echo $plName  ?></div>
						<div class="plan-text">· Más de 14.000 libros disponibles.</div>
						<div class="plan-text">· Podés cancelar cuando quieras.</div>
						<div class="plan-text">· Hasta cuatro lectores a la vez.</div>
						<div class="plan-text">· $<?php echo $plPrice  ?> mensuales.</div>
					</div>
				</div>
			
				<div style="padding:16px;"></div>
				<input class="hidden" name="plan" id="selected-plan"/>
				<a class="button accent-alt submit disabled" id="plan-next" onclick="showDataForm()">Siguiente</a>
			</div>

			<div class="form absolute-center box-shadow hidden " id="data-form"> 
				<div class="title" >Tus datos</div>
				<div style="padding:16px;"></div>
				<input class="textbox width-100" type="text" name="name" id="name" placeholder="Tu nombre" oninput="verifyData()"/>
				<div id="name-redtext" class="redtext"></div>
				<input class="textbox width-100 " type="email" name="email" id="email" placeholder="Correo electrónico" oninput="verifyData()"/>
				<div id="email-redtext" class="redtext"></div>
				<input class="textbox width-100 " type="password" name="pass" id="pass" placeholder="Contraseña" oninput="verifyData()"/>
				<div id="pass-redtext" class="redtext"></div>
				<input class="textbox width-100 " type="password" name="pass-conf" id="pass-conf" placeholder="Confirmación de contraseña" oninput="verifyData()"/>
				<div id="pass-conf-redtext" class="redtext"></div>
				<a class="button accent-alt submit disabled" id="data-next" onclick="validateData()">Siguiente</a>
			</div>

			<div class="form absolute-center box-shadow hidden " id="payment-form">
				<div class="title">Pago</div>
				<div style="padding:8px;"></div>
				<div style="color:black;">Ingresá los datos de tu tarjeta de crédito o débito. </div>
				<div style="padding:8px;"></div>
				<input class="textbox width-100 " type="text" pattern="[0-9]*" inputmode="numeric" name="card-number" id="card-number" placeholder="Número de tarjeta" maxlength="16" oninput="verifyPayment()"/>
				<div id="card-number-redtext" class="redtext"></div>
				<input class="textbox width-100  " type="text" name="card-name" id="card-name" placeholder="Nombre y apellido" oninput="verifyPayment()"/>
				<div id="card-name-redtext" class="redtext"></div>
				<div style="display:flex">
					<div class="width-100"> 
						<input class="textbox width-100" type="text" name="exp-date" id="exp-date" placeholder="Vencimiento (mm/aa)" maxlength="5" oninput="verifyPayment()"/>
						<div id="exp-date-redtext" class="redtext"></div>
					</div>
				<div style="padding:16px;"></div>
					<div class="width-100"> 
						<input class="textbox width-100" type="text" name="security-code" id="security-code" placeholder="Código de seguridad" oninput="verifyPayment()"/>
						<div id="security-code-redtext" class="redtext"></div>
					</div>
				</div>
				<input class="textbox width-100 " type="text" name="dni" id="dni" placeholder="DNI del titular" oninput="verifyPayment()"/>
				<div id="dni-redtext" class="redtext"></div>
				<a class="button accent-alt submit disabled" id="payment-next" onclick="validatePayment()">Suscribirse</a>
			</div>
		</form>
    </div>
    <div class="footer">
        <span>
            <a class="gray-link" href='help.php'>Ayuda</a>
            -
            <a class="gray-link" href='legal.php'>Legales</a>
            -
            <a class="gray-link" href='vm.php'>Viking Moon</a>
        </span>
    </div>
    <script src="js/scripts-alt.js"></script>
	<script src="js/toast.js"></script>
	<script src="js/signup.js"></script>
	<script src="js/field-validation.js"></script>
	
</body>
</html>