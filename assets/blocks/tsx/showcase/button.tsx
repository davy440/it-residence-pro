// UploadButton component
import { MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { useContext } from 'react';
import { __ } from '@wordpress/i18n';
import { Button, ResponsiveWrapper } from '@wordpress/components';
import { attsContext } from './index';
import type { Media } from './index';

const ALLOWED_TYPES = ['image'];

const UploadButton = ({ count, data }: { count: number; data: Media | null }) => {
    const { attributes, setAttributes } = useContext(attsContext);
    const { sections } = attributes;
    const section = sections.filter(item => item.order === count)[0];
    const { mediaId, mediaURL } = section;
    
    const onSelectMedia = (media: Media) => {
        const newSections = sections.map(item => (
            item.order === count ? {...item, mediaId: media.id, mediaURL: media.url } : item
        ));
        return setAttributes({sections: newSections});
    }

    return (
        <MediaUploadCheck>
            <MediaUpload
                allowedTypes={ALLOWED_TYPES}
                multiple={false}
                render={({ open }: { open: () => void }) => {
                    return (
                        <>
                            {mediaId === 0 && (
                                <p>
                                    <span className="dashicons dashicons-format-image"></span>
                                    Image
                                </p>
                            )}
                            {data !== null && (
                                <ResponsiveWrapper
                                    naturalWidth={data.media_details.width}
                                    naturalHeight={data.media_details.height}
                                >
                                    <img src={mediaURL} alt="" />
                                </ResponsiveWrapper>
                            )}
                            <p>
                                <Button
                                    className={data === null ? 'is-primary' : 'is-secondary'}
                                    onClick={open}
                                >
                                    {mediaId === 0
                                        ? __('Choose an Image', 'it-listings')
                                        : __('Replace Image', 'it-listings')}
                                </Button>
                            </p>
                        </>
                    );
                }}
                value={mediaId}
                onSelect={onSelectMedia}
            />
        </MediaUploadCheck>
    )
}

export default UploadButton;