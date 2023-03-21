<?php

	/**
	 * Plugin Name: 	Responsive Image Manager
	 * Plugin URI:  	https://davewoodhall.com
	 * Description: 	Adds a shortcode to add <code>&lt;picture></code> with a Gutenberg Block and a TinyMCE button.
	 * 
	 * Version:	 		0.0.2
	 * Author:	  		Dave Woodhall, Eric Girouard
	 * Author URI:  	https://github.com/davewoodhall
	 *
	 * Requires at least: 5.2
	 * 
	 * Text Domain: 	dwrim
	 * Domain Path: 	/languages/
	 * License:	 		GPL v3
	 */
	
	// Exit if accessed directly
	if ( ! defined( 'ABSPATH' ) )
		exit;
		
	define( 'DW_RIM_DIR', untrailingslashit( dirname( __FILE__ ) ) ); // URL-path/
	define( 'DW_RIM_URL', plugin_dir_url(__FILE__) );				  // URL-path/
	
	require_once('shortcode.php');
	
	require_once('tinymce-button.php');
	require_once('gutenberg-block.php');
