<?php
/**
 * Boilerplate Customizer Options Config
 *
 * @package Boilerplate
 * @since 1.0.0
 */

/**
 * Hook into the Customify's fields and settings.
 *
 * The config can turn to be complex so is best to visit:
 * https://github.com/pixelgrade/customify
 *
 * @param array $options Contains the plugin's options array right before they are used, so edit with care
 *
 * @return array The returned options are required, if you don't need options return an empty array
 */
add_filter( 'customify_filter_fields', 'boilerplate_add_customify_options', 11, 1 );

// Modify Customify Config
add_filter( 'customify_filter_fields', 'pixelgrade_add_customify_style_manager_section', 12, 1 );
add_filter( 'pixelgrade_customify_general_section_options', 'boilerplate_customify_general_section', 10, 2 );
add_filter( 'pixelgrade_header_customify_section_options', 'boilerplate_customify_header_section', 10, 2 );
add_filter( 'pixelgrade_customify_main_content_section_options', 'boilerplate_customify_main_content_section', 10, 2 );
add_filter( 'pixelgrade_customify_buttons_section_options', 'boilerplate_customify_buttons_section', 10, 2 );
add_filter( 'pixelgrade_footer_customify_section_options', 'boilerplate_customify_footer_section', 10, 2 );
add_filter( 'pixelgrade_customify_blog_grid_section_options', 'boilerplate_customify_blog_grid_section', 10, 2 );

// @todo EXAMPLE!!! PLEASE DO NOT LEAVE IT LIKE THIS!!!

define( 'SM_COLOR_PRIMARY',     '#FFB1A5' ); // Pink (used at 40% opacity)
define( 'SM_COLOR_SECONDARY',   '#E79696' ); // Darker Pink
define( 'SM_COLOR_TERTIARY',    '#383E5A' ); // Vibrant Blue

define( 'SM_DARK_PRIMARY',      '#34394B' ); // Blueish
define( 'SM_DARK_SECONDARY',    '#49494B' ); // Dark Grey
define( 'SM_DARK_TERTIARY',     '#A2A3A2' ); // Light Grey

define( 'SM_LIGHT_PRIMARY',     '#FFFFFF' ); // White
define( 'SM_LIGHT_SECONDARY',   '#FFF4F4' ); // Light Pink
define( 'SM_LIGHT_TERTIARY',    '#FFF5C1' ); // Light Yellow

define( 'SM_HEADINGS_FONT',     'IBM Plex Sans' );
define( 'SM_ACCENT_FONT',       'IBM Plex Sans' );
define( 'SM_BODY_FONT',         'IBM Plex Sans' );
define( 'SM_LOGO_FONT',         'Bungee' );

function boilerplate_add_customify_options( $options ) {
	$options['opt-name'] = 'boilerplate_options';

	//start with a clean slate - no Customify default sections
	$options['sections'] = array();

	return $options;
}

/**
 * Add the Style Manager cross-theme Customizer section.
 *
 * @param array $options
 *
 * @return array
 */
function pixelgrade_add_customify_style_manager_section( $options ) {
	// If the theme hasn't declared support for style manager, bail.
	if ( ! current_theme_supports( 'customizer_style_manager' ) ) {
		return $options;
	}

	if ( ! isset( $options['sections']['style_manager_section'] ) ) {
		$options['sections']['style_manager_section'] = array();
	}

	// The section might be already defined, thus we merge, not replace the entire section config.
	$options['sections']['style_manager_section'] = array_replace_recursive( $options['sections']['style_manager_section'], array(
		'options' => array(
			'sm_color_primary' => array(
				'default' => SM_COLOR_PRIMARY,
				'connected_fields' => array(
					'accent_color'
				),
				'css'     => array(
					array(
						'property' => '--sm-color-primary',
						'selector' => ':root',
					),
				),
			),
			'sm_color_secondary' => array(
				'default' => SM_COLOR_SECONDARY,
				'connected_fields' => array(
					'accent_light_color'
				),
				'css'     => array(
					array(
						'property' => '--sm-color-secondary',
						'selector' => ':root',
					),
				),
			),
			'sm_color_tertiary' => array(
				'default' => SM_COLOR_TERTIARY,
				'connected_fields' => array(
					'tertiary_color'
				),
				'css'     => array(
					array(
						'property' => '--sm-color-tertiary',
						'selector' => ':root',
					),
				),
			),
			'sm_dark_primary' => array(
				'default' => SM_DARK_PRIMARY,
				'connected_fields' => array(
					'main_content_border_color',
					'main_content_page_title_color',
					'main_content_body_link_color',
					'main_content_body_link_active_color',
					'main_content_heading_1_color',
					'main_content_heading_2_color',
					'main_content_heading_3_color',
					'main_content_heading_4_color',
					'main_content_heading_5_color',
					'main_content_heading_6_color',
					'header_links_active_color',
					'footer_background',
					'buttons_color',
				),
				'css'     => array(
					array(
						'property' => '--sm-dark-primary',
						'selector' => ':root',
					),
					array(
						'property' => 'color',
						'selector' => '.c-boilerplate__item--widget',
					),
				),
			),
			'sm_dark_secondary' => array(
				'default' => SM_DARK_SECONDARY,
				'connected_fields' => array(
					'main_content_body_text_color',
				),
				'css'     => array(
					array(
						'property' => '--sm-dark-secondary',
						'selector' => ':root',
					),
				),
			),
			'sm_dark_tertiary' => array(
				'default' => SM_DARK_TERTIARY,
				'connected_fields' => array(
				),
				'css'     => array(
					array(
						'property' => '--sm-dark-tertiary',
						'selector' => ':root',
					),
				),
			),
			'sm_light_primary' => array(
				'default' => SM_LIGHT_PRIMARY,
				'connected_fields' => array(
					'main_content_content_background_color',
					'header_navigation_links_color',
					'footer_body_text_color',
					'buttons_text_color',
				),
				'css'     => array(
					array(
						'property' => '--sm-light-primary',
						'selector' => ':root',
					),
				),
			),
			'sm_light_secondary' => array(
				'default' => SM_LIGHT_SECONDARY,
				'connected_fields' => array(
					'accent_lighter_color',
					'header_background',
					'footer_links_color',
				),
				'css'     => array(
					array(
						'property' => '--sm-light-secondary',
						'selector' => ':root',
					),
				),
			),
			'sm_light_tertiary' => array(
				'default' => SM_LIGHT_TERTIARY,
				'connected_fields' => array(
					'light_tertiary_color'
				),
				'css'     => array(
					array(
						'property' => '--sm-light-tertiary',
						'selector' => ':root',
					),
				),
			),
		),
	));

	return $options;
}

/**
 * Modify the Customify config for the General Section - from the Base component
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $general_section The modified specific config
 */
function boilerplate_customify_general_section( $section_options, $options ) {

	$new_section_options = array(
		// General
		'general' => array(
			'options' => array(
			),
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $new_section_options );

	return $section_options;
}

/**
 * Main Content Section
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $main_content_section The modified specific config
 */
function boilerplate_customify_main_content_section( $section_options, $options ) {

	// First setup the default values
	// These should always come from the theme, not relying on the component's defaults
	$new_section_options = array(

		// Main Content
		'main_content' => array(
			'options' => array(
				'main_content_border_color'             => array(
					'default' => SM_DARK_PRIMARY,
					'css' => array(
						array(
							'property' => 'background-color',
							'selector' => 'body.u-content-background,
								.profile-photo-link__label:after',
						),
						array(
							'property' => 'color',
							'selector' => '.c-card .wave-svg-mask,
								.c-reading-progress,
								.profile-photo-link--default svg',
						),
					),
				),
				'main_content_page_title_color'         => array(
					'default' => SM_DARK_PRIMARY,
					'css' => array(
						array(
							'selector' => '.c-search-overlay .search-field, .entry-title, .h0',
							'property' => 'color',
						),
					),
				),
				'main_content_body_text_color'          => array(
					'default' => SM_DARK_SECONDARY
				),
				'main_content_body_link_color'          => array(
					'default' => SM_DARK_PRIMARY
				),
				'main_content_body_link_active_color'   => array(
					'default' => SM_DARK_PRIMARY
				),
				'main_content_underlined_body_links'    => array(
					'default' => SM_DARK_PRIMARY
				),
				'main_content_heading_1_color'          => array(
					'default' => SM_DARK_PRIMARY
				),
				'main_content_heading_2_color'          => array(
					'default' => SM_DARK_PRIMARY
				),
				'main_content_heading_3_color'          => array(
					'default' => SM_DARK_PRIMARY
				),
				'main_content_heading_4_color'          => array(
					'default' => SM_DARK_PRIMARY
				),
				'main_content_heading_5_color'          => array(
					'default' => SM_DARK_PRIMARY
				),
				'main_content_heading_6_color'          => array(
					'default' => SM_DARK_PRIMARY
				),
				'main_content_content_background_color' => array(
					'default' => SM_LIGHT_PRIMARY,
					'css' => array(
						array(
							'property' => 'background-color',
							'selector' => '
								.c-footer-layers__background,
								.c-footer-layers__accent,
								.c-navbar__zone--left .menu > li > a:before,
								.c-search-overlay,
								.c-reading-progress,
								.page .header:after,
								.single .header:after,
								.profile-photo-link--admin svg'
						),
						array(
							'property' => 'color',
							'selector' => '.profile-photo-link__label,
										   .u-buttons-solid  .search-submit[class]:hover'
						),
					),
				),
				'main_content_page_title_font'          => array(
					'selector' => '.c-search-overlay .search-field, .entry-title, .h0',
					'default' => array(
						'font-family'    => SM_HEADINGS_FONT,
						'font-weight'    => '700',
						'font-size'      => 74,
						'line-height'    => 1.08,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_body_text_font'           => array(
					'default' => array(
						'font-family'    => SM_BODY_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 15,
						'line-height'    => 1.6,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_paragraph_text_font'      => array(
					'selector' => '.entry-content, .site-description, .mce-content-body',
					'default' => array(
						'font-family'    => SM_BODY_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 18,
						'line-height'    => 1.67,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_quote_block_font'         => array(
					'selector' => 'blockquote, .intro',
					'default'  => array(
						'font-family'    => SM_ACCENT_FONT,
						'font-weight'    => 'italic',
						'font-size'      => 18,
						'line-height'    => 1.67,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_heading_1_font'           => array(
					'default' => array(
						'font-family'    => SM_HEADINGS_FONT,
						'font-weight'    => '700',
						'font-size'      => 56,
						'line-height'    => 1.05,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_heading_2_font'           => array(
					'default' => array(
						'font-family'    => SM_HEADINGS_FONT,
						'font-weight'    => '700',
						'font-size'      => 42,
						'line-height'    => 1.15,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_heading_3_font'           => array(
					'default' => array(
						'font-family'    => SM_HEADINGS_FONT,
						'font-weight'    => '700',
						'font-size'      => 32,
						'line-height'    => 1.2,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_heading_4_font'           => array(
					'default' => array(
						'font-family'    => SM_HEADINGS_FONT,
						'font-weight'    => '700',
						'font-size'      => 24,
						'line-height'    => 1.3,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_heading_5_font'           => array(
					'selector' => 'h5, .header-category,
							ul.page-numbers,
							.c-author__name,
							.c-reading-progress__label,
							.post-navigation .nav-links__label,
							.cats__title,
							.tags__title,
							.sharedaddy--official h3.sd-title[class]',
					'default'  => array(
						'font-family'    => SM_ACCENT_FONT,
						'font-weight'    => '500',
						'font-size'      => 18,
						'line-height'    => 1.4,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_heading_6_font'           => array(
					'selector' => 'h6, .h6,
									.comment-reply-title a, .comment__metadata a,
									.edit-link a, .logged-in-as a, .reply a',
					'default'  => array(
						'font-family'    => SM_ACCENT_FONT,
						'font-weight'    => '500',
						'font-size'      => 14,
						'line-height'    => 1.5,
						'letter-spacing' => 0.05,
						'text-transform' => 'uppercase',
					),
				),
			),
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $new_section_options );

	$options_to_be_removed = array(
		'main_content_container_width',
		'main_content_container_sides_spacing',
		'main_content_content_width',
		'main_content_container_padding',
		'main_content_border_width',
	);

	foreach ( $options_to_be_removed as $option_name ) {
		unset( $section_options['main_content']['options'][ $option_name ] );
	}

	return $section_options;
}

/**
 * Buttons Section
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $main_content_section The modified specific config
 */
function boilerplate_customify_buttons_section( $section_options, $options ) {
	$buttons = array(
		'.c-btn',
		'.c-card__action',
		'.c-comments-toggle__label',
		'.comment-respond .submit',
		'.cats a',
		'.button:not(.default)',
		'button[type=button]',
		'button[type=reset]',
		'button[type=submit]',
		'input[type=button]',
		'input[type=submit]',
		'div.wpforms-container[class] .wpforms-form .wpforms-submit',
	);

	$new_section_options = array(

		// Main Content
		'buttons' => array(
			'options' => array(
				'buttons_style' => array(
					'default' => 'solid',
				),
				'buttons_shape' => array(
					'default' => 'rounded',
				),
				'buttons_color'      => array(
					'default' => SM_DARK_PRIMARY,
				),
				'buttons_text_color' => array(
					'default' => SM_LIGHT_PRIMARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => implode( ',', $buttons )
						),
					),
				),
				'buttons_font'       => array(
					'default'  => array(
						'font-family'    => SM_ACCENT_FONT,
						'font-weight'    => '500',
						'font-size'      => 17,
						'line-height'    => 1.94,
						'letter-spacing' => 0,
					),
				),
			)
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $new_section_options );

	return $section_options;
}

/**
 * Blog Grid Section
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $main_content_section The modified specific config
 */
function boilerplate_customify_blog_grid_section( $section_options, $options ) {
	// First setup the default values
	// These should always come from the theme, not relying on the component's defaults
	$new_section_options = array(
		// Blog Grid
		'blog_grid' => array(
			'options' => array(
				// [Section] Layout
				'blog_grid_width'                    => array(
					'default' => 1240,
				),
				'blog_container_sides_spacing'       => array(
					'default' => 42,
				),
				// [Sub Section] Items Grid
				'blog_grid_layout'                   => array(
					'default' => 'regular',
				),
				'blog_items_aspect_ratio'            => array(
					'default' => 50,
				),
				'blog_items_per_row'                 => array(
					'default' => 3,
				),
				'blog_items_vertical_spacing'        => array(
					'default' => 32,
				),
				'blog_items_horizontal_spacing'      => array(
					'default' => 32,
				),
				// [Sub Section] Items Title
				'blog_items_title_position'          => array(
					'default' => 'below',
				),
				'blog_items_title_alignment_nearby'  => array(
					'default' => 'left',
				),
				'blog_items_title_alignment_overlay' => array(
					'default' => 'middle-center',
				),
				// Title Visiblity
				'blog_items_title_visibility'        => array(
					'default' => 1,
				),
				// Excerpt Visiblity
				'blog_items_excerpt_visibility'      => array(
					'default' => 1,
				),
				// [Sub Section] Items Meta
				'blog_items_primary_meta'            => array(
					'default' => 'category',
				),
				'blog_items_secondary_meta'          => array(
					'default' => 'date',
				),

				// [Section] COLORS
				'blog_item_title_color'              => array(
					'default' => '#333131',
				),
				'blog_item_meta_primary_color'       => array(
					'default' => THEME_ACCENT_COLOR,
				),
				'blog_item_meta_secondary_color'     => array(
					'default' => THEME_ACCENT_COLOR,
				),
				'blog_item_thumbnail_background'     => array(
					'default' => '#000000',
				),
				'blog_item_excerpt_color'              => array(
					'default' => THEME_ACCENT_COLOR,
				),

				// [Sub Section] Thumbnail Hover
				'blog_item_thumbnail_hover_opacity'  => array(
					'default' => 1,
				),

				// [Section] FONTS
				'blog_item_title_font'           => array(
					'default' => array(
						'font-family'    => SM_HEADINGS_FONT,
						'font-weight'    => '700',
						'font-size'      => 21,
						'line-height'    => 1.3,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'blog_item_meta_font'            => array(
					'default' => array(
						'font-family'    => SM_LOGO_FONT,
						'font-weight'    => '400',
						'font-size'      => 13,
						'line-height'    => 1.1,
						'letter-spacing' => 0.1,
						'text-transform' => 'uppercase',
					),
				),
				'blog_item_excerpt_font'         => array(
					'default' => array(
						'font-family'    => SM_BODY_FONT,
						'font-weight'    => '400',
						'font-size'      => 16,
						'line-height'    => 1.5,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
			),
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $new_section_options );

	return $section_options;
}

/**
 * Header Section
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $main_content_section The modified specific config
 */
function boilerplate_customify_header_section( $section_options, $options ) {

	$new_section_options = array(
		'header_section' => array(
			'options' => array(
				// [Section] Layout
				'header_logo_height'              => array(
					'default' => 30,
				),
				'header_height'                   => array(
					'default' => 87,
				),
				'header_navigation_links_spacing' => array(
					'default' => 56,
				),
				'header_position'                 => array(
					'default' => 'sticky',
				),
				'header_width'                    => array(
					'default' => 'full',
				),
				'header_sides_spacing'            => array(
					'default' => 42,
				),

				// [Section] COLORS
				'header_navigation_links_color'   => array(
					'default' => '#323232',
				),
				'header_links_active_color'       => array(
					'default' => SM_DARK_PRIMARY,
				),
				'header_links_active_style'       => array(
					'default' => 'active',
				),
				'header_background'               => array(
					'default' => '#F5F6F1',
				),

				// [Section] FONTS
				'header_site_title_font'          => array(
					'default' => array(
						'font-family'    => SM_LOGO_FONT,
						'font-weight'    => '400',
						'font-size'      => 30,
						'line-height'    => 1,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'header_navigation_font'          => array(
					'default' => array(
						'font-family'    => SM_ACCENT_FONT,
						'font-weight'    => '500',
						'font-size'      => 16,
						'line-height'    => 1,
						'letter-spacing' => 0,
						'text-transform' => 'none'
					),
				),
			),
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $new_section_options );

	return $section_options;
}

/**
 * Footer Section
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $main_content_section The modified specific config
 */
function boilerplate_customify_footer_section( $section_options, $options ) {
	// First setup the default values
	// These should always come from the theme, not relying on the component's defaults
	$new_section_options = array(
		// Footer
		'footer_section' => array(
			'options' => array(
				// [Section] Layout
				'copyright_text'               => array(
					/* translators: %year%: current year  %site-title%: the site title */
					'default' => esc_html__( '&copy; %year% %site-title%.', '__theme_txtd' ),
				),
				'footer_top_spacing'           => array(
					'default' => 80,
				),
				'footer_bottom_spacing'        => array(
					'default' => 56,
				),
				'footer_hide_back_to_top_link' => array(
					'default' => false,
				),
				'footer_hide_credits'          => array(
					'default' => false,
				),
				'footer_layout'                => array(
					'default' => 'row',
				),

				// [Section] COLORS
				'footer_body_text_color'       => array(
					'default' => SM_LIGHT_PRIMARY,
				),
				'footer_links_color'           => array(
					'default' => SM_LIGHT_SECONDARY,
				),
				'footer_background'            => array(
					'default' => SM_DARK_PRIMARY,
				),
			),
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $new_section_options );

	return $section_options;
}

function boilerplate_add_default_color_palette( $color_palettes ) {

	$color_palettes = array_merge(array(
		'default' => array(
			'label' => esc_html__( 'Theme Default', '__theme_txtd' ),
			'preview' => array(
				// @todo EXAMPLE!!! PLEASE DO NOT LEAVE IT LIKE THIS!!!
				'background_image_url' => 'https://cloud.pixelgrade.com/wp-content/uploads/2018/07/boilerplate-palette-e1531482820427.jpg',
			),
			'options' => array(
				'sm_color_primary' => SM_COLOR_PRIMARY,
				'sm_color_secondary' => SM_COLOR_SECONDARY,
				'sm_color_tertiary' => SM_COLOR_TERTIARY,
				'sm_dark_primary' => SM_DARK_PRIMARY,
				'sm_dark_secondary' => SM_DARK_SECONDARY,
				'sm_dark_tertiary' => SM_DARK_TERTIARY,
				'sm_light_primary' => SM_LIGHT_PRIMARY,
				'sm_light_secondary' => SM_LIGHT_SECONDARY,
				'sm_light_tertiary' => SM_LIGHT_TERTIARY,
			),
		),
	), $color_palettes);

	return $color_palettes;
}
add_filter( 'customify_get_color_palettes', 'boilerplate_add_default_color_palette' );
