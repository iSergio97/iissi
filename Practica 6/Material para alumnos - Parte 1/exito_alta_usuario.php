<?php
session_start();

// HAY QUE IMPORTAR LA LIBRERÍA DE LA CONEXIÓN A BD
// HAY QUE IMPORTAR LA LIBRERIA DEL CRUD DE USUARIOS
require_once ("gestionBD.php");
require_once ("gestionarUsuarios.php");

// COMPROBAR QUE EXISTE LA SESIÓN CON LOS DATOS DEL FORMULARIO YA VALIDADOS
// RECOGER LOS DATOS Y ANULAR LOS DATOS DE SESIÓN (FORMULARIO Y ERRORES)
// EN OTRO CASO HAY QUE DERIVAR AL FORMULARIO
//...

if (isset($_SESSION["formulario"])) {
	$nuevoUsuario = $_SESSION["formulario"];
	$_SESSION["formulario"] = null;
	$_SESSION["errores"] = null;
} else
	Header("Location: form_alta_usuario.php");

$conexion = crearConexionBD();
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Gestión de Biblioteca: Alta de Usuario realizada con éxito</title>
	</head>

	<body>
		<?php
		include_once ("cabecera.php");
		?>

		<main>
			<!-- CONSULTAR EL TEMA DE TEORÍA SOBRE ACCESO A DATOS -->
			<?php
				if(alta_usuario($conexion, $nuevoUsuario)) {
					$_SESSION['login'] = $nuevoUsuario['email'];
			?>
			<h3>Hola <?php echo $nuevoUsuario["nombre"]; ?>,
			gracias por registrarte</h3>
			<div>
				Pulsa <a href="consulta_libros.php">aquí</a> para acceder a la gestión de biblioteca.
			</div>
			<?php	} else {
				Header("Location: form_alta_usuario.php");
				}
			?>
		</main>

		<?php
		include_once ("pie.php");
		?>
	</body>
</html>
<?php
// DESCONECTAR LA BASE DE DATOS

?>

