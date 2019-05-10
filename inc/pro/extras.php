<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @package Boilerplate
 */


/**
 * Sets up pro theme features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function boilerplate_pro_setup() {
	/**
	 * Enable support for the Style Manager Customizer section (via Customify).
	 */
	add_theme_support( 'customizer_style_manager' );
}
add_action( 'after_setup_theme', 'boilerplate_pro_setup' );

/**
 * Handle the specific Pixelgrade Care integration.
 *
 * @package Boilerplate
 * @since 1.0.0
 */
function boilerplate_setup_pixelgrade_care() {
	/*
	 * Declare support for Pixelgrade Care
	 */
	add_theme_support( 'pixelgrade_care', array(
			'support_url'   => 'https://pixelgrade.com/docs/boilerplate/',
			'changelog_url' => 'https://wupdates.com/boilerplate-changelog',
		)
	);
}
add_action( 'after_setup_theme', 'boilerplate_setup_pixelgrade_care', 10 );

/**
 * Adds CSS to hide header text for custom logo, based on Customizer setting.
 */
function _boilerplate_custom_logo_header_styles() {
	if ( ! current_theme_supports( 'custom-header', 'header-text' ) && get_theme_support( 'custom-logo', 'header-text' ) ) {
		// remove the default core hook that handles the custom inline CSS for hiding the Site Title & Description.
		remove_action( 'wp_head', '_custom_logo_header_styles', 10 );

		$classes = array();
		if ( ! pixelgrade_option( 'display_site_title' ) ) {
			$classes[] = '.site-title';
		}
		if ( ! pixelgrade_option( 'display_site_description' ) ) {
			$classes[] = '.site-description-text';
		}
		if ( empty( $classes ) ) {
			return;
		}

		$classes = array_map( 'sanitize_html_class', $classes );
		$classes = implode( ', ', $classes );

		?>
        <!-- Custom Logo: hide header text -->
        <style id="custom-logo-css" type="text/css">
            <?php echo esc_attr( $classes ); ?>
            {
                position: absolute;
                clip: rect(1px, 1px, 1px, 1px);
            }
        </style>
		<?php
	}
}
add_action( 'wp_head', '_boilerplate_custom_logo_header_styles', 9 );

/**
 * @todo EXAMPLE!!! PLEASE DO NOT LEAVE IT LIKE THIS!!! MAYBE EVEN DELETE IT!!!
 * Add the markup for the Boilerplate Search Icon.
 */
function boilerplate_search_icon() { ?>
	<div class="search-trigger">
		<button class="js-search-trigger">
			<?php get_template_part( 'template-parts/svg/icon-search' );?>
			<span class="screen-reader-text"><?php esc_html_e( 'Search', '__theme_txtd' ); ?></span>
		</button>
	</div>
    <?php
}
add_action( 'pixelgrade_header_after_navbar_content', 'boilerplate_search_icon', 20 );
