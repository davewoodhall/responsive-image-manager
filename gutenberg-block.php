<?php

	// Exit if accessed directly
	if ( ! defined( 'ABSPATH' ) )
		exit;
	
	// Stop now if the Classic Editor plugin is not loaded.
	if( class_exists('Classic_Editor') )
		return;
	
	if( !class_exists('DW_RIM_GutenbergBlock') ) {
		class DW_RIM_GutenbergBlock {
			/**
			 * Constructor
			 */
			function __construct(){
				add_action( 'enqueue_block_editor_assets', array($this, 'register_block') );
				add_action( 'admin_enqueue_scripts', array($this, 'register_admin_styles') );
			}
			
			/**
			 * Registers the block dashboard stylesheet
			 */
			function register_admin_styles(){
				wp_enqueue_style(
					'dwrim-gutenberg',
					DW_RIM_URL . 'assets/css/gutenberg-admin-styles.css'
				);
			}
			
			/**
			 * Registers the block javascript
			 */
			function register_block() {
				wp_enqueue_script(
					'dwrim/gutenberg',
					DW_RIM_URL . 'assets/js/gutenberg-block.js',
					array('wp-blocks','wp-editor'),
					true
				);
			}
		}
		
		$DW_RIM_GutenbergBlock = new DW_RIM_GutenbergBlock();
	}