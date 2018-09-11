WPinabox Project
==========================

Developed by Andy Dayton.

Setup
------

See the instructions for [wpinabox-stack](https://github.com/andyinabox/wpinabox-stack) to bootstrap this project on [VVV 2](https://github.com/Varying-Vagrant-Vagrants/VVV).


Stack
------------

* [Composer](https://getcomposer.org/ for dependency management (including WordPress plugins if desired)
* [Wordmove](https://github.com/welaika/wordmove) for deployment
* [symfony/dotenv](https://github.com/symfony/dotenv) to manage environment variables

I'm using [composer](https://getcomposer.org/) to install PHP dependencies, but I usually include plugins, etc. in the repo just to be safe.

### Themes

* [**Site Theme**](wp-content/themes/wpinabox-theme/) (click through to see theme setup info)

### Plugins

* [**Site Plugin**](wp-content/plugins/wpinabox-plugin/)
* [Timber](https://github.com/timber/timber) for templating
* [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/pro/)

Also, these are optional but come installed:

* [Open Graph for Facebook, Google+ and Twitter Card Tags](https://wordpress.org/plugins/wonderm00ns-simple-facebook-open-graph-tags/)
* [Google XML Sitemaps](https://wordpress.org/plugins/google-sitemap-generator/)
