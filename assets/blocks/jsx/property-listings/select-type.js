import { useEffect, useContext } from 'react';
import { __ } from '@wordpress/i18n';
import { useSelect } from '@wordpress/data';
import { SelectControl } from '@wordpress/components';
import { attsContext } from './index';

const SelectPropType = () => {
    const { attributes: {propType}, setAttributes } = useContext(attsContext);
    const propTypes = useSelect(select => select('core').getEntityRecords('taxonomy', 'property-type', {per_page: -1}));

    useEffect(() => {
        if (propTypes) {
            setAttributes({propType: propTypes[0].slug})
        }
        return () => {
            setAttributes({propType: ""})
        }
    }, [propTypes]);

    return (
        
        <SelectControl
            label={__('Select Property Type')}
            value={propType}
            onChange={newType => setAttributes({propType: newType})}
            options={
                propTypes !== null &&
                propTypes.map( type => ({label: type.name, value: type.slug}))
            }
        />
    );
}

export default SelectPropType;