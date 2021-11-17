<?php
/**
 * Main plugin class
 *
 * @package reCAPTCHAGive
 */

namespace ReCAPTCHA_Give;

// Security Note: Blocks direct access to the plugin PHP files.
defined( 'ABSPATH' ) || die();

/**
 * Main plugin class
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @var Plugin
	 */
	public static $instance = null;

	/**
	 * Plugin constructor
	 */
	private function __construct() {
		$this->register_autoloader();

		add_action( 'init', array( $this, 'init' ), 0 );
	}

	/**
	 * Register autoloader
	 */
	private function register_autoloader() {
		require_once RECAPTCHA_GIVE_PATH . 'includes/class-autoloader.php';

		Autoloader::run();
	}

	/**
	 * Instance
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Init
	 */
	public function init() {
		$this->init_components();
	}

	/**
	 * Init components
	 */
	private function init_components() {
		new \ReCAPTCHA_Give\Modules\ReCAPTCHA();

		if ( is_admin() ) {
			new \ReCAPTCHA_Give\Core\Admin\Admin();
		}
	}
}

Plugin::instance();
