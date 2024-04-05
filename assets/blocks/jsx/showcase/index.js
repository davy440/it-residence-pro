/**
 * WordPress dependencies
 */
import { getBlockType, registerBlockType, unregisterBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';
import { useSelect, select, subscribe, dispatch } from '@wordpress/data';
import { createContext } from 'react';
import { TextControl } from '@wordpress/components';
import Section from './section';
import { __ } from '@wordpress/i18n';
import metadata from '../../../../inc/blocks/showcase/block.json';

let registered = false;
const slug = 'it-listings/showcase';
export const attsContext = createContext();

const blockData = {
    icon: {
        src: <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><title>grid_view_black_24dp</title><rect width="24" height="24" fill="none"/><path d="M3,3v8h8V3ZM9,9H5V5H9ZM3,13v8h8V13Zm6,6H5V15H9ZM13,3v8h8V3Zm6,6H15V5h4Zm-6,4v8h8V13Zm6,6H15V15h4Z"/></svg>
    },
    edit: ( props ) => {
        const { attributes, setAttributes } = props;
        const { sections } = attributes;
        const images = useSelect(select => {
            const imgData = sections.map((item, index) => {
                const image = item.mediaId !== 0 ? select('core').getMedia(item.mediaId) : '';
                return item = {order: index + 1, image};
            });
            return imgData;
        });

        return (
            <section {...useBlockProps({ className: "itre-editor-showcase section" })}>
                <h2>{__("Showcase")}</h2>
                <div className="itre-editor-showcase__title">
                    <p>
                        <TextControl
                            label="Title"
                            value={ attributes.title }
                            onChange={value => setAttributes({title: value})}
                        />
                    </p>
                </div>

                <div className="itre-editor-showcase__sections">
                    <attsContext.Provider value={{attributes, setAttributes}}>
                        {attributes['sections'].map((section, index) => (
                            <Section count={section.order} image={images[index]} />
                        ))}
                    </attsContext.Provider>
                </div>
            </section>
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