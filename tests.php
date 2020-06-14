<?php
    include "session.php";
    include "mercadopago.php";
    $sesion = new session();
    try{
        $sesion->auth();
    } catch (Exception $e) {
		header("Location: login.php#must-login");
    }
    $conn = conn();
    
    $mercadopago = new MercadoPago();

?>

<?php
    include "session.php";
    $sesion = new session();
    $conn = conn();

    $bookId = $_REQUEST['book'];

    $bookRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM books WHERE id = '$bookId'"));


    $content = "'data:pdf;base64,".base64_encode($bookRow['preview'])."'";
    
?>
<html>
<head>
    <link rel="stylesheet" href="css/general.css">
    <title> Bookflix </title>
    <link rel="icon" href="res/ico.png">
    <meta charset="UTF-8">
</head>
<body>
    <object data=<?php echo $content?> type="application/pdf" class="pdf-viewer">
    </object>
</body>
</html>