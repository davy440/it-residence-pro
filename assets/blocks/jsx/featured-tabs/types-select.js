import { useContext } from 'react';
import { useSelect } from '@wordpress/data';
import { SelectControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { attsContext } from '.';

const TypesSelect = () => {

    const allTypes = useSelect(select => (
        select('core').getEntityRecords('taxonomy', 'property-type', {per_page: -1})
    ), []);
    
    const { attributes, setAttributes } = useContext(attsContext);
    const { types } = attributes;
    return (
        <>
            <p>
                <SelectControl
                    label={__("Types")}
                    value={[...types]}
                    multiple={true}
                    autoFocus={true}
                    onChange={value => (
                        setAttributes({types: [...value]})
                    )}
                >
                    {
                        allTypes !== null &&
                        allTypes.map(type => {
                            return <option value={type.id}>{type.name}</option>
                        })
                    }
                </SelectControl>
            </p>
        </>
    )
}
 
export default TypesSelect;