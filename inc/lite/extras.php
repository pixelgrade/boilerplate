<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package Boilerplate
 * @since 1.1.0
 */

/**
 * Admin Dashboard logic.
 */
require pixelgrade_get_parent_theme_file_path( pixelgrade_get_theme_relative_path( __DIR__ ) . 'admin/admin.php' ); // phpcs:ignore

/**
 * @todo EXAMPLE!!! PLEASE DO NOT LEAVE IT LIKE THIS!!!
 * Generate a link to the Boilerplate (Free) info page.
 */
function boilerplate_lite_get_pro_link() {
	return 'https://pixelgrade.com/themes/blogging/boilerplate-pro?utm_source=boilerplate-lite-clients&utm_medium=customizer&utm_campaign=boilerplate-lite';
}

/**
 * @todo EXAMPLE!!! PLEASE DO NOT LEAVE IT LIKE THIS!!!
 */
function boilerplate_lite_footer_credits_url( $url ) {
	return 'https://pixelgrade.com/?utm_source=boilerplate-lite-clients&utm_medium=footer&utm_campaign=boilerplate-lite';
}
add_filter( 'pixelgrade_footer_credits_url', 'boilerplate_lite_footer_credits_url' );

function boilerplate_lite_body_classes( $classes ) {

	$classes[] = 'lite-version';

	return $classes;
}
add_filter( 'body_class', 'boilerplate_lite_body_classes' );

/**
 * @todo EXAMPLE!!! PLEASE DO NOT LEAVE IT LIKE THIS!!! MAYBE EVEN DELETE IT!!!
 */
function boilerplate_alter_footer_component_config( $config ) {

	unset($config['sidebars']['sidebar-footer']);

	return $config;
}
add_filter( 'pixelgrade_footer_initial_config', 'boilerplate_alter_footer_component_config', 10 );
