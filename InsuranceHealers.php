<?php
    session_start();
    require ("Lib/mod004_FormatHTML.php");
	
    if ( isset ( $_GET[ "idInsurance" ] ) ) {
        $id = $_GET[ "idInsurance" ];
		$userOpctions = mod004_userHeaderOptions();
		$userHeader = mod004_userHeader();
        $Healers = mod004_getInsuranceHealers($id);
        $divInsurrance = mod004_getNameInsurance($id);

    } else {
        header( 'Location:Insurance.php' );
    }
	require ("View/view_InsuranceHealers.php");
?>