<?php
	require ("../Lib/mod004_FormatHTML.php");
	
	session_start();

	$action = $_POST[ "action" ];

	switch ( $action ) {
        case "dataMedicines":
			if (isset( $_POST[ "idMedicine" ])) {
				$idMedicine = $_POST["idMedicine"];
				$dataMedicine = mod004_getDataMedicine($idMedicine);

				echo $dataMedicine;
				break;
			}

        case "dataBuy":
            if ( (isset( $_POST[ "Buy" ] )) && (isset( $_SESSION[ "idUser" ] ))) {
                $idMedicine = $_POST[ "Buy" ];
				$dataBuy = mod002_getDataBuy($idMedicine);
				$data = "";
				if (isset($dataBuy[ 'data' ])) {
					foreach ($dataBuy[ 'data' ] as $dataBuys) {
						$data.= "<div class='overlay'>";
						$data.= 	"<div>";
						$data.= 		"<p>fecha: '{$dataBuys[ 'Date_Buy']}'</p>";
						$data.= 		"<p>Cantidad: '{$dataBuys[ 'Amount']}'</p>";
						$data.= 	"</div>";
						$data.= "</div>";
					}
				} else {
					$data = "<div>";
					$data.= "No has comprado este medicamento";
					$data.= "</div>";
				}
				echo $data;

            } else if(!isset( $_SESSION[ "idUser" ] )) {
				$data = "<div>";
				$data.= "registrate";
				$data.= "</div>";
				echo $data;
			}
            break;
		case "Logout":
			if ( isset( $_SESSION[ "nameUser" ] ) ) {
				session_destroy();
				$_SESSION = array();
				$view = mod004_userHeaderOptions();
					
				echo $view;
				//dump( $_SERVER );
				//$actual_link = "http://$_SERVER[HTTP_REFERER]$_SERVER[REQUEST_URI]";
				//$actual_link = "http://localhost/Curso%20POO/Proyecto/Profile.php";
				/* if ( strpos($_SERVER["HTTP_REFERER"], "Profile.php") === false ) {
					$view = mod004_userHeaderOptions();
					
					echo $view;
				} else {
					
					header( 'Location:../Insurance.php' );
				} */

			} else {
				
			}
			break;
		case "sign_in":
			break;
		case "save":
			$arRetorno = "";
			if ( isset( $_POST[ "Name" ], $_POST[ "Surname" ], $_POST[ "DNI" ], $_POST[ "Tlf" ], $_POST[ "Address" ], $_POST[ "Birthday" ], $_POST[ "Email" ], $_POST[ "Password" ])) 
			{
				$arRetorno = mod004_save($_POST[ "Name" ], $_POST[ "Surname" ], $_POST[ "DNI" ], $_POST[ "Tlf" ], $_POST[ "Address" ], $_POST[ "Birthday" ], $_POST[ "Email" ], $_POST[ "Password" ]);
			}
			if ( $arRetorno[ "status" ][ "codError" ] = "000") {
				echo "Se ha registrado correctamente";
			}
			break;
		case "beginSearch":
			if ( isset( $_POST[ "itemToSearch" ], ) ) {
                $arDataSearch =  mod003_search( $_POST[ "itemToSearch" ] );
                echo json_encode( $arDataSearch );
            }
			break;
		case "buying":
			if ( isset( $_SESSION[ "idUser" ], $_POST[ "idMedicine" ] )) {
				$arDataSearch =  mod003_buying( $_SESSION[ "idUser" ], $_POST[ "idMedicine" ] );
			}
			echo json_encode( $arDataSearch );
			break;
        default:
            echo "Te has confundido al teclear. El case no coincide con el action.";
    }

?>