<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarLibros.php");
	
	if (isset($_SESSION["libro"])){
		$libro = $_SESSION["libro"];
		unset($_SESSION["libro"]);
	}

	$conexion = crearConexionBD();
	$filas = consultarTodosLibros($conexion);
	cerrarConexionBD($conexion);
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
	
?>
<form method="get" action="anadir_libros.php">
	

<input type="text" id"libroNuevo" name="libroNuevo"/>
<button id="anadir_libro" name="anadir_libro" type="submit" class="anadir_libro">
	
							<img src="images/índice.jpg" class="anadir_libro" alt="Nuevo libro" width="25px" height="25px">
							
						</button>

</form>
<main>
	<?php
		foreach($filas as $fila) {
	?>

	<article class="libro">
		<form method="post" action="controlador_libros.php">
			<div class="fila_libro">
				<div class="datos_libro">	
					<input id="OID_LIBRO" name="OID_LIBRO"

						type="hidden" value="<?php echo $fila["OID_LIBRO"]; ?>"/>

					<input id="OID_AUTOR" name="OID_AUTOR"

						type="hidden" value="<?php echo $fila["OID_AUTOR"]; ?>"/>

					<input id="OID_AUTORIA" name="OID_AUTORIA"

						type="hidden" value="<?php echo $fila["OID_AUTORIA"]; ?>"/>

					<input id="NOMBRE" name="NOMBRE"

						type="hidden" value="<?php echo $fila["NOMBRE"]; ?>"/>

					<input id="APELLIDOS" name="APELLIDOS"

						type="hidden" value="<?php echo $fila["APELLIDOS"]; ?>"/>	
					<!-- Controles de los campos que quedan ocultos:
						OID_LIBRO, OID_AUTOR, OID_AUTORIA, NOMBRE, APELLIDOS -->
				<?php
					if ( isset($libro) and $libro['OID_LIBRO']==$fila['OID_LIBRO']) { ?>
						<!-- Editando título -->
							<input type="text" id="TITULO" name="TITULO" value="<?php echo $fila['TITULO']; ?>"/>
						<?php }	else { 
							echo "<h3>".$fila['TITULO']."</h3>"."     ";
							echo $fila['APELLIDOS']."    ";
							echo $fila['NOMBRE'];
							?>
						<!--	<input type="text" id="TITULO" name="TITULO" value="<?php echo $fila['TITULO']; ?>"/>
						 mostrando título -->						
				<?php } ?>

				</div>
				
				<div id="botones_fila">
				<?php if (isset($libro)) { ?>
						<!-- Botón de grabar -->
						<button id="grabar" name="grabar" type="submit" class="editar_fila">

							<img src="images/bag_menuito.bmp" class="editar_fila" alt="Guardar modificación">

						</button>
				<?php } else {?>
						<!-- Botón de editar -->
						<button id="editar" name="editar" type="submit" class="editar_fila">

							<img src="images/pencil_menuito.bmp" class="editar_fila" alt="Editar libro">

						</button>
				<?php } ?>
					<button id="borrar" name="borrar" type="submit" class="editar_fila">
						<img src="images/remove_menuito.bmp" class="editar_fila" alt="Borrar libro">
					</button>
				</div>
			</div>
		</form>
	</article>

	<?php } ?>
</main>

<?php
	include_once("pie.php");
?>

</body>
</html>
