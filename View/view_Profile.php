<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Listado Medicos</title>
		<link href="View/CSS/Style.css" rel="stylesheet" type="text/css">
		<script src="View/JS/Medicines.js"></script>
		<script src="View/JS/Logout.js"></script>
		<script src="View/JS/Sign_in.js"></script>
		<script src="View/JS/Search.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
	</head>
	<body>
		<header class='flex'>
			<div class='flex font'>
				<?php
				echo $userOpctions
				?>
			</div>
			<div>
				<input type='text' name='busqueda' placeholder='buscador' />
			</div>
			<div class='flex2'>
			<?php
				echo $userHeader;
				?>
			</div>
		</header>
		<main class='main'>
			<h1>Tus datos personales</h1>
			<?php
				echo $userProfile;
			?>
		</main>
	</body>
</html>