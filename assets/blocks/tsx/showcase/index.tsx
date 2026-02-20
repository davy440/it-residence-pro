/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';
import { createContext } from 'react';
import { TextControl } from '@wordpress/components';
import Section from './section';
import { __ } from '@wordpress/i18n';
import metadata from "../../../../inc/blocks/showcase/block.json";

interface ShowcaseSection {
    order: number;
    mediaId: number;
    mediaURL: string;
    sectionTitle: string;
    sectionDesc: string;
}

export interface Media {
    id: number;
    url: string;
    media_details: {
        width: number;
        height: number;
    }
}

interface Props {
    attributes: {
        title: string;
        sections: ShowcaseSection[];
    };
    setAttributes: (attrs: Partial<{ title: string; sections: ShowcaseSection[] }>) => void;
}

interface ImageData {
    order: number;
    image: Media | null;
}

const slug = 'it-listings/showcase';
export const attsContext = createContext<Props>({
    attributes: {
        title: '',
        sections: [],
    },
    setAttributes: () => {},
});

const blockData = {
    icon: {
        src: <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><title>grid_view_black_24dp</title><rect width="24" height="24" fill="none"/><path d="M3,3v8h8V3ZM9,9H5V5H9ZM3,13v8h8V13Zm6,6H5V15H9ZM13,3v8h8V3Zm6,6H15V5h4Zm-6,4v8h8V13Zm6,6H15V15h4Z"/></svg>
    },
    edit: ( props: Props ) => {
        const { attributes, setAttributes } = props;
        const { sections } = attributes;
        const images: ImageData[] = useSelect((select: any) => {
            
            const coreSelector = select('core') as { getMedia: (id: number) => Media | null };
            const imgData: ImageData[] = sections.map((item, index) => {
                const image = item.mediaId !== 0 ? coreSelector.getMedia(item.mediaId) : null;
                return { order: index + 1, image };
            }, []);
            return imgData;
        });

        return (
            <section {...useBlockProps({ className: "itre-editor-showcase section" })}>
                <h2>{__("Showcase")}</h2>
                <div className="itre-editor-showcase__title">
                    <p>
                        <TextControl
                            label="Title"
                            value={ attributes.title }
                            onChange={value => setAttributes({title: value})}
                        />
                    </p>
                </div>

                <div className="itre-editor-showcase__sections">
                    <attsContext.Provider value={{attributes, setAttributes}}>
                        {attributes['sections'].map((section, index) => (
                            <Section count={section.order} image={images[index]?.image ?? null} />
                        ))}
                    </attsContext.Provider>
                </div>
            </section>
        )
    },
    save: () => null,
    ...metadata as any,
}
registerBlockType(slug, blockData);