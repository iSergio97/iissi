<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de biblioteca: Usuarios</title>
</head>

<body>
	<?php 
	include_once 'cabecera.php';
	?>
	
	<form id="altaUsuario" method="get" action="accion_alta_usuario.php">
			<p>
				<i>Los campos obligatorios están marcados con </i><em>*</em>
			</p>
			<fieldset>
				<legend>
					Datos personales
				</legend>
				<label for="nif">NIF<em>*</em></label>
				<input id="nif" name="nif" type="text" placeholder="12345678X" pattern="^[0-9]{8}[A-Z]" title="Ocho dígitos seguidos de una letra mayúscula" required>
				<br>

				<label for="nombre">Nombre:<em>*</em></label>
				<input id="nombre" name="nombre" type="text" size="40" required/>
				<br>

				<label for="apellidos">Apellidos:</label>
				<input id="apellidos" name="apellidos" type="text" size="80" required/>
				<br>

				<label>Perfil:</label>
				<label>
					<input name="perfil" type="radio" value="ALUMNO"/>
					Alumno</label>
				<label>
					<input name="perfil" type="radio" value="PDI" />
					PDI</label>
				<label>
					<input name="perfil" type="radio" value="PAS" />
					PAS</label>
				<br>

				<label for="fechaNacimiento">Fecha de nacimiento:</label>
				<input type="date" id="fechaNacimiento" name="fechaNacimiento" required/>
				<br>

				<label for="email">Email:<em>*</em></label>
				<input id="email" name="email"  type="email"
				pattern="(^[A-Z]{1}[a-zA-Z0-9]+)@(lsi.)?us.es" required/><br>

				<br>
			</fieldset>

			<fieldset>
				<legend>
					Datos de usuario
				</legend>
				<label for="nick">Nickname:</label>
				<input id="nick" name="nick" type="text" size="40" required/>
				<br>

				<label for="pass">Password:<em>*</em></label>
				<input type="password" name="pass" id="pass" placeholder="Mínimo 8 caracteres entre letras y dígitos" required />

				<br>
				<label for="confirmpass">Confirmar Password: </label>
				<input type="password" name="confirmpass" id="confirmpass" placeholder="Confirmación de contraseña" required />
				<br>

				<label for="generoLiterario">¿Cuáles son tus géneros literarios favoritos?</label>
				<select name="generoLiterario[]" id="generoLiterario" multiple="">
<!--
	EJERCICIO 2 APT 4	
-->

					<option value="CF">Ciencia Ficción</option>
					<option value="NH">Novela Histórica</option>
					<option value="NN" >Novela Negra</option>
					<option value="NG">Novela Gráfica</option>
					<option value="E">Ensayo</option>
					<option value="P">Poesíaa</option>
					<option value="B">Biografías</option>
					<option value="T">Terror</option>
					<option value="I">Infantil</option>
					<option value="O">Otro</option>
				</select>
				<br>
			</fieldset>

			<fieldset>
				<legend>
					Dirección
				</legend>

				<label for="calle">Calle/Avda.:<em>*</em></label>
				<input id="calle" name="calle" type="text" size="80"/>
				<br>

				<label for="provincia">Provincia:<em>*</em></label>
				<input list="opcionesProvincias" name="provincia" id="provincia"/>
				<datalist id="opcionesProvincias">
				  	<option value="CD">Cádiz</option>
					<option value="SV">Sevilla</option>
					<option value="MA" >Málaga</option>
					<option value="HU">Huelva</option>
					<option value="CO">Córdoba</option>
					<option value="JA">Jaén</option>
					<option value="AL">Almería</option>
					<option value="GR">Granada</option>
					<option value="OT">Otra</option>
				</datalist>
				<br>
			</fieldset>
			<input type="submit" value="Enviar" />
		</form>
		<?php
		include_once 'pie.php';
		?>
	</body>
</html>
