<?php
    session_start();
	require ("Lib/mod004_FormatHTML.php");
	
	$userOpctions = mod004_userHeaderOptions();
	$userHeader = mod004_userHeader();
    $divMedicines = mod004_getMedicines();
	
	require ("View/view_Medicines.php");
?>