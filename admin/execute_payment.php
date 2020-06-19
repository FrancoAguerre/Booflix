<?php 
  include_once "../mercadopago.php";
  include_once "../db.php";
  $conn = conn();
	$date = date('Y-m-d');

  $mp = new mercadoPago();

  $res = mysqli_query($conn,"SELECT * FROM payment");
?>

<html>
     <head>
          <meta charset="UTF-8">
          <link rel="stylesheet" href="../css/general.css">
     </head>
     <body style = "background-color: white; color: black" >
          <div class= "absolute-center" style = "border:1px solid gray; padding: 16px; border-radius: 6px; ">
               <h1> PAGO MANUAL </h1>
               <p>Estado:</p>
               <div style="height:256px; overflow:auto; border:1px solid gray">
<?php
                $counter = 0;
                $badCounter = 0;
                while($paymentRow=mysqli_fetch_assoc($res)){
                    $id = $paymentRow['id'];
                    $month1 = date('m');
                    $month2 = date('m', strtotime($paymentRow['last_payment_date']));
                    $datesMonthDiff = $month1 - $month2;
                    if($datesMonthDiff>=1 || $paymentRow['last_payment_state']==0){
                      if ($mp->pay('','','','','') && mysqli_query($conn,"UPDATE payment SET last_payment_date='$date', last_payment_state='1' WHERE id = '$id'"))
                        echo nl2br ("user " . $paymentRow['user_id'] . " Pagó.\n");
                      else{
                        echo nl2br ("user " . $paymentRow['user_id'] . " Falló el pago.\n");
                        $badCounter++;
                      }
                      $counter++; }
                }
                


                
?>
               </div>
               <form action="execute_payment.php">
                    <p><?php echo $counter ?> pago(s) en total.</p>
                    <div align='center' >
                    <input <?php if ($badCounter==0) echo "disabled" ?> type="submit" value="Repetir <?php echo $badCounter ?> pago(s) erroneo(s)" />
                    </div>
               </form>
               <div align='center' >
                  <input type="button" value="Volver" onclick="window.location='index.php'"/>
               </div>
          </div>
          <script src="../js/load.js"></script>
     </body>
</html>


