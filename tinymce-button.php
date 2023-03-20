<?php

	// Exit if accessed directly
	if ( ! defined( 'ABSPATH' ) )
		exit;
	
	// Stop now if the Classic Editor plugin is not loaded.
	if( !class_exists('Classic_Editor') )
		return;
	
	if( !class_exists('DW_RIM_TinyMCE') ) {
		class DW_RIM_TinyMCE {
			function __construct(){
				add_action( 'init', array($this, 'init_TinyMCE_Editor') );
				add_action('admin_enqueue_scripts', array($this, 'load_admin_styles'));
			}
			
			/**
			 * Extends the TinyMCE Editor
			 */
			function init_TinyMCE_Editor() {
				if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) )
					return;
				
				if ( get_user_option( 'rich_editing' ) !== 'true' )
					return;
				
				add_filter( 'mce_external_plugins', array($this, 'include_tinyMCE_editor_scripts') );
				add_filter( 'mce_buttons', array($this, 'register_TinyMCE_editor') );
				
				add_action('wp_footer', array($this, 'dw_rim_tinymce_footer'));
			}
			
			function dw_rim_tinymce_footer(){
				?>
					<script>
						window.dw_rim_tinymce = '<?php echo DW_RIM_URL; ?>assets/tinymce/tinymce-window.html';
					</script>
				<?php
			}
			
			/**
			 * Includes the TinyMCE Editor button JavaScript
			 */
			function include_tinyMCE_editor_scripts( $plugin_array ) {
				$plugin_array['dw-rim-tinymce'] = DW_RIM_URL.'assets/js/tinymce-button.js'; // get_stylesheet_directory_uri().'/assets/js/tinymce_buttons.js';
				return $plugin_array;
			}
			
			/**
			 * Loads a stylesheet for the TinyMCE Buttons
			 */
			function load_admin_styles(){
				wp_enqueue_style(  'dw-rim-tinymce-styles', DW_RIM_URL.'assets/css/style.css' );
			}
			
			/**
			 * Registers TinyMCE Editor button
			 */
			function register_TinyMCE_editor( $buttons ) {
				array_push( $buttons, 'dw-rim-tinymce' );
				return $buttons;
			}
		}
		
		$DW_RIM_TinyMCE = new DW_RIM_TinyMCE();
	}