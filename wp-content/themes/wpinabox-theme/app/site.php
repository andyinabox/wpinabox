<?php
namespace WPB;
use Timber;
use Timber\Site as TimberSite;

class Site extends TimberSite {
	var $assets_manifest;
	var $env;

	function __construct() {
		// load the package.json file
		$this->load_env_variables();
		$this->load_assets_manifest();

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
			wp_register_style('wpinabox/css', $this->assets('main.css'), array());

			// register scripts
			wp_register_script('wpinabox/js', $this->assets('main.js'),  array(), null, true);

			// enqueue styles/scripts
			wp_enqueue_style('wpinabox/css');			
			wp_enqueue_script('wpinabox/js');		

		} else {
			// admin-specific styles / scripts
		}
	}

	function load_assets_manifest() {
		$path = get_template_directory() . '/assets/dist/manifest.json';
		if(file_exists($path)) {
			$this->assets_manifest = json_decode(file_get_contents(get_template_directory() . '/assets/dist/manifest.json'));
		} else {
			$this->assets_manifest = (object) null;
		}
	}

	function load_env_variables() {
		$this->env = getenv('WPB_ENV') ? getenv('WPB_ENV') : 'production';
	}

	function assets($key) {
		$path = get_stylesheet_directory_uri() . '/assets/dist/';
		if(isset($this->assets_manifest->{$key})) {
			$path .= $this->assets_manifest->{$key};
		}
		return $path;
	}

	function register_image_sizes() {
		// set up image sizes
	}

	function add_to_context( $context ) {
		// include ACF options in the contect
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