import { useContext } from 'react';
import { useSelect, AsyncModeProvider } from '@wordpress/data';
import { SelectControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { attsContext } from '.';

const LocationsSelect = () => {

    const allLocations = useSelect(select => (
        select('core').getEntityRecords('taxonomy', 'location', {per_page: -1})
    ), []);
    
    const { attributes, setAttributes } = useContext(attsContext);
    const { locations } = attributes;
    return (
        <>
            <p>
                <SelectControl
                    label={__("Locations")}
                    value={[...locations]}
                    multiple={true}
                    autoFocus={true}
                    onChange={value => (
                        setAttributes({locations: [...value]})
                    )}
                >
                    {
                        allLocations !== null &&
                        allLocations.map(location => {
                            return <option value={location.id}>{location.name}</option>
                        })
                    }
                </SelectControl>
            </p>
        </>
    )
}
 
export default LocationsSelect;