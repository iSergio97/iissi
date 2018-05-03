<?php
    //phpinfo();
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
		$TITULO=$_REQUEST['nuevoLibro'];
		echo $_REQUEST['nuevoLibro'];
		$exception = insertar_libro($conexion, $TITULO);
		cerrarConexionBD($conexion);
		
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "consulta_libros.php";
			Header("Location: excepcion.php");
		}
		//else Header("Location: consulta_libros.php");
		
	}else // Se ha tratado de acceder directamente a este PHP 
		Header("Location: consulta_libros.php"); 
?>