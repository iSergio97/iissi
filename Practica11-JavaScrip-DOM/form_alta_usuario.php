<?php
	session_start();

	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION['formulario'])) {
		$formulario['nif'] = "";
		$formulario['nombre'] = "";
		$formulario['apellidos'] = "";
		$formulario['perfil'] = "ALUMNO";
		$formulario['fechaNacimiento'] = "";
		$formulario['email'] = "";
		$formulario['pass'] = "";

		$_SESSION['formulario'] = $formulario;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else
		$formulario = $_SESSION['formulario'];

	// Si hay errores de validación, hay que mostrarlos y marcar los campos (El estilo viene dado y ya se explicará)
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/biblio.css"/>
    <script src="js/validacion_cliente_alta_usuario.js" type="text/javascript"></script>
  <title>Gestión de Biblioteca: Alta de Usuarios</title>
</head>

<body>
	<?php
		include_once("cabecera.php");
	?>

	<?php
		// Mostrar los erroes de validación (Si los hay)
		if (isset($errores) && count($errores)>0) {
	    	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
    		foreach($errores as $error) echo $error;
    		echo "</div>";
  		}
	?>

	<!-- EJERCICIO 3: invocar la validación de formulario en Javascript antes de enviarlo -->
	<form id="altaUsuario" method="get" action="accion_alta_usuario.php">
		<p><i>Los campos obligatorios están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos personales</legend>
			<div></div><label for="nif">NIF<em>*</em></label>
			<input id="nif" name="nif" type="text" placeholder="12345678X" pattern="^[0-9]{8}[A-Z]" title="Ocho dígitos seguidos de una letra mayúscula" value="<?php echo $formulario['nif'];?>" required>
			</div>

			<div><label for="nombre">Nombre:<em>*</em></label>
			<input id="nombre" name="nombre" type="text" size="40" value="<?php echo $formulario['nombre'];?>" required/>
			</div>

			<div><label for="apellidos">Apellidos:</label>
			<input id="apellidos" name="apellidos" type="text" size="80" value="<?php echo $formulario['apellidos'];?>"/>
			</div>

			<div><label>Perfil:</label>
			<label>
				<input name="perfil" type="radio" value="ALUMNO" <?php if($formulario['perfil']=='ALUMNO') echo ' checked ';?>/>
				Alumno</label>
			<label>
				<input name="perfil" type="radio" value="PDI" <?php if($formulario['perfil']=='PDI') echo ' checked ';?>/>
				PDI</label>
			<label>
				<input name="perfil" type="radio" value="PAS" <?php if($formulario['perfil']=='PAS') echo ' checked ';?>/>
				PAS</label>
			</div>

			<div<<label for="fechaNacimiento">Fecha de nacimiento:</label>
			<input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $formulario['fechaNacimiento'];?>"/>
			</div>

			<div><label for="email">Email:<em>*</em></label>
			<input id="email" name="email"  type="email" placeholder="usuario@dominio.extension" value="<?php echo $formulario['email'];?>" required/><br>
			</div>
		</fieldset>

		<fieldset><legend>Datos de cuenta</legend>
			<div><label for="pass">Password:<em>*</em></label>
                <!-- EJERCICIO 2 apartados B y C -->
                <input type="password" name="pass" id="pass" placeholder="Mínimo 8 caracteres entre letras y dígitos" required oninput="passwordValidation();" onkeyup="passwordColor()"/>
								<span id="fortaleza"></span>
                <!-- EJERCICIO 4 -->

                <!-- FIN DE EJERCICIO 4 -->
			</div>
			<div><label for="confirmpass">Confirmar Password: </label>
			<input type="password" name="confirmpass" id="confirmpass" placeholder="Confirmación de contraseña" required oninput="passwordConfirmation();"/>
			</div>
		</fieldset>

		<div><input type="submit" value="Enviar" /></div>

	</form>

	<?php
		include_once("pie.php");
	?>

	</body>
</html>
