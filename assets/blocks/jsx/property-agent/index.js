import { registerBlockType } from '@wordpress/blocks';
import { useSelect } from '@wordpress/data';
import { useBlockProps } from '@wordpress/block-editor';
import { useEffect } from 'react';
import { SelectControl } from '@wordpress/components';
import { useEntityRecord } from '@wordpress/core-data';
import { useContext } from 'react';
import { __ } from '@wordpress/i18n';
import metadata from '../../../../inc/blocks/property-agent/block.json';

const slug = 'it-listings/property-agent';

const blockData = {
    icon: {
        src: <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><rect fill="none" height="24" width="24"/><path d="M21,6.5V14h-2V7.5L14,4L9,7.5V9H7V6.5l7-5L21,6.5z M15.5,7h-1v1h1V7z M13.5,7h-1v1h1V7z M15.5,9h-1v1h1V9z M13.5,9h-1v1h1V9 z M19,16h-2c0-1.2-0.75-2.28-1.87-2.7L8.97,11H1v11h6v-1.44l7,1.94l8-2.5v-1C22,17.34,20.66,16,19,16z M3,20v-7h2v7H3z M13.97,20.41 L7,18.48V13h1.61l5.82,2.17C14.77,15.3,15,15.63,15,16c0,0-1.99-0.05-2.3-0.15l-2.38-0.79l-0.63,1.9l2.38,0.79 c0.51,0.17,1.04,0.26,1.58,0.26H19c0.39,0,0.74,0.23,0.9,0.56L13.97,20.41z"/></svg>
    },
    edit: () => {
        
        return (
            <section {...useBlockProps({ className: "itre-editor-property-agent section" })}>
                <h2 className="itre-editor-property-agent__title">{__("Property Agent")}</h2>
                <p>{__('Agent Block for the agent associated with the property.')}</p>
                <br/>
                <p>The Block will show up once a Property is set in <a href='#itre_prop_meta'>Property Details.</a></p>
            </section>
        )
    },
    save: () => null,
    ...metadata
}

registerBlockType(slug, blockData);