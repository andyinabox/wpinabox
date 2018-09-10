<?php
namespace WPB;
use Timber;
use Timber\Site as TimberSite;

class Site extends TimberSite {
	var $pkg;
	var $env;

	function __construct() {
		// load the package.json file
		$this->pkg = json_decode(file_get_contents(get_template_directory() . '/package.json'));
		$this->env = getenv('WP_ENV') ? getenv('WP_ENV') : 'production';

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
			wp_register_style('wpinabox/css', $this->assets_root() . '/assets/dist/main.css', array(), $this->pkg->version);

			// modernizr build
			wp_register_script('wpinabox/modernizr', $this->assets_root() . '/assets/dist/modernizr-bundle.js',  array(), $this->pkg->version, true);

			// register scripts
			wp_register_script('wpinabox/js', $this->assets_root() . '/assets/dist/main.js',  array('wpinabox/modernizr'), $this->pkg->version, true);

			// enqueue styles/scripts
			wp_enqueue_style('wpinabox/css');			
			wp_enqueue_script('wpinabox/js');		

		} else {
			// admin-specific styles / scripts
		}
	}

	function assets_root() {
		$path = get_template_directory_uri();
		if($this->env == 'development') {
			$port = getenv('DEV_SERVER_PORT') ? getenv('DEV_SERVER_PORT') : '9000';
			$path = "http://localhost:$port" . wp_make_link_relative($path);
		}
		return $path;		
	}

	function register_image_sizes() {
		// set up image sizes
	}

	function add_to_context( $context ) {
		// set up context
		$context['options'] = get_fields('options');
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