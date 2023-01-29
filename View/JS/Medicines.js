window.addEventListener("load", loadMedicine);

function loadMedicine () {
	let node;
	node = document.querySelectorAll(".medicinex");
	node.forEach(element => {
		element.addEventListener("click", dataMedicines);
	});
}

function dataMedicines() {
	const datos = {
		action : "dataMedicines",
		idMedicine : this.getAttribute( "data-idMedicine" )
	};
	$.ajax({
		type: "POST",
		url: "Ajax/Ajax.php",
		data: datos,
		error: function() {
			alert ("se ha producido un error");
		},
		success: function (dataServer) {
			let node = document.querySelector(".dataM");
			node.innerHTML = dataServer;

				let node2 = document.querySelector(".photoMedicine img");
				node2.addEventListener("click", dataBuy);
				let node3 = document.querySelector("input[name='guardar']");
				node3.addEventListener("click", buying);
		}

	})
}

function dataBuy() {
	const datos = {
		action : "dataBuy",
		Buy : this.getAttribute( "data-buy" )
	};
	$.ajax({
		type: "POST",
		url: "Ajax/Ajax.php",
		data: datos,
		error: function() {
			alert ("se ha producido un error");
		},
		success: function ($dataBuy) {
			let node = document.querySelector(".main");
			node.innerHTML = $dataBuy;
		}
	})
}

function buying() {
	let node = document.querySelector( ".photoMedicine img" );
	const datos = {
		action : "buying",
		idMedicine : node.getAttribute( "data-buy" )
	};
	console.log(datos);
	$.ajax({
		type: "POST",
		url: "Ajax/Ajax.php",
		data: datos,
		error: function() {
			alert ("se ha producido un error");
		},
		success: function (dataServer) {
			let node = document.querySelector(".main");
			console.log(dataServer)
			//node.innerHTML = dataServer;
		}
	})
}
