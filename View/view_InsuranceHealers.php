<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Registro</title>
		<link href="View/CSS/Style1.css" rel="stylesheet" type="text/css">
		<link href="View/CSS/Style2.css" rel="stylesheet" type="text/css">
		<link href="View/CSS/Style3.css" rel="stylesheet" type="text/css">
		<link href="View/CSS/Style4.css" rel="stylesheet" type="text/css">
		<link href="View/CSS/Style5.css" rel="stylesheet" type="text/css">
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
			<h1>Medicos de <?php echo $divInsurrance?></h1>
			<?php
				echo $Healers;
			?>
		</main>
	</body>
</html>