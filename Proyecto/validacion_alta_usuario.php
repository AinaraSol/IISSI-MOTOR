<?php
	session_start();

	// Importar librerías necesarias para gestionar direcciones y géneros literarios
	require_once("gestionBD.php");
	
	

	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		// Recogemos los datos del formulario
		$nuevoUsuario["nombre"] = $_REQUEST["NOMBRE"];
		$nuevoUsuario["apellidos"] = $_REQUEST["APELLIDOS"];
		$nuevoUsuario["dir"] = $_REQUEST["DIRECCION"];
		$nuevoUsuario["dni"] = $_REQUEST["DNI"];
		$nuevoUsuario["email"] = $_REQUEST["EMAIL"];
		$nuevoUsuario["telefono"] = $_REQUEST["TELEFONO"];
		$nuevoUsuario["cuentaAsociada"] = $_REQUEST["CUENTA_ASOCIADA"];
		$nuevoUsuario["fechaNacimiento"] = $_REQUEST["fechaNacimiento"];
		$nuevoUsuario["pass"] = $_REQUEST["PASSWORD"];
	
		
		
		
	
		if(isset($_REQUEST["generoLiterario"])){
			$nuevoUsuario["generoLiterario"] = $_REQUEST["generoLiterario"];
		}else{
			$nuevoUsuario["generoLiterario"] = array();
		}
		
		// Guardar la variable local con los datos del formulario en la sesión.
		$_SESSION["formulario"] = $nuevoUsuario;		
	}
	else // En caso contrario, vamos al formulario
		Header("Location: form_alta_usuario.php");

	// Validamos el formulario en servidor
	$conexion = crearConexionBD(); 
	$errores = validarDatosUsuario($conexion, $nuevoUsuario);
	cerrarConexionBD($conexion);
	
	// Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: form_alta_usuario.php');
	} else
		// Si todo va bien, vamos a la página de acción (inserción del usuario en la base de datos)
		Header('Location: accion_alta_usuario.php');

///////////////////////////////////////////////////////////
// Validación en servidor del formulario de alta de usuario
///////////////////////////////////////////////////////////
function validarDatosUsuario($conexion, $nuevoUsuario){
	$errores=array();
	// Validación del NIF
	if($nuevoUsuario["nif"]=="") 
		$errores[] = "<p>El NIF no puede estar vacío</p>";
	else if(!preg_match("/^[0-9]{8}[A-Z]$/", $nuevoUsuario["nif"])){
		$errores[] = "<p>El NIF debe contener 8 números y una letra mayúscula: " . $nuevoUsuario["nif"]. "</p>";
	}

	// Validación del Nombre			
	if($nuevoUsuario["nombre"]=="") 
		$errores[] = "<p>El nombre no puede estar vacío</p>";
	
	// Validación del email
	if($nuevoUsuario["email"]==""){ 
		$errores[] = "<p>El email no puede estar vacío</p>";
	}else if(!filter_var($nuevoUsuario["email"], FILTER_VALIDATE_EMAIL)){
		$errores[] = "<p>El email es incorrecto: " . $nuevoUsuario["email"]. "</p>";
	}
		
	// Validación de la contraseña
	if(!isset($nuevoUsuario["pass"]) || strlen($nuevoUsuario["pass"])<8){
		$errores [] = "<p>Contraseña no válida: debe tener al menos 8 caracteres</p>";
	}else if(!preg_match("/[a-z]+/", $nuevoUsuario["pass"]) || 
		!preg_match("/[A-Z]+/", $nuevoUsuario["pass"]) || !preg_match("/[0-9]+/", $nuevoUsuario["pass"])){
		$errores[] = "<p>Contraseña no válida: debe contener letras mayúsculas y minúsculas y dígitos</p>";
	}else if($nuevoUsuario["pass"] != $nuevoUsuario["confirmpass"]){
		$errores[] = "<p>La confirmación de contraseña no coincide con la contraseña</p>";
	}
	
	// Validación de la dirección
	if($nuevoUsuario["calle"]==""){
		$errores[] = "<p>La dirección no puede estar vacía</p>";	
	}
	// Validación de la fechaNacimiento
	
	$fecha_correcta=true;
		
	date_default_timezone_set("Spain/Madrid");
    $fecha_actual = strtotime(date("Y-m-d H:i:s"));
    

        if($fecha_actual > strtotime ( '+18 year' , strtotime ( $nuevoUsuario["fechaNacimiento"] ))){
            $fecha_correcta= true;
        }else{
            $fecha_correcta= false;
			
        }
		
		if($nuevoUsuario["fechaNacimiento"]=="" ){
		$errores[] = "<p>La dirección no puede estar vacía</p>";	
		}
		
		if(!$fecha_correcta){
			$errores[] = "<p>Tiene que ser mayor de 18</p>";
			
		}
	
	
	
	return $errores;
}



?>

