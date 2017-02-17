Starter Wordpress Project
==========================

Developed by Andy Dayton.

Setup
------

To install ACF Pro with composer you need to set the env variable `ACF_PRO_KEY` with your api key:

```bash
export ACF_PRO_KEY=[ your acf key ] 
```

You'll need to do some renaming:

* Find and replace files for `wpinabox` and `WPinabox`
* Rename the theme to fit your project
* Change project name in `composer.json` in the project root and `package.json` in the theme.
* _I'm sure there's something I'm forgetting..._

Then you can run:

```bash
# install php dependencies
composer install

# install npm dependencies
cd wp-content/themes/[theme name] && yarn install
```

Dependencies
------------

I'm using [composer](https://getcomposer.org/) to install PHP dependencies, but I usually include plugins, etc. in the repo just to be safe.

### Themes

* [Site Theme](wp-content/themes/wpinabox-theme/) (click through to see theme setup info)

### Plugins

* [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/pro/)
* [Timber](https://github.com/timber/timber) for templating
