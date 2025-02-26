<?php
	if(defined('MOORE_URL') 	== false) 	define('MOORE_URL', get_template_directory());
	if(defined('MOORE_URI') 	== false) 	define('MOORE_URI', get_template_directory_uri());

	load_theme_textdomain( 'moore', MOORE_URL . '/languages' );

	// Main Feature
	require_once( MOORE_URL.'/inc/class-main.php' );

	// Functions
	require_once( MOORE_URL.'/inc/functions.php' );

	// Hooks
	require_once( MOORE_URL.'/inc/class-hook.php' );

	// Widget
	require_once (MOORE_URL.'/inc/class-widgets.php');

	// CMB2
	require_once (MOORE_URL.'/inc/class-cmb2-customize.php');
	
	// Ajax
	require_once (MOORE_URL.'/inc/class-ajax.php');
    require_once (MOORE_URL.'/inc/class-ajax-filter.php');
	// Elementor
	if (defined('ELEMENTOR_VERSION')) {
		require_once (MOORE_URL.'/inc/class-elementor.php');
	}
	
	// WooCommerce
	if (class_exists('WooCommerce')) {
		require_once (MOORE_URL.'/inc/class-woo.php');	
	}
	
	
	/* Customize */
	if( current_user_can('customize') ){
	    require_once MOORE_URL.'/customize/custom-control/google-font.php';
	    require_once MOORE_URL.'/customize/custom-control/heading.php';
	    require_once MOORE_URL.'/inc/class-customize.php';
	}
    
   
	require_once ( MOORE_URL.'/install-resource/active-plugins.php' );