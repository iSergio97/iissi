<?php
require_once("gestionBD.php");


// EJERCICIO 4: Código que se ejecutará en la llamada AJAX a este script
if(isset($_GET["provincia"])) {
	$conexion = crearConexionBD();
	$provincia = $_GET["provincia"];
	$lista_municipios = listarMunicipios($conexion, $provincia);


	if($lista_municipios != NULL) {
		foreach ($lista_municipios as $municipio) {
			echo "<option value='" . $municipio["OID_MUNICIPIO"]."' "
			."label='" . $municipio["NOMBRE"]."'>";
		}
	}

$conexion = crearConexionBD();
}
// Si llegamos a este script por haber seleccionado una provincia

	// Abrimos una conexión con la BD y consultamos la lista de municipios dada una provincia

		// Para cada municipio del listado devuelto
			// Creamos options con valores = oid_municipio y label = nombre del municipio

	// Cerramos la conexión y borramos de la sesión la variable "provincia"



// Función que devuelve el listado de municipios de una provincia dada
function listarMunicipios($conexion, $provincia){
try {
	$consulta = "SELECT NOMBRE, OID_MUNICIPIO FROM MUNICIPIOS WHERE OID_PROVINCIA=:prov";
	$stmt=$conexion->prepare($consulta);
	$stmt->bindParam(':prov', $provincia);
	$stmt->execute();

	return $stmt;
} catch (PDOException $e) {
	return null;
}

}

// FIN DE EJERCICIO 4


function listarProvincias($conexion){
	try{
		$consulta = "SELECT * FROM PROVINCIAS ORDER BY NOMBRE";
    	$stmt = $conexion->query($consulta);
		return $stmt;
	}catch(PDOException $e) {
		return $e->getMessage();
    }
}

function buscarProvincia($conexion, $nombre){
	try{
		$consulta = "SELECT OID_PROVINCIA FROM PROVINCIAS WHERE NOMBRE LIKE :nombre";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nombre',$nombre);
		$stmt->execute();

		return $stmt;
	}catch(PDOException $e) {
		return $e->getMessage();
    }
}

function buscarMunicipioProvincia($conexion, $oid_provincia, $oid_municipio){
	try{
		$consulta = "SELECT * FROM MUNICIPIOS WHERE OID_PROVINCIA = :prov AND OID_MUNICIPIO = :mun";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':mun',$oid_municipio);
		$stmt->bindParam(':prov',$oid_provincia);
		$stmt->execute();

		return $stmt;
	}catch(PDOException $e) {
		return $e->getMessage();
    }
}

?>
