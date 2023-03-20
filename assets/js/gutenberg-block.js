(function(){
	const { 
		MediaUpload
	} = wp.editor;

	const blockConfig = {
		title: 'Responsive Image Manager',
		icon: 'smiley',
		category: 'media',
		attributes: {
			xsID	: { type: 'number', default: 0 },
			smID	: { type: 'number', default: 0 },
			mdID	: { type: 'number', default: 0 },
			lgID	: { type: 'number', default: 0 },
			xlID	: { type: 'number', default: 0 },
			
			xs		: { type: 'string', default: '' },
			sm		: { type: 'string', default: '' },
			md		: { type: 'string', default: '' },
			lg		: { type: 'string', default: '' },
			xl		: { type: 'string', default: '' },
		//	alt   : { type: 'string', default: '' },
		//	title : { type: 'string', default: '' }
		},
		
		// Editing the <picture> tag
		edit(props) {
			function selectImageXS(value) {
				props.setAttributes({ xsID: value.id });
				props.setAttributes({ xs: value.sizes.full.url });
			}
			function selectImageSM(value) {
				props.setAttributes({ smID: value.id });
				props.setAttributes({ sm: value.sizes.full.url });
			}
			function selectImageMD(value) {
				props.setAttributes({ mdID: value.id });
				props.setAttributes({ md: value.sizes.full.url });
			}
			function selectImageLG(value) {
				props.setAttributes({ lgID: value.id });
				props.setAttributes({ lg: value.sizes.full.url });
			}
			function selectImageXL(value) {
				props.setAttributes({ xlID: value.id });
				props.setAttributes({ xl: value.sizes.full.url });
			}

			return wp.element.createElement(
				'div',
				{ className: props.className },
				[
					// xs
					wp.element.createElement(
						MediaUpload,
						{
							onSelect: selectImageXS,
							render(renderProps) {
								return wp.element.createElement(
									'button',
									{ className: 'btn-xs', onClick: renderProps.open, },
									wp.element.createElement( 'img', { src: props.attributes.xs, }, null )
								);
							}
						},
						null
					), // end xs
					// sm
					wp.element.createElement(
						MediaUpload,
						{
							onSelect: selectImageSM,
							render(renderProps) {
								return wp.element.createElement(
									'button',
									{ className: 'btn-sm', onClick: renderProps.open, },
									wp.element.createElement( 'img', { src: props.attributes.sm, }, null )
								);
							}
						},
						null
					), // end sm
					// md
					wp.element.createElement(
						MediaUpload,
						{
							onSelect: selectImageMD,
							render(renderProps) {
								return wp.element.createElement(
									'button',
									{ className: 'btn-md', onClick: renderProps.open, },
									wp.element.createElement( 'img', { src: props.attributes.md, }, null )
								);
							}
						},
						null
					), // end md
					// lg
					wp.element.createElement(
						MediaUpload,
						{
							onSelect: selectImageLG,
							render(renderProps) {
								return wp.element.createElement(
									'button',
									{ className: 'btn-lg', onClick: renderProps.open, },
									wp.element.createElement( 'img', { src: props.attributes.lg, }, null )
								);
							}
						},
						null
					), // end lg
					// xl
					wp.element.createElement(
						MediaUpload,
						{
							onSelect: selectImageXL,
							render(renderProps) {
								return wp.element.createElement(
									'button',
									{ className: 'btn-xl', onClick: renderProps.open, },
									wp.element.createElement( 'img', { src: props.attributes.xl, }, null )
								);
							}
						},
						null
					), // end xl
				]
			);
		},
		
		// Saving the <picture> tag
		save(props) {
			var ranks = ["xl", "lg", "md", "sm", "xs"],
				vars  = [];
			
			// List the requested sources
			for (var rank=0; rank<ranks.length;rank++) {
				var size  = ranks[rank];
				
				if (props.attributes[size] != '') {
					vars.push( size+':'+props.attributes[size+'ID'] );
				}
			}
			
			// Save the shortcode
			return wp.element.createElement('div', null, '[picture vars="'+vars.join('|')+'"]');
		}
	};
	
	wp.blocks.registerBlockType('dwrim/gutenberg', blockConfig);
})();