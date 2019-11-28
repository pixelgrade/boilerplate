<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Boilerplate
 * @since 1.1.0
 */

if ( ! function_exists( 'boilerplate_google_fonts_url' ) ) {
	/**
	 * Register Google fonts for Boilerplate.
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function boilerplate_google_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';


		/* Translators: If there are characters in your language that are not
		* supported by Bungee, translate this to 'off'. Do not translate
		* into your own language.
		*/
		if ( 'off' !== esc_html_x( 'on', 'Bungee font: on or off', '__theme_txtd' ) ) {
			$fonts[] = 'Bungee';
		}

		if ( 'off' !== esc_html_x( 'on', 'IBM Plex Sans font: on or off', '__theme_txtd' ) ) {
			$fonts[] = 'IBM Plex Sans:300,400,500,700';
		}

		/* translators: To add an additional character subset specific to your language, translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language. */
		$subset = esc_html_x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', '__theme_txtd' );

		if ( 'cyrillic' == $subset ) {
			$subsets .= ',cyrillic,cyrillic-ext';
		} elseif ( 'greek' == $subset ) {
			$subsets .= ',greek,greek-ext';
		} elseif ( 'devanagari' == $subset ) {
			$subsets .= ',devanagari';
		} elseif ( 'vietnamese' == $subset ) {
			$subsets .= ',vietnamese';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), '//fonts.googleapis.com/css' );
		}

		return $fonts_url;
	} #function
}


/**
 * Prevent the comments from being shown by default.
 */
add_filter( 'pixelgrade_get_comments_toggle_checked_attribute', '__return_empty_string' );

/**
 * Dequeue various scripts.
 */
function boilerplate_dequeue_scripts() {
	// Dequeue the Jetpack Social Menu Javascript as we don't need it.
	wp_dequeue_style( 'jetpack-social-menu' );
}
add_action( 'wp_enqueue_scripts', 'boilerplate_dequeue_scripts', 20 );

/**
 * Display the hidden "Styles" drop-down in the Advanced editor bar.
 *
 * @see https://codex.wordpress.org/TinyMCE_Custom_Styles
 */
function boilerplate_mce_editor_buttons( $buttons ) {
	array_unshift( $buttons, 'styleselect' );

	return $buttons;
}
add_filter( 'mce_buttons_2', 'boilerplate_mce_editor_buttons' );

/**
 * Add styles/classes to the "Styles" drop-down.
 *
 * @see https://codex.wordpress.org/TinyMCE_Custom_Styles
 *
 * @param array $settings
 *
 * @return array
 */
function boilerplate_mce_before_init( $settings ) {

	$style_formats = array(
		array( 'title' => esc_html__( 'Intro Text', '__theme_txtd' ), 'selector' => 'p', 'classes' => 'intro' ),
		array( 'title' => esc_html__( 'Highlight', '__theme_txtd' ), 'inline' => 'span', 'classes' => 'highlight' ),
		array( 'title' => esc_html__( 'Dropcap', '__theme_txtd' ), 'inline' => 'span', 'classes' => 'dropcap' ),
		array(
			'title'   => esc_html__( 'Pull Left', '__theme_txtd' ),
			'wrapper' => true,
			'block'   => 'blockquote',
			'classes' => 'pull-left'
		),
		array(
			'title'   => esc_html__( 'Pull Right', '__theme_txtd' ),
			'wrapper' => true,
			'block'   => 'blockquote',
			'classes' => 'pull-right'
		),
	);

	$settings['style_formats'] = json_encode( $style_formats );

	return $settings;
}
add_filter( 'tiny_mce_before_init', 'boilerplate_mce_before_init' );

/**
 * Add specific classes for Archive page.
 */
function boilerplate_alter_archive_post_classes( $classes = array() ) {
	$location = pixelgrade_get_location();

	if ( pixelgrade_in_location( 'index blog post portfolio jetpack', $location, false ) && ! is_single() ) {
		$classes[] = 'c-boilerplate__item';
		$classes[] = 'c-boilerplate__item--post';

		if ( has_post_thumbnail() ) {
			$classes[] = 'c-boilerplate__item--image';
		} else {
			$classes[] = 'c-boilerplate__item--no-image';
		}
	}

	return $classes;
}
add_filter( 'post_class', 'boilerplate_alter_archive_post_classes', 20, 1 );

/**
 * Add specific classes for Body.
 *
 * @param array $classes Contains the CSS classes that will be used.
 *
 * @return array
 */
function boilerplate_alter_body_classes( $classes ) {

	return $classes;
}
add_filter( 'body_class', 'boilerplate_alter_body_classes', 20, 1 );

/**
 * Handle the WUpdates theme identification.
 *
 * @param array $ids
 *
 * @return array
 */
function boilerplate_wupdates_add_id_wporg( $ids = array() ) {
	//  @todo EXAMPLE!!! PLEASE DO NOT LEAVE IT LIKE THIS!!! PUT IN THE PROPER DATA GENERATED WITH THE CODE BELLOW (PUT A BREAKPOINT : )!!!
//	/*
//	 * Temporary code to generate the digest for the wupdates code for free themes.
//	 */
//	$theme_stylesheet_name = 'Boilerplate';
//	$slug         = 'boilerplate';
//	$hash_id = 'v7zV3'; // the WUpdates main theme hash ID
//	$type = 'theme_modular_wporg';
//	// This is the digest you need to paste in the array at the end of the function.
//	$theme_digest = md5( 'name-' . $theme_stylesheet_name . ';slug-' . $slug . ';id-' . $hash_id . ';type-' . $type );
//	/*
//	 * End of temporary code.
//	 */

	// First get the theme directory name (unique)
	$slug = basename( get_template_directory() );

	// Now add the predefined details about this product
	// Do not tamper with these please!!!
	$ids[ $slug ] = array( 'name' => 'Boilerplate', 'slug' => 'boilerplate', 'id' => 'JDKZB', 'type' => 'theme_modular_wporg', 'digest' => '0352ff8297cd42ec6f7c03ee9287559e', );

	return $ids;
}
// The 5 priority is intentional to allow for pro to overwrite.
add_filter( 'wupdates_gather_ids', 'boilerplate_wupdates_add_id_wporg', 5, 1 );

function boilerplate_maybe_load_pro_features() {
	if ( true === pixelgrade_user_has_access( 'pro-features' ) ) {
		pixelgrade_autoload_dir( 'inc/pro' );
	} else {
		pixelgrade_autoload_dir( 'inc/lite' );
	}
}
// We want to do this as early as possible. So the zero priority is as intended.
add_action( 'after_setup_theme', 'boilerplate_maybe_load_pro_features', 0 );

function boilerplate_woocommerce_setup() {
	if ( function_exists( 'WC') && pixelgrade_user_has_access('woocommerce') ) {
		require_once trailingslashit( get_template_directory() ) . 'inc/integrations/woocommerce.php';
	}
}
add_action( 'after_setup_theme', 'boilerplate_woocommerce_setup', 10 );
