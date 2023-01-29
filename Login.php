<?php
    session_start();
	require ("Lib/mod004_FormatHTML.php");
	
	if ( isset( $_POST[ "email" ], $_POST[ "password" ] ) ) {
        $email      = $_POST[ "email" ];
        $password   = $_POST[ "password" ];
        mod003_validateUser( $email, $password );
    } else {
       
    }
	

?>