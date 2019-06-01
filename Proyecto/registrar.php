<?php
	session_start();
	if(isset ($_POST)){
		
		
	

	include ('gestionBD.php');
	$conexion = crearConexionBD();
	include ('gestionRegistro.php');
	
	$nombre = $_POST['NOMBRE'];
	$apellidos = $_POST['APELLIDOS'];
	$dni = $_POST['DNI'];
	$email = $_POST['EMAIL'];
	$telefono = $_POST['TELEFONO'];
	$cuentaAsociada = $_POST['CUENTA_ASOCIADA'];
	$fechaNacimiento = $_POST['FECHA_NACIMIENTO'];
	$password = $_POST['PASSWORD'];
	$direccion = $_POST['DIRECCION'];
	
	if($fechaNacimiento == null || $fechaNacimiento < time()-18*(60*60*24*365)){
		$_SESSION["error"]= "fecha no valida";
		header("location:form_alta_usuario.php");
	}
	
	inserta_cliente ($conexion,$nombre,$apellidos,$dni,$email,$telefono,$cuentaAsociada,$fechaNacimiento,$password,$direccion);
	
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset = "utf-8">    
   
   
    
    
    <title>
      IISSIMOTOR-ConfirmaciónRegistro
    </title>
    <link  rel="stylesheet" href="css/" type="text/css"/>  
    <link rel="shortcut icon" type="image/png" href="/iissiMotor/img/issimotorp.png" />
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>

    </head  >
    <body >
    	 <p> Se ha registrado correctamente, se le ha enviado a su correo un mensaje de confirmación. Confirme para poder acceder a la plataforma</p>
         <img src="\IISSI\Proyecto\logo.jpeg" alt="HTML5 Icon" style="width:130px;height:90px;">
          <form action="index.php">
               
          <input type="submit" />
          </form>
    </body>
    
</html>
<?php
	}else{
		header("Location:index.php");
	}

?>     