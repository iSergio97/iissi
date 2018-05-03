<?php	
	session_start();	
	
	if (isset($_SESSION["libro"])) {
		$libro = $_SESSION["libro"];
		unset($_SESSION["libro"]);
		
		require_once("gestionBD.php");
		require_once("gestionarLibros.php");
		
		$conexion = crearConexionBD();
		$exception = modificar_titulo($conexion, $libro['OID_LIBRO'], $libro['TITULO']);
		cerrarConexionBD($conexion);
		// CREAR LA CONEXIÓN A LA BASE DE DATOS
		// INVOCAR "MODIFICAR_TITULO"
		// CERRAR LA CONEXIÓN

		if ($exception<>"") {
			$_SESSION['excepcion'] = $exception;
			$_SESSION['destino'] = "consulta_libros.php";
			Header("Location: EXCEPCION.PHP");
		} else {
			header("Location: consulta_libros.php");
		}
		
		// SI LA FUNCIÓN RETORNÓ UN MENSAJE DE EXCEPCIÓN, ENTONCES REDIRIGIR A "EXCEPCION.PHP"
		// EN OTRO CASO, VOLVER A "CONSULTA_LIBROS.PHP"
	} 
	else // Se ha tratado de acceder directamente a este PHP 
		Header("Location: consulta_libros.php"); 
?>
