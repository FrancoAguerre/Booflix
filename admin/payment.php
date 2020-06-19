<html>
     <head>
          <meta charset="UTF-8">
          <link rel="stylesheet" href="../css/general.css">
     </head>
     <body style = "background-color: white; color: black" >
          <div align = "center" class= "absolute-center" style = "border:1px solid gray; padding: 16px; border-radius: 6px; max-height:256px">
               <div id="toast" class="toast" onmouseover="hideToast()"></div>
               <div id="toast-text" class="full-width no-pointer-actions"></div>
               <h1> PAGO MANUAL </h1>
			   <p>Efectua los pagos que aun no se hayan realizado en el mes
			   o los que no se pudieron efectuar en el último intento.</p>
               <form align='center' action="execute_payment.php">
                    <input type="submit" value="Realizar Pago" />
               </form>
               <input type="button" value="Volver" onclick="window.location='index.php'"/>
          </div>
          <script src="../js/toast.js"></script>
          <script src="../js/load.js"></script>
     </body>
</html>
