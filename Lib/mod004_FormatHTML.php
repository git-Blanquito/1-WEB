<?php
    require ( "mod003_Logic.php");

	function mod004_getInsurances() 
    {
		$arDataInsurances = mod003_getInsurances();

        $listInsurances = "";
        if ( $arDataInsurances[ "status" ][ "codError" ] === "000" ) {
            $listInsurances = "<div class='flex3'>";
            foreach ($arDataInsurances[ "data" ] as $arDataInsurence ) {
                $listInsurances.= "<div class='margin10'><a href='InsuranceHealers.php?idInsurance={$arDataInsurence[ "idInsurance" ]}'><div><img src='{$arDataInsurence[ "logo" ]}'/></div></a>";
                $listInsurances.= "<p> Nombre: {$arDataInsurence['nameInsurance']}</p>";
                $listInsurances.= "<p>Telefono: {$arDataInsurence['tlf']}</p>";
                $listInsurances.= "<p>Nombre: {$arDataInsurence['email']}</p></div>";
            }
            $listInsurances.= "</div>";
        } else if ( $arDataInsurances[ "status" ][ "codError" ] === "001" ) {
            // Sin datos.
            $listInsurances.= "<p>No tenemos datos de los jugadores solicitados.</p>";
        }
		return $listInsurances;
	}

    function mod004_getNameInsurance($id)
    {
		$arDataInsurances = mod003_getNameInsurance($id);

        $listInsurances = "";
        if ( $arDataInsurances[ "status" ][ "codError" ] === "000" ) {
            foreach ($arDataInsurances[ "data" ] as $arDataInsurence ) {
                $listInsurances.= "{$arDataInsurence['nameInsurance']}";
            }
        } else if ( $arDataInsurances[ "status" ][ "codError" ] === "001" ) {
            // Sin datos.
            $listInsurances.= "<p>No tenemos datos de los jugadores solicitados.</p>";
        }
		return $listInsurances;
	}

/* 	function mod004_getHealers() {
		$arDataMedicos = mod003_getHealers();

        $listMedicos = "";
        if ( $arDataMedicos[ "status" ][ "codError" ] === "000" ) {
            foreach ($arDataMedicos[ "data" ] as $arDataMedico ) {
                $listMedicos.=  "<p><a href='InfoHealer.php?idHealer={$arDataMedico[ "idHealer" ]}'>  {$arDataMedico[ "nameHealer" ]} {$arDataMedico[ "surnameHealer" ]}</a>  -  {$arDataMedico[ "address" ]}   tlf: {$arDataMedico[ "tlf" ]}</p>";
            }
        } else if ( $arDataMedicos[ "status" ][ "codError" ] === "001" ) {
            $listMedicos.= "<p>No tenemos datos de los medicos solicitados.</p>";
        }
		return $listMedicos;
	} */

    function mod004_getInsuranceHealers($id) {
		$arDataMedicos = mod003_getInsuranceHealers($id);

        $listMedicos = "";
        if ( $arDataMedicos[ "status" ][ "codError" ] === "000" ) {
            foreach ($arDataMedicos[ "data" ] as $arDataMedico ) {
                $listMedicos.=  "<p><a href='InfoHealer.php?idHealer={$arDataMedico[ "idHealer" ]}'> {$arDataMedico[ "nameHealer" ]} {$arDataMedico[ "surnameHealer" ]}</a>  -  {$arDataMedico[ "address" ]}   tlf: {$arDataMedico[ "tlf" ]}</p>";
            }
        } else if ( $arDataMedicos[ "status" ][ "codError" ] === "001" ) {
            $listMedicos.= "<p>No tenemos datos de los medicos solicitados.</p>";
        }
		return $listMedicos;
	}

	function mod004_getInfoHealer($idHealer) {
		$arDataMedicos = mod003_getInfoHealer($idHealer);
        $listMedicos = "";
        if ( $arDataMedicos[ "status" ][ "codError" ] === "000" ) {
            foreach ($arDataMedicos[ "data" ] as $arDataMedico ) {
				$listMedicos.= "<div class='photoHealer'><div><img src='{$arDataMedico[ "photo" ]}' class='width100'/></div></div>";
                $listMedicos.=  "<p>{$arDataMedico[ "idHealer" ]} - {$arDataMedico[ "nameHealer" ]} {$arDataMedico[ "surnameHealer" ]} - {$arDataMedico[ "DNI" ]} - tlf: {$arDataMedico[ "tlf" ]} - {$arDataMedico[ "email" ]} - {$arDataMedico[ "address" ]} - {$arDataMedico[ "height" ]} cm.</p>";
            }	
        } else if ( $arDataMedicos[ "status" ][ "codError" ] === "001" ) {
            $listMedicos.= "<p>No tenemos datos de los medicos solicitados.</p>";
        }
		return $listMedicos;
	}

	function mod004_userHeader() {
		$see = "";
		if ( isset( $_SESSION[ "idUser" ]) ) {
			$see.=			"<div>";
			$see.=			"<div>";
			$see.=				"Usuario {$_SESSION[ "nameUser" ]}";
			$see.=			"</div>";
			$see.=			"<div>";
			$see.=				"<div class='logout'>Logout</div>";
			$see.=			"</div>";
			$see.=			"</div>";
		} else {
			$see.=			"<div class='margin10'>";
			$see.=				"Login";
			$see.=			"</div>";
			$see.=			"<div class='login'>";
			$see.=				"<form name='loginform' method='POST' onsubmit='return validateloginform();' action='Login.php'>";
			$see.=					"<input type='text' name='email' placeholder='User' />";
			$see.=					"<input type='password' name='password' placeholder='Key' />";
			$see.=					"<div class='margin10'>";
			$see.=						"<input type='submit' name='ir' value='Iniciar sesion' />";
			$see.=					"</div>";
			$see.=					"<div class='sign_in'>";
			$see.=						"Sign in";
			$see.=					"</div>";
			$see.=				"</form>";
			$see.=			"</div>";
		}
		return $see;
	}

	function mod004_userHeaderOptions() {
		$see = "";
		if ( isset( $_SESSION[ "idUser" ]) ) {
			$see.=	"<div class='margin20'>";
			$see.=		"<a href='InfoHealer.php?idHealer=3' class='sameColor'>Aitor</a>";
			$see.=	"</div>";
			$see.=	"<div class='margin20'>";
			$see.=		"<a href='Insurance.php' class='sameColor'>Aseguradoras</a>";
			$see.=	"</div>";
			$see.=	"<div class='margin20'>";
			$see.=		"<a href='Healers.php' class='sameColor'>Todos los médicos</a>";
			$see.=	"</div>";
			$see.=	"<div class='margin20'>";
			$see.=		"<a href='Medicines.php' class='sameColor'>Todos los medicamentos</a>";
			$see.=	"</div>";
			$see.=	"<div class='margin20 delete'>";
			$see.=		"<a href='Profile.php' class='sameColor'>Perfil</a>";
			$see.=	"</div>";
		} else {
			$see.=	"<div class='margin20'>";
			$see.=		"<a href='InfoHealer.php?idHealer=3' class='sameColor'>Aitor</a>";
			$see.=	"</div>";
			$see.=	"<div class='margin20'>";
			$see.=		"<a href='Insurance.php' class='sameColor'>Aseguradoras</a>";
			$see.=	"</div>";
			$see.=	"<div class='margin20'>";
			$see.=		"<a href='Healers.php' class='sameColor'>Todos los médicos</a>";
			$see.=	"</div>";
			$see.=	"<div class='margin20'>";
			$see.=		"<a href='Medicines.php' class='sameColor'>Todos los medicamentos</a>";
			$see.=	"</div>";
		}
		return $see;
	}

	function mod004_getProfile() {
		$arRetorno = mod003_getProfile();
		
		$see= "";
		if (isset($arRetorno["data"])) {
			if ( $arRetorno[ "status" ][ "codError" ] === "000" ) {
				$see.= "<div class='flex'>";
				$see.= "<div class='margin20'><img src='imagenes/Flores/Flord.jpg'/></div>";
				$see.=	"<div>";
				foreach ($arRetorno["data"][0] as $key => $userDetails) {
					$see.= "<p><span class='font20'>{$key}:</span> <span class='font20_2'>{$userDetails}</span></p>";
				}
				$see.= "</div>";
				$see.= "<div class='margin20'><img src='imagenes/Flores/Flori.jpg'/></div>";
				$see.= "<div></div>";
			}
		} else
			$see.= "Inicia sesión";

		return $see;
	}

	function mod004_paginationOfHealers($initialRow, $amount) {
		$arRetorno = mod003_paginationOfHealers($initialRow, $amount);
		$totalPag = mod002_totalRowHealers();
		$i = "";
		$listMedicos = "";
        if ( $arRetorno[ "status" ][ "codError" ] === "000" ) {
            foreach ($arRetorno[ "data" ] as $arDataMedico ) {
                $listMedicos.=  "<p><a href='InfoHealer.php?idHealer={$arDataMedico[ "idHealer" ]}'>  {$arDataMedico[ "nameHealer" ]} {$arDataMedico[ "surnameHealer" ]}</a>  -  {$arDataMedico[ "address" ]}   tlf: {$arDataMedico[ "tlf" ]}</p>";
				$i++;
            }
			$p = $amount -$i;
			for ($i=0; $i < $p ; $i++) { 
				$listMedicos.= "<p class='hiddenV'>a</p>";
			}
			$listMedicos.= "<div class='flex4'>";
			
			$backRow = $initialRow - $amount;
			if ($initialRow != 0) {
				$listMedicos.= "<a href='Healers.php?row=$backRow' class='sameColor'>Anterior</a>";
			} else {
				$listMedicos.= "<a href='Healers.php?row=$backRow' class='hiddenV'>Anterior</a>";
			}
			$listMedicos.= "<div class='flex'>";
			$y = 1;
			for ($x=0; $x < ($totalPag["data"][0]["Médicos"]/$amount) ; $x++) {
				$z = ($y - 1)*$amount;
				if ($initialRow == $z) {
					$listMedicos.="<a href='Healers.php?row=$z' class='red'>&nbsp $y &nbsp</a>";
					$y++;
				} else {
				$listMedicos.="<a href='Healers.php?row=$z' class='sameColor'>&nbsp $y &nbsp</a>";
				$y++;
				}
			}
			$listMedicos.= "</div>";
			if ($initialRow < ($arRetorno["row"] - $amount)) {
				$nextrow = $initialRow + $amount;
				$listMedicos.= "<a href='Healers.php?row=$nextrow' class='sameColor'>Siguiente</a>";
			} else {
				$nextrow = $initialRow + $amount;
				$listMedicos.= "<a href='Healers.php?row=$nextrow' class='sameColor hiddenV'>Siguiente</a>";
			}
			$listMedicos.="</div>";
        } else if ( $arRetorno[ "status" ][ "codError" ] === "001" ) {
            $listMedicos.= "<p>No tenemos datos de los medicos solicitados.</p>";
        }
		return $listMedicos;

	}

	function mod004_getMedicines() {
		$arRetorno = mod003_getMedicines();
		
		$listMedicines = "";
		
        if ( $arRetorno[ "status" ][ "codError" ] === "000" ) {
			$listMedicines.= "<div class='mediciness'>";
			$listMedicines.= "<div class='medicin'>";

			foreach ($arRetorno["data"] as $dataMedicines) {
			$listMedicines.= "<p data-idMedicine='{$dataMedicines[ 'idMedicines' ]}' class='medicinex'>{$dataMedicines[ 'nameMedicine' ]}</p>";
			}

			$listMedicines.= "</div>";
			$listMedicines.= "<div class='dataM'>";
			$listMedicines.= "</div>";
			$listMedicines.= "</div>";
		}
		return $listMedicines;
	}


	function mod004_getDataMedicine($idMedicine) {
		$arRetorno = mod003_getDataMedicine($idMedicine);

		$listMedicine = "";

        if ( $arRetorno[ "status" ][ "codError" ] === "000" ) {
			foreach ($arRetorno["data"] as $dataMedicine) {
			$listMedicine.= "<div>";
			$listMedicine.= 	"<h2 class='medicine' 'photoMedicine'>{$dataMedicine[ 'nameMedicine' ]}</h2>";
			$listMedicine.= 	"<div class='photoMedicine'>";
			$listMedicine.= 		"<img data-buy='{$idMedicine}'src='{$dataMedicine[ 'photo' ]}'/>";
			$listMedicine.= 	"</div>";
			$listMedicine.= 	"<p class='medicine'>{$dataMedicine[ 'prescription' ]}</p>";
			$listMedicine.= 	"<p class='medicine'>{$dataMedicine[ 'description' ]}</p>";
			$listMedicine.=		"<div class='buying'>";
			//$listMedicine.=			"<form name='buying'>";
			$listMedicine.=				"<input type='button' name='guardar' value='Comprar' />";
			//$listMedicine.=			"</form>";
			$listMedicine.=		"</div>";
			$listMedicine.= "</div>";
			}
		}

		return $listMedicine;
	}

	function mod004_save($name, $surname, $dni_nie, $tlf, $address, $birthday, $email, $password) {
		$arRetorno = mod003_save($name, $surname, $dni_nie, $tlf, $address, $birthday, $email, $password);
		return $arRetorno;
	}
?>