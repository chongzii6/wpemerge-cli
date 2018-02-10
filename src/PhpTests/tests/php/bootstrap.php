<?php

class App_Tests_Bootstrap {
	/**
	 * The bootstrap instance.
	 *
	 * @var WPEmerge_Tests_Bootstrap
	 */
	protected static $instance = null;

	/**
	 * Directory where wordpress-tests-lib is installed
	 *
	 * @var string
	 */
	public $wp_tests_directory;

	/**
	 * Theme directory.
	 *
	 * @var string
	 */
	public $theme_directory;

	/**
	 * Testing directory.
	 *
	 * @var string
	 */
	public $tests_directory;

	/**
	 * Library directory.
	 *
	 * @var string
	 */
	public $library_directory;

	/**
	 * Get the single tests boostrap instance
	 *
	 * @return WPEmerge_Tests_Bootstrap
	 */
	public static function instance() {
		if ( is_null( static::$instance ) ) {
			static::$instance = new self();
		}

		return static::$instance;
	}

	/**
	 * Setup the unit testing environment
	 */
	private function __construct() {
		ini_set( 'display_errors','on' );
		error_reporting( E_ALL );

		$this->theme_directory = dirname( dirname( __DIR__ ) );
		$this->library_directory = dirname( __DIR__ );
		$this->tests_directory = __DIR__;
		$this->wp_tests_directory = getenv( 'WP_TESTS_DIR' ) ? getenv( 'WP_TESTS_DIR' ) : $this->tests_directory . '/environment/wordpress-tests-lib';

		define( 'WPEMERGE_TEST_DIR', $this->tests_directory );
	}

	/**
	 * Load the plugin
	 */
	public function load_plugin() {
		require_once( $this->theme_directory . '/vendor/autoload.php' );
	}

	/**
	 * Load the plugin
	 */
	public function boot() {
		// load test function so tests_add_filter() is available
		require_once( $this->wp_tests_directory . '/includes/functions.php' );

		// load plugin
		tests_add_filter( 'muplugins_loaded', array( $this, 'load_plugin' ) );

		// load the WP testing environment
		require_once( $this->wp_tests_directory . '/includes/bootstrap.php' );

		// make sure query vars are prepared
		global $wp;
		if ( ! is_array( $wp->query_vars ) ) {
			$wp->query_vars = array();
		}
	}
}

App_Tests_Bootstrap::instance()->boot();