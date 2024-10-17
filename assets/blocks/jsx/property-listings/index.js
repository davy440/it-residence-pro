import { createContext } from 'react';
import { registerBlockType } from '@wordpress/blocks';
import {__} from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import {
    RadioControl,
    Flex,
    FlexItem
} from '@wordpress/components';
import { SelectLocation } from './select-location';
import SelectPropType from './select-type';
import metadata from '../../../../inc/blocks/property-listings/block.json';

export const attsContext = createContext();

const slug = 'it-listings/property-listings';

const blockData = {
    icon: {
        src: <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z"/></svg>
    },
    edit:({attributes, setAttributes}) => {
        const { filter } = attributes;
        
        return (
            <section {...useBlockProps({className: 'itre-properties-editor'})}>
                <h3>{__('Properties')}</h3>
                <Flex
                    style={{alignItems: 'flex-start'}}
                >
                    <FlexItem
                        style={{width: '50%'}}
                    >
                    <p>
                        <RadioControl
                            label={__('Select Properties to Show')}
                            selected={filter}
                            onChange={newVal => setAttributes({filter: newVal})}
                            options={[
                                {label: __('All'), value: 'all'},
                                {label: __('Based on Property Type'),  value: 'type'},
                                {label: __('Based on Location'), value: 'location'}
                            ]}
                        />
                    </p>
                    </FlexItem>

                    <FlexItem
                        style={{width: '50%'}}
                    >
                        <attsContext.Provider value={{attributes, setAttributes}}>
                            {filter === 'location' &&
                                <SelectLocation />
                            }

                            {filter === 'type' &&
                                <SelectPropType />
                            }
                        </attsContext.Provider>
                    </FlexItem>
                </Flex>

            </section>
        );
    },
    save: () => null,
    ...metadata
}
registerBlockType(slug, blockData);