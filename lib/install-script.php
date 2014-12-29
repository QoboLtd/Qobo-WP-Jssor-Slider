<?php
	
	global	$wpdb;
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	
	if ( !is_dir(JSSOR_MAIN_DIR ) ) {

		wp_mkdir_p( JSSOR_MAIN_DIR );
	}

	if ( !is_dir( JSSOR_MAIN_UPLOAD_DIR ) ) {

		wp_mkdir_p(JSSOR_MAIN_UPLOAD_DIR);
	}

	if( !is_dir( JSSOR_MAIN_THUMB_DIR ) ) {

		wp_mkdir_p( JSSOR_MAIN_THUMB_DIR );
	}
	
	
	
	if ( count( $wpdb->get_var( "SHOW TABLES LIKE '" . JssorSliderPlugin::jssor_sliders() . "'" ) ) == 0 ) {
		
		create_table_sliders();
	}
	
	if ( count( $wpdb->get_var( "SHOW TABLES LIKE '" . JssorSliderPlugin::jssor_slides() . "'" ) ) == 0 ) {
		
		create_table_slides();
	}

	function create_table_sliders(){
		
		$sql = "CREATE TABLE " . JssorSliderPlugin::jssor_sliders() . "(
					slider_id INTEGER(10)	UNSIGNED NOT NULL AUTO_INCREMENT,
					slider_name	VARCHAR(100),
					author	VARCHAR(100),
					slider_date	DATE,
					slider_order INTEGER(10),
					slider_settings	LONGTEXT,
					PRIMARY	KEY	(slider_id)
				)	ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE	utf8_general_ci";
	
		dbDelta( $sql );
		
	}
	
	function create_table_slides(){
		
		$sql = "CREATE TABLE " . JssorSliderPlugin::jssor_slides() . "(
					slide_id INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
					slider_id INTEGER(10) UNSIGNED NOT NULL,
					title TEXT,
					description	TEXT,
					thumbnail_url TEXT NOT NULL,
					sorting_order INTEGER(20),
					date DATE,
					url	VARCHAR(250),
					slide_name TEXT NOT NULL,
					caption_in TEXT,
					caption_out	TEXT,
					description_in	TEXT,
					description_out	TEXT,
					slide_trans	TEXT,
					PRIMARY KEY (slide_id)
				)	ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci";
			
		dbDelta( $sql );
		
	}
?>
