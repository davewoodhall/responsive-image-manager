<?php
	
	// Exit if accessed directly
	if ( ! defined( 'ABSPATH' ) )
		exit;

	return array(
		'plugin_name' 		=> __('Responsive Image Manager', 'dwrim'),
		'gutenberg'			=> array(
			// Keeping this in case we want it later on
		),
		'tinymce'			=> array(
			'details' 			=> __('Details', 'dwrim'),
			'displayed_image'	=> __('The most appropriate image will be displayed.', 'dwrim'),
			'modal'			=> array(
				'add'				=> __('Add', 'dwrim'),
				'select_image'		=> __('Select an image', 'dwrim'),
			),
			'preview' 			=> __('Preview', 'dwrim'),
			'screens'			=> array(
				'xs'				=> array(
					'label'				=> __('Extra small screens', 'dwrim'),
					'description'		=> __('767px wide and less', 'dwrim'),
				),
				'sm'				=> array(
					'label'				=> __('Extra small screens', 'dwrim'),
					'description'		=> __('768px wide and up', 'dwrim'),
				),
				'md'				=> array(
					'label'				=> __('Extra small screens', 'dwrim'),
					'description'		=> __('992px wide and up', 'dwrim'),
				),
				'lg'				=> array(
					'label'				=> __('Extra small screens', 'dwrim'),
					'description'		=> __('1200px wide and up', 'dwrim'),
				),
				'xl'				=> array(
					'label'				=> __('Extra small screens', 'dwrim'),
					'description'		=> __('1500px wide and up', 'dwrim'),
				)
			),
		)
	);
