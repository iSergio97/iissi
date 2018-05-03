<?php
	session_start();
  	
  	include_once("gestionBD.php");
 	include_once("gestionarUsuarios.php");
	
	// SI HAY INFORMACIÓN EN $_POST ENTONCES ES QUE 
	// YA SE HA INTRODUCIDO PREVIAMENTE EMAIL Y PASS
	// ENTONCES:
	// - RECOGEMOS LOS DATOS DE EMAIL Y PASS EN VARIABLES LOCALES
	// - SE CREA LA CONEXIÓN A LA BASE DE DATOS
	// - SE INVOCA LA FUNCIÓN CONSULTARUSUARIO EN GESTIONARUSUARIOS
	// - SE CIERRA LA CONEXIÓN
	// - SI HAY UN USUARIO ENTONCES SE ASIGNA EMAIL A LA
	// - 								VARIABLE DE SESION
	// - 							SE REDIRIGE A CONSULTA_LIBROS.PHP
	
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

<!-- LLEGANDO LA EJECUCIÓN AQUÍ, HAY DOS POSIBILIDADES:
	(1) ES LA PRIMERA VEZ QUE SE EJECUTA EL SCRIPT
	(2) SE HA PULSADO EL BOTON DE SUBMIT Y RESULTA QUE EL 
		USUARIO NO EXISTE O CONTRASEÑA NO VÁLIDA 
	EN CUALQUIER CASO, SE HACE LO MISMO, APARTE DE QUE SE DEBE
	MOSTRAR EL ERROR EN EL CASO (2) -->

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/biblio.css" />
  <title>Gestión de biblioteca: Login</title>
</head>

<body>

<?php
	include_once("cabecera.php");
?>

<main>
	<?php if (isset($login)) {
		echo "<div class=\"error\">";
		echo "Error en la contraseña o no existe el usuario.";
		echo "</div>";
	}	
	?>
	
	<!-- The HTML login form -->
	<form action="login.php" method="post">
		<div><label for="email">Email: </label>
		<input type="text" name="email" id="email" /></div>
		<div><label for="pass">Contraseña: </label>
		<input type="password" name="pass" id="pass" /></div>
		<input type="submit" name="submit" value="submit" />
	</form>
		
	<p>¿No estás registrado? <a href="form_alta_usuario.php">¡Registrate!</a></p>
</main>

<?php
	include_once("pie.php");
?>
</body>
</html>

