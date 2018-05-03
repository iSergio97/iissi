<?php
session_start();

$generosLiterarios = ["NG" => "Novela Gráfica", "NH" => "Novela Histórica", "NN" => "Novela Negra", "CF" => "Ciencia Ficción", "E" => "Ensayo", "P" => "Poesía", "B" => "Biografías", "T" => "Terror", "I" => "Infantil", "O" => "Otro"];

// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
if (isset($_SESSION["formulario"])) {
	// Recogemos los datos del formulario
	$nuevoUsuario["nif"] = $_REQUEST["nif"];
	$nuevoUsuario["nombre"] = $_REQUEST["nombre"];
	$nuevoUsuario["apellidos"] = $_REQUEST["apellidos"];
	$nuevoUsuario["email"] = $_REQUEST["email"];
	$nuevoUsuario["perfil"] = $_REQUEST["perfil"];
	$nuevoUsuario["fechaNacimiento"] = $_REQUEST["fechaNacimiento"];
//	$nuevoUsuario["nick"] = $_REQUEST["nick"];
	$nuevoUsuario["provincia"] = $_REQUEST["provincia"];
	$nuevoUsuario["calle"] = $_REQUEST["calle"];

	if (isset($_REQUEST["generoLiterario"])) {
		$nuevoUsuario["generoLiterario"] = $_REQUEST["generoLiterario"];
	} else {
		$nuevoUsuario["generoLiterario"] = array();
	}

	//print_r($_REQUEST);

	/////////////////////// EJERCICIO 3	 APT 1
	// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION['formulario'] = $nuevoUsuario;
	/////////////////////// FIN EJERCICIO 3 APT 1

	// Validamos el formulario en servidor
	$errores = validarDatosUsuario($nuevoUsuario);

	//print_r($errores);
	/////////////////// EJERCICIO 2
	// Si se han detectado errores

	if (count($errores) > 0) {
		$_SESSION['errores'] = $errores;
		Header('Location: form_alta_usuario.php');
	} else {
		Header('Location: e_alta_usuario.php');
	}
	// Guardo en la sesión los mensajes de error

	// Redirigimos al usuario al formulario

	// Si NO se han detectado errores
	// Redirigimos al usuario a la página de éxito

	/////////////////// FIN DE EJERCICIO 2
	// Si se ha llegado a esta página sin haber rellenado el formulario, se redirige al usuario al formulario
} else {
	Header("Location:alta_usuario.html");
}

// Obtener el nombre completo del género literario mediante un array
function getNombreGeneroLiterario($abbrv) {
	global $generosLiterarios;

	if (isset($generosLiterarios[$abbrv])) {
		return $generosLiterarios[$abbrv];
	} else {
		return "ERROR: abreviatura '" . $abbrv . "' inexistente.";
	}
}

// Formatear la fecha
function getFechaFormateada($fecha) {
	$fechaNacimiento = date('d/m/Y', strtotime($fecha));

	return $fechaNacimiento;
}

/////////////////// EJERCICIO 1
// Validación en servidor del formulario de alta de usuario
function validarDatosUsuario($nuevoUsuario) {
	global $generosLiterarios;
	$error = "";

	// Validación del NIF

	if ($nuevoUsuario['nif'] == "") {
		$errores[] = "El nif no es correcto";
	} else if(!preg_match("/^[0-9]{8}[A-Z]$/", $nuevoUsuario['nif'])) {
		$errores[] = "Nif: ".$nuevoUsuario['nif'];
	}
	// Validación del Nombre
	if ($nuevoUsuario['nombre'] == "") {
		$errores[] = "El nombre no puede ser vacío";
	}

	// Validación del email
	if ($nuevoUsuario['email'] == "") {
		$errores[] = "El email no puede ser vacío";
	}

	// Validación del perfil
	if ($nuevoUsuario['perfil'] == "") {
		$errores[] = "El perfil no puede ser vacío";
	}

	// Validación de la contraseña
	if(!isset($nuevoUsuario['pass']) || strlen($nuevoUsuario['pass']) < 0) {
		$errores[] = "Contraseña no válida. Longitud mínima = 8 caracteres";
	}else if (!preg_match("/[A-Z]+/", $nuevoUsuario['pass'])
			||!preg_match("/[0-9]+/", $nuevoUsuario['pass'])){
				$errores[] = "La contraseña no es válida. Debe contener mayúsculas y minúsculas y dígitos";
		
	} else if ($nuevoUsuario['pass'] != $nuevoUsuario['confirmpass']) {
		$errores[] = "La contraseñas no coinciden";
	}
	// Validación de la dirección
	if($nuevoUsuario['calle'] == "") {
		$errores[] = "La dirección no es correcta";
	}

	// Validación del género literario
	if(is_array($nuevoUsuario['generoLiterario'])) {
		foreach ($nuevoUsuario as $genero) {
			if (!array_key_exists($genero, $generoLiterarios)) {
				$errores[] = "Los géneros literarios no son válidos";
				break;
			}
		}
	}


	return $errores;
}


/////////////////// FIN DE EJERCICIO 1
?>
