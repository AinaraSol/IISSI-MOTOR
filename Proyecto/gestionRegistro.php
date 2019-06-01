<?php

function inserta_cliente ($conexion,$nombre,$apellidos,$dni,$email,$telefono,$cuentaAsociada,$fechaNacimiento,$password,$direccion){
	
	$stmt=$conexion -> prepare("insert into CLIENTE (NOMBRE, APELLIDOS, DIRECCION, DNI, EMAIL, TELEFONO, CUENTA_ASOCIADA, FECHA_NACIMIENTO, PASSWORD) VALUES 
							(:nombre, :apellidos, :direccion, :dni, :email, :telefono, :cuenta_asociada, TO_DATE(:fecha_nacimiento,'yyyy-mm-dd'), :password)");
							
	$stmt -> bindParam(":nombre",$nombre);	
	$stmt -> bindParam(":apellidos",$apellidos);
	$stmt -> bindParam(":direccion",$direccion);
	$stmt -> bindParam(":dni",$dni);
	$stmt -> bindParam(":email",$email);
	$stmt -> bindParam(":telefono",$telefono);
	$stmt -> bindParam(":cuenta_asociada",$cuentaAsociada);
	$stmt -> bindParam(":fecha_nacimiento",$fechaNacimiento);	
	$stmt -> bindParam(":password",$password);		
	$stmt->execute();
    return true;
							
							
							
							
}

 
?>