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
				
				add_action( 'plugins_loaded', array( &$this, 'localization_load' ) );
			}
			
			/**
			 * Handles localization
			 */
			function localization_strings(){
				return require_once('languages/strings.php');
			}
			
			/**
			 * Loads localization
			 */
			function localization_load(){
				load_plugin_textdomain( 'dwrim', false, DW_RIM_DIR . '/languages/' );
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
				wp_register_script('dwrim-gutenberg', DW_RIM_URL . 'assets/js/gutenberg-block.js', array('wp-blocks','wp-editor'), false, true );
				wp_localize_script('dwrim-gutenberg', 'dwrim', $this->localization_strings());
				wp_enqueue_script('dwrim-gutenberg');
			}
		}
		
		$DW_RIM_GutenbergBlock = new DW_RIM_GutenbergBlock();
	}