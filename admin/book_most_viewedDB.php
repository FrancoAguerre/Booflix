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
$desde = date("Ym", strtotime($desde));
$hasta = date("Ym", strtotime($hasta));

if($desde > $hasta ){
  header("Location:book_most_viewed.php#dateInverted");
}
$desde_año = date("Y", strtotime($desde));
$hasta_año = date("Y", strtotime($hasta));
$desde_mes = date("m", strtotime($desde));
$hasta_mes = date("m", strtotime($hasta));
$res = mysqli_query($conn,"SELECT date,book_id FROM views_stats ORDER BY book_id");
$last_book_id= -1;
$book_id = -1;
$marca = 0;
$ok = true;
error_reporting(0); 
  while($data = mysqli_fetch_assoc($res)){
      //$año = date('Y', strtotime($data['date']));
      //$mes = date('m', strtotime($data['date']));
      $fecha = date("Ym", strtotime($data['date']));
      $book_id =  $data['book_id']; 
        if($fecha >= $desde && $fecha <= $hasta){
          if($last_book_id == -1){
          $last_book_id = $book_id;
          }
          if ($book_id == $last_book_id ){                                                                                        
            $counter[$book_id] = $counter[$book_id] + 1;
            }
          else{
              $last_book_id = $book_id;
              $counter[$book_id] = 1;
            }
          }
        }
    
  if ($book_id != -1){
      $marca = 1;
      arsort($counter);
      foreach ($counter as $clave => $valor){
      $libro = mysqli_fetch_assoc(mysqli_query($conn,"SELECT name FROM books WHERE id = '$clave'"));    
      echo nl2br ("Libro: " . $libro['name'] . "  Vistas:  " . $valor . "\n");
      }
      $res2 = mysqli_query($conn,"SELECT name,id FROM books");                                                                       ////////-----------
      while ($libro2 = mysqli_fetch_assoc($res2)){ 
        foreach ($counter as $clave => $valor){ 
          if( intval($libro2['id']) != $clave and $ok != false ){
            $ok = true;
          }
          else{
            $ok = false;
          }
        }                                                                                                                                    
        if ($ok == true){
          echo nl2br ("Libro: " . $libro2['name'] . "  Vistas:  " . 0 . "\n");                                                               
        }
        $ok = true;
      }
        
                                                                                                                                        ////////-------------       
      }
  if ($marca == 0){
     echo nl2br ("No se realizaron lecturas dentro del periodo solicitado");
    }    
?>

</div>
<div align='center' >
<br><br>  
                  <input type="button" value="Volver" onclick="window.location='book_most_viewed.php'"/>
               </div>
          </div>
          <script src="../js/load.js"></script>
     </body>
</html>