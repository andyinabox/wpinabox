<?php
namespace WPB;
use Timber;
use Timber\Site as TimberSite;

class Site extends TimberSite {
	var $pkg;

	function __construct() {
		// load the package.json file
		$this->pkg = json_decode(file_get_contents(get_template_directory() . '/package.json'));

		// timber setup
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );

		// theme support
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_theme_support( 'html5', array( 'search-form', 'caption' ) );

		// assets
		add_action( 'init', array( $this, 'register_scripts_and_styles' ) );
		add_action( 'init', array( $this, 'register_image_sizes' ) );
		
		parent::__construct();
	}

	function register_scripts_and_styles() {


		// don't apply in wp admin
		if(!is_admin()) {

			// register styles
			wp_register_style('wpinabox/css', get_stylesheet_directory_uri() . '/assets/dist/main.css', array('fonts.com'), $this->pkg->version);

			// register scripts
			wp_register_script('wpinabox/js', get_stylesheet_directory_uri() . '/assets/dist/main.js',  array(), $this->pkg->version, true);

			// enqueue styles/scripts
			wp_enqueue_style('wpinabox/css');			
			wp_enqueue_script('wpinabox/js');		

		} else {
			// admin-specific styles / scripts
		}
	}


	function register_image_sizes() {
		// set up image sizes
	}

	function add_to_context( $context ) {
		// set up context
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