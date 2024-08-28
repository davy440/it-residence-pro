import { md5 } from "js-md5";

// Adding blockId attribute to blocks

function addUniqueID( attributes, block) {
    if (block['name'] !== 'it-listings/property-filter') {
        return attributes;
    }

    const hash = md5(JSON.stringify(Object.keys(attributes).sort().reduce((acc, currVal) => {
        acc[currVal] = attributes[currVal]
        return acc;
    }, {})));
    const blockId = `block_${hash}`;
    const newAttrs = {blockId, ...attributes};
    return newAttrs;
}

// wp.hooks.addFilter(
//     'blocks.getBlockAttributes',
//     'it-residence/add-unique-id',
//     addUniqueID
// );