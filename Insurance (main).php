<?php
    session_start();
    require ("Lib/mod004_FormatHTML.php");   
	
	$userOpctions = mod004_userHeaderOptions();
	$userHeader = mod004_userHeader();
	$divInsurrances = mod004_getInsurances();
    
	require ("View/view_insurance.php");
?>