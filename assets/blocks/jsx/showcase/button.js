// UploadButton component
import { MediaUpload, MediaUploadCheck } from '@wordpress/blockEditor';
import { useContext } from 'react';
import { __ } from '@wordpress/i18n';
import { Button, ResponsiveWrapper } from '@wordpress/components';
import { attsContext } from './index.js';

const ALLOWED_TYPES = ['image'];

const UploadButton = ({ count, image: data }) => {
    const { attributes, setAttributes } = useContext(attsContext);
    const { sections } = attributes;
    const section = sections.filter(item => item.order === count)[0];
    const { mediaId, mediaURL } = section;
    let { image } = data;
    
    
    const onSelectMedia = (media) => {
        const newSections = sections.map(item => (
            item.order === count ? {...item, mediaId: media.id, mediaURL: media.url } : item
        ));
        return setAttributes({sections: newSections});
    }

    return (
        <MediaUploadCheck>
            <MediaUpload
                allowedTypes = { ALLOWED_TYPES }
                multiple = { false }
                render = {({open}) => {
                    return (
                        <>
                            {
                                mediaId === 0 &&
                                <p>
                                    <span class="dashicons dashicons-format-image"></span>Image
                                </p>
                            }   
                                
                            {
                                image !== "" &&
                                image !== undefined &&
                                <ResponsiveWrapper
                                    naturalWidth={ image.media_details.width }
                                    naturalHeight={ image.media_details.height }
                                >
                                    <img src={ mediaURL } />
                                </ResponsiveWrapper>
                            }

                            <p>
                                <Button
                                    className={image === "" ? 'is-primary' : 'is-secondary'}
                                    onClick={open}
                                >
                                    {mediaId === 0 ? __('Choose an Image', 'it-listings') : __('Replace Image', 'it-listings')}
                                </Button>
                            </p>
                        </>
                    );
                }}
                value={ mediaId }
                onSelect={ onSelectMedia }
            >
            </MediaUpload>
        </MediaUploadCheck>
    )
}

export default UploadButton;