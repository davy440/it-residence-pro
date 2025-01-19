import { getBlockTypes, unregisterBlockType } from '@wordpress/blocks';
import { subscribe } from '@wordpress/data';
import domReady from '@wordpress/dom-ready';

const getPostType = () => wp.data.select('core/editor').getCurrentPostType();
let postType = null;

domReady(() => {
    let unregistered = false;
    const unsubscribe = subscribe(() => {

        // Disable blocks if not "property" post type
        const newPostType = getPostType();
        if (newPostType !== postType) {
            unsubscribe();
            postType = newPostType;
            getBlockTypes().forEach(() => {
                if (postType !== 'property' && unregistered === false) {
                    unregistered = true;
                    unregisterBlockType('it-listings/walk-score');
                    unregisterBlockType('it-listings/property-agent');
                }
            });
        }
    });
});