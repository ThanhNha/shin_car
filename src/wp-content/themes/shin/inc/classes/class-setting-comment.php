<?php
/**
 * Setting Comment Feature
 *
 * @package Shin
 */

namespace SHIN_THEME\Inc;

use SHIN_THEME\Inc\Traits\Singleton;

class Setting_Comment {
	use Singleton;

	protected function __construct() {
		//load all class in here
		$this->set_hooks();

	}

	protected function set_hooks() {
		// Removing Items From the Admin Bar
		add_action( 'wp_before_admin_bar_render', [ $this, 'shin_wp_admin_bar_remove' ] );
		add_action( 'admin_init', [ $this, 'shin_remove_comment_feature' ] );
		// Close comments on the front-end
		add_filter( 'comments_open', '__return_false', 20, 2 );
		add_filter( 'pings_open', '__return_false', 20, 2 );

		// Hide existing comments
		add_filter( 'comments_array', '__return_empty_array', 10, 2 );

		// Remove comments links from admin bar
		add_action( 'init', [ $this, 'shin_remove_comment_link' ] );
		// Remove comments page in menu
		add_action( 'admin_menu', [ $this, 'shin_remove_comment_page' ] );
	}


	public function shin_wp_admin_bar_remove() {
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu( 'wp-logo' );
		$wp_admin_bar->remove_menu( 'updates' );
		$wp_admin_bar->remove_menu( 'comments' );

		// $wp_admin_bar->remove_menu('customize');
		// $wp_admin_bar->remove_menu('customize-background');
		// $wp_admin_bar->remove_menu('customize-header');
	}

	public function shin_remove_comment_feature() {
		// Redirect any user trying to access comments page
		global $pagenow;

		if ( $pagenow === 'edit-comments.php' ) {
			wp_redirect( admin_url() );
			exit;
		}

		// Remove comments metabox from dashboard
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );

		// Disable support for comments and trackbacks in post types
		foreach ( get_post_types() as $post_type ) {
			if ( post_type_supports( $post_type, 'comments' ) ) {
				remove_post_type_support( $post_type, 'comments' );
			}
		}
	}

	public function shin_remove_comment_link() {
		if ( is_admin_bar_showing() ) {
			remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
		}
	}

	public function shin_remove_comment_page() {
		remove_menu_page( 'edit-comments.php' );
	}


}