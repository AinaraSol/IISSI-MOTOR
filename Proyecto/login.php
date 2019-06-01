<?php
    session_start();

     include_once("gestionBD.php");
     include_once("gestionarUsuarios.php");

    if (isset($_POST['submit'])){
        $email= $_POST['email'];
        $pass = $_POST['pass'];

        $conexion = crearConexionBD();
        $num_usuarios = consultarUsuario($conexion,$email,$pass);
        cerrarConexionBD($conexion);

        if ($num_usuarios == 0)
            $login = "error";
        else {
            $_SESSION['login'] = $email;
            Header("Location: index.php");
        }
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
 
  <title>IISSI-MOTOR: Login</title>
   <link rel="shortcut icon" type="image/png" href="./imágenes/logo.jpeg" />
   <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>

</head>

<body>

<?php
    include_once("cabecera.php");
?>

<main>
    <?php if (isset($login)) {
        echo "<div class=>";
        echo "Error en la contraseña o no existe el usuario.";
        echo "</div>";
    }
    ?>

    <!-- The HTML login form -->
    <div>

    <form style="margin:20px;" action="login.php" method="post">
       <label for="email">Email: </label><input style="border: 1px solid black" type="text" name="email" id="email" /><br><br>
        <label for="pass">Contraseña: </label>
        <input  style="border: 1px solid black" type="password" name="pass" id="pass" /><br><br>
        <input type="submit" name="submit" value="submit" />
    </form>

    <p>¿No estás registrado? <a href="form_alta_usuario.php">¡Registrate!</a></p></div>
</main>

<?php
    include_once("pie.php");
?>
</body>
</html>







