const defaultConfig = require('@wordpress/scripts/config/webpack.config');

module.exports = {
    ...defaultConfig,
    entry: {
        'showcase': { import: './assets/blocks/tsx/showcase/index.tsx', filename: './showcase/index.js' },
        'featured-property': { import: './assets/blocks/jsx/featured-property/index.js', filename: './featured-property/index.js'},
        'featured-tabs': { import: './assets/blocks/jsx/featured-tabs/index.js', filename: './featured-tabs/index.js'},
        'agents': { import: './assets/blocks/jsx/agents/index.js', filename: './agents/index.js'},
        'property-filter': { import: './assets/blocks/jsx/property-filter/index.js', filename: './property-filter/index.js'},
        'walk-score': { import: './assets/blocks/jsx/walk-score/index.js', filename: './walk-score/index.js'},
        'property-listings': { import: './assets/blocks/jsx/property-listings/index.js', filename: './property-listings/index.js'},
        'property-agent': { import: './assets/blocks/jsx/property-agent/index.js', filename: './property-agent/index.js'},
        'block-filters': { import: './assets/blocks/jsx/block-filters.js', filename: './block-filters.js'},
    },
    module: {
        ...defaultConfig.module,
        rules: [
            ...defaultConfig.module.rules,
            {
                test: /\.tsx?$/,
                use: 'ts-loader',
                exclude: /node_modules/,
            },
        ],
    },
    resolve: {
        ...defaultConfig.resolve,
        extensions: [ '.ts', '.tsx', '.js', '.jsx' ],
    },
};