<?php
// namespace Even;

/**
 * Plugin Name:     Even Plugin
 * Plugin URI:      -
 * Description:     Plugin for even magazine
 * Author:          Andy Dayton for Common Name
 * Author URI:      http://common-name.com
 * Text Domain:     even-plugin
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Even_Plugin
 */

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
// include_once 'lib/taxonomies/example.php';

  // post types
include_once 'lib/post-types/base-post.php';
include_once 'lib/post-types/post.php';
include_once 'lib/post-types/page.php';
// include_once 'lib/post-types/example.php';

// misc
include_once 'lib/shortcodes.php';
include_once 'lib/helper.php';
include_once 'lib/plugin.php';

new WPB\Plugin();