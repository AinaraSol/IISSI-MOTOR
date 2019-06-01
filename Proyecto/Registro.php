<?php 
    session_start();
    include ('gestionBD.php');
	$conexion = crearConexionBD();
	
	if (!isset($_SESSION['login']))
    Header("Location: login.php");
    else {


	}	

?>


<!DOCTYPE html>
<html>
    <head>
    <meta charset = "utf-8">    
    

  
    
    <title>
      IISSIMOTOR-REGISTRO
    </title>
    <link  rel="stylesheet" href="css/Factura.css" type="text/css"/>  
    <link rel="shortcut icon" type="image/png" href="/iissiMotor/img/issimotorp.png" />
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>

    </head  >
    <body style="padding-top: 8%; padding-bottom:10%; padding-left : 1.5% ;padding-right : 3% ; background-image: url('/IISSI/Proyecto/imágenes/coche.jpg');background-repeat: no-repeat;background-size: cover; ">
        
        
              <form class="form">
                <h1> Regístrese </h1>
                <p> Los campos con asteríscos (*) son obligatorios.</p>
                  <input type="text" id="nombre" name="nombre" placeholder="Nombre" >
                  <input type="apellidos" id="apellidos" name="apellidos" placeholder="Apellidos">
                  <input type="pais" id="pais" name="pais" placeholder="Pais">
                  <input type="email" id="correo" name="correo" placeholder="Email" >
                  <input type="password" id="password" name="password" placeholder="Contraseña">
                  <input type="password" id="password" name="password" placeholder="Repetir contraseña"></input>
                  
                  <imput type="radio" value= "Confirmo que he leído y he comprendido la documentación"></imput><br>
                  
                  <button> Registrarse </button><br>
                  
                  
                 
              
              
               </form>
                            
            
            
             
        
    </body>
</html>