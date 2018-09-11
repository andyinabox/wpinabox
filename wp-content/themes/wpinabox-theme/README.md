WPinabox Theme
=======================

Configuration
--------------

You'll want to update `build/config.js` to set up your dev server correctly.

Development
------------

Some notes on the dev setup:

 * [Webpack](https://webpack.js.org/) for development & builds
 * [Sass](https://sass-lang.com/) for styles
 * [Babel](https://babeljs.io/) for the latest js sugar
 * [Yarn](https://yarnpkg.com/en/) for dependency management
 * [Timber](https://timber.github.io/timber/) and [Twig](http://twig.sensiolabs.org/doc/2.x/templates.html) for templating
 * [modernizr-loader](https://github.com/peerigon/modernizr-loader) for easily-configurable compatability detection

To install dependencies:

```
yarn install
```

To run development server (with proxy):

```
yarn start
```

To build all assets:

```
yarn build
```

_(If you don't have yarn installed you can substitute `npm` in the above commands and they'll still work)_



Dependencies
-------------

### Scripts

 * _None yet_

### Styles

 * [CSS Reset & Normalize SASS](https://www.npmjs.com/package/css-reset-and-normalize-sass)
