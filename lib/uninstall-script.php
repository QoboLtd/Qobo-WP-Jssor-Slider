<?php
	
	global	$wpdb;

	$sql = "DROP TABLE " . JssorSliderPlugin::jssor_sliders();
	$wpdb->query( $sql );

	$sql = "DROP TABLE " . JssorSliderPlugin::jssor_slides();
	$wpdb->query( $sql );

	/* delete folder */
	rmdirr( JSSOR_MAIN_DIR );
	
	function rmdirr( $dirname ){

		if( !file_exists( $dirname ) ) {
			return false;
		}

		
		if( is_file( $dirname ) ) {
			return unlink( $dirname );
		}

		/* Loop through the folder */
		$dir = dir( $dirname );
		while( false !== $entry = $dir->read() ) {
			/*Skip	pointers */
			if( $entry == '.' || $entry == '..' ) {
				continue;
			}

			/* Recurse */
			rmdirr( "$dirname/$entry" );
		}

		/* Clean up */
		$dir->close();
		return rmdir( $dirname );
		
	}

?>
