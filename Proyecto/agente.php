
<?php
	session_start(); 
	include ('gestionBD.php');
	$conexion = crearConexionBD();
	include ('gestion_factura.php');
	
	if(!isset($_SESSION["login"])){
		header("Location:login.php");
	}else if($_SESSION["login"]!="luz@gmail.com"){
		header("location:index.php");
	}
	
	
	// ¿Venimos simplemente de cambiar página o de haber seleccionado un registro ?
	// ¿Hay una sesión activa?
	if (isset($_SESSION["paginacion"]))
		$paginacion = $_SESSION["paginacion"];
	
	$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);
	$pag_tam = isset($_GET["PAG_TAM"]) ? (int)$_GET["PAG_TAM"] : (isset($paginacion) ? (int)$paginacion["PAG_TAM"] : 5);

	if ($pagina_seleccionada < 1) 		$pagina_seleccionada = 1;
	if ($pag_tam < 1) 		$pag_tam = 5;

	// Antes de seguir, borramos las variables de sección para no confundirnos más adelante
	unset($_SESSION["paginacion"]);

	$query = "SELECT * FROM FACTURA NATURAL JOIN PRODUCTO ";
	// La consulta que ha de paginarse
	

	// Se comprueba que el tamaño de página, página seleccionada y total de registros son conformes.
	// En caso de que no, se asume el tamaño de página propuesto, pero desde la página 1
	$total_registros = total_consulta($conexion, $query);
	$total_paginas = (int)($total_registros / $pag_tam);

	if ($total_registros % $pag_tam > 0)		$total_paginas++;

	if ($pagina_seleccionada > $total_paginas)		$pagina_seleccionada = $total_paginas;

	// Generamos los valores de sesión para página e intervalo para volver a ella después de una operación
	$paginacion["PAG_NUM"] = $pagina_seleccionada;
	$paginacion["PAG_TAM"] = $pag_tam;
	$_SESSION["paginacion"] = $paginacion;
	
	$filas = facturas($conexion, $paginacion);
	
	
?>





<!DOCTYPE html>
<html>
	<head>
		<title>Mostrar datos de facturas</title>
		<link rel="stylesheet" type="text/css" href="./css/estilo.css"/>
	</head>
	<?php include ('cabecera.php')?>
	<body>
		<h1>FACTURAS GENERADAS</h1>
		
		<nav>

		<div id="enlaces">

			<?php

				for( $pagina = 1; $pagina <= $total_paginas; $pagina++ )

					if ( $pagina == $pagina_seleccionada) { 	?>

						<span class="current"><?php echo $pagina; ?></span>

			<?php }	else { ?>

						<a href="agente.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

			<?php } ?>

		</div>



		<form method="get" action="agente.php">

			<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>

			Mostrando

			<input id="PAG_TAM" name="PAG_TAM" type="number"

				min="1" max="<?php echo $total_registros; ?>"

				value="<?php echo $pag_tam?>" autofocus="autofocus" />

			entradas de <?php echo $total_registros?>

			<input type="submit" value="Cambiar">

		</form><br><br>
		

	</nav>

		<table>
			<tr>
				<th style="margin-left:2px;">ID_FACTURA</th>
				<th>NOMBRE PRODUCTO </th>
				<!--<th>ID_AGENTE</th>-->
				<th>ID_CLIENTE</th>
				<th>FECHA FACTURA</th>
				<!--<th>ID_SERVIDIOS</th>-->
				<th>CUENTA DEUDORA</th>
				<th>TOTAL PAGAR </th>
			</tr>
				<?php 
					foreach ($filas as $lista_factura) {
				
					
						echo "<tr>";
							echo "<td>";
								echo $lista_factura['ID_FACTURA'];
							echo "</td>";
							
							echo "<td>";
								echo $lista_factura['MARCA'];
							echo "</td>";
							
							//echo "<td>";
							//	echo $lista_factura['ID_AGENTE'];
							//echo "</td>";
							
							echo "<td>";
								echo $lista_factura['ID_CLIENTE'];
							echo "</td>";
							
							echo "<td>";
								echo $lista_factura['FECHA_FACTURA'];
							echo "</td>";
							
						//	echo "<td>";
							//	echo $lista_factura['ID_SERVICIOS'];
						//	echo "</td>";
						
							echo "<td>";
								echo $lista_factura['CUENTA_DEUDORA'];
							echo "</td>";
							
							echo "<td>";
								echo $lista_factura['TOTAL_PAGAR'];
							echo "</td>";
							echo '<form action="borraFactura.php" method="post">
							<input type="hidden" name="id_factura" value="'.$lista_factura['ID_FACTURA'].'"></input>
							
							<td><input type="submit" value="Borrar"></input></td></form>';
						echo "</tr>";
											}
				?>
			
		</table>
		<?php include('pie.php')?>
		
	</body>
</html>