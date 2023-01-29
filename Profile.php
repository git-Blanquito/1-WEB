<?php	
	session_start();
    require ("Lib/mod004_FormatHTML.php");


	$userOpctions = mod004_userHeaderOptions();
	$userHeader = mod004_userHeader();
	$userProfile = mod004_getProfile();

	require ("View/view_Profile.php");
?>