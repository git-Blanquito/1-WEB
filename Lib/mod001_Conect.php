<?php
    function mod001_conectBD () 
    {
        $direction = "localhost";
        $user      = "root";
        $pastword  = "";
        $database  = "Proyectov1";

        $link = mysqli_connect($direction, $user, $pastword, $database);

        if ( !$link ) {
			echo "Conexion fallida";
		} 
		
		return $link;
	}

	function mod001_disconectBDD ( $link ) {
        mysqli_close( $link );
	}
?>