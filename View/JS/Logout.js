window.addEventListener("load", sessionLogout);

function sessionLogout () {
	let node;

	node = document.querySelector(".logout");
	if ( node !== null ) {
		node.addEventListener("click", Logout);
	}
}


function Logout() {
	const datos = {
		action : "Logout",
	};
	console.log ( datos );
	$.ajax({
		type: "POST",
		url: "Ajax/Ajax.php",
		data: datos,
		error: function() {
			alert ("se ha producido un error");
		},
		success: function ( view ) {
			let URLActual = window.location.href;
			if ( URLActual.indexOf( "Profile.php" ) >= 0 ) {
				//  Estas en la pagina profile.php
				location.href = "Insurance.php";
			} else {
				console.log( view );
				let nodePerfil = document.querySelector(".delete");
				nodePerfil.remove();
				let header = document.querySelector(".font");
				header.remove();
				header = document.querySelector(".flex");
				header.insertAdjacentHTML( "afterbegin", view );
				let node = document.querySelector(".flex2");
				let nodeToDelete = document.querySelector(".flex2>div");
				nodeToDelete.remove();
				let formLogin = "<div class='margin10'>"+
									"Login"+
								"</div>"+
								"<div class='login'>"+
									"<form name='loginform' method='POST' onsubmit='return validateloginform();' action='Login.php'>"+
										"<input type='text' name='email' placeholder='User' />"+
										"<input type='password' name='password' placeholder='Key' />"+
										"<div class='margin10'>"+
											"<input type='submit' name='ir' value='Iniciar sesion' />"+
										"</div>"+
										"<div class='sign_in'>"+
											"Sign in"+
										"</div>"+
									"</form>"+
								"</div>";
				node.insertAdjacentHTML( "beforeend", formLogin );
				sign_inClick();
			}
		}
	})
}
