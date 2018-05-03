<?php	
	session_start();	
	
	if (isset($_SESSION["libro"])) {
		$libro = $_SESSION["libro"];
		unset($_SESSION["libro"]);
		
		require_once("gestionBD.php");
		require_once("gestionarLibros.php");
		
		// CREAR LA CONEXIÓN A LA BASE DE DATOS
		// INVOCAR "QUITAR_TITULO"
		// CERRAR LA CONEXIÓN
		$conexion = crearConexionBD();
		$exception = quitar_libro($conexion, $libro['OID_LIBRO']);
		cerrarConexionBD($conexion);
		
		// SI LA FUNCIÓN RETORNÓ UN MENSAJE DE EXCEPCIÓN, ENTONCES REDIRIGIR A "EXCEPCION.PHP"
		// EN OTRO CASO, VOLVER A "CONSULTA_LIBROS.PHP"

	if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "consulta_libros.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: consulta_libros.php");
		
	}else // Se ha tratado de acceder directamente a este PHP 
		Header("Location: consulta_libros.php"); 
?>
