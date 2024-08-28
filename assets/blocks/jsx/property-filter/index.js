import { useEffect } from 'react';
import { getBlockType, registerBlockType, unregisterBlockType } from '@wordpress/blocks';
import {__} from '@wordpress/i18n';
import { select, subscribe, dispatch } from '@wordpress/data';
import { useBlockProps } from '@wordpress/block-editor';
import { SelectControl, TextControl } from '@wordpress/components';
import metadata from '../../../../inc/blocks/property-filter/block.json';

let registered = false;
const slug = 'it-listings/property-filter';
 
const blockData = {
    icon: {
        src: <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#5f6368"><g><path d="M0,0h24 M24,24H0" fill="none"/><path d="M7,6h10l-5.01,6.3L7,6z M4.25,5.61C6.27,8.2,10,13,10,13v6c0,0.55,0.45,1,1,1h2c0.55,0,1-0.45,1-1v-6 c0,0,3.72-4.8,5.74-7.39C20.25,4.95,19.78,4,18.95,4H5.04C4.21,4,3.74,4.95,4.25,5.61z"/><path d="M0,0h24v24H0V0z" fill="none"/></g></svg>
    },
    edit: (props) =>  {
        const {attributes, setAttributes} = props;
        const { filterby: filters, count } = attributes;
        const { id } = useBlockProps();

        useEffect(() => {
            setAttributes({blockId: id})
        }, []);

        return (
            <>
            <section {...useBlockProps({ className: "itre-editor-property-filter section" })}>
                <p>
                <h2>{__("Property Filter")}</h2>
                <SelectControl
                    label={__("Filter by")}
                    value={[...filters]}
                    multiple
                    options={[
                        { label: 'Type', value: 'type'},
                        { label: 'Location', value: 'location'},
                        { label: 'Status', value: 'status'},
                        { label: 'Bedrooms', value: 'bedrooms'},
                        { label: 'Price', value: 'price'},
                        { label: 'Area', value: 'area'}
                    ]}
                    onChange={newFilters => {
                       return  setAttributes({filterby: [...newFilters]})
                    }}
                />
                </p>

                <p>
                <TextControl
                    label={__("Number of Posts")}
                    type="number"
                    onChange={newCount => setAttributes({count: newCount})}
                    value={ count }
                />
                </p>
            </section>
            </>
        )
    },
    save: () => null,
    ...metadata
}
registerBlockType(slug, blockData);

// Subscribe to State Changes
subscribe(() => {
    const blocks = select('core/block-editor').getBlocks();

    if (!select('core/editor')) {
        return;
    }
    const template = select('core/editor').getEditedPostAttribute('template');
    
    if (!template) {
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