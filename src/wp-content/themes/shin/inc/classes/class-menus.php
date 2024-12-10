<?php
/**
 * ACF Setting
 *
 * @package Shin
 */

namespace SHIN_THEME\Inc;

use SHIN_THEME\Inc\Traits\Singleton;

class Menus {
	use Singleton;

	protected function __construct() {
		//load all class in here
		$this->set_hooks();
	}

	protected function set_hooks() {
		// Menu Register
		add_action( 'init', [ $this, 'register_menu_location' ] );
	}


	public function register_menu_location() {
		register_nav_menus(
			array(
				"primary"   => __( "Primary Menu" ),
				"footer"    => __( "Footer Menu" ),
				"copyright" => __( "Copyright Menu" )
			)
		);
	}
}