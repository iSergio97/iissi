<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarLibros.php");
	
	if (!isset($_SESSION['login']))
		Header("Location: login.php");
	else {
		$conexion = crearConexionBD();
		$filas = consultarTodosLibros($conexion);
		cerrarConexionBD($conexion);
	}
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
			<?php echo "<B>" . $fila["TITULO"] . "</B>, <EM>written by</EM> ".$fila["APELLIDOS"] . ", " . $fila["NOMBRE"]; ?>
	</article>

	<?php } ?>
</main>

<?php
	include_once("pie.php");
?>

</body>
</html>
