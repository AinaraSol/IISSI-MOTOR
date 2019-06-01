<?php
session_start();
include("gestion_factura.php");
include("gestionBD.php");
$conexion = crearConexionBD();
	$factura['nombre_marca'] = $_POST['marca'];
	$factura['cantidad'] = $_POST['cantidad'];
	$factura['email_cliente'] = $_SESSION['login'];
	
	 if($factura['cantidad'] >10 || $factura['cantidad'] <1 || $factura['cantidad']== null){
	 	$_SESSION['error']= "La cantidad no es válida";
		header('Location:factura.php');
	 }
	 
	  if($factura['nombre_marca'] == null || !existeMarca($conexion, $factura['nombre_marca'])){
	 	$_SESSION['error']= "La marca no es válida";
		header('Location:factura.php');
	 }
	 
	
	if(isset ($_SESSION['factura'])){
		unset($_SESSION['factura']);

		
	}
	
	$_SESSION['factura']= $factura;

?>


<!DOCTYPE html>
<html>
    <head>
    <meta charset = "utf-8">    
  

    
    <title>
      IISSIMOTOR-ConfirmaciónFactura
    </title>
    <link  rel="stylesheet" href="css/conFactura.css" type="text/css"/>   
    <link rel="shortcut icon" type="image/png" href="/iissiMotor/img/issimotorp.png" />
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>

    </head  >
    <body >
         <form class="form" action="/IISSI/Proyecto/muestraFactura.php" method="POST">
         <!--<input type="hidden" id="cliente" name="cliente" value="<?php echo $email_cliente ?>"
         	<input type="hidden" id="cantidad" name="cantidad" value="<?php echo $cantidad ?>"
         	<input type="hidden" id="marca" name="marca" value="<?php echo $nombre_marca ?>"-->
         	
                <p> Se ha generado la factura correctamente, dale al botón para descargar </p>
          		<img src="\IISSI\Proyecto\logo.jpeg" alt="HTML5 Icon" style="width:130px;height:98px;">
           <button><input type="submit" value="Finalizar" formmethod="POST"></input></button>
          </form>
    </body>
</html>     