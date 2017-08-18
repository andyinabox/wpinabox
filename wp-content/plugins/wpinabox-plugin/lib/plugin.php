<?php
namespace Even;
use Timber;

class Plugin {

	function __construct() {

		// content types
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_shortcodes' ) );
		add_action( 'init', array( $this, 'register_taxonomy' ) );

		// Advanced Custom Fields stuff
		if( function_exists('acf_add_options_page') ) {
				acf_add_options_page();   
		} 
		add_filter('acf/settings/save_json', array($this, 'acf_save_acf_json'));
		add_filter('acf/settings/load_json', array($this, 'acf_json_load_point'));
		add_filter('acf/options_page/settings', array($this, 'acf_options_page_settings'));

		// admin stuff
		add_action( 'admin_menu', array( $this, 'admin_menu' ) ); 
		add_filter( 'custom_menu_order', '__return_true' );
		add_filter( 'menu_order', array( $this, 'menu_order' ) );
	}

	/**
	 * Register custom post classes
	 *
	 * @return void
	 */
	function register_post_types() {
		Post::register();
		Page::register();
		// Example::register();
	}


	function register_shortcodes() {
		Shortcodes::register();
	}

	function register_taxonomy() {
		// ExampleTaxonomy::register();
	}

	//
	// Advanced Custom Fields
	//

	/**
	 * Set save point for Advanced Custom Fields settings
	 *
	 * @param String $path
	 * @return String
	 */
	function acf_save_acf_json( $path ) {
			// update path
			$path = self::get_plugin_path() . '../acf/';
			// return
			return $path;
	}


	/**
	 * Set load point(s) for Advanced Custom Fields settings
	 *
	 * @param Array $paths
	 * @return Array
	 */
	function acf_json_load_point( $paths ) {
			// remove original path (optional)
			unset($paths[0]);
			// append path
			$paths[] = self::get_plugin_path() . '../acf/';
			// return
			return $paths; 
	}


	/**
	 * Set up options page for Advanced Custom Fields settings
	 *
	 * @param Array $paths
	 * @return Array
	 */
	function acf_options_page_settings( $settings ) {

		$settings['title'] = 'Global';
		$settings['pages'] = array('General', 'Header', 'Footer');

		return $settings;
	}



/**
	 * Change admin menu order
	 *
	 * @return void
	 */
	function menu_order($menu_order) {

		// this will manually order menu items
		// anything not included here will be tacked
		// on to the end in default order
		$custom_order = [
			'index.php',
			, 'acf-options'
			, 'separator1'
			, 'edit.php'
			, 'edit.php?post_type=page'
			// , 'edit.php?post_type=example'
		];

		// merge in remaining menu items
		$custom_order = array_unique(array_merge($custom_order, $menu_order));

		return $custom_order;
	}


	/**
	 * Misc admin menu options
	 *
	 * @return void
	 */
	function admin_menu() {
		// no comments
		remove_menu_page( 'edit-comments.php' );
	}

  static function get_plugin_path() {
    return plugin_dir_path( __FILE__ );
  }


}


?>