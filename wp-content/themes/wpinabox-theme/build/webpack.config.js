const path = require('path');
const webpack = require('webpack');
// const pkg = require('../package.json');
const config = require('./config');

const CleanWebpackPlugin = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const ManifestPlugin = require('webpack-manifest-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

require('dotenv').config({
  path: path.join(__dirname, '../../../.env')
});

// const NODE_ENV = process.env.NODE_ENV || 'production';
// const isDev = NODE_ENV === 'development';
// const assetsPath = '/wp-content/themes/wpinabox-theme/assets/dist/';
// const serverPort = process.env.DEV_SERVER_PORT || 9000;
const inProduction = process.env.NODE_ENV === 'production';
const styleHash = inProduction ? 'contenthash' : 'hash';
const scriptHash = inProduction ? 'chunkhash' : 'hash';

// LOADER HELPERS
const extractCss = {
  loader: MiniCssExtractPlugin.loader,
  options: {
    publicPath: `${config.assetsPath}`,
  },
};

const cssLoader = {
  loader: 'css-loader',
  options: { minimize: inProduction },
};

const postCssLoader = {
  loader: 'postcss-loader',
  options: {
    config: { path: './build/' }
  }
};

module.exports = {
  // devServer: {
  //   hot: true,
  //   compress: true,
  //   headers: { 'Access-Control-Allow-Origin': '*' },
  //   historyApiFallback: true,
  //   port: 9001,
  //   publicPath: 'http://localhost:' + SERVER_PORT + assetsPath,
  //   proxy: {
  //     '**/': {
  //       target: 'http://wpinabox.test/',
  //       secure: false,
  //       changeOrigin: true,
  //       autoRewrite: true
  //     }
  //   }
  // },
  entry: ['@babel/polyfill', './assets/src/js/main.js'],
  output: {
    filename: `[name].[${scriptHash}].js`,
    path: path.resolve(__dirname, '../assets/dist/'),
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
          extractCss,
          cssLoader,
          postCssLoader,
          'sass-loader'
        ]
      },
      {
        test: /\.(png|jpe?g|gif|svg)$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: '[name].[ext]',
              outputPath: 'images/',
              publicPath: `${config.assetsPath}`,
            },
          },
          'image-webpack-loader',
        ],
      },
      {
        test: /\.js$/,
        loader: 'babel-loader',
        exclude: /node_modules/
      },
      {
        test: /\.(woff2?|eot|ttf|otf)(\?.*)?$/,
        loader: 'url-loader',
        options: {
          limit: 10000,
          name: '[name].[hash:7].[ext]',
          outputPath: 'fonts/',
          publicPath: `${config.assetsPath}`,
        },
      }
    ]
  },
  resolve: {
    alias: {
      modernizr: path.resolve(__dirname, "modernizr.config.js")
    }
  },
  optimization: {
    splitChunks: {
      cacheGroups: {
        vendor: {
          chunks: 'all',
          name: 'vendor',
          test: 'vendor',
          enforce: true,
        },
      },
    },
  },
  // performance: {
  //   hints: false
  // },
  devtool: 'eval',
  plugins: [
    // new CleanWebpackPlugin('assets/dist/'),
    new MiniCssExtractPlugin({
      // Options similar to the same options in webpackOptions.output
      // both options are optional
      filename: `[name].[${styleHash}].css`
    }),
    new ManifestPlugin(),

    new BrowserSyncPlugin({
      host: 'localhost',
      port: config.devPort,
      proxy: config.devUrl, // YOUR DEV-SERVER URL
      files: ['./*.php', './views/**/*.twig'],
    })
  ]
};