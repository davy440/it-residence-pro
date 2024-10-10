import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';
import { useEntityProp } from '@wordpress/core-data';
import { __ } from '@wordpress/i18n';
import metadata from '../../../../inc/blocks/walk-score/block.json';

const slug = 'it-listings/walk-score';

const blockData = {
    icon: {
        src: <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M13.5 5.5c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zM9.8 8.9L7 23h2.1l1.8-8 2.1 2v6h2v-7.5l-2.1-2 .6-3C14.8 12 16.8 13 19 13v-2c-1.9 0-3.5-1-4.3-2.4l-1-1.6c-.56-.89-1.68-1.25-2.65-.84L6 8.3V13h2V9.6l1.8-.7"/></svg>
    },
    edit: ({attributes, setAttributes, context: {postId, postType}}) => {

        return (
            <section {...useBlockProps({ className: "itre-editor-walk-score section" })}>
                <h2 className="itre-editor-walk-score__title">{__("Walk Score")}</h2>
                <p>{__("Feature only available in United States and Canada.")}</p>
                <p>{__('In order to show the walk score, make sure address is properly entered in Property Options.')}</p>
            </section>
        )
    },
    save: () => null,
    ...metadata
}

registerBlockType(slug, blockData);