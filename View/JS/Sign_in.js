window.addEventListener("load", sign_inClick);

function sign_inClick() {
	let node;

	node = document.querySelector(".sign_in");
	if ( node !== null ) {
		node.addEventListener("click", sign_in);
	}
}

function sign_in() {
	const datos = {
		action : "sign_in",
	};
	$.ajax({
		type: "POST",
		url: "Ajax/Ajax.php",
		data: datos,
		error: function() {
			alert ("se ha producido un error");
		},
		success: function () {
			let node = document.querySelector(".main");
				see = "<div class='save'>"+
							"<form name='sign_inform' method='POST' onsubmit='return validateSign_in();'>"+
								"<div>"+
									"Nombre: <input type='text' name='name' placeholder='Name' maxlength='15'/>"+
								"</div>"+
								"<div>"+
									"Apellidos: <input type='text' name='surname' placeholder='Surname' maxlength='25'/>"+
								"</div>"+
								"<div>"+
									"DNI: <input type='text' name='dni_nie' placeholder='DNI' minlength='9' maxlength='9'/>"+
								"</div>"+
								"<div>"+
									"Tlf: <input type='text' name='tlf' placeholder='Tlf' maxlength='15'/>"+
								"</div>"+
								"<div>"+
									"Dirección: <input type='text' name='address' placeholder='Address' maxlength='40'/>"+
								"</div>"+
								"<div>"+
									"Fecha de nacimiento: <input type='date' name='birthday' placeholder='Birthday' />"+
								"</div>"+
								"<div>"+
									"Email: <input type='text' name='email' placeholder='Email' maxlength='40'/>"+
								"</div>"+
								"<div>"+
									"Contraseña: <input type='password' name='password' placeholder='Password' maxlength='40'/>"+
								"</div>"+
								"<div>"+
									"<input type='button' name='save' value='Save'"+
								"</div>"+
							"</form>"+
						"</div>";
			node.insertAdjacentHTML('beforeend', see);
			node = document.querySelector(".save");
			node.addEventListener("click", destroy);
			node2 = document.querySelector("form[name='sign_inform'] input[name='save']");
			node2.addEventListener("click", save);
		}
	})
}

function save() {
	const datos = {
		action : "save",
		idMedicine : this.getAttribute( "data-idMedicine" ),
		Name 		: sign_inform.name.value,                       //los nombres de la capa form y de las capas input.
		Surname 	: sign_inform.surname.value,
		DNI 		: sign_inform.dni_nie.value,
		Tlf 		: sign_inform.tlf.value,
		Address 	: sign_inform.address.value,
		Birthday 	: sign_inform.birthday.value,
		Email 		: sign_inform.email.value,
		Password 	: sign_inform.password.value
	};

	$.ajax({
		type: "POST",
		url: "Ajax/Ajax.php",
		data: datos,
		error: function() {
			alert ("se ha producido un error");
		},
		success: function ($sign_in) {
			let node = document.querySelector(".main");
			node.innerHTML = $sign_in;
		}
	})
}

function destroy(event) {
	if ( event.target === this ) {
        $("div").remove(".save")
    }
}
