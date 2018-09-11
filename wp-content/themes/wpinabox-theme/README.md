WPinabox Theme
=======================

Setup
------

1. See the [wpinabox project readme](../../../) for info on how to bootstrap & configure.
2. Install frontend dependencies:

```
yarn install
```

Development
------------

Some notes on the dev setup:

 * [Webpack](https://webpack.js.org/) for development & builds
 * [Sass](https://sass-lang.com/) for styles
 * [Babel](https://babeljs.io/) for the latest js sugar
 * [Yarn](https://yarnpkg.com/en/) for dependency management
 * [Timber](https://timber.github.io/timber/) and [Twig](http://twig.sensiolabs.org/doc/2.x/templates.html) for templating
 * [modernizr-loader](https://github.com/peerigon/modernizr-loader) for easily-configurable compatability detection

To run development server (with proxy):

```
yarn start
```

To build all assets:

```
yarn build
```

To deploy using [Wordmove](https://github.com/welaika/wordmove):

```
yarn deploy
```

Dependencies
-------------
 * [@babel/polyfill](https://babeljs.io/docs/en/babel-polyfill)
 * [CSS Reset & Normalize SASS](https://www.npmjs.com/package/css-reset-and-normalize-sass)
