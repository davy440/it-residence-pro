import { useContext } from 'react';
import { TextControl } from '@wordpress/components';
import { attsContext } from './index';
import {__} from '@wordpress/i18n';

const Title = () => {
    const { attributes, setAttributes } = useContext(attsContext);
    const { title, description } = attributes;

    return (
        <>
            <h2>{__("Agents")}</h2>
            <p>
                <TextControl
                label="Title"
                    value={title}
                    onChange={value => setAttributes({title: value})}
                />
            </p>

            <p>
                <TextControl
                    className="section-sub"
                    label={__("Description")}
                    value={description}
                    onChange={value => setAttributes({description: value})}
                />
            </p>
        </>
    )
};

export default Title;