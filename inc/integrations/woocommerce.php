<?php
/**
 * Handle the WooCommerce integration logic specific for this theme
 */


// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function boilerplate_woocommerce_styles() {
	$theme  = wp_get_theme( get_template() );
	wp_enqueue_style( 'boilerplate-woocommerce', get_template_directory_uri() . '/woocommerce.css', array( 'boilerplate-style' ), $theme->get( 'Version' ) );
}

add_action( 'wp_enqueue_scripts', 'boilerplate_woocommerce_styles', 10 );

function boilerplate_alterCartMenuItem() {
	$cart_item_count = WC()->cart->get_cart_contents_count();
	$cart_count_span = '';
	$class = '';

	if ( $cart_item_count ) {
		$cart_count_span = '<div class="cart-count"><span>' . esc_html( $cart_item_count ) . '</span></div>';
		$class = 'cart-has-items';
	}

	$cart_link               = apply_filters( 'pixelgrade_cart_menu_item_markup', '<div class="menu-item '. $class .'  menu-item--cart"><a class="js-open-cart" href="' . esc_url( get_permalink( wc_get_page_id( 'cart' ) ) ) . '">' . esc_html__( 'My Cart', '__components_txtd' ) . $cart_count_span . '</a></div>' );

	echo $cart_link;
}


function boilerplate_remove_cart_menu_icon() {
	$woocommerce_layout_instance = Pixelgrade_Woocommerce_Layout::instance( null );
	remove_filter( 'wp_nav_menu_items', array( $woocommerce_layout_instance, 'appendCartIconToMenu' ), 10 );
	add_action('pixelgrade_header_before_navbar_content', 'boilerplate_alterCartMenuItem', 10);
}
add_action( 'init', 'boilerplate_remove_cart_menu_icon', 20 );

function boilerplate_alter_woocommerce_blocks( $config ) {
	$config['blocks']['entry-header-archive'] = array(
		'type'      => 'template_part',
		'templates' => array(
			array(
				'component_slug' => 'woocommerce',
				'slug' => 'entry-header',
				'name' => 'archive-dropdown',
			),
		),
	);

	$config['blocks']['container'] = array(
		'type'     => 'layout',
		'wrappers' => array(
			'sides-spacing' => array(
				'classes'  => 'u-container-sides-spacing',
			),
			'wrapper'       => array(
				'classes'  => 'o-wrapper u-woocommerce-grid-width',
			),
		),
	);

	return $config;
}
add_filter( 'pixelgrade_woocommerce_config', 'boilerplate_alter_woocommerce_blocks' );

//Remove the notice that shows the number of results.
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering',30 );

function boilerplate_woocommerce_pagination_args( $args ) {
	$args['prev_text'] = esc_html_x( '« Previous', 'previous set of posts', '__theme_txtd' );
	$args['next_text'] = esc_html_x( 'Next »', 'next set of posts', '__theme_txtd' );
	$args['type'] = null;
	return $args;
}
add_filter( 'woocommerce_comment_pagination_args', 'boilerplate_woocommerce_pagination_args', 40, 1 );
add_filter( 'woocommerce_pagination_args', 'boilerplate_woocommerce_pagination_args', 10 );
