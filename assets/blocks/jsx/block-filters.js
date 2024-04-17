import { createHigherOrderComponent, compose } from '@wordpress/compose';
import { InspectorControls } from '@wordpress/blockEditor';
import { PanelBody, PanelRow, __experimentalNumberControl as NumberControl } from '@wordpress/components';

const addSliderAtts = ( settings, name ) => {
    if ( name !== 'core/gallery' ) {
        return settings;
    }
    settings.attributes = {...settings.attributes, numberOfSlides: {'default': 3, type: 'number'}};
    return settings;
}

wp.hooks.addFilter(
    'blocks.registerBlockType',
    'itre/addSliderAtts/gallery-block',
    addSliderAtts
);

const addSliderControls = createHigherOrderComponent((BlockEdit) => {
    return (props) => {
        const { isSelected, attributes, setAttributes } = props;
        const { numberOfSlides } = attributes;
        console.log(attributes);
        const onChangeSlides = (newVal) => {
            setAttributes({...attributes, numberOfSlides: newVal, className: `is-style-slider slides-${newVal}`})
        }

        return (
            <>
            <BlockEdit {...props}/>
            {isSelected &&
            (props.name === 'core/gallery') &&
            (props.attributes.className === 'is-style-slider') &&
            <InspectorControls group="styles">
                <PanelBody>
                    <PanelRow>
                        <h3>Slider Options</h3>
                    </PanelRow>
                    <PanelRow>
                        <NumberControl
                            label="Number of Slides"
                            value={numberOfSlides}
                            onChange={(newSlides) => onChangeSlides(newSlides)}
                            min="1"
                            max="5"
                        />
                    </PanelRow>
                </PanelBody>
            </InspectorControls>
            }
            </>
        )
    }

}, 'addSliderControls');

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