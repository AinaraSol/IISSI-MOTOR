<?php
include ('paginacion_consulta.php');
   
    	
    
   		function facturas($conexion, $paginacion){
    	
		$consulta = "SELECT * FROM FACTURA NATURAL JOIN PRODUCTO ";
		return consulta_paginada($conexion, $consulta, $paginacion['PAG_NUM'], $paginacion["PAG_TAM"]);
		
		
	
    }
	
	
	
	 function insertar_factura ($conexion, $id_cliente, $cuentaDeudora,$id_producto, $precio){
    	
		
		$consulta = "insert into FACTURA (ID_PRODUCTO, ID_CLIENTE, CUENTA_DEUDORA, TOTAL_PAGAR) VALUES (:id_producto,:id_cliente,:cuenta_asociada,:total_pagar)";
		$stmt= $conexion-> prepare($consulta);
		$stmt -> bindParam(":id_cliente",$id_cliente);
		$stmt -> bindParam(":id_producto", $id_producto);
		$stmt -> bindParam(":total_pagar", $precio);
		$stmt -> bindParam(":cuenta_asociada", $cuentaDeudora);
		$stmt->execute();
		return true;
    }
	
	function consultaMarca($conexion,$nombre_marca) {
 		
 		$consulta = "SELECT * FROM PRODUCTO WHERE MARCA=:nombre_marca";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':nombre_marca',$nombre_marca);
		$stmt->execute();
		return $stmt->fetch();
}
	
	
	function quitarFactura($conexion,$id_factura) {
	try {
		$stmt=$conexion->prepare('DELETE FROM FACTURA WHERE ID_FACTURA = :id_factura');
		$stmt->bindParam(':id_factura',$id_factura);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}
	
	function existeMarca($conexion, $nombre_marca){
		$stmt= $conexion-> prepare("SELECT COUNT(*) FROM PRODUCTO WHERE MARCA=:marca");
		$stmt-> bindParam(":marca",$nombre_marca);
		$stmt->execute();
		return $stmt->fetchColumn()>0;
	}
	
    
    
?>