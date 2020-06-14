<html>
<head>
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/alternative.css">
    <title>Ajustes - Bookflix </title>
    <link rel="icon" href="../res/ico.png">
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
                <div class="tab" onclick="window.location='payment.php';">Pago</div>
                <div class="splitter"></div>
                <div class="tab-active">Seguridad</div>
                
            </div>
            <div class="settings-container">
                <form method="POST" enctype="multipart/form-data" id="security-form" onsubmit="return validatePassEditing()" action="securityDB.php">
                    <div>Cambiar contraseña</div>
                    <div style="padding:8px;"></div>
                    <div class="change-pass">
                        <div class="flex-grow">
                            <input class="textbox width-100" type="password" id="old-pass" name="old-pass" placeholder="Contraseña actual" oninput="verifyPassEditing()"/>
                            <div style="padding:8px;"></div>
                        </div>
                        <div style="padding:8px;"></div>
                        <div class="flex-grow">
                            <input class="textbox width-100" type="password" id="new-pass" name="new-pass" placeholder="Contraseña nueva" oninput="verifyPassEditing()"/>
                            <div style="padding:8px;"></div>
                            <input class="textbox width-100" type="password" id="new-pass-conf" placeholder="Confirmación de contraseña" oninput="verifyPassEditing()"/>
                        </div>
                    </div>
                    <div style="padding:16px;"></div>
                    <div class="settings-item">
                        <div class="desc">Eliminar cuenta: </div>
                    <a class="button-alt " href='delete.php'>Eliminar</a>
                    </div>
                    <div class="settings-foot" id="form-foot">
                        <input class="button accent-alt disabled" id="security-next" style="font-size: 16px" type="submit" value="Confirmar">
                        <div style="padding:8px;"></div>
                        <div id="redtext" class="settings-redtext" style="max-width:332px"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
	<script src="../js/settings.js"></script>
    <script src="../js/scripts-alt.js"></script>
	<script src="../js/toast.js"></script>
	<script src="../js/field-validation.js"></script>
    <div class="footer">
        <span>
            <a class="gray-link" href='help.php'>Ayuda</a>
            -
            <a class="gray-link" href='legal.php'>Legales</a>
            -
            <a class="gray-link" href='../vm.php'>Viking Moon</a>
        </span>
    </div>
</body>
</html>