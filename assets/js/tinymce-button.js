// Bind the button
jQuery(document).ready(function($) {
	tinymce.PluginManager.add( 'dw-rim-tinymce', function(editor) { // , url
		var href 	= window.location.href,
			index 	= href.indexOf('/wp-admin'),
			homeUrl = href.substring(0, index);
		
		// Add Button to Visual Editor Toolbar
		editor.addButton('dw-rim-tinymce', {
			title	: dwrim.plugin_name,
			cmd		: 'dw-rim-tinymce',
			image	: homeUrl+'/wp-content/plugins/responsive-image-manager/assets/img/dw.png',
		});
		
		// Bind button
		editor.addCommand('dw-rim-tinymce', function() {
			// Open the box
			tinymce.activeEditor.windowManager.open({
				title: dwrim.plugin_name,
				width: 480,
				height: 465,
				body: {
					type: 'panel', // The root body type - a Panel or TabPanel
					items: [ // A list of panel components
						{
							type: 'container', // A HTML panel component
							html:
								"<p><em>"+dwrim.tinymce.displayed_image+"</em></p>"+
								'<table class="dw-rim-tinymce wp-list-table widefat striped table-view-list" style="width: 100%">'+
									'<thead>'+
										'<tr>'+
											'<th style="50px;">&nbsp;</th>'+
											'<th style="width: auto">'+dwrim.tinymce.details+'</th>'+
											'<th>'+dwrim.tinymce.preview+'</th>'+
										'</tr>'+
									'</thead>'+
									'<tbody>'+
										'<tr>'+
											'<td><a class="wp-menu-image dashicons-before dashicons-admin-media button button-primary"></a></td>'+
											'<td>'+dwrim.tinymce.screens.xs.label+'<br><small style="font-size: 80%;">'+dwrim.tinymce.screens.xs.description+'</small></td>'+
											'<td><input type="hidden" name="xs" value="" /><div class="image-preview"></div></td>'+
										'</tr>'+
										'<tr>'+
											'<td><a class="wp-menu-image dashicons-before dashicons-admin-media button button-primary"></a></td>'+
											'<td>'+dwrim.tinymce.screens.sm.label+'<br><small style="font-size: 80%;">'+dwrim.tinymce.screens.sm.description+'</small></td>'+
											'<td><input type="hidden" name="sm" value="" /><div class="image-preview"></div></td>'+
										'</tr>'+
										'<tr>'+
											'<td><a class="wp-menu-image dashicons-before dashicons-admin-media button button-primary"></a></td>'+
											'<td>'+dwrim.tinymce.screens.md.label+'<br><small style="font-size: 80%;">'+dwrim.tinymce.screens.md.description+'</small></td>'+
											'<td><input type="hidden" name="md" value="" /><div class="image-preview"></div></td>'+
										'</tr>'+
										'<tr>'+
											'<td><a class="wp-menu-image dashicons-before dashicons-admin-media button button-primary"></a></td>'+
											'<td>'+dwrim.tinymce.screens.lg.label+'<br><small style="font-size: 80%;">'+dwrim.tinymce.screens.lg.description+'</small></td>'+
											'<td><input type="hidden" name="lg" value="" /><div class="image-preview"></div></td>'+
										'</tr>'+
										'<tr>'+
											'<td><a class="wp-menu-image dashicons-before dashicons-admin-media button button-primary"></a></td>'+
											'<td>'+dwrim.tinymce.screens.xl.label+'<br><small style="font-size: 80%;">'+dwrim.tinymce.screens.xl.description+'</small></td>'+
											'<td><input type="hidden" name="xl" value="" /><div class="image-preview"></div></td>'+
										'</tr>'+
									'</tbody>'+
								'</table>'+
								''
						}
					]
				},
				onSubmit: function() {
					// Include the images
					var shortcode_string = '',
						images = [];
						
					if ( $('.dw-rim-tinymce [name="xs"]').val() != "" ) images.push( "xs:" + $('.dw-rim-tinymce [name="xs"]').val() );
					if ( $('.dw-rim-tinymce [name="sm"]').val() != "" ) images.push( "sm:" + $('.dw-rim-tinymce [name="sm"]').val() );
					if ( $('.dw-rim-tinymce [name="md"]').val() != "" ) images.push( "md:" + $('.dw-rim-tinymce [name="md"]').val() );
					if ( $('.dw-rim-tinymce [name="lg"]').val() != "" ) images.push( "lg:" + $('.dw-rim-tinymce [name="lg"]').val() );
					if ( $('.dw-rim-tinymce [name="xl"]').val() != "" ) images.push( "xl:" + $('.dw-rim-tinymce [name="xl"]').val() );
					
					shortcode_string += images.join("|");
					
					editor.execCommand('mceReplaceContent', false, "[picture "+ 'vars="' + shortcode_string + '"' +"]");
					
					// And we're done!
					editor.windowManager.close(editor);
					return false;
				}
			});
			
			// Bind the media button
			$('.dw-rim-tinymce .wp-menu-image').unbind('click').bind('click', function(){
				var e = $(this),
					t = e.closest('tr'),
					i = $('input[type="hidden"]', t);
					
				var gallery_window = wp.media({
					title		: dwrim.tinymce.modal.select_image,
					library		: {type: 'image'},
					multiple	: false,
					button		: { text : dwrim.tinymce.modal.add }
				});
				
				gallery_window.on('select', function(){
					var user_uselection = gallery_window.state().get('selection').first().toJSON();
					
					i.val( user_uselection.id );
					$('.image-preview', t).html( '<img src="'+user_uselection.url+'" />' );
				});
				
				gallery_window.open();
			});
			
			return;
		});
	});
});