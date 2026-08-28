// Add the custom 'reverseOnMobile' attribute to the core/columns block
function addCoverAttribute(settings, name) {
	if (typeof settings.attributes !== 'undefined') {
		if (name === 'core/columns') {
			settings.attributes = Object.assign(settings.attributes, {
				reverseOnMobile: {
					type: 'boolean',
					default: false,
				}
			});
		}
	}
	return settings;
}

wp.hooks.addFilter(
	'blocks.registerBlockType',
	'awp/cover-custom-attribute',
	addCoverAttribute
);

// Add custom toggle to the InspectorControls for 'core/columns'
const coverSettingsControls = wp.compose.createHigherOrderComponent((BlockEdit) => {
	return (props) => {
		const { Fragment } = wp.element;
		const { ToggleControl } = wp.components;
		const { InspectorControls } = wp.blockEditor;
		const { attributes, setAttributes, isSelected, name } = props;

		return (
			<Fragment>
				<BlockEdit {...props} />
				{isSelected && name === 'core/columns' && (
					<InspectorControls>
						<div className="components-panel__body is-opened">
							<ToggleControl
								label={wp.i18n.__('Reverse on mobile?', 'awp')}
								checked={!!attributes.reverseOnMobile}
								onChange={() =>
									setAttributes({ reverseOnMobile: !attributes.reverseOnMobile })
								}
							/>
						</div>
					</InspectorControls>
				)}
			</Fragment>
		);
	};
}, 'coverSettingsControls');

wp.hooks.addFilter(
	'editor.BlockEdit',
	'awp/cover-settings-control',
	coverSettingsControls
);

// Apply the 'reverse-on-mobile' class if enabled
function coverApplyExtraClass(extraProps, blockType, attributes) {
	const { reverseOnMobile } = attributes;

	if (reverseOnMobile) {
		extraProps.className = (extraProps.className || '') + ' reverse-on-mobile';
	}

	return extraProps;
}

wp.hooks.addFilter(
	'blocks.getSaveContent.extraProps',
	'awp/cover-apply-class',
	coverApplyExtraClass
);
