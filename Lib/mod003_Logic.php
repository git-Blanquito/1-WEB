<?php
	require ("mod002_Querie.php");
	require ("mod003i_debug.php");

	function mod003_getInsurances() {
		$arDataInsurances = mod002_getInsurances();

		/* Tratar el array para crear una variable que podamos retornar y que podamos utilizar 
		en el fichero presentacion. El tratamiento será en relación a la lógica de negocio. */

		return $arDataInsurances;
	}

	function mod003_getNameInsurance($id) {
		$arDataInsurances = mod002_getNameInsurance($id);

		/* Tratar el array para crear una variable que podamos retornar y que podamos utilizar 
		en el fichero presentacion. El tratamiento será en relación a la lógica de negocio. */

		return $arDataInsurances;
	}

/* 	function mod003_getHealers() {
		$arDataMedicos = mod002_getHealers();
        
		return $arDataMedicos;
	} */

	function mod003_getInsuranceHealers($id) {
		$arDataMedicos = mod002_getInsuranceHealers($id);
        
		return $arDataMedicos;
	}

	function mod003_getInfoHealer($idHealer) {
		$arDataMedico = mod002_getInfoHealer($idHealer);
        

		return $arDataMedico;
	}

	/** 
	 	Graba en la variable SESSION el id del usuario y su nombre y le redirige a la pagina principal.
			Argumentos:
				$email:     email del usuario.
				$password:	Contraseña del usuario
			Retorna: 
				Nada.
			Autor:
				Aitor.
			Fecha:
				13/11/2022 
	**/
	function mod003_validateUser( $email, $password ) {
		$arValidateUser = mod002_validateUser( $email, $password );

        if ( $arValidateUser[ "status" ][ "codError" ] === "000" ) {
            if ( $arValidateUser[ "status" ][ "numRows"] === 1 ) {
                $_SESSION[ "idUser" ]   = $arValidateUser[ "data" ][ 0 ][ "idUser" ];
                $_SESSION[ "nameUser" ] = $arValidateUser[ "data" ][ 0 ][ "nameUser" ];
                header( 'Location:Insurance.php' );

            } else {
                echo "Intentas hackearme, no vuelvas a intentarlo.";
               
            }

        } else if ( $arValidateUser[ "status" ][ "codError" ] === "001" ) {
            echo "Email y contraseña incorrectos.";
        }
    }

	function mod003_getProfile() {
		$arRetorno = "";
		if (isset($_SESSION["idUser"])) {
			$arRetorno = mod002_getProfile();
		}
		return $arRetorno;
	}

	
	function mod003_paginationOfHealers($initialRow, $amount) {
		$arRetorno = mod002_paginationOfHealers($initialRow, $amount);
		$arCount = mod002_totalRowHealers();

		if ( $arCount[ "status" ][ "codError" ] === "000" ) {
			$arCount = $arCount[ "data"][0]["Médicos"];
			$arRetorno["row"] = $arCount;
		}

		return $arRetorno;
	}

	function mod003_getMedicines() {
		$arRetorno = mod002_getMedicines();

		return $arRetorno;
	}

	function mod003_getDataMedicine($idMedicine) {
		$arRetorno = mod002_getDataMedicine($idMedicine);

		return $arRetorno;
	}

	function mod003_save($name, $surname, $dni_nie, $tlf, $address, $birthday, $email, $password) {
		$arRetorno = mod002_save($name, $surname, $dni_nie, $tlf, $address, $birthday, $email, $password);
		return $arRetorno;
	}

	function mod003_search( $itemToSearch ) {
        $arWords = explode( " ", $itemToSearch );
        $arDataHealers[ "data" ] = [];
        if ( count( $arWords ) > 1 ) {
            foreach ( $arWords as $word ) {
                if ( $word !== "" ) {
                    $arArray1 = mod002_getInfoHealers( $word );
                    if ( $arArray1[ "status" ][ "codError" ] === "000" ) { 
                        $arDataHealers[ "data" ] = array_merge( $arDataHealers[ "data" ], $arArray1[ "data" ] );
                    } else {                    
                        $arDataHealers[ "data" ] = array_merge( $arDataHealers[ "data" ], [] );
                    }
                }
            }
        } else {
			$arDataHealers = mod002_getInfoHealers( $itemToSearch );
		}
        /* $arDataSearchWithoutDuplicates = [];
        foreach ($arDataSearch as $element) {
            $bFound = false;
            if ( isset( $element[ "idHealer" ] ) ) {
                foreach ( $arDataSearchWithoutDuplicates as $element2 ) {
                    if ( isset( $element2[ "idHealer" ] ) ) {
                        if ( $element2[ "idHealer" ] === $element[ "idHealer" ] ) {
                            $bFound = true;
                        }
                    }
                }
                if ( !$bFound ) { 
                    $arDataSearchWithoutDuplicates[] = $element;
                }
			} */
        
        return $arDataHealers;
    }

	function mod003_buying( $idUser, $idMedicine ) {
		$arRetorno = mod002_buying( $idUser, $idMedicine );
		return $arRetorno;
	}
?>