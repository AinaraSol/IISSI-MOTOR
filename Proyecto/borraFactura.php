<?php 
include("gestionBD.php");
$conexion = crearConexionBD();
include("gestion_factura.php");
$id_factura = $_POST["id_factura"];
quitarFactura($conexion,$id_factura); 
echo $id_factura;
header("Location: agente.php")
?>