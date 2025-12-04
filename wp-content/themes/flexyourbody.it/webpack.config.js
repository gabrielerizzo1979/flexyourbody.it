const path = require('path');
const fs = require('fs');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const SVGSpritemapPlugin = require('svg-spritemap-webpack-plugin');
const glob = require('glob');

const appDirectory = fs.realpathSync(process.cwd());
const resolveAppPath = (relativePath) =>
    path.resolve(appDirectory, relativePath);

const jsSrcPath = resolveAppPath('src/views');
const jsSrcFiles = glob.sync(`${jsSrcPath}/**/*.js`);

let entry = {};
// entry['app'].push(resolveAppPath('src/js')+'/app.js');
entry['app'] = resolveAppPath('src/js') + '/app.js';

jsSrcFiles.forEach((match) => {
    entry[path.basename(match, '.js')] = match;
});

module.exports = (env) => {
    return {
        mode: env.development ? 'development' : 'production',
        entry,
        output: {
            filename: './js/[name].js',
            path: resolveAppPath('assets/build'),
            assetModuleFilename: 'dep/[name].[ext]',
            clean: true,
        },
        module: {
            rules: [
                {
                    test: /\.(scss|css)$/,
                    exclude: /node_modules/,
                    use: [
                        {
                            loader: MiniCssExtractPlugin.loader,
                            options: {
                                esModule: false,
                            },
                        },
                        'css-loader',
                        {
                            loader: 'sass-loader',
                            options: {
                                additionalData: `
                                @use "scss/base" as *;
                            `,
                            },
                        },
                    ],
                },
                {
                    test: /\.css$/,
                    include: /node_modules/,
                    use: [
                        {
                            loader: MiniCssExtractPlugin.loader,
                            options: {
                                esModule: false,
                            },
                        },
                        'css-loader',
                    ],
                },
                {
                    test: /\.(gif|jpg|png|woff|woff2|eot|ttf|svg)$/,
                    type: 'asset/resource',
                },
            ],
        },
        plugins: [
            new MiniCssExtractPlugin({
                filename: './css/[name].css',
            }),
            new SVGSpritemapPlugin('./src/icons/**/*.svg', {
                output: {
                    svg: {
                        sizes: true,
                    },
                },
                sprite: {
                    prefix: 'ico_',
                    idify: (filename) => filename.replace(/[\s]+/g, '_'),
                },
            }),
        ],
        resolve: {
            extensions: ['.js', '.ts'],
            alias: {
                scss: resolveAppPath('src/scss'),
                js: resolveAppPath('src/js'),
                components: resolveAppPath('src/components'),
                imComponents: resolveAppPath('src/im-components'),
                animations: resolveAppPath('src/animations'),
            },
        },
    };
};
