<?php
	session_start();
	
	// Importar librerías necesarias para gestionar direcciones y géneros literarios
	require_once("gestionBD.php");
	
	
	
	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION["formulario"])) {
			
		$formulario['nombre'] = "";	
		$formulario['apellidos'] = "";
		$formulario['calle'] = "";
		$formulario['dni'] = "";
		$formulario['email'] = "";
		$formulario['telefono'] = "";
		$formulario['cuenta_asociada'] = "";
		$formulario['fechaNacimiento'] = "";
		$formulario['pass'] = "";
	
	
		$_SESSION["formulario"] = $formulario;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else
		$formulario = $_SESSION["formulario"];
			
	// Si hay errores de validación, hay que mostrarlos y marcar los campos (El estilo viene dado y ya se explicará)
	if (isset($_SESSION["errores"])){
		$errores = $_SESSION["errores"];
		unset($_SESSION["errores"]);
	}
		
	// Creamos una conexión con la BD
	$conexion = crearConexionBD();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/formalta.css"/>
  <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
  <!--<script src="https://code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"></script>-->
  <script src="js/validacion_cliente_alta_usuario.js" type="text/javascript"></script>
  <title>IISSI-MOTOR: Alta de Usuarios</title>
</head>

<?php include('cabecera.php')?>

<body>
	<script>
		// Inicialización de elementos y eventos cuando el documento se carga completamente
		$(document).ready(function() {
			$("#altaUsuario").on("submit", function() {
				return validateForm();
			});
			
			// Manejador de evento para copiar automáticamente el email como nick del usuario
			$("#email").on("input", function(){
				$("#nick").val($(this).val());
			});

			// Manejador de evento del color de la contraseña
			$("#password").on("keyup", function() {
				// Calculo el color
				passwordColor();
			});

			// Uso de AJAX con JQuery para cargar de manera asíncrona los municipios según la provincia seleccionada
			// Manejador de evento sobre el campo de provincias
			$("#provincia").on("input", function () {
				// Llamada AJAX con JQuery, pasándole el valor de la provincia como parámetro
        		$.get("cambio_provincia.php", { provinciaMunicipio: $("#provincia").val()}, function (data) {
        			// Borro los municipios que hubiera antes en el datalist
        			$("#opcionesMunicipios").empty();
        			// Adjunto al datalist la lista de municipios devuelta por la consulta AJAX
        			$("#opcionesMunicipios").append(data);
				});
    		});
		});
	</script>
	
	<?php
	
	?>
	
	<?php 
		// Mostrar los erroes de validación (Si los hay)
		if (isset($errores) && count($errores)>0) { 
	    	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
    		foreach($errores as $error){
    			echo $error;
			} 
    		echo "</div>";
  		}
	?>

	
	<form style="margin:20px;" id="altaUsuario" method="POST" action="registrar.php">
		<!--novalidate-> 
		<!--onsubmit="return validateForm()"-->   
		<?php 
		if(isset($_SESSION["error"])){
			echo $_SESSION["error"];
		}
		?>
		
		<p><i>Los campos obligatorios están marcados con </i><em>*</em></p>

			<fieldset><legend>Datos personales</legend>
			
			<div><label for="nombre">Nombre:<em>*</em></label>
			<input id="nombre" name="NOMBRE" type="text" size="40" value="<?php echo $formulario['nombre'];?>" required/>
			</div>
			
			<div><label for="apellidos">Apellidos:</label>
			<input id="apellidos" name="APELLIDOS" type="text" size="80" value="<?php echo $formulario['apellidos'];?>"/>
			</div>
			
			<div></div><label for="nif">NIF<em>*</em></label>
			<input id="nif" name="DNI" type="text" placeholder="12345678X" pattern="^[0-9]{8}[A-Z]" title="Ocho dígitos seguidos de una letra mayúscula" value="<?php echo $formulario['dni'];?>" required>
			</div>

			<div><label for="email">Email:<em>*</em></label>
			<input id="email" name="EMAIL"  type="email" placeholder="usuario@dominio.extension" value="<?php echo $formulario['email'];?>" required/>
			</div>

			<div<<label for="telefono">Teléfono:</label>
			<input  id="telefono" name="TELEFONO" type="telefono" value="<?php echo $formulario['telefono'];?>"/>
			</div>

			<div<<label for="cuenta_asociada">Cuenta asociada:</label>
			<input  id="cuenta_asociada" name="CUENTA_ASOCIADA" type="cuenta_asociada" value="<?php echo $formulario['cuenta_asociada'];?>"/>
			</div>
			
			
			<div<<label for="fechaNacimiento">Fecha de nacimiento:</label>
			<input type="date" id="fechaNacimiento" name="FECHA_NACIMIENTO" value="<?php echo $formulario['fechaNacimiento'];?>"/>
			</div>

			
		</fieldset>

		<fieldset><legend>Datos de cuenta</legend>
			
			
			<div id="divPass"><label for="pass">Password:<em>*</em></label>
                <input  type="password" name="PASSWORD" id="password" placeholder="Mínimo 8 caracteres entre letras y dígitos" required onkeyup="passwordValidation();" onkeydown="validaPass(this); "/>
			</div>
			<!--<div><label for="confirmpass">Confirmar Password: </label>
				<input type="password" name="confirmpass" id="confirmpass" placeholder="Confirmación de contraseña"  oninput="passwordConfirmation();" required"/>
			</div>-->
			
		
				
				</select>
			</div>
		</fieldset>

		<fieldset>
			<legend>
				Dirección
			</legend>

			<div><label for="calle">Calle/Avda.:<em>*</em></label>
			<input id="calle" name="DIRECCION" type="text" size="80" value="<?php echo $formulario['calle'];?>" required/>
			</div>
		</fieldset>
         <br><br>
		<div><input type="submit" value="Enviar"/></div>
	</form>
	
	<?php
		include_once("pie.php");
		cerrarConexionBD($conexion);
	?>
	
	</body>
</html>
