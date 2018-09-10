const path = require('path');
const webpack = require('webpack');
const pkg = require('./package.json');

const CleanWebpackPlugin = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

require('dotenv').config({
  path: path.join(__dirname, '../../../.env')
});

const SERVER_PORT = process.env.DEV_SERVER_PORT || 9000;
const NODE_ENV = process.env.NODE_ENV || 'production';
const isDev = NODE_ENV === 'development';
const assetsPath = '/wp-content/themes/wpinabox-theme/assets/dist/';

const config = {
  mode: NODE_ENV,
  devServer: {
    hot: true,
    compress: true,
    headers: { 'Access-Control-Allow-Origin': '*' },
    historyApiFallback: true,
    port: 9001,
    publicPath: 'http://localhost:' + SERVER_PORT + assetsPath,
    proxy: {
      '**/': {
        target: 'http://wpinabox.test/',
        secure: false,
        changeOrigin: true,
        autoRewrite: true
      }
    }
  },
  entry: ['@babel/polyfill', './assets/src/js/main.js'],
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, 'assets/dist/'),
  },
  module: {
    rules: [
      {
        test: /modernizr\.config\.js$/,
        loader: "modernizr"
      },
      {
        test: /\.scss$/,
        use: [
          isDev ? 'style-loader' : MiniCssExtractPlugin.loader,
          'css-loader',
          'postcss-loader',
          'sass-loader'
        ]
      },
      {
        test: /\.(png|svg|jpg|gif)$/,
        use: [
          'file-loader'
        ]
      },
      {
        test: /\.js$/,
        loader: 'babel-loader',
        exclude: /node_modules/
      }
    ]
  },
  resolve: {
    alias: {
      modernizr: path.resolve(__dirname, "modernizr.config.js")
    }
  },
  performance: {
    hints: false
  },
  devtool: 'eval',
  plugins: [
    new CleanWebpackPlugin('assets/dist/'),
    new MiniCssExtractPlugin({
      // Options similar to the same options in webpackOptions.output
      // both options are optional
      filename: "[name].css",
      chunkFilename: "[id].css"
    })
  ]
};


module.exports = config;