WPinabox Project Template
==========================

This is a project template for WordPress sites. It includes a [theme template](wp-content/themes/wpinabox-theme/) and [plugin template](wp-content/plugins/wpinabox-plugin/) for the project to get you started, with an aim to decouple site architecture from the theme by including it in a plugin. It leans heavily on [Timber](https://github.com/timber/timber), and assumes you'll probably use [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/pro/).

Stack
------------

* [Composer](https://getcomposer.org/) for dependency management (including WordPress plugins if desired)
* [Wordmove](https://github.com/welaika/wordmove) for deployment
* [symfony/dotenv](https://github.com/symfony/dotenv) to manage environment variables

### Themes

* [**Site Theme**](wp-content/themes/wpinabox-theme/) (click through to see theme setup info)

### Plugins

* [**Site Plugin**](wp-content/plugins/wpinabox-plugin/)
* [Timber](https://github.com/timber/timber) for templating
* [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/pro/)

Also, these are optional but come installed:

* [Open Graph for Facebook, Google+ and Twitter Card Tags](https://wordpress.org/plugins/wonderm00ns-simple-facebook-open-graph-tags/)
* [Google XML Sitemaps](https://wordpress.org/plugins/google-sitemap-generator/)


Setup
------

1. Clone this repo somewhere.
2. Run `./init.sh` script from the project root to customize the project and create a new repo.
3. See the instructions for [wpinabox-stack](https://github.com/andyinabox/wpinabox-stack) to bootstrap this project on [VVV 2](https://github.com/Varying-Vagrant-Vagrants/VVV).

