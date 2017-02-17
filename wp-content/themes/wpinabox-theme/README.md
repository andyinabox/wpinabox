Assembled Brands Theme
=======================

Development
------------

Some notes on the dev setup:

 * [Gulp](http://gulpjs.com/) for development & builds
 * [Sass](https://sass-lang.com/) for styles
 * [ECMAScript 2015](https://en.wikipedia.org/wiki/ECMAScript#6th_Edition_-_ECMAScript_2015) and [browserify](http://browserify.org/) for js
 * [Yarn](https://yarnpkg.com/en/) for dependency management
 * [Timber](https://timber.github.io/timber/) and [Twig](http://twig.sensiolabs.org/doc/2.x/templates.html) for templating
 * [SVGO](https://github.com/svg/svgo) for optimizing svgs

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
yarn run build
```

_(If you don't have yarn installed you can substitute `npm` in the above commands and they'll still work)_



Dependencies
-------------

### Scripts

 * [Macy.js](https://github.com/bigbitecreative/macy.js) for masonry layout
 * [Swiper](https://github.com/nolimits4web/swiper/) for slideshow
 * [Layzr.js](https://github.com/callmecavs/layzr.js) for lazy-loading images
 * [jump.js](http://callmecavs.com/jump.js/) for anchor navigation

### Styles

 * [CSS Reset & Normalize SASS](https://www.npmjs.com/package/css-reset-and-normalize-sass)
 * [Breakpoint SASS](https://github.com/at-import/breakpoint) for setting up breakpoints