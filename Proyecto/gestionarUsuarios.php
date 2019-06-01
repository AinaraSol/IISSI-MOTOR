<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión
     * #	de usuarios de la capa de acceso a datos
     * #==========================================================#
     */

 function alta_usuario($conexion,$usuario) {
	$fechaNacimiento = date('d/m/Y', strtotime($usuario["fechaNacimiento"]));

	try {
		$consulta = "insert into CLIENTE VALUES( :nombre, :ape, :dir, :dni, :email, :telefono, :cuenta_asociada, :fec, :pass)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam('nombre:',$usuario["NOMBRE"]);
		$stmt->bindParam(':ape',$usuario["APELLIDOS"]);
		$stmt->bindParam(':dir',$usuario["DIRECCION"]);
		$stmt->bindParam(':dni',$usuario["DNI"]);
		$stmt->bindParam(':email',$usuario["EMAIL"]);
		$stmt->bindParam(':telefono',$usuario["TELEFONO"]);
		$stmt->bindParam(':cuenta_asociada',$usuario["CUENTA_DEUDORA"]);
		$stmt->bindParam(':fec',$fechaNacimiento);
		$stmt->bindParam(':pass',$usuario["PASSWORD"]);
		
		
		$stmt->execute();
		
		return true;
	} catch(PDOException $e) {
		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
    }
}
 function busquedaUsuario($conexion,$email) {
 	$consulta = "SELECT * FROM CLIENTE WHERE EMAIL=:email";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':email',$email);
	$stmt->execute();
	return $stmt->fetch();
}


  
function consultarUsuario($conexion,$email,$pass) {
 	$consulta = "SELECT COUNT(*) AS TOTAL FROM CLIENTE WHERE EMAIL=:email AND PASSWORD=:pass";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':email',$email);
	$stmt->bindParam(':pass',$pass);
	$stmt->execute();
	return $stmt->fetchColumn();
}


