<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión     			 
     * #	de libros de la capa de acceso a datos 		
     * #==========================================================#
     */
function consultarTodosLibros($conexion) {
	$consulta = "SELECT * FROM AUTORES, LIBROS, AUTORIAS"
		. " WHERE (AUTORES.OID_AUTOR = AUTORIAS.OID_AUTOR"
		. "   AND LIBROS.OID_LIBRO = AUTORIAS.OID_LIBRO)"
		. " ORDER BY APELLIDOS, NOMBRE";
    return $conexion->query($consulta);
}
    
?>