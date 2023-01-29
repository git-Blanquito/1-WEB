<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Registro</title>
		<link href="View/CSS/Style.css" rel="stylesheet" type="text/css">
		<script src="View/JS/Medicines.js"></script>
		<script src="View/JS/Logout.js"></script>
		<script src="View/JS/Sign_in.js"></script>
		<script src="View/JS/Search.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
		<script>
            function validateloginform() {
                //alert ( "Estoy a punto de validar la información" );
                let isValidate = true;
                const reLargo = /^(([^<>()\[\]\\.,;:\s@”]+(\.[^<>()\[\]\\.,;:\s@”]+)*)|(“.+”))@((\[[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}])|(([a-zA-Z\-0–9]+\.)+[a-zA-Z]{2,}))$/
                
                loginform.email.className       = "";
                loginform.password.className    = "";

                let email = loginform.email.value;
                let password = loginform.password.value;

                if ( email.trim() === "" ) {
                    loginform.email.className = "error";       
                    isValidate = false;
                } else if ( !reLargo.test( email )) {
                    loginform.email.className = "error";           
                    isValidate = false;
                }

                if ( password.length < 8 ) {
                    loginform.password.className = "error";  
                    isValidate = false;
                } 

                return isValidate;
            }
        </script>
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
       		<h1>Listado de Aseguradoras</h1>
			<?php
				echo $divInsurrances;
			?>
		</main>
	</body>
</html>