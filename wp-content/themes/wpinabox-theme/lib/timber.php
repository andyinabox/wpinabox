<?php

namespace WPinabox;

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php') ) . '</a></p></div>';
	});
	
	add_filter('template_include', function($template) {
		return get_stylesheet_directory() . '/assets/no-timber.html';
	});
	
	return;
}

Timber::$dirname = array('tpl', 'views');

class Site extends TimberSite {
	var $ns;
	var $pkg;

	function __construct() {
		$this->ns = 'asb';
		$this->pkg = $pkg = json_decode(file_get_contents(get_template_directory() . '/package.json'));

		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_scripts_and_styles' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );


		$this->register_image_sizes();

		parent::__construct();
	}

	function register_scripts_and_styles() {
		$css = $this->ns . '/css';
		$js = $this->ns . '/js';

		// don't apply in wp admin
		if(!is_admin()) {

			// register styles
			wp_register_style($css, get_stylesheet_directory_uri() . '/assets/dist/main.css', array('fonts.com'), $this->pkg->version);
			wp_enqueue_style($css);

			// register scripts
			wp_register_script($js, get_stylesheet_directory_uri() . '/assets/dist/main.js',  array(), $this->pkg->version, true);
			wp_enqueue_script($js);		

		} else {
			// admin-specific styles / scripts
		}
	}

	function register_post_types() {
		Page::register();
	}


	function register_image_sizes() {
		// set up image sizes

	}

	function add_to_context( $context ) {
		//
		return $context;
	}
	function add_to_twig( $twig ) {
		/* this is where you can add your own functions to twig */
		// $twig->addExtension( new Twig_Extension_StringLoader() );
		// $twig->addFilter('myfoo', new Twig_SimpleFilter('myfoo', array($this, 'myfoo')));
		return $twig;
	}
}
new Site();