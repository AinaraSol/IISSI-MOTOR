<?php

	if($_POST["verificacion"] == "Aceptar"){
    include ('gestion_factura.php');
	
	$id_cliente = $_POST['id_cliente'];
	$id_producto = $_POST['id_producto'];
	$cuenta_deudora = $_POST['cuenta_deudora'];
	$precio = $_POST['precio'];
	
	include ('gestionBD.php');
	$conexion= crearConexionBD();
    insertar_factura($conexion, $id_cliente, $cuenta_deudora,$id_producto, $precio);
	header('Location: index.php');
	}else{
		unset($_SESSION["factura"]);
		header("Location: index.php");
	}
?>