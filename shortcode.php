<?php

	// Exit if accessed directly
	if ( ! defined( 'ABSPATH' ) )
		exit;
	
	if( !function_exists('dw_rim_shortcode') ) {
		function dw_rim_shortcode($atts = array(), $content = "") {
			$out = "";
			
			$vars = explode( "|", str_replace(' ', '', $atts['vars']) );
			
			$alt   = (empty($atts['alt']))   ? false : $atts['alt'];
			$title = (empty($atts['title'])) ? false : $atts['title'];
			
			// Create array of $size => $ID
			$pairs = array();
			foreach($vars as $pair) {
				if (strpos($pair, ":") !== false) {
					$key   = strtolower( explode(":", $pair)[0] );
					$value = strtolower( explode(":", $pair)[1] );
					
					$pairs[$key] = $value;
				}
			}
			
			// Sort the images from largest to smallest
			$cnt	 = count($pairs);
			$image   = 1; // Counter reference for last image
			$m	   = 0; // Minimum counter
			$ranks   = ["xl", "lg", "md", "sm", "xs"];
			$min	 = [1500, 1200, 992, 768, null];
			$sources = array();
			
			foreach($ranks as $size) {
				if( isset( $pairs[$size] ) ) {
					$sources[$size] = array('ID' => $pairs[$size], 'min' => $min[$m]);
				}
				$m++;
			}
			
			$out .= "<picture data-list='" . $atts['vars'] . "'>";
			
				foreach($sources as $size) {
					if( $image == $cnt ) {
						$out .= '<img src="'.wp_get_attachment_image_url($size['ID']).'" />';
					}
					else {
						$out .= '<source srcset="'.wp_get_attachment_image_url($size['ID']).'" media="(min-width: '.$size['min'].'px)" />';
					}
					$image++;
				}
				
			$out .= "</picture>";
			
			return $out;
		}
	}
	add_shortcode('picture', 'dw_rim_shortcode');
	