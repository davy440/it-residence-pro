import { getBlockType, registerBlockType, unregisterBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import { createContext } from 'react';
import { subscribe, select, dispatch } from '@wordpress/data';
import { SelectControl, TextControl, CheckboxControl } from '@wordpress/components';
import TypesSelect from './types-select';
import LocationsSelect from './locations-select';
import metadata from '../../../../inc/blocks/featured-tabs/block.json';

let registered = false;
const slug = 'it-listings/featured-tabs';
export const attsContext = createContext();

const blockData = {
    icon: {
        src: <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0zm0 0h24v24H0V0z" fill="none"/><path d="M21 3H3c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H3V5h10v4h8v10z"/></svg>
    },
    edit: ({ attributes, setAttributes }) => {
        const { all, title, taxonomy } = attributes;
        return (
            
            <section {...useBlockProps({className: 'itre-editor-featured-tabs'})}>
                <h2>{__("Featured Tabs")}</h2>
                <p>
                    <CheckboxControl 
                        label={__("Include 'All' Tab")}
                        checked={ all }
                        onChange={() => setAttributes({all: !all})}
                    />
                </p>

                <p>
                    <TextControl
                        label={__("Title")}
                        value={title}
                        onChange={value => setAttributes({title: value})}
                    />
                </p>

                <attsContext.Provider value={{ attributes, setAttributes }}>
                    <SelectControl
                        label={__("Tabs to Show")}
                        value={taxonomy}
                        onChange={(value) => setAttributes({ taxonomy: value })}
                    >
                        <option value="">{__("— Select —")}</option>
                        <option value="property-type">{__("Property Type")}</option>
                        <option value="location">{__("Location")}</option>
                    </SelectControl>
                    {
                        taxonomy === 'property-type' &&
                        <TypesSelect />
                    }
                    {
                        taxonomy === 'location' &&
                        <LocationsSelect />
                    }
                </attsContext.Provider>
            </section>
            
        )
    },
    save: () => null,
    ...metadata
};
registerBlockType(slug, blockData);

// Subscribe to State Changes
subscribe(() => {
    const blocks = select('core/block-editor').getBlocks();

    if (!select('core/editor')) {
        return;
    }
    
    const template = select('core/editor').getEditedPostAttribute('template');
    
    if (template === undefined) {
        return;
    }

    if (template === 'template-property-listings.php' && registered === false) {
        registered = true;
        if (getBlockType(slug)) {
            return;
        }
        registerBlockType(slug, blockData);
    }
    
    if (template !== 'template-property-listings.php') {

        if (blocks.length !== 0) {
            const filteredBlocks = blocks.filter(block => block.name === slug);
            filteredBlocks.forEach( block => {
                const { clientId } = block;
                dispatch('core/editor').removeBlock(clientId);
            });
        }
        
        if (getBlockType(slug)) {
            unregisterBlockType(slug);
            registered = false;
        }
    }
});