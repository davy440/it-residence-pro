import { useEffect, useContext } from 'react';
import { __ } from '@wordpress/i18n';
import { useSelect } from '@wordpress/data';
import { SelectControl } from '@wordpress/components';
import { attsContext } from './index';

export const SelectLocation = () => {
    const { attributes: {location}, setAttributes } = useContext(attsContext);
    const locations = useSelect(select => select('core').getEntityRecords('taxonomy', 'location', {per_page: -1}));
    
    useEffect(() => {
        if (locations !== null) {
            // Set first location as the location attribute
            setAttributes({location: locations[0].slug})
        }
        return () => {
            setAttributes({location: ""})
        }
    }, [locations]);
    
    return (
        
        <SelectControl
            label={__('Select Location')}
            value={location}
            onChange={newLocation => setAttributes({location: newLocation})}
            options={
                locations !== null &&
                locations.map(location => ({label: location.name, value: location.slug}))
            }
        />
    );
}