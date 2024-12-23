<?php
/**
 * Main class base
 *
 * @package Shin
 */

namespace SHIN_THEME\Inc;

use SHIN_THEME\Inc\Traits\Singleton;

class SHIN_THEME {
	use Singleton;

	protected function __construct() {
		//load all class in here
		$this->set_hooks();
		Assets::get_instance();
		Settings::get_instance();
		Menus::get_instance();
		Setting_Comment::get_instance();
		// Admin::get_instance();
		Acf::get_instance();
		Optimise::get_instance();
		Custom_Post_Type::get_instance();
		Remove_CPT_Slug::get_instance();
		Remove_Tax_Slug::get_instance();
	}

	protected function set_hooks() {
		//In here hook and filter
		define('DISALLOW_FILE_EDIT', true);
	}

}
