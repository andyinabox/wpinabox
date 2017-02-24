Starter Wordpress Project
==========================

Developed by Andy Dayton.

Setup
------

To install ACF Pro with composer you need to create a `.env` file and include your ACF Pro license key:

```bash
ACF_PRO_KEY=[ your acf key ] 
```

Then you'll need to do some renaming:

1. Find and replace within project files (examples below):
  * `WPinabox` &rarr; `My Awesome Site`
  * `WPB` &rarr; `MAS`
  * `wpb` &rarr; `mas`
  * `wpinabox` &rarr; `my-awesome-site`
2. Rename `wpinabox-theme` to something that makes sense.

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
