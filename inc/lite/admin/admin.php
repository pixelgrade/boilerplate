<?php
/**
 * Boilerplate Theme admin dashboard logic.
 *
 * @package Boilerplate
 */

function boilerplate_lite_admin_setup() {

	/**
	 * Load and initialize Pixelgrade Assistant notice logic.
	 * @link https://wordpress.org/plugins/pixelgrade-assistant/
	 */
	require_once trailingslashit( get_template_directory() ) . 'inc/admin/pixelgrade-assistant-notice/class-notice.php';
	PixelgradeAssistant_Install_Notice::init();
}
add_action( 'after_setup_theme', 'boilerplate_lite_admin_setup' );

function boilerplate_lite_admin_assets() {
	wp_enqueue_style( 'boilerplate_lite_admin_style', get_template_directory_uri() . '/inc/lite/admin/css/admin.css', array(), '1.0.0', false );
}
add_action( 'admin_enqueue_scripts', 'boilerplate_lite_admin_assets' );
