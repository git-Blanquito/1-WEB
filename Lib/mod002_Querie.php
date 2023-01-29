<?php
	require ("mod001_Conect.php");
    
    // Función generalista que ejecuta una query y obtiene y transforma los datos de la query con el array $arAttributes.
    function mod002_executeQuery( $strSQL, $arAttributes ) {
        $link = mod001_conectBD();
        
        if ( $result = $link -> query( $strSQL ) ) {
            if ( $result -> num_rows !== 0 ) {
                $arRetorno[ "status" ][ "codError" ] = "000"; // Con datos.
                $arRetorno[ "status" ][ "numRows" ]  = $result -> num_rows;
                
                $i = 0;
                while ( $row = $result -> fetch_array( MYSQLI_ASSOC ) ) {
                    foreach( $arAttributes as $element ) {
                        if ( isset( $element[ 2 ] ) ) {
                            if ( $element[ 2 ] === "bool" ) {
                                $arRetorno[ "data" ][ $i ][ $element[ 1 ] ] = (bool)$row[ $element[ 0 ] ];
                            } else if ( $element[ 2 ] === "int" ) {
                                if ( $row[ $element[ 0 ] ] !== null ) {
                                    $arRetorno[ "data" ][ $i ][ $element[ 1 ] ] = intval( $row[ $element[ 0 ] ] );
                                } else {
                                    $arRetorno[ "data" ][ $i ][ $element[ 1 ] ] = null;
                                }
                            }
                        } else {
                            $arRetorno[ "data" ][ $i ][ $element[ 1 ] ] = $row[ $element[ 0 ] ];
                        }                 
                    }
                    $i++;
                }
            } else {
                $arRetorno[ "status" ][ "codError" ]    = "001"; // Sin datos.
                $arRetorno[ "status" ][ "strSQL" ]      = $strSQL;
            }
        } else {
            $arRetorno[ "status" ][ "codError" ]        = "002"; // Error Query.
            $arRetorno[ "status" ][ "strSQL" ]          = $strSQL;
            $arRetorno[ "status" ][ "codSQL" ]          = $link -> errno;
            $arRetorno[ "status" ][ "desSQL" ]          = $link -> error;
        }
       
        mod001_disconectBDD($link);

        return $arRetorno;
    }

    function mod002_getInsurances ()
    {
        $arAttributes = [
            [ "idaseguradora",        "idInsurance",         "int"    ],
            [ "nombreaseguradora",    "nameInsurance"       ],
            [ "logo",                 "logo"                ],
            [ "tlf",                  "tlf"                 ],
            [ "correo",               "email"               ]
        ];
        $strSQL = "SELECT 
        idaseguradora, nombreaseguradora, logo, tlf, correo
                        FROM ASEGURADORAS";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );

        return $arRetorno;
    }

    function mod002_getNameInsurance($id)
    {
        $arAttributes = [
            [ "idaseguradora",        "idInsurance",         "int"    ],
            [ "nombreaseguradora",    "nameInsurance"       ]
        ];
        $strSQL = "SELECT idaseguradora, nombreaseguradora
                    FROM ASEGURADORAS
                    WHERE idaseguradora = $id";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );

        return $arRetorno;
    }

/*     function mod002_getHealers() {
        $arAttributes = [
            [ "idmedico",          "idHealer",         "int"   ],
            [ "nombre",            "nameHealer"                ],
            [ "apellidos",         "surnameHealer"                ],
            [ "direccion",         "address"                ],
            [ "tlf",               "tlf"                ],
        ];

        $strSQL = "SELECT idmedico, nombre, apellidos, direccion, tlf
                    FROM MEDICOS";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );

        return $arRetorno;
    }  */

    function mod002_getInsuranceHealers($id) {
        $arAttributes = [
            [ "idmedico",          "idHealer",         "int"   ],
            [ "nombre",            "nameHealer"                ],
            [ "apellidos",         "surnameHealer"                ],
            [ "direccion",         "address"                ],
            [ "tlf",               "tlf"                ],
        ];

        $strSQL =  "SELECT ESPECIALISTASPORASEGURADORAS.idmedico, nombre, apellidos, direccion, MEDICOS.tlf
                    FROM MEDICOS
                    INNER JOIN ESPECIALISTAS
                    ON MEDICOS.idmedico = ESPECIALISTAS.idmedico
                    INNER JOIN ESPECIALISTASPORASEGURADORAS
                    ON ESPECIALISTAS.idmedico = ESPECIALISTASPORASEGURADORAS.idmedico
                    AND ESPECIALISTAS.idespecialidad = ESPECIALISTASPORASEGURADORAS.idespecialidad
                    INNER JOIN ASEGURADORAS
                    ON ESPECIALISTASPORASEGURADORAS.idaseguradora = ASEGURADORAS.idaseguradora
                    WHERE ASEGURADORAS.idaseguradora = $id";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );

        return $arRetorno;
    }

	function mod002_getInfoHealer($idHealer) {
        $arAttributes = [
            [ "idmedico",          "idHealer",         "int"   ],
            [ "nombre",            "nameHealer"                ],
            [ "apellidos",         "surnameHealer"             ],
			[ "foto",          	   "photo"                     ],
			[ "dni_nie",           "DNI"                       ], 
            [ "tlf",               "tlf"                       ],
			[ "correo",            "email"                     ],
			[ "direccion",         "address"                   ],
			[ "altura",            "height",           "int"   ],
        ];

        $strSQL = "SELECT * 
                    FROM MEDICOS
					WHERE idmedico = $idHealer";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );

        return $arRetorno;
    }

	function mod002_validateUser( $email, $password ){
        $arAttributes = [
            [ "idpaciente",      "idUser",      "int"            ],
            [ "nombre",    		 "nameUser"                      ]
        ];
        //1' OR '1' = '1

        // AND contrasena = '12612' OR '1' = '1' LIMIT 1'
        $strSQL = "SELECT idpaciente, nombre
                    FROM PACIENTES
                    WHERE correo = '$email'
                    AND contrasena = '$password'";
    
        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );
        
        return $arRetorno;
    }

	function mod002_getProfile() {
		$arAttributes = [
            [ "idpaciente",    		 "Identificador",      "int"       ],
            [ "nombre",    			 "Nombre"                 ],
			[ "apellidos",    		 "Apellidos"              ],
			[ "dni_nie",    		 "DNI_NIE"                  ],
			[ "tlf",    		     "Tlf"                      ],
			[ "direccion",    		 "Dirección"                  ],
			[ "fechnacimiento",		 "Fecha de nacimiento"                 ]
        ];

        $strSQL = "SELECT idpaciente, nombre, apellidos, dni_nie, tlf, direccion, fechnacimiento
                    FROM PACIENTES
                    WHERE idpaciente = '{$_SESSION[ "idUser" ]}'";
    
        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );
        
        return $arRetorno;
	}

	function mod002_paginationOfHealers($initialRow, $amount) {
        $arAttributes = [
            [ "idmedico",          "idHealer",         "int"   ],
            [ "nombre",            "nameHealer"                ],
            [ "apellidos",         "surnameHealer"                ],
            [ "direccion",         "address"                ],
            [ "tlf",               "tlf"                ],
        ];

        $strSQL = "SELECT idmedico, nombre, apellidos, direccion, tlf
                    FROM MEDICOS
					LIMIT $initialRow, $amount";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );

        return $arRetorno;
	}

	function mod002_totalRowHealers() {
		$arAttributes = [
            [ "Healers", "Médicos","int" ]
        ];

        $strSQL = "SELECT COUNT(*) AS Healers
                    FROM MEDICOS";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );
        return $arRetorno;
	}

	function mod002_getMedicines() {
		$arAttributes = [
            [ "idmedicamento", "idMedicines", "int" ],
			[ "nombremedicamento", "nameMedicine"        ]
        ];

        $strSQL = "SELECT idmedicamento, nombremedicamento
                    FROM MEDICAMENTOS
					ORDER BY idmedicamento";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );
        return $arRetorno;

	}


	function mod002_getDataMedicine($idMedicine) {
		$arAttributes = [
            [ "idmedicamento",         "idMedicines",   "int" ],
			[ "nombremedicamento",     "nameMedicine"         ],
			[ "foto",                  "photo"         		  ],
			[ "breceta",               "prescription"         ],
			[ "descripcion",           "description"          ]
        ];

        $strSQL = "SELECT idmedicamento, nombremedicamento, foto, breceta, descripcion
                    FROM MEDICAMENTOS
					WHERE idmedicamento = $idMedicine";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );
        return $arRetorno;
	}

	function mod002_getDataBuy($idMedicine) {
		$arAttributes = [
            [ "fechcompra", "Date_Buy"          ],
			[ "Cantidad", "Amount",  "int"     ]
        ];

        $strSQL = "SELECT fechcompra, count(*) AS Cantidad
                    FROM ABASTECIMIENTO
					INNER JOIN PACIENTES
					ON PACIENTES.idpaciente = ABASTECIMIENTO.idpaciente
					INNER JOIN MEDICAMENTOS
					ON MEDICAMENTOS.idmedicamento = ABASTECIMIENTO.idmedicamento
					WHERE PACIENTES.idpaciente = {$_SESSION[ "idUser" ]}
					AND MEDICAMENTOS.idmedicamento = $idMedicine
					GROUP BY fechcompra";

		
        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );
        return $arRetorno;

	}

	function mod002_save($name, $surname, $dni_nie, $tlf, $address, $birthday, $email, $password) {
		$link = mod001_conectBD();
        $strSQL = "INSERT INTO `PACIENTES` (
					`idpaciente`,
					`nombre`,
					`apellidos`,
					`dni_nie`,
					`tlf`,
					`direccion`,
					`fechnacimiento`,
					`correo`,
					`contrasena`)
				VALUES (
					NULL,
					'$name',
					'$surname',
					'$dni_nie',
					'$tlf',
					'$address',
					'$birthday',
					'$email',
					'$password')";

		if ( $result = $link -> query( $strSQL)) {
			if ( $link -> affected_rows > 0) {
				$arRetorno[ "status" ][ "codError" ] = "000";
			} else {
				$arRetorno[ "status" ][ "codError" ] = "001";
			}
		} else if ($link -> errno) {
			$arRetorno[ "status" ][ "codError" ] = "002";
			$arRetorno[ "status" ][ "errorno" ] = $link->errno;
		}
		mod001_disconectBDD ( $link );
        return $arRetorno;
	}

	function mod002_getInfoHealers( $word ) {
		$arAttributes = [
            [ "idmedico",          "idHealer",         "int"   ],
            [ "nombre",            "nameHealer"                ],
            [ "apellidos",         "surnameHealer"                ],
            [ "direccion",         "address"                ],
            [ "tlf",               "tlf"                ],
        ];

        $strSQL = "SELECT idmedico, nombre, apellidos, direccion, tlf
                    FROM MEDICOS
					WHERE nombre LIKE '%$word%'";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );

        return $arRetorno;
	}

	function mod002_buying( $idUser, $idMedicine ) {
		$link = mod001_conectBD();
        $strSQL = "INSERT INTO `ABASTECIMIENTO` (
						`fechcompra`,
						`idpaciente`,
						`idmedicamento`)
					VALUES (
						(select NOW()),
						$idUser,
						$idMedicine)";
		echo $strSQL;
		if ( $result = $link -> query( $strSQL)) {
			if ( $link -> affected_rows > 0) {
				$arRetorno[ "status" ][ "codError" ] = "000";
			} else {
				$arRetorno[ "status" ][ "codError" ] = "001";
			}
		} else if ($link -> errno) {
			$arRetorno[ "status" ][ "codError" ] = "002";
			$arRetorno[ "status" ][ "errorno" ] = $link->errno;
		}
		mod001_disconectBDD ( $link );
		dump($arRetorno);
        return $arRetorno;
	}
?>