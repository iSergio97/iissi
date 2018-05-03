<?php

if(!isset ($_REQUEST['nif'])) {
		Header("Location:alta_usuario.php");
	}

//////////////////////////////////////////////////////// EJERCICIO 3

//////////////////////////////////////////////////////// FIN EJERCICIO 3


//////////////////////////////////////////////////////// EJERCICIO 2
///////// A)


///////// B)


///////// C)


//////////////////////////////////////////////////////// FIN EJERCICIO 2
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de biblioteca: Alta de Usuario</title>
</head>

<body>	
	<main>

<!--
	Mensaje para confirmar alta de usuario
-->

		<h2>Usuario dado de alta con éxito con los siguientes datos:</h2>
<!--
					EJERCICIO 1	
-->
	

	
	<?php 
	
	
	
	$generosLiterarios=array("NG" => "Novela Gráfica",
						 "NH" => "Novela Histórica",
						 "NN" => "Novela Negra",
						 "CF" => "Ciencia Ficción",
						 "E" => "Ensayo",
						 "P" => "Poesía",
						 "B" => "Biografía",
						 "T" => "Terror",
						 "I" => "Infantil",
						 "O" => "Otros");
	
	
	function getNombreGeneros($abr) {
	global $generosLiterarios;
	if (isset($generosLiterarios[$abr])) {
		return $generosLiterarios[$abr];
	} else {
		return "Error, no existe";
	}
}
	
	function getFechaFormateada($fecha) {
		return date('d/m/y',strtotime($fecha));
	}

	
	//print_r($_REQUEST);
	echo "<ul>";
	echo"<h3>"."<li>"."Nombre: ".$_REQUEST['nombre']."</li>"."</h3>";
	echo"<h3>"."<li>"."Apellidos: ".$_REQUEST['apellidos']."</li>"."</h3>";
	//echo"<h3>"."<li>"."Fecha de nacimiento: ".$_REQUEST['fechaNacimiento']."</li>"."</h3>"
	echo "<h3>"."<li>"."Fecha de nacimiento: ".$_REQUEST['fechaNacimiento'].getFechaFormateada($_REQUEST['fechaNacimiento'])."</li>"."</h3>";
	//echo"<h3>"."<li>"."Fecha de nacimiento modificada: ".getFechaFormateada($_REQUEST['fechaNacimiento'])."</li>"."</h3>";
	//echo"<h3>"."<li>"."Género: ".$_REQUEST['generoLiterario']."</li>"."</h3>";
	//echo"<h3>"."<li>"."Género: ".getNombreGeneros($_REQUEST['generoLiterario'])."</li>"."</h3>";
	echo "<h3>"."<li>"."Géneros Literarios"."</li>"."</h3>";
	echo "<ul>";
	foreach ($_REQUEST['generoLiterario'] as $key => $value) {
		echo "<li>".getNombreGeneros($value)."</li>";
	}
		echo "</ul>";
		echo "</ul>";
			
?>	
<!--
					FIN EJERCICIO 1
-->

	</main>
</body>
</html>