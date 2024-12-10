<?php

/**
 * ACF Setting
 *
 * @package Shin
 */

namespace SHIN_THEME\Inc;

use SHIN_THEME\Inc\Traits\Singleton;

class Acf
{
	use Singleton;

	protected function __construct()
	{
		// wp_die('hello');
		//load all class in here
		$this->set_hooks();
	}

	protected function set_hooks()
	{
		//Add ACF options page
		$this->shin_setting_page();
		// Local JSON acf
		add_filter('acf/settings/save_json', [$this, 'my_acf_json_save_point']);
		add_filter('acf/settings/load_json', [$this, 'my_acf_json_load_point']);
		add_filter('acf/fields/google_map/api', [$this, 'shin_acf']);
	}



	public function shin_setting_page()
	{
		if (function_exists('acf_add_options_page')) {
			$parent = acf_add_options_page(__('Site Settings', 'Shin'));
		}
	}


	public function my_acf_json_save_point($path)
	{
		$theme_dir = SHIN_SSD_PATH;
		// Create our directory if it doesn't exist.
		if (!is_dir($theme_dir .= '/acf-field')) {
			mkdir($theme_dir, 0755);
		}
		$path = SHIN_SSD_PATH . '/acf-field';

		return $path;
	}


	public function my_acf_json_load_point($paths)
	{
		// remove original path (optional)
		unset($paths[0]);
		$paths[] = SHIN_SSD_PATH . '/acf-field';

		return $paths;
	}
	function shin_acf($api)
	{

		$api['key'] = 'AIzaSyAWXH4d76M9WHvvP60WwnD3F532SoToxkE';

		return $api;
	}
}
