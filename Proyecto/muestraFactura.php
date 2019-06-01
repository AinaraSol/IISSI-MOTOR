<?php
session_start();
	if(isset($_SESSION["factura"])){
	$factura = $_SESSION['factura'];
    $nombre_marca= $factura['nombre_marca'];
	$cantidad = $factura['cantidad'];
	$email_cliente = $factura['email_cliente'];
	include ('gestionBD.php');
	$conexion = crearConexionBD();
	include ('gestion_factura.php');
	$producto = consultaMarca($conexion,$nombre_marca);
	include ('gestionarUsuarios.php');
   	$cliente = busquedaUsuario($conexion,$email_cliente);

    $precio_total = $cantidad*$producto["PRECIO_CON_IVA"];
	
	

    
    
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Mostrar datos de facturas</title>
		<link rel="stylesheet" type="text/css" href="./css/muestraFactura.css"/>
				<!-- <link rel="stylesheet" type="text/css" href="./css/Factura.css"/> -->
	</head>
	<body>
		<div class="form">
		<h1>FACTURA</h1>
		
		<table class="fechaID"><tr>
		<td><?php echo"Id cliente: </td><td>".$cliente["CUENTA_ASOCIADA"];?></td></tr>
		<tr><td><?php
		$fecha = date("d-m-Y",time()); 
		echo"Fecha: </td><td>".$fecha;?></td></tr>
		</table>
		
		<div class="datosCliente">
			<?php echo"Nombre: ".$cliente["NOMBRE"]."<br>"; ?> 
			<?php echo"Apellidos: ".$cliente["APELLIDOS"]."<br>"; ?> 
			<?php echo"DNI: ".$cliente["DNI"]."<br>"; ?> 
			<?php echo"Dirección: ".$cliente["DIRECCION"]."<br>"; ?> 
			<?php echo"Email: ".$cliente["EMAIL"]."<br>"; ?> 
			<?php echo"Teléfono: ".$cliente["TELEFONO"]."<br>"; ?> 
		
		</div>
		<table class="precios"><tr>
			<td><?php echo'Cantidad: '.$cantidad;?></td>
			<td><?php echo'Precio unidad: '.$producto["PRECIO_CON_IVA"];?></td>
			<td><?php echo'Precio total: '.$precio_total;?></td></tr>
		</table>	
			
			<form action="insertaFactura.php" method="POST">
			<input type="hidden" id="id_cliente" name="id_cliente" value="<?php echo $cliente["ID_CLIENTE"] ?>"></input>
         	<input type="hidden" id="precio" name="precio" value="<?php echo $precio_total ?>"></input>
         	<input type="hidden" id="id_producto" name="id_producto" value="<?php echo $producto["ID_PRODUCTO"] ?>"></input>
         	<input type="hidden" id="cuenta_deudora" name="cuenta_deudora" value="<?php echo $cliente["CUENTA_ASOCIADA"] ?>"></input>
         	<input class="button" name="verificacion" type="submit" value="Aceptar">
         	<input class="button" name="verificacion"  type="submit" value="Rechazar">
			</form>
		</div>
	</body>
</html>

<?php 
	}
?>
