<?php
/*
 * Jssor Slider. Slideshow plugin for WordPress.
 * Plugin Name: Jssor Slider
 * Plugin URI:	http://www.phpcentre.net
 * Description: Easy to use slideshow plugin.
 * Version: 1.0
 * Author: PhP Centre
 * Author URI: phpcentre.net
 * License: GPL-2.0+
 * Copyright: 2014 PhP Centre
 * Text Domain: jssor_slider
 *
 */
 
	if ( ! defined( 'ABSPATH' ) ) {
		
		exit; // disable direct access
	}

	if( !defined( 'JSSORSLIDER_VERSION' ) ) define( 'JSSORSLIDER_VERSION', '1.0' );

	if ( !defined( 'JSSOR_CONTENT_DIR' ) ) define( 'JSSOR_CONTENT_DIR', ABSPATH . 'wp-content' );
	if ( !defined( 'JSSOR_MAIN_DIR' ) ) define( 'JSSOR_MAIN_DIR', wp_upload_dir()['basedir']. '/jssor-slider' );
	if ( !defined( 'JSSOR_MAIN_UPLOAD_DIR' ) ) define( 'JSSOR_MAIN_UPLOAD_DIR', JSSOR_MAIN_DIR . '/jssor-uploads/' );
	if ( !defined( 'JSSOR_MAIN_THUMB_DIR' ) ) define( 'JSSOR_MAIN_THUMB_DIR', JSSOR_MAIN_DIR.'/thumbs/' );
	if ( !defined( 'JSSOR_CONTENT_URL' ) )  define( 'JSSOR_CONTENT_URL', site_url() . '/wp-content' );
	if ( !defined( 'JSSOR_PLUGIN_DIR' ) ) define( 'JSSOR_PLUGIN_DIR', JSSOR_CONTENT_DIR . '/plugins' );
	if ( !defined( 'JSSOR_PLUGIN_URL' ) ) define( 'JSSOR_PLUGIN_URL', JSSOR_CONTENT_URL . '/plugins' );
	if ( !defined( 'JSSOR_SL_PLUGIN_FILENAME' ) ) define( 'JSSOR_SL_PLUGIN_FILENAME', basename(__FILE__) );
	if ( !defined( 'JSSOR_SL_PLUGIN_DIRNAME' ) ) define( 'JSSOR_SL_PLUGIN_DIRNAME', plugin_basename( dirname(__FILE__) ) );
	if ( !defined( 'JSSOR_SL_PLUGIN_DIR' ) ) define( 'JSSOR_SL_PLUGIN_DIR', JSSOR_PLUGIN_DIR . '/' . JSSOR_SL_PLUGIN_DIRNAME );
	if ( !defined( 'JSSOR_SL_PLUGIN_URL' ) ) define( 'JSSOR_SL_PLUGIN_URL', home_url().  plugin_dir_url( __FILE__ ) );
	if ( !defined( 'JSSOR_SLIDER_PATH' ) )  define( 'JSSOR_SLIDER_PATH', plugin_dir_path( __FILE__ ) );
	
	if ( !defined( 'JSSOR_SL_THUMB_URL' ) ) define( 'JSSOR_SL_THUMB_URL',  wp_upload_dir()['baseurl'].'/jssor-slider/jssor-uploads/' );
	if ( !defined( 'JSSOR_SL_THUMB_SMALL_URL') ) define( 'JSSOR_SL_THUMB_SMALL_URL', wp_upload_dir()['baseurl'].'/jssor-slider/thumbs/' );
	if ( !defined( 'jssor_slider' ) ) define( 'jssor_slider', 'jssor_slider' );


require_once ( JSSOR_SLIDER_PATH . '/lib/jssor-slider-class.php' );

	add_action( 'plugins_loaded', array( 'JssorSliderPlugin', 'run' ) );

	register_activation_hook( __FILE__, array( 'JssorSliderPlugin', 'plugin_install_script' ) );
	
	register_uninstall_hook( __FILE__, array( 'JssorSliderPlugin', 'plugin_uninstall_script' ) );
	
?>
