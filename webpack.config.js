const path = require('path');

const ExtractTextPlugin = require('extract-text-webpack-plugin');
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const CssNano = require('cssnano');

module.exports = {
    mode: 'production',
    entry: {
        campaign: path.resolve(__dirname, 'front/modules/campaign/index.ts'),
        vendor: path.resolve(__dirname, 'front/vendor.ts')
    },
    output: {
        path: __dirname + '/public/dist',
        filename: '[name].js'
    },
    module: {
        rules: [
            {
                test: /\.scss$/,
                use: ExtractTextPlugin.extract({
                    fallback: 'style-loader',
                    use: ['css-loader', 'postcss-loader', 'sass-loader']
                }),
                exclude: /node_modules/
            },
            {
                test: /\.css$/,
                use: ExtractTextPlugin.extract({
                    fallback: 'style-loader',
                    use: ['css-loader', 'postcss-loader']
                })
            },
            {
                test: /\.ts$/,
                use: [
                    {
                        loader: 'awesome-typescript-loader',
                        options: {
                            babelOptions: {
                                presets: false,
                                plugins: [
                                    ['angularjs-annotate', {explicitOnly: true}]
                                ]
                            },
                            useCache: true,
                            useBabel: true
                        }
                    }
                ],
                include: __dirname,
                exclude: /node_modules/
            },
            {
                test: /\.html$/,
                use: [ {
                    loader: 'html-loader?exportAsEs6Default',
                    options: {
                        minimize: true
                    }
                }]
            }
        ]
    },
    resolve: {
        extensions: ['.ts', '.js']
    },
    plugins: [
        new ExtractTextPlugin('[name].css'),
        new OptimizeCssAssetsPlugin({
            cssProcessor: new CssNano({
                postcssDiscardDuplicates: {}, // We want this plugin only, we deactivate all others
                postcssDiscardComments: false,
                postcssMinifyGradients: false,
                postcssReduceInitial: false,
                postcssSvgo: false,
                reduceDisplayValues: false,
                postcssReduceTransforms: false,
                autoprefixer: false,
                postcssZindex: false,
                postcssConvertValues: false,
                reduceTimingFunctions: false,
                postcssCalc: false,
                postcssColormin: false,
                postcssOrderedValues: false,
                postcssMinifySelectors: false,
                postcssMinifyParams: false,
                postcssNormalizeCharset: false,
                postcssDiscardOverridden: false,
                normalizeString: false,
                normalizeUnicode: false,
                postcssMinifyFontValues: false,
                postcssDiscardUnused: false,
                postcssNormalizeUrl: false,
                functionOptimiser: false,
                filterOptimiser: false,
                reduceBackgroundRepeat: false,
                reducePositions: false,
                postcssMergeIdents: false,
                postcssReduceIdents: false,
                postcssMergeLonghand: false,
                postcssMergeRules: false,
                postcssDiscardEmpty: false,
                postcssUniqueSelectors: false
            })
        }),
    ],
    optimization: {
        splitChunks: {
            cacheGroups: {
                vendor: {
                    chunks: 'initial',
                    name: 'vendor',
                    test: 'vendor',
                    enforce: true
                },
            }
        },
        runtimeChunk: false
    }
};
