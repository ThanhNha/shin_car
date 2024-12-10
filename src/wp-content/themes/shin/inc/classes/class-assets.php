<?php

/**
 * Assets of the Theme
 *
 * @package Shin
 */

namespace SHIN_THEME\Inc;

use SHIN_THEME\Inc\Traits\Singleton;

class Assets
{
	use Singleton;

	protected function __construct()
	{
		//load all class in here
		$this->set_hooks();
	}

	protected function set_hooks()
	{
		//In here hook and filter
		add_action('wp_enqueue_scripts', [$this, 'register_styles']);
		add_action('wp_enqueue_scripts', [$this, 'register_scripts']);
	}

	public function register_styles()
	{
		//Register Custom Css

		wp_enqueue_style(
			'main-style',
			SHIN_DIR_URL . '-child/assets/dist/css/main.min.css',
			array(),
			filemtime(SHIN_SSD_PATH . '/assets/dist/css/main.min.css'),
			'all'
		);
		wp_enqueue_style(
			'main-style',
			'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
			array(),

		);
	}

	public function register_scripts()
	{
		//Register main script
		wp_enqueue_script(
			'main-scripts-js',
			SHIN_DIR_URL . '-child/assets/dist/js/main.min.js',
			array('jquery'),
			filemtime(SHIN_SSD_PATH . '/assets/dist/js/main.min.js'),
			true
		);
		wp_enqueue_script(
			'main-scripts',
			'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
			array('jquery'),

		);
	}
}
