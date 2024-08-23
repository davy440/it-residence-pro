const defaultConfig = require('@wordpress/scripts/config/webpack.config');

module.exports = {
    ...defaultConfig,
    entry: {
        'showcase': { import: './assets/blocks/jsx/showcase/index.js', filename: './showcase/index.js' },
        'featured-property': { import: './assets/blocks/jsx/featured-property/index.js', filename: './featured-property/index.js'},
        'featured-tabs': { import: './assets/blocks/jsx/featured-tabs/index.js', filename: './featured-tabs/index.js'},
        'agents': { import: './assets/blocks/jsx/agents/index.js', filename: './agents/index.js'},
        'agents': { import: './assets/blocks/jsx/property-filter/index.js', filename: './property-filter/index.js'},
        'block-filters': { import: './assets/blocks/jsx/block-filters.js', filename: './block-filters.js'},
    }
};