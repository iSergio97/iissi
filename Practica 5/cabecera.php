<header>
	<img src="images/marca_mini.jpg" alt="Universidad de Sevilla"><h1>Biblioteca</h1>
	<h2>Gestión de usuarios y préstamos de libros</h2>
	<?php
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {?>
		<a href="logout.php">Desconectar</a>
	<?php
	}
	?>
</header>
