import { registerBlockType } from '@wordpress/blocks';
import { SelectControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';
import metadata from '../../../../inc/blocks/featured-property/block.json';

const slug = 'it-listings/featured-property';

const blockData = {
    icon: {
        src: <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><g><rect fill="none" height="24" width="24"/></g><g><g><path d="M1,11v10h6v-5h2v5h6V11L8,6L1,11z M13,19h-2v-5H5v5H3v-6.97l5-3.57l5,3.57V19z"/><rect height="2" width="2" x="17" y="7"/><rect height="2" width="2" x="17" y="11"/><rect height="2" width="2" x="17" y="15"/><polygon points="10,3 10,4.97 12,6.4 12,5 21,5 21,19 17,19 17,21 23,21 23,3"/></g></g></svg>
    },
    
    edit: (props) => {
        const { attributes, setAttributes } = props;
        const { property } = attributes;

        const allProps = useSelect(select => (
            select('core').getEntityRecords('postType', 'property', {per_page: -1})
        ), []);
        
        return (
            <section {...useBlockProps({className: "itre-editor-featured-property section"})}>
                <h2>{__("Featured Property")}</h2>
                <SelectControl
                    value={ property }
                    onChange={value => {
                        setAttributes({ property: parseInt(value) })
                    }}
                >
                    <option value={0}>{__("Select a Property")}</option>
                    {
                        allProps !== null &&
                        allProps.map(item => {
                            return <option value={item.id}>{item.title.raw}</option>
                        })
                    }

                </SelectControl>
            </section>
        )
    },
    save: () => null,
    ...metadata
}
registerBlockType(slug, blockData);