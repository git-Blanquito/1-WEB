<?php
    session_start();
    require ("Lib/mod004_FormatHTML.php");
	
    if ( isset ( $_GET[ "idHealer" ] ) ) {
        $idHealer = $_GET[ "idHealer" ];
		$userOpctions = mod004_userHeaderOptions();
		$userHeader = mod004_userHeader();
		$divHealer = mod004_getInfoHealer($idHealer);
    } else {
        header( 'Location:Insurance.php' );
    }
	require ("View/view_InfoHealer.php");
?>