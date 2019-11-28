<?php
/**
 * Handle the specific Components integration.
 *
 * Development notice: This file is synced from the variations directory! Do not edit in the `inc` directory!
 *
 * @package Boilerplate
 * @since 1.0.0
 */

/**
 * @todo EXAMPLE!!! PLEASE DO NOT LEAVE IT LIKE THIS!!!
 */
function boilerplate_setup_components() {
	/*
	 * Declare support for the Pixelgrade Components the theme uses.
	 * Please note that some components will load regardless (like Base, Blog, Header, Footer).
	 * It is safe although to declare support for all that you use (for future proofing).
	 */
	add_theme_support( 'pixelgrade-base-component' );
	add_theme_support( 'pixelgrade-blog-component' );
	add_theme_support( 'pixelgrade-header-component' );
	add_theme_support( 'pixelgrade-hero-component' );
	add_theme_support( 'pixelgrade-footer-component' );
	add_theme_support( 'pixelgrade-featured-image-component' );
	add_theme_support( 'pixelgrade-gallery-settings-component' );
	add_theme_support( 'pixelgrade-multipage-component' );
	add_theme_support( 'pixelgrade-portfolio-component' );

	if ( pixelgrade_user_has_access( 'woocommerce' ) ) {
		add_theme_support( 'pixelgrade-woocommerce-component' );
}
add_action( 'after_setup_theme', 'boilerplate_setup_components', 10 );

/**
 * @todo EXAMPLE!!! PLEASE DO NOT LEAVE IT LIKE THIS!!!
 * Add the required features regarding the header component, mainly options regarding menus.
 *
 * @param array $config The array containing all the active features of the header component.
 *
 * @return array
 */
function boilerplate_alter_header_component_config( $config ) {
	// Output markup in the header, even if empty (aka no menu assigned).
	$config['zones']['left']['display_blank'] = true;

	$config['menu_locations']['primary-left'] = array(
		'title'         => esc_html__( 'Header Top', '__theme_txtd' ),
		'default_zone'  => 'left',
		// This callback should always accept 3 parameters as documented in pixelgrade_header_get_zones()
		'zone_callback' => false,
		'order'         => 10,
		// We will use this to establish the display order of nav menu locations, inside a certain zone
		'nav_menu_args' => array( // skip 'theme_location' and 'echo' args as we will force those
			'menu_id'         => 'menu-1',
			'container'       => 'nav',
			'container_class' => '',
			'fallback_cb'     => false,
			'depth'           => 0,
		),
	);

	if ( ! pixelgrade_user_has_access( 'pro-features' ) ) {
		unset( $config['menu_locations']['primary-right'] );
		$config['menu_locations']['primary-left']['nav_menu_args']['depth'] = 1;
	} else {
		$config['menu_locations']['primary-right']['title'] = esc_html__( 'Header Bottom', '__theme_txtd' );
	}

	return $config;
}
add_filter( 'pixelgrade_header_config', 'boilerplate_alter_header_component_config', 10, 1 );
