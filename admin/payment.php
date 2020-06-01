<html>
     <head>
          <meta charset="UTF-8">
          <link rel="stylesheet" href="../css/general.css">
     </head>
     <body style = "background-color: white; color: black" >
          <div align = "center" class= "absolute-center" style = "border:1px solid gray; padding: 16px; border-radius: 6px; max-width:512px">
               <div id="toast" class="toast" onmouseover="hideToast()"></div>
               <div id="toast-text" class="full-width no-pointer-actions"></div>
               <h1> PAGO MANUAL </h1>
			   <p>Efectuar los pagos con más de un mes de diferencia a la fecha,
			   o los que no se pudieron efectuar en el último intento.</p>
               <form align='center' action="execute_payment.php">
                    <input type="submit" value="Realizar pagos" />
               </form>
               <input type="button" value="Volver" onclick="window.location='index.php'"/>
          </div>
          <script src="../js/toast.js"></script>
          <script src="../js/load.js"></script>
     </body>
</html>
