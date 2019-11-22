wp.domReady( () => {
	wp.blocks.unregisterBlockStyle( 'core/button', 'default' );
	wp.blocks.unregisterBlockStyle( 'core/button', 'outline' );
	wp.blocks.unregisterBlockStyle( 'core/button', 'squared' );

	wp.blocks.registerBlockStyle( 'core/code', {
		name: 'default',
		label: 'Default',
		isDefault: true,
	});

	wp.blocks.registerBlockStyle( 'core/code', {
		name: 'wide',
		label: 'Wide',
	});

	wp.blocks.registerBlockStyle( 'core/table', {
		name: 'plugin-audit',
		label: 'Plugin Audit',
	});

	wp.blocks.registerBlockStyle( 'core/list', {
		name: 'alpha',
		label: 'Lower Alpha',
	});
} );
