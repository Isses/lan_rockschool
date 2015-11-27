<?php
/**
 * Lanfoster Shortcuts for WP
 *
 * @package lanfoster
 * @subpackage lanfosterWP
 */

final class LanfosterWP {

	public $version = '0.1';
	public $cssPATH = '';
	public $pluginsPATH = '';
	protected static $_instance = null;
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public $admin;
	public $front;

	public function __construct() {
		require('lanfosterWP_admin.php' );
		require('lanfosterWP_front.php' );
		$this->securise();
		$this->pluginsPATH = get_template_directory_uri().'/includes/lanfoster-plugins/';
		$this->cssPATH = get_template_directory_uri().'/includes/lanfoster-css/';
		$this->admin = new lanfosterWP_admin();
		$this->front = new lanfosterWP_front();

		require('super-cpt/super-cpt.php' );
	}

	public function logginError( $message ) {
		add_filter( 'login_errors', function() use($message) { return $message; });
	}

	public function securise() {
		remove_action("wp_head", "wp_generator");
	}
}

function lanfosterWP() {
	return lanfosterWP::instance();
}

// Global for backwards compatibility.
$GLOBALS['lanfosterWP'] = lanfosterWP();

