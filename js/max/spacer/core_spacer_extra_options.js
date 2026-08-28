function addSpacerAttributes(settings, name) {
	if (typeof settings.attributes !== 'undefined') {
		if (name == 'core/spacer') {
			settings.attributes = Object.assign(settings.attributes, {
				backgroundColor: {
					type: 'string',
				},
				customBackgroundColor: {
					type: 'string'
				}
			});
		}
	}
	return settings;
}
 
wp.hooks.addFilter(
	'blocks.registerBlockType',
	'awp/spacer-background-attribute',
	addSpacerAttributes
);

const spacerInspectorControls = wp.compose.compose(
    wp.blockEditor.withColors({ backgroundColor: 'background-color' }),

    wp.compose.createHigherOrderComponent((BlockEdit) => {
        return (props) => {

            if (props.name !== 'core/spacer') {
                return (<BlockEdit {...props} />);
            }

            const { Fragment } = wp.element;
            const { InspectorControls, PanelColorSettings } = wp.blockEditor;
            const { attributes, setAttributes, isSelected } = props;
            const { backgroundColor, setBackgroundColor } = props;

            let newClassName = (attributes.className != undefined) ? attributes.className : '';
            let newStyles = { ...props.style };

            if (backgroundColor != undefined) {
                if (backgroundColor.class == undefined) {
                    newStyles.backgroundColor = backgroundColor.color;
                } else {
                    // Update className with 'bg-' instead of using direct backgroundColor class
                    newClassName += ' bg-' + backgroundColor.class;
                }
            }

            const handleClearColor = () => {
                setBackgroundColor(undefined);
                setAttributes({ customBackgroundColor: undefined });
            };

            const newProps = {
                ...props,
                attributes: {
                    ...attributes,
                    className: newClassName
                },
                style: newStyles
            }

            return (
                <Fragment>
                    <div style={newStyles} className={newClassName}>
                        <BlockEdit {...newProps} />
                        {isSelected && (props.name == 'core/spacer') && 
                            <InspectorControls>
                                <PanelColorSettings 
                                    title={wp.i18n.__('Color Settings', 'awp')}
                                    colorSettings={[
                                        {
                                            value: backgroundColor.color,
                                            onChange: setBackgroundColor,
                                            label: wp.i18n.__('Background color', 'awp')
                                        }
                                    ]}
                                />
                                {/* Clear Color Button */}
                                <div class="px-3 pb-3">
                                    <button 
                                        type="button" 
                                        onClick={handleClearColor}
                                        className="components-button is-link">
                                        {wp.i18n.__('Clear Color', 'awp')}
                                    </button>
                                </div>
                            </InspectorControls>
                        }
                    </div>
                </Fragment>
            );
        };
    }, 'spacerInspectorControls')
);

 
wp.hooks.addFilter(
	'editor.BlockEdit',
	'awp/spacer-inspector-control',
	spacerInspectorControls
);

function applySpacerBackground(props, blockType, attributes) {
    if (blockType.name == 'core/spacer') {
        const { backgroundColor, customBackgroundColor } = attributes;

        // For improved class name handling, use classnames library or handle manually.
        let className = (props.className != undefined) ? props.className : '';
        
        if (backgroundColor != undefined) {
            // Change here: using 'bg-' + backgroundColor to 'bg-backgroundColor'
            className += ' bg-' + backgroundColor;
        }

        props.className = className;

        // If customBackgroundColor exists, apply it inline as a style.
        if (customBackgroundColor != undefined) {
            Object.assign(props, { style: { ...props.style, backgroundColor: customBackgroundColor }});
        }
    }
    return props;
}

wp.hooks.addFilter(
    'blocks.getSaveContent.extraProps',
    'awp/spacer-apply-class',
    applySpacerBackground
);
