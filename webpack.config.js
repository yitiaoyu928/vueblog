const webpack = require('webpack');
const path = require('path');
const VueLoaderPlugins = require('vue-loader/lib/plugin-webpack4');
const htmlWebpackPlugin = require('html-webpack-plugin');
module.exports = {
    entry: {
        main: './index.js'
    },
    output: {
        filename: '[name].js',
        path: path.resolve(__dirname, 'bundle')
    },
    module: {
        rules: [{
                test: /\.css$/,
                use: ["style-loader", "css-loader"],
            },
            {
                test: /\.scss$/,
                use: [
                    "style-loader",
                    {
                        loader: "css-loader",
                        options: {
                            importLoaders: 1,
                        },
                    },
                    "sass-loader",
                ],
            },
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: "babel-loader",
                    options: {
                        presets: ["@babel/preset-env"]
                    },
                },
            },
            {
                test: /\.vue$/,
                use: "vue-loader",
            },
            {
                test: /\.(ttf|woff|otf|eot|svg)/,
                use: "file-loader",
            },
            {
                test: /\.(png|jpg|bmp|gif)/,
                use: "url-loader"
            }
        ]
    },
    plugins: [
        new htmlWebpackPlugin({
            template: path.resolve(__dirname, "public/index.html"),
        }),
        new VueLoaderPlugins(),
        new webpack.HotModuleReplacementPlugin(),
    ],
    devServer: {
        open: true,
        hot: true,
        contentBase: "./src",
        overlay: {
            warning: true,
            error: true
        },
        noInfo: true
    },
    resolve: {
        alias: {
            vue$: "vue/dist/vue.js",
        },
    },
}