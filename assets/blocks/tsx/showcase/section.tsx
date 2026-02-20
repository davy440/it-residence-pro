import { TextControl, TextareaControl } from '@wordpress/components';
import { useContext } from 'react';
import UploadButton from './button';
import { attsContext } from './index';
import type { Media } from './index';

interface SectionProps {
    count: number;
    image: Media | null;
}

interface Section {
    order: number;
    mediaId: number;
    mediaURL: string;
    sectionTitle: string;
    sectionDesc: string;
}

interface BlockAttributes {
    title: string;
    sections: Section[];
}


const Section = ({ count, image }: SectionProps) => {
    const { attributes, setAttributes } = useContext<{
        attributes: BlockAttributes;
        setAttributes: (attrs: Partial<BlockAttributes>) => void;
    }>(attsContext);

    const { sections } = attributes;
    const section = sections.filter((item: Section) => item.order === count)[0];
    
    return (
        <div className="itre-editor-showcase__section">
            <div className="itre-showcase__section--image">
                <UploadButton count={count} data={image} />
            </div>
            <p className="itre-editor-showcase__section--title">
                <TextControl
                    label="Section Title"
                    value={section.sectionTitle}
                    onChange={(value) => {
                        const newSections = sections.map(item => {
                            return item.order === count ? {...item, sectionTitle : value} : item;
                        });
                        setAttributes({ sections: newSections});
                    }}
                />
            </p>
            <p className="itre-editor-showcase__section--desc">
                <TextareaControl
                    label="Description"
                    value={section.sectionDesc}
                    onChange={(value) => {
                        const newSections = sections.map((item) => {
                            return item.order === count ? {...item, sectionDesc : value} : item;
                        });
                        setAttributes({ sections: newSections});
                    }}
                />
            </p>
        </div>
    )
}

export default Section;