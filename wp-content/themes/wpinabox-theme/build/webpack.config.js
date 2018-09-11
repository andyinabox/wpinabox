const path = require('path');
// load env variables
require('dotenv').config({ path: path.join(__dirname, '../../../../.env') });

const webpack = require('webpack');

const CleanWebpackPlugin = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const ManifestPlugin = require('webpack-manifest-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

const assetsPath = process.env.WPB_THEME_ASSETS_PATH;
const devPort = process.env.WPB_THEME_DEV_PORT || 9000;
const devUrl = process.env.WPB_THEME_DEV_URL;
const inProduction = process.env.NODE_ENV === 'production';
const styleHash = inProduction ? 'contenthash' : 'hash';
const scriptHash = inProduction ? 'chunkhash' : 'hash';

// LOADER HELPERS
const extractCss = {
  loader: MiniCssExtractPlugin.loader,
  options: {
    publicPath: `${assetsPath}`,
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
              publicPath: `${assetsPath}`,
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
          publicPath: `${assetsPath}`,
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
      port: devPort,
      proxy: devUrl,
      files: ['./*.php', './views/**/*.twig'],
    })
  ]
};