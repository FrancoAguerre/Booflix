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
                <form class="settings-container" method="POST" enctype="multipart/form-data">
                    <div class="desc">Eliminar cuenta</div>
                    <p>Esta acción eliminará toda tu información en el  sitio y no se puede deshacer.</p>
                    <p>Para continuar confirmá tu contraseña: </p>
                    <input class="textbox" type="password" placeholder="Contraseña" />

                    <div class="settings-foot">
                        <input class="button accent-alt" style="font-size: 16px" type="submit" value="Confirmar">
                        <div style="padding:8px;"></div>
                        <a class="button-alt" href='security.php'>Cancelar</a>
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
</body>
</html>