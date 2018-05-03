<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarLibros.php");
	require_once("paginacion_consulta.php");
	
	if (isset($_SESSION["libro"])){
		$libro = $_SESSION["libro"];
		unset($_SESSION["libro"]);
	}
	
	if (isset($_SESSION['paginacion'])) 
		$paginacion = $_SESSION['paginacion'];
	
	$pagina_seleccionada = isset($_GET['PAG_NUM'])?$_GET['PAG_NUM']:
				(isset($paginacion)? $paginacion['PAG_NUM']:1);
				
	$pag_tam = isset($_GET['PAG_TAM'])?$_GET['PAG_TAM']:
				(isset($paginacion)? $paginacion['PAG_TAM']:10);
				
	unset($_SESSION['paginacion']);
	
	// ¿Hay cambio de página o de haber seleccionado un registro?
	// Si no es el caso, ¿hay una sesión activa?
	// Si no, variables por defecto y comprobar límite inferior.
		// Mirar la teoría, pero recuerda que también hay que tener en cuenta 
		// que haya sesión activa si $_GET no está definido
	if ($pagina_seleccionada < 1) $pagina_seleccionada = 1;
	if ($pag_tam < 1) $pag_tam = 5;
	
	// Borrar la variable de sesión respecto paginación
	// ...

	$conexion = crearConexionBD();

	// La consulta que ha de paginarse
	$query = 'SELECT AUTORES.OID_AUTOR, AUTORES.APELLIDOS, AUTORES.NOMBRE, ' 
		.'LIBROS.OID_LIBRO, LIBROS.TITULO, AUTORIAS.OID_AUTORIA '
		.'FROM AUTORES, LIBROS, AUTORIAS '
		.'WHERE '
			.'AUTORES.OID_AUTOR = AUTORIAS.OID_AUTOR AND '
			.'LIBROS.OID_LIBRO = AUTORIAS.OID_LIBRO '
		.'ORDER BY APELLIDOS, NOMBRE, OID_AUTORIA';
	
	// Se comprueba que el tamaño de página, página seleccionada y total de registros son conformes. En caso de que no, se asume el tamaño de página propuesto, pero desde la página 1
	// ...
	
	
	$total_registros = total_consulta( $conexion, $query );
	$total_paginas=(int) $total_registros / $pag_tam;
	if($total_registros % $pag_tam != 0) {
		$total_paginas+1;
	}
	// Generamos los valores de sesión para página e intervalo para volver a ella después de una operación
	$paginacion['PAG_NUM'] = $pagina_seleccionada;
	$paginacion['PAG_TAM'] = $pag_tam;
	$_SESSION['paginacion'] = $paginacion;
	
	$filas = consulta_paginada($conexion, $query, $pagina_seleccionada, $pag_tam);
	
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

<main>
	 <nav>
		<div id="enlaces">
			<!-- Código para poner los enlaces a las páginas -->
					 <?php
					 for ($pagina = 1; $pagina <= $total_paginas; $pagina++) {
					 	if ($pagina == $pagina_seleccionada) {
					 		echo $pagina;
					 	}else { 
					 		 ?>
					 		<a href="consulta_libros.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>
					 		<?php 
					 	}
					 }
?>
				
		</div>
		
		<form method="get" action="consulta_libros.php">
			<!-- Formulario que contiene el número y cambio de tamaño de página -->
			<input type="hidden" name="PAG_NUM" 
			value="<?php echo $pagina_seleccionada; ?>" 
			/>
			Mostrando
			<input type="number" name="PAG_TAM" 
			min="1" max="<?php echo $total_registros; ?>" /> de  <?php echo $total_registros; ?> entradas
			<input type="submit" value="Enviar"/>
		</form>
	</nav>

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
						
				<?php
					if (isset($libro) and ($libro["OID_LIBRO"] == $fila["OID_LIBRO"])) { ?>
						<!-- Editando título -->
						<h3><input id="TITULO" name="TITULO" type="text" value="<?php echo $fila["TITULO"]; ?>"/>	</h3>
						<h4><?php echo $fila["NOMBRE"]." ".$fila["APELLIDOS"]; ?></h4>
				<?php }	else { ?>
						<!-- mostrando título -->
						<input id="TITULO" name="TITULO" type="hidden" value="<?php echo $fila["TITULO"]; ?>"/>
						<div class="titulo"><b><?php echo $fila["TITULO"]; ?></b></div>
						<div class="autor">By <em><?php echo $fila["NOMBRE"]." ".$fila["APELLIDOS"]; ?></em></div>
				<?php } ?>
				</div>
				
				<div id="botones_fila">
				<?php if (isset($libro) and ($libro["OID_LIBRO"] == $fila["OID_LIBRO"])) { ?>
						<button id="grabar" name="grabar" type="submit" class="editar_fila">
							<img src="images/bag_menuito.bmp" class="editar_fila" alt="Guardar modificación">
						</button>
				<?php } else {?>
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