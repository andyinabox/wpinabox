<?php
// namespace Even;

/**
 * Plugin Name:     Wpinabox Plugin
 * Plugin URI:      -
 * Description:     Plugin template
 * Author:          Andy Dayton
 * Author URI:      http://andydayton.com
 * Text Domain:     wpinabox
 * Domain Path:     /languages
 * Version:         0.2.0
 *
 * @package         WPB
 */

require_once __DIR__ . '/../../../vendor/autoload.php';

// Init Dotenv
$dotenv = new Dotenv\Dotenv(__DIR__ . '/../../../');
$dotenv->load();

$timber_path = plugin_dir_path( __FILE__ ).'../timber-library/timber.php';

// timber check
if(!class_exists('Timber')) {
  if (file_exists($timber_path)) {
   include_once($timber_path);
  } else {
    add_action( 'admin_notices', function() {
      echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php') ) . '</a></p></div>';
    });
    
    add_filter('template_include', function($template) {
      return get_stylesheet_directory() . '/assets/no-timber.html';
    });
    
    return;
  }
}

// taxonomies
// include_once 'app/taxonomies/example.php';

  // post types
include_once 'app/post-types/base-post.php';
include_once 'app/post-types/post.php';
include_once 'app/post-types/page.php';
// include_once 'app/post-types/example.php';

// misc
include_once 'app/shortcodes.php';
include_once 'app/helper.php';
include_once 'app/plugin.php';

new WPB\Plugin();