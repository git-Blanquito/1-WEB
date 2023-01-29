<?php
    session_start();
    require ("Lib/mod004_FormatHTML.php");
	
	$initialRow = "";
	$userOpctions = mod004_userHeaderOptions();
	$userHeader = mod004_userHeader();
	if ( isset( $_GET [ "row" ])) {
		$row = $_GET["row"];
		$initialRow = $row;
	} else {
		$initialRow = 0;
	}
	$amount = 3;
	$divHealers = mod004_paginationOfHealers ($initialRow, $amount);
	require ("View/view_Healers.php");
?>