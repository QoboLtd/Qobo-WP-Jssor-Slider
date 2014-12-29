<?php
	
	global	$wpdb;
	$sql = "TRUNCATE TABLE " . JssorSliderPlugin::jssor_sliders();
	$wpdb->query($sql);

	$sql = "TRUNCATE TABLE " . JssorSliderPlugin::jssor_slides();
	$wpdb->query( $sql );
	
?>
