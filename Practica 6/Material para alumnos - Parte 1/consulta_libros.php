<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarLibros.php");
	if (!isset($_SESSION['login'])) {
		Header("Location: login.php");
	} else {
		$conexion = crearConexionBD();
		$filas = consultarTodosLibros($conexion);
	}
	
	// SI NO HAY SESIÓN DE USUARIO ABIERTA, REDIRIGIR A LOGIN.PHP
	// EN OTRO CASO:
	// - HAY QUE CREAR LA CONEXIÓN A LA BASE DE DATOS
	// - INVOCAR LA FUNCIÓN DE CONSULTA DE TODOS LOS LIBROS
	//		QUE SE ENCUENTRA EN "GESTIONARLIBROS.PHP"
	//		Y GUARDAR EL RESULTADO EN UNA VARIABLE
	// - CERRAR LA CONEXIÓN
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de biblioteca: Lista de Libros</title>
</head>

<body>

<?php
	include_once("cabecera.php");
	include_once("menu.php");
?>

<main>

	<?php
		foreach($filas as $fila) {
			
	?>

	<article class="libro">
		
		<?php 
		  echo $fila['TITULO'];
		?>
	</article>

	<?php } ?>
</main>

<?php
	include_once("pie.php");
?>

</body>
</html>
