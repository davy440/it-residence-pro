const addSliderAtts = ( settings, name ) => {
    if ( name !== 'core/gallery' ) {
        return settings;
    }
    settings.attributes = {...settings.attributes, numberOfSlides: 3};
    return settings;
}

wp.hooks.addFilter(
    'blocks.registerBlockType',
    'itre/addSliderAtts/gallery-block',
    addSliderAtts
);

const addSliderControls = (BlockEdit) => {
    const { createHigherOrderComponent } = wp.compose;
    const { InspectorControls } = wp.blockEditor;
    const { Panel, PanelBody, PanelRow } = wp.components;
    
    return (props) => {
        const { isSelected } = props;
        return (
            <>
            <BlockEdit {...props}/>
            {isSelected &&
            (props.name === 'core/gallery') &&
            (props.attributes.className === 'is-style-slider') &&
            <InspectorControls group="styles">
                <Panel children={children}>
                    {console.log(children)}
                    <PanelBody>
                        <PanelRow header="Slider Options">
                            <h3>Slider Options</h3>
                        </PanelRow>
                    </PanelBody>
                </Panel>
            </InspectorControls>
            }
            </>
        )
    }

}
wp.hooks.addFilter(
    'editor.BlockEdit',
    'itre/addSliderControls/gallery-block',
    addSliderControls
);


// function getBlockStyle( attributes, setting, content, controls ) {

//     if ( setting.name === 'core/gallery') {
//         console.log(setting)
//         return attributes;
//     }
//     return attributes;
// }
// wp.hooks.addFilter(
//     'blocks.getBlockAttributes',
//     'itre/checkBlockStyle/gallery-block',
//     getBlockStyle
// )