const path = require('path');
const webpack = require('webpack');
const pkg = require('./package.json');

const CleanWebpackPlugin = require('clean-webpack-plugin')
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const ModernizrWebpackPlugin = require('modernizr-webpack-plugin');

const config = {
  devServer: {
    hot: true,
    compress: true,
    headers: { 'Access-Control-Allow-Origin': '*' },
    historyApiFallback: true,
    port: 9001,
    // noInfo: true,
    // ignorePath: false,
    publicPath: 'http://localhost:9001/wp-content/themes/wpinabox-theme/assets/dist/',
    proxy: {
      '**/': {
        target: 'http://wpinabox.test/',
        secure: false,
        changeOrigin: true,
        autoRewrite: true
      }
    }
  },
  entry: './assets/src/js/main.js',
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, 'assets/dist/'),
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        loader: 'babel-loader',
        exclude: /node_modules/
      },
      {
        test: /\.scss$/,
        use: ExtractTextPlugin.extract({
          fallback: 'style-loader',
          use: [
            { loader: 'css-loader', options: { sourceMap: true } },
            { loader: 'postcss-loader', options: { sourceMap: true } },
            { loader: 'sass-loader', options: { sourceMap: true } }
          ]
        })
      },
      {
        test: /\.(png|svg|jpg|gif)$/,
        use: [
          'file-loader'
        ]
      }
    ]
  },
  performance: {
    hints: false
  },
  devtool: 'eval',
  plugins: [
    new ExtractTextPlugin('main.css'),
    new CleanWebpackPlugin('assets/dist/'),
    // https://github.com/Modernizr/Modernizr/blob/master/lib/config-all.json
    new ModernizrWebpackPlugin(require('./modernizr.config.js'))
  ]
};


if (process.env.NODE_ENV === 'production') {

  config.plugins.push(new webpack.optimize.UglifyJsPlugin({
    sourceMap: true,
    compress: {
      warnings: false
    }
  }));

}

module.exports = config;