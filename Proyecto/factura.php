
<?php 
    session_start();
    include ('gestionBD.php');
	$conexion = crearConexionBD();
	
	if (!isset($_SESSION['login'])){
    Header("Location: login.php");
    }else {


	}	


?>

<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset = "utf-8">    
    

   
   
    
    <title>
      IISSIMOTOR-FACTURA
    </title>
    <link  rel="stylesheet" href="css/Factura.css" type="text/css"/>   
    <link rel="shortcut icon" type="image/png" href="/iissiMotor/img/issimotorp.png" />
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>

<script src="./js/validar.js" type="text/javascript">

</script>
    </head  >
    <body >
        
        
              <form class="form" action="/IISSI/Proyecto/ConfirmacionFactura.php" method="POST" >
                <h1> Factura </h1>
                  <?php
                  if(isset ($_SESSION['error'])){
                  	echo $_SESSION['error'];
					 unset ($_SESSION['error']);
                  }
                  ?>
                  <p type="Nombre producto :"><input  name="marca" placeholder="Introduzca la marca ..." required=""></input></p>
                  <p type="Cantidad :"><input id="cantidad" onkeyup="validaCantidad()" class="inputNumber" type="number" name="cantidad" placeholder="Introduzca cantidad ..."  required=""></input></p>
                  <p id="Cantidad no válida"></p>
                  <button><input type="submit" value="Confirmar" formmethod="POST"></input></button><br>
                  <button ><a href="index.php"<a/>Cancelar</button>
                               
                  <div>
                    <span>955 xxx xxx</span>
                    <span > servicioTec@IISSIMOTOR.com</span>
                  </div> 
                   
              
              
                </form>
                            
            
            
             
        
    </body>
</html>