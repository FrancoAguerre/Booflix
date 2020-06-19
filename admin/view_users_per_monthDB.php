<html>
     <head>
          <meta charset="UTF-8">
          <link rel="stylesheet" href="../css/general.css">
     </head>
     <body style = "background-color: white; color: black" >
          <div align='center' class= "absolute-center" style = "border:1px solid gray; padding: 20px; border-radius: 6px; ">
               <h1> REPORTE </h1>
               <div style="height:256px; overflow:auto; border:1px solid gray; padding: 40px; ">
<?php
include "../db.php";
$conn = conn(); 
$desde = trim($_POST["fecha_desde"]);
$hasta = trim($_POST["fecha_hasta"]);
$desde = date('Ym', strtotime($desde)); //+
$hasta = date('Ym', strtotime($hasta)); //+

if($desde > $hasta ){
  header("Location:view_users_per_month.php#dateInverted");
}
$desde_año = date("Y", strtotime($desde));
$hasta_año = date("Y", strtotime($hasta));
$desde_mes = date("m", strtotime($desde));
$hasta_mes = date("m", strtotime($hasta));
$res = mysqli_query($conn,"SELECT date,type FROM users");
$counter = 0;
$año_aux = 0;
$mes_aux = 0;
$marca = 0;
$mes_control = $desde_mes;    //////----------
$año_control = $desde_año;	  //////----------
	while($data = mysqli_fetch_assoc($res)){
    	$fecha_sus = date('Ym', strtotime($data['date']));       //+
      $año_sus = date('Y', strtotime($data['date']));
    	$mes_sus = date('m', strtotime($data['date']));
      $mes_sus--;
      if($data['type'] != 0 && $fecha_sus -1 >= $desde && $fecha_sus -1 <= $hasta){     /////  <<<< manejarme con la fecha entera y no separarla 
         
          //elseif($mes_sus != $mes_control && $año_sus != $año_control ){                                            ///////
            //for ($i = $mes_control; $i < $mes_sus; $i++){
              //echo nl2br ("Año: " . $año_sus . "  Mes:  " . $i . "  Suscripciones:     " . 0 . "\n");
            //}          

         // }                                                                                                         ///////                                                   
        if( $año_aux == 0){
          $año_aux = $año_sus;
          $mes_aux = $mes_sus;
         }
        if ($año_sus == $año_aux && $mes_sus == $mes_aux){
          $counter++;
        		}
        else{

        //if( $mes_aux != intval($mes_control)  && $año_aux == $año_control){                                                 //////-------
            
            //for ($i = intval($mes_control); $i < $mes_aux; $i++){
            //echo nl2br ("Año: " . $año_aux . "  Mes:  " . $i . "  Suscripciones:     " . 0 . "\n");
            //}
            //$mes_control = $mes_sus; 
          //}
       //else{
            //$mes_control = $mes_sus;
          //}                                                                                                                   //////----------
          
          //if( $mes_aux != intval($mes_control) || $año_aux != intval($año_control) ){                                           ///////+++++++++++
             //$AC = intval($año_control);
             //$MC = intval($mes_control);
             //while ($AC < $año_aux + 1) {
               //while($MC < 13 ){
                 //echo nl2br ("Año: " . $AC . "  Mes:  " . $MC . "  Suscripciones:     " . 0 . "\n");
                 //$MC++;

                //}

                //$MC = 1;
                //$AC++;

                //}
               //$mes_control = $mes_sus;
               //$año_control = $año_sus; 
             //}
          //else{
            //$mes_control = $mes_sus;
            //$año_control = $año_sus;

          //}                                                                                                              /////////++++++++
          
          echo nl2br ("Año:	" . $año_aux . "	Mes:	" . $mes_aux . "	Suscripciones:	   " . $counter . "\n");
        	$counter = 1;
        	$año_aux = $año_sus;
        	$mes_aux = $mes_sus;
        		}
          }
        }
  
  if ($counter == 0){
  echo nl2br ("No hay subscripciones registradas dentro de el periodo solicitado");
  } 
  else{
  echo nl2br ("Año: " . $año_aux . "  Mes:  " . $mes_aux . "  Suscripciones:     "  . $counter . "\n");
  }     
 //$mes_control = $hasta_mes;                                                                                            ///////----------
  //if( $mes_aux != intval($mes_control)  && $año_aux == $año_control){                                               
            
            //for ($i = $mes_aux + 1 ; $i <= intval($mes_control); $i++){
            //echo nl2br ("Año: " . $año_aux . "  Mes:  " . $i . "  Suscripciones:     " . 0 . "\n");
            //}
            //$mes_control = $mes_sus; 
          //}                                                                                                             //////------------

     
?>

</div>
<div align='center' >
<br><br>	
                  <input type="button" value="Volver" onclick="window.location='view_users_per_month.php'"/>
               </div>
          </div>
          <script src="../js/load.js"></script>
     </body>
</html>
